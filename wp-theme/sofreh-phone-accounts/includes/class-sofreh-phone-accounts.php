<?php
/**
 * Phone-number checkout with automatic customer accounts.
 *
 * Flow:
 * 1. Checkout always allows buying without signing in first (no redirect to a
 *    registration page) and requires a mobile number.
 * 2. When a signed-out customer's order is paid (the gateway confirms the
 *    payment, or WooCommerce moves the order to a paid status such as
 *    "processing" for cash on delivery), an account is created with the
 *    mobile number as username and a generated password. The order is
 *    attached to it and, in the buyer's own browser, the customer is signed
 *    in, the same way WooCommerce's own checkout sign-up does. Unpaid,
 *    failed or cancelled orders never create accounts.
 * 3. The order confirmation page shows the order tracking code with the
 *    account confirmation and login details beside it. The password is kept
 *    only in the customer's own session, for a limited time, and is never
 *    stored in the order or sent by email. If the payment was confirmed by a
 *    server-to-server callback while the buyer was away, the account is
 *    created then and its password is set and shown when the buyer opens the
 *    confirmation page in the browser that placed the order.
 * 4. Customers can sign in later with the mobile number (Persian digits and
 *    +98 forms accepted) and complete their account details.
 * 5. "Create account" (manual sign-up) sits beside "Log in" on the My Account
 *    page and is offered at checkout; it asks for the mobile number too,
 *    which becomes the username, so every account signs in the same way.
 *
 * @package SofrehPhoneAccounts
 */

defined( 'ABSPATH' ) || exit;

/**
 * Main plugin class.
 */
final class Sofreh_Phone_Accounts {

	/** Session key holding just-created credentials. */
	const SESSION_KEY = 'sofreh_pa_new_account';

	/** How long the confirmation page may show the password (seconds). */
	const SHOW_PASSWORD_FOR = 1800;

	/** User meta: account was created at checkout and is not completed yet. */
	const META_INCOMPLETE = 'sofreh_pa_incomplete';

	/** Option holding the order tracking page ID. */
	const OPTION_TRACKING_PAGE = 'sofreh_pa_tracking_page_id';

	/** Session key: the order this browser placed without signing in. */
	const SESSION_ORDER = 'sofreh_pa_guest_order';

	/** Order meta: placed at checkout by a signed-out customer. */
	const META_GUEST = '_sofreh_pa_guest_checkout';

	/** Order meta: the account step for this order is finished. */
	const META_DONE = '_sofreh_pa_account_done';

	/** Order meta: an account was created while the buyer was away; set and show its password on their next visit. */
	const META_REVEAL = '_sofreh_pa_reveal_pending';

	/**
	 * Singleton.
	 *
	 * @var Sofreh_Phone_Accounts|null
	 */
	private static $instance = null;

	/**
	 * Get the instance.
	 *
	 * @return Sofreh_Phone_Accounts
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Register hooks.
	 */
	private function __construct() {
		add_action( 'init', array( $this, 'load_textdomain' ) );

		// 1. Checkout rules.
		add_filter( 'woocommerce_checkout_registration_required', '__return_false', 20 );
		add_filter( 'woocommerce_checkout_registration_enabled', '__return_false', 20 );
		add_filter( 'pre_option_woocommerce_checkout_phone_field', array( $this, 'phone_field_required' ) );
		add_filter( 'woocommerce_billing_fields', array( $this, 'classic_billing_fields' ), 20 );
		add_filter( 'woocommerce_default_address_fields', array( $this, 'default_phone_label' ), 20 );
		add_action( 'woocommerce_after_checkout_validation', array( $this, 'classic_validate_mobile' ), 10, 2 );
		add_action( 'woocommerce_checkout_create_order', array( $this, 'classic_normalize_order_phone' ), 10 );
		add_action( 'woocommerce_store_api_checkout_update_order_from_request', array( $this, 'blocks_validate_mobile' ), 10 );

		// 2. Account creation once the order is paid.
		add_action( 'woocommerce_checkout_order_processed', array( $this, 'classic_order_processed' ), 20, 3 );
		add_action( 'woocommerce_store_api_checkout_order_processed', array( $this, 'mark_guest_order' ), 20 );
		add_action( 'woocommerce_payment_complete', array( $this, 'on_payment_complete' ) );
		add_action( 'woocommerce_order_status_changed', array( $this, 'on_status_changed' ), 10, 4 );

		// 3. Order confirmation page.
		add_action( 'template_redirect', array( $this, 'on_confirmation_page' ), 5 );
		add_action( 'woocommerce_before_thankyou', array( $this, 'render_confirmation' ), 5 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );

		// 4. Signing in and completing the account.
		add_action( 'wp_authenticate', array( $this, 'normalize_login' ), 1, 2 );
		add_action( 'woocommerce_login_form_start', array( $this, 'login_hint' ) );
		if ( ! is_admin() ) {
			add_filter( 'gettext_woocommerce', array( $this, 'login_label' ), 10, 2 );
		}
		add_action( 'woocommerce_account_dashboard', array( $this, 'dashboard_notice' ), 5 );
		add_action( 'woocommerce_save_account_details', array( $this, 'mark_complete' ) );

		// 5. "Create account" with the mobile number as username.
		add_action( 'woocommerce_register_form_start', array( $this, 'register_mobile_field' ) );
		add_action( 'woocommerce_login_form_end', array( $this, 'return_field' ) );
		add_action( 'woocommerce_register_form_end', array( $this, 'return_field' ) );
		add_action( 'woocommerce_before_checkout_form', array( $this, 'checkout_account_notice' ), 15 );
		add_filter( 'render_block_woocommerce/checkout', array( $this, 'block_checkout_account_notice' ) );
		add_filter( 'woocommerce_process_registration_errors', array( $this, 'register_validate' ) );
		add_filter( 'woocommerce_new_customer_data', array( $this, 'register_username' ) );
		add_action( 'woocommerce_created_customer', array( $this, 'register_save_phone' ) );

		// Order tracking by order number + mobile.
		add_shortcode( 'sofreh_order_tracking', array( $this, 'tracking_shortcode' ) );
	}

	/**
	 * Load translations.
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'sofreh-phone-accounts', false, dirname( plugin_basename( SOFREH_PA_FILE ) ) . '/languages' );
	}

	/**
	 * On activation: allow guest checkout, turn off WooCommerce's own checkout
	 * sign-up (accounts are created automatically instead) and create the
	 * order tracking page.
	 */
	public static function activate() {
		update_option( 'woocommerce_enable_guest_checkout', 'yes' );
		update_option( 'woocommerce_enable_signup_and_login_from_checkout', 'no' );
		// Manual sign-up stays available on My Account; the mobile number is
		// the username, so WooCommerce's own username field is not shown.
		update_option( 'woocommerce_enable_myaccount_registration', 'yes' );
		update_option( 'woocommerce_registration_generate_username', 'yes' );
		// Customers choose their own password when they sign up, so they can
		// sign in straight away without waiting for an email.
		update_option( 'woocommerce_registration_generate_password', 'no' );

		$page_id = (int) get_option( self::OPTION_TRACKING_PAGE );
		if ( ! $page_id || ! get_post( $page_id ) ) {
			load_plugin_textdomain( 'sofreh-phone-accounts', false, dirname( plugin_basename( SOFREH_PA_FILE ) ) . '/languages' );
			$page_id = wp_insert_post(
				array(
					'post_type'    => 'page',
					'post_status'  => 'publish',
					'post_title'   => __( 'Track your order', 'sofreh-phone-accounts' ),
					'post_name'    => 'order-tracking',
					'post_content' => '<!-- wp:shortcode -->[sofreh_order_tracking]<!-- /wp:shortcode -->',
				)
			);
			if ( $page_id && ! is_wp_error( $page_id ) ) {
				update_option( self::OPTION_TRACKING_PAGE, (int) $page_id );
			}
		}
	}

	/*
	 * ---------------------------------------------------------------------
	 * Mobile numbers
	 * ---------------------------------------------------------------------
	 */

	/**
	 * Normalize an Iranian mobile number to 09XXXXXXXXX.
	 *
	 * Accepts Persian/Arabic digits, spaces, dashes, brackets and the +98 /
	 * 0098 / 98 prefixes. Returns '' when the input is not a mobile number.
	 *
	 * @param string $raw Input.
	 * @return string
	 */
	public static function normalize_mobile( $raw ) {
		$raw = (string) $raw;
		$map = array();
		for ( $i = 0; $i <= 9; $i++ ) {
			$map[ html_entity_decode( '&#' . ( 0x06F0 + $i ) . ';', ENT_QUOTES, 'UTF-8' ) ] = (string) $i;
			$map[ html_entity_decode( '&#' . ( 0x0660 + $i ) . ';', ENT_QUOTES, 'UTF-8' ) ] = (string) $i;
		}
		$digits = preg_replace( '/[\s\-\(\)\.]/u', '', strtr( $raw, $map ) );

		if ( 0 === strpos( $digits, '+98' ) ) {
			$digits = '0' . substr( $digits, 3 );
		} elseif ( 0 === strpos( $digits, '0098' ) ) {
			$digits = '0' . substr( $digits, 4 );
		} elseif ( 12 === strlen( $digits ) && 0 === strpos( $digits, '98' ) ) {
			$digits = '0' . substr( $digits, 2 );
		} elseif ( 10 === strlen( $digits ) && 0 === strpos( $digits, '9' ) ) {
			$digits = '0' . $digits;
		}

		/**
		 * Filters the normalized mobile number. Return '' to reject it.
		 * Stores outside Iran can replace the format check here.
		 *
		 * @param string $mobile Normalized number, or '' when invalid.
		 * @param string $raw    What the customer typed.
		 */
		return (string) apply_filters( 'sofreh_pa_normalize_mobile', preg_match( '/^09\d{9}$/', $digits ) ? $digits : '', $raw );
	}

	/**
	 * Error message for an invalid mobile number.
	 *
	 * @return string
	 */
	private function invalid_mobile_message() {
		return __( 'Please enter a valid mobile number, for example 09121234567. It becomes your username for signing in.', 'sofreh-phone-accounts' );
	}

	/*
	 * ---------------------------------------------------------------------
	 * 1. Checkout rules
	 * ---------------------------------------------------------------------
	 */

	/**
	 * The phone field is always required: it is the customer's username.
	 *
	 * @return string
	 */
	public function phone_field_required() {
		return 'required';
	}

	/**
	 * Classic checkout: mobile first and required, email optional.
	 *
	 * The Checkout block always asks for an email address (WooCommerce does
	 * not offer a way to make it optional there); on the classic checkout it
	 * becomes optional.
	 *
	 * @param array $fields Billing fields.
	 * @return array
	 */
	public function classic_billing_fields( $fields ) {
		if ( isset( $fields['billing_phone'] ) ) {
			$fields['billing_phone']['required']    = true;
			$fields['billing_phone']['label']       = __( 'Mobile number', 'sofreh-phone-accounts' );
			$fields['billing_phone']['placeholder'] = '09121234567';
			if ( ! is_user_logged_in() ) {
				$fields['billing_phone']['description'] = __( 'Once your payment is confirmed, your account is created with this number and your password is shown on the confirmation page.', 'sofreh-phone-accounts' );
			}
		}
		if ( isset( $fields['billing_email'] ) ) {
			$fields['billing_email']['required'] = false;
		}
		return $fields;
	}

	/**
	 * Label the phone field "Mobile number" in the default address fields too:
	 * WooCommerce's address script relabels fields from these defaults when
	 * the country changes.
	 *
	 * @param array $fields Default address fields.
	 * @return array
	 */
	public function default_phone_label( $fields ) {
		if ( isset( $fields['phone'] ) ) {
			$fields['phone']['label']       = __( 'Mobile number', 'sofreh-phone-accounts' );
			$fields['phone']['placeholder'] = '09121234567';
		}
		return $fields;
	}

	/**
	 * Classic checkout: the billing phone must be a mobile number.
	 *
	 * @param array    $data   Posted data.
	 * @param WP_Error $errors Errors.
	 */
	public function classic_validate_mobile( $data, $errors ) {
		if ( is_user_logged_in() ) {
			return;
		}
		$raw = isset( $data['billing_phone'] ) ? $data['billing_phone'] : '';
		if ( '' === self::normalize_mobile( $raw ) ) {
			$errors->add( 'billing_phone_validation', $this->invalid_mobile_message(), array( 'id' => 'billing_phone' ) );
		}
	}

	/**
	 * Classic checkout: store the phone in its normalized form.
	 *
	 * @param WC_Order $order Order.
	 */
	public function classic_normalize_order_phone( $order ) {
		$mobile = self::normalize_mobile( $order->get_billing_phone() );
		if ( '' !== $mobile ) {
			$order->set_billing_phone( $mobile );
		}
	}

	/**
	 * Checkout block (Store API): validate and normalize the mobile number.
	 * The exception is shown to the customer as a checkout error.
	 *
	 * @param WC_Order $order Order being built from the request.
	 * @throws \Automattic\WooCommerce\StoreApi\Exceptions\RouteException When the number is invalid.
	 */
	public function blocks_validate_mobile( $order ) {
		$mobile = self::normalize_mobile( $order->get_billing_phone() );
		if ( '' === $mobile ) {
			if ( is_user_logged_in() ) {
				return;
			}
			throw new \Automattic\WooCommerce\StoreApi\Exceptions\RouteException( 'sofreh_pa_invalid_mobile', esc_html( $this->invalid_mobile_message() ), 400 );
		}
		$order->set_billing_phone( $mobile );
	}

	/*
	 * ---------------------------------------------------------------------
	 * 2. Account creation
	 * ---------------------------------------------------------------------
	 */

	/**
	 * Classic checkout adapter.
	 *
	 * @param int      $order_id Order ID.
	 * @param array    $posted   Posted data.
	 * @param WC_Order $order    Order.
	 */
	public function classic_order_processed( $order_id, $posted, $order ) {
		$this->mark_guest_order( $order instanceof WC_Order ? $order : wc_get_order( $order_id ) );
	}

	/**
	 * Remember that this browser placed the order without signing in. Runs
	 * before the payment is taken, so no account is created yet.
	 *
	 * @param WC_Order $order Order.
	 */
	public function mark_guest_order( $order ) {
		if ( ! $order instanceof WC_Order || is_user_logged_in() || $order->get_customer_id() ) {
			return;
		}
		$order->update_meta_data( self::META_GUEST, 1 );
		$order->save_meta_data();
		if ( WC()->session ) {
			WC()->session->set( self::SESSION_ORDER, $order->get_id() );
		}
	}

	/**
	 * The gateway reported a successful payment.
	 *
	 * @param int $order_id Order ID.
	 */
	public function on_payment_complete( $order_id ) {
		$this->create_account_for_paid_order( wc_get_order( $order_id ) );
	}

	/**
	 * The order moved to a paid status (for example "processing" for cash on
	 * delivery, or when the store marks a bank transfer as received).
	 *
	 * @param int      $order_id Order ID.
	 * @param string   $from     Old status.
	 * @param string   $to       New status.
	 * @param WC_Order $order    Order.
	 */
	public function on_status_changed( $order_id, $from, $to, $order ) {
		if ( in_array( $to, wc_get_is_paid_statuses(), true ) ) {
			$this->create_account_for_paid_order( $order instanceof WC_Order ? $order : wc_get_order( $order_id ) );
		}
	}

	/**
	 * Is this request the buyer's own browser session for the order?
	 *
	 * @param WC_Order $order Order.
	 * @return bool
	 */
	private function is_buyer_session( $order ) {
		return ! is_user_logged_in()
			&& WC()->session
			&& (int) WC()->session->get( self::SESSION_ORDER ) === (int) $order->get_id();
	}

	/**
	 * Create an account for a paid order placed without signing in, and
	 * attach the order to it. In the buyer's own browser the customer is
	 * signed in and the login details are kept for the confirmation page;
	 * otherwise (a server callback) the password is set and shown when the
	 * buyer next opens the confirmation page.
	 *
	 * @param WC_Order|false $order Order.
	 */
	public function create_account_for_paid_order( $order ) {
		if ( ! $order instanceof WC_Order || ! $order->is_paid() || $order->get_customer_id() ) {
			return;
		}
		if ( ! $order->get_meta( self::META_GUEST ) || $order->get_meta( self::META_DONE ) ) {
			return;
		}

		$in_session = $this->is_buyer_session( $order );
		$mobile     = self::normalize_mobile( $order->get_billing_phone() );

		$order->update_meta_data( self::META_DONE, 1 );
		$order->save_meta_data();

		if ( '' === $mobile ) {
			return;
		}

		// An account with this number already exists: never attach the order
		// to it; the confirmation page suggests signing in.
		if ( username_exists( $mobile ) ) {
			if ( $in_session ) {
				$this->remember(
					array(
						'order_id' => $order->get_id(),
						'existing' => true,
					)
				);
			}
			return;
		}

		$password = self::generate_password();
		$email    = $order->get_billing_email();
		if ( ! is_email( $email ) || email_exists( $email ) ) {
			$email = ''; // WordPress allows accounts without email; the customer can add one later.
		}

		$first = $order->get_billing_first_name();
		$last  = $order->get_billing_last_name();

		$user_id = wp_insert_user(
			array(
				'user_login'   => $mobile,
				'user_pass'    => $password,
				'user_email'   => $email,
				'first_name'   => $first,
				'last_name'    => $last,
				'display_name' => trim( $first . ' ' . $last ) ? trim( $first . ' ' . $last ) : $mobile,
				'role'         => 'customer',
			)
		);

		if ( is_wp_error( $user_id ) ) {
			wc_get_logger()->warning( 'Could not create an account for order ' . $order->get_id() . ': ' . $user_id->get_error_message(), array( 'source' => 'sofreh-phone-accounts' ) );
			return;
		}

		update_user_meta( $user_id, self::META_INCOMPLETE, 1 );

		// Save the checkout addresses to the new account.
		$customer = new WC_Customer( $user_id );
		foreach ( array( 'billing', 'shipping' ) as $type ) {
			foreach ( array( 'first_name', 'last_name', 'company', 'address_1', 'address_2', 'city', 'state', 'postcode', 'country', 'phone' ) as $field ) {
				$getter = "get_{$type}_{$field}";
				$setter = "set_{$type}_{$field}";
				if ( is_callable( array( $order, $getter ) ) && is_callable( array( $customer, $setter ) ) ) {
					$customer->{$setter}( $order->{$getter}() );
				}
			}
		}
		if ( $email ) {
			$customer->set_billing_email( $email );
		}
		$customer->save();

		$order->set_customer_id( $user_id );
		if ( ! $in_session ) {
			$order->update_meta_data( self::META_REVEAL, 1 );
		}
		$order->add_order_note( __( 'Payment confirmed: customer account created automatically from the mobile number.', 'sofreh-phone-accounts' ) );
		$order->save();

		/** This action is documented in woocommerce/includes/wc-user-functions.php */
		do_action(
			'woocommerce_created_customer',
			$user_id,
			array(
				'user_login' => $mobile,
				'user_email' => $email,
				'role'       => 'customer',
				'source'     => 'sofreh-phone-checkout',
			),
			true
		);

		if ( $in_session ) {
			$this->sign_in_and_remember( $order, $user_id, $mobile, $password );
		}
	}

	/**
	 * Confirmation page, before anything is printed: create the account if
	 * the order is paid but the paid hooks ran before this browser was
	 * recognised, and reveal an account created while the buyer was away.
	 * Only for the browser session that placed the order, with its order key.
	 */
	public function on_confirmation_page() {
		if ( ! function_exists( 'is_order_received_page' ) || ! is_order_received_page() ) {
			return;
		}
		global $wp;
		$order = wc_get_order( absint( isset( $wp->query_vars['order-received'] ) ? $wp->query_vars['order-received'] : 0 ) );
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- The order key is the capability, as in WooCommerce.
		$key = isset( $_GET['key'] ) ? sanitize_text_field( wp_unslash( $_GET['key'] ) ) : '';
		if ( ! $order || ! is_string( $key ) || ! hash_equals( $order->get_order_key(), $key ) || ! $this->is_buyer_session( $order ) ) {
			return;
		}

		$this->create_account_for_paid_order( $order );

		if ( ! $order->get_meta( self::META_REVEAL ) || ! $this->is_buyer_session( $order ) ) {
			return;
		}
		$user = get_userdata( $order->get_customer_id() );
		if ( ! $user || ! in_array( 'customer', (array) $user->roles, true ) ) {
			return;
		}
		// Nobody has seen this password yet: set a fresh one now and show it.
		$password = self::generate_password();
		wp_set_password( $password, $user->ID );
		$order->delete_meta_data( self::META_REVEAL );
		$order->save_meta_data();
		$this->sign_in_and_remember( $order, $user->ID, $user->user_login, $password );
	}

	/**
	 * Sign the new customer in and keep the login details for the
	 * confirmation page.
	 *
	 * @param WC_Order $order    Order.
	 * @param int      $user_id  User ID.
	 * @param string   $username Username.
	 * @param string   $password Password.
	 */
	private function sign_in_and_remember( $order, $user_id, $username, $password ) {
		// Sign the customer in, as WooCommerce does for accounts created at
		// checkout. Without this, WooCommerce (8.4+) would hide the order
		// confirmation page behind a login form.
		wc_set_customer_auth_cookie( $user_id );

		// Remember the credentials only after signing in: signing in moves the
		// session from the guest ID to the user ID.
		$this->remember(
			array(
				'order_id' => $order->get_id(),
				'username' => $username,
				'password' => $password,
				'expires'  => time() + self::SHOW_PASSWORD_FOR,
			)
		);
	}

	/**
	 * Store data in the customer's session.
	 *
	 * @param array $data Data.
	 */
	private function remember( $data ) {
		if ( WC()->session ) {
			WC()->session->set( self::SESSION_KEY, $data );
		}
	}

	/**
	 * A readable random password (no 0/O, 1/l/I look-alikes).
	 *
	 * @param int $length Length.
	 * @return string
	 */
	public static function generate_password( $length = 10 ) {
		$chars = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789';
		$max   = strlen( $chars ) - 1;
		do {
			$password = '';
			for ( $i = 0; $i < $length; $i++ ) {
				$password .= $chars[ random_int( 0, $max ) ];
			}
		} while ( ! preg_match( '/\d/', $password ) || ! preg_match( '/[a-z]/', $password ) || ! preg_match( '/[A-Z]/', $password ) );
		return $password;
	}

	/*
	 * ---------------------------------------------------------------------
	 * 3. Order confirmation page
	 * ---------------------------------------------------------------------
	 */

	/**
	 * Tracking code, with the account confirmation and login details beside it.
	 *
	 * @param int $order_id Order ID.
	 */
	public function render_confirmation( $order_id ) {
		$order = wc_get_order( $order_id );
		if ( ! $order ) {
			return;
		}

		$stash       = WC()->session ? WC()->session->get( self::SESSION_KEY ) : null;
		$stash       = ( is_array( $stash ) && (int) $stash['order_id'] === (int) $order->get_id() ) ? $stash : null;
		$credentials = null;

		if ( $stash && ! empty( $stash['password'] ) ) {
			$user = wp_get_current_user();
			if ( $stash['expires'] > time() && $user->exists() && $user->user_login === $stash['username'] && (int) $order->get_customer_id() === $user->ID ) {
				$credentials = $stash;
			} else {
				WC()->session->set( self::SESSION_KEY, null ); // Expired or not this customer: forget it.
			}
		}

		$guest_order = (bool) $order->get_meta( self::META_GUEST );
		$state       = '';
		if ( $credentials ) {
			$state = 'created';
		} elseif ( $stash && ! empty( $stash['existing'] ) ) {
			$state = 'existing';
		} elseif ( $guest_order && $order->get_customer_id() && get_current_user_id() === (int) $order->get_customer_id() ) {
			$state = 'created-earlier';
		} elseif ( $guest_order && ! $order->get_customer_id() && ! $order->is_paid() && ! $order->has_status( array( 'failed', 'cancelled', 'refunded' ) ) ) {
			$state = 'awaiting';
		}

		$tracking_url = $this->tracking_url();
		$account_url  = wc_get_page_permalink( 'myaccount' );
		?>
		<section class="sofreh-pa-card<?php echo $state ? ' sofreh-pa-card--split' : ''; ?>" aria-labelledby="sofreh-pa-title">
			<div class="sofreh-pa-card__row sofreh-pa-card__row--tracking">
				<div>
					<h2 id="sofreh-pa-title" class="sofreh-pa-card__title"><?php esc_html_e( 'Your order tracking code', 'sofreh-phone-accounts' ); ?></h2>
					<p class="sofreh-pa-card__help">
						<?php
						if ( $tracking_url ) {
							printf(
								/* translators: %s: link to the order tracking page. */
								wp_kses( __( 'Use it with your mobile number on the <a href="%s">order tracking page</a>.', 'sofreh-phone-accounts' ), array( 'a' => array( 'href' => true ) ) ),
								esc_url( $tracking_url )
							);
						} else {
							esc_html_e( 'Keep it to follow up on your order.', 'sofreh-phone-accounts' );
						}
						?>
					</p>
				</div>
				<?php $this->copy_value( $order->get_order_number(), __( 'Copy tracking code', 'sofreh-phone-accounts' ), 'sofreh-pa-value--large' ); ?>
			</div>

			<?php if ( 'created' === $state ) : ?>
				<div class="sofreh-pa-card__row sofreh-pa-card__row--account" role="status">
					<h3 class="sofreh-pa-card__subtitle sofreh-pa-card__subtitle--done"><?php esc_html_e( 'Your account has been created', 'sofreh-phone-accounts' ); ?></h3>
					<p class="sofreh-pa-card__help"><?php esc_html_e( 'Your payment was confirmed and you are signed in. Use these details to sign in next time, then complete your account information whenever you like.', 'sofreh-phone-accounts' ); ?></p>
					<dl class="sofreh-pa-credentials">
						<div>
							<dt><?php esc_html_e( 'Username (your mobile number)', 'sofreh-phone-accounts' ); ?></dt>
							<dd><?php $this->copy_value( $credentials['username'], __( 'Copy username', 'sofreh-phone-accounts' ) ); ?></dd>
						</div>
						<div>
							<dt><?php esc_html_e( 'Password', 'sofreh-phone-accounts' ); ?></dt>
							<dd><?php $this->copy_value( $credentials['password'], __( 'Copy password', 'sofreh-phone-accounts' ) ); ?></dd>
						</div>
					</dl>
					<p class="sofreh-pa-card__warning">
						<?php
						printf(
							/* translators: %s: number of minutes. */
							esc_html__( 'Write the password down or save it now: for your security it is shown only on this page, for %s minutes, and is never sent by email or text message.', 'sofreh-phone-accounts' ),
							esc_html( number_format_i18n( self::SHOW_PASSWORD_FOR / 60 ) )
						);
						?>
					</p>
					<p class="sofreh-pa-card__actions">
						<a class="button" href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>"><?php esc_html_e( 'Complete your account', 'sofreh-phone-accounts' ); ?></a>
						<a class="button button--ghost" href="<?php echo esc_url( $account_url ); ?>"><?php esc_html_e( 'Go to my account', 'sofreh-phone-accounts' ); ?></a>
					</p>
				</div>
			<?php elseif ( 'created-earlier' === $state ) : ?>
				<div class="sofreh-pa-card__row sofreh-pa-card__row--account">
					<h3 class="sofreh-pa-card__subtitle sofreh-pa-card__subtitle--done"><?php esc_html_e( 'Your account has been created', 'sofreh-phone-accounts' ); ?></h3>
					<p class="sofreh-pa-card__help">
						<?php
						printf(
							/* translators: %s: the customer's mobile number (username). */
							esc_html__( 'This order is saved in your account. Sign in with %s and your password.', 'sofreh-phone-accounts' ),
							'<bdi dir="ltr">' . esc_html( wp_get_current_user()->user_login ) . '</bdi>' // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in place.
						);
						?>
					</p>
					<p class="sofreh-pa-card__actions">
						<a class="button" href="<?php echo esc_url( $account_url ); ?>"><?php esc_html_e( 'Go to my account', 'sofreh-phone-accounts' ); ?></a>
					</p>
				</div>
			<?php elseif ( 'existing' === $state ) : ?>
				<div class="sofreh-pa-card__row sofreh-pa-card__row--account">
					<h3 class="sofreh-pa-card__subtitle"><?php esc_html_e( 'You already have an account', 'sofreh-phone-accounts' ); ?></h3>
					<p class="sofreh-pa-card__help">
						<?php
						printf(
							/* translators: %s: link to the account page. */
							wp_kses( __( 'If you already have an account with this mobile number, <a href="%s">sign in</a> to see your orders there.', 'sofreh-phone-accounts' ), array( 'a' => array( 'href' => true ) ) ),
							esc_url( $account_url )
						);
						?>
					</p>
				</div>
			<?php elseif ( 'awaiting' === $state ) : ?>
				<div class="sofreh-pa-card__row sofreh-pa-card__row--account">
					<h3 class="sofreh-pa-card__subtitle sofreh-pa-card__subtitle--waiting"><?php esc_html_e( 'Your account is created after payment', 'sofreh-phone-accounts' ); ?></h3>
					<p class="sofreh-pa-card__help"><?php esc_html_e( 'As soon as your payment is confirmed, an account is created with your mobile number. Open this page again in this browser to see your login details.', 'sofreh-phone-accounts' ); ?></p>
				</div>
			<?php endif; ?>
		</section>
		<?php
	}

	/**
	 * A value with a copy button.
	 *
	 * @param string $value Value.
	 * @param string $label Accessible label for the copy button.
	 * @param string $extra_class Extra class.
	 */
	private function copy_value( $value, $label, $extra_class = '' ) {
		?>
		<span class="sofreh-pa-value <?php echo esc_attr( $extra_class ); ?>">
			<code dir="ltr" translate="no"><?php echo esc_html( $value ); ?></code>
			<button type="button" class="sofreh-pa-copy" data-copy="<?php echo esc_attr( $value ); ?>" aria-label="<?php echo esc_attr( $label ); ?>">
				<span class="sofreh-pa-copy__idle"><?php esc_html_e( 'Copy', 'sofreh-phone-accounts' ); ?></span>
				<span class="sofreh-pa-copy__done" aria-hidden="true"><?php esc_html_e( 'Copied', 'sofreh-phone-accounts' ); ?></span>
			</button>
		</span>
		<?php
	}

	/**
	 * Copy-button script and fallback styles on the pages that need them.
	 */
	public function enqueue_assets() {
		$needs = is_order_received_page() || ( is_singular() && has_shortcode( (string) get_post_field( 'post_content', get_queried_object_id() ), 'sofreh_order_tracking' ) );
		if ( ! $needs ) {
			return;
		}
		wp_enqueue_style( 'sofreh-pa', SOFREH_PA_URL . 'assets/sofreh-phone-accounts.css', array(), SOFREH_PA_VERSION );
		wp_enqueue_script(
			'sofreh-pa',
			SOFREH_PA_URL . 'assets/sofreh-phone-accounts.js',
			array(),
			SOFREH_PA_VERSION,
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
		wp_localize_script( 'sofreh-pa', 'sofrehPA', array( 'copied' => __( 'Copied to clipboard', 'sofreh-phone-accounts' ) ) );
	}

	/*
	 * ---------------------------------------------------------------------
	 * 4. Signing in and completing the account
	 * ---------------------------------------------------------------------
	 */

	/**
	 * Accept the mobile number in any common form at sign-in (Persian digits,
	 * +98, spaces) by mapping it to the stored username.
	 *
	 * @param string $username Username, by reference.
	 */
	public function normalize_login( &$username ) {
		if ( ! is_string( $username ) || '' === $username || false !== strpos( $username, '@' ) ) {
			return;
		}
		$mobile = self::normalize_mobile( $username );
		if ( '' !== $mobile && $mobile !== $username && username_exists( $mobile ) ) {
			$username = $mobile;
		}
	}

	/**
	 * The login form's "Username or email address" label names what customers
	 * actually type here: their mobile number (the username) or their email.
	 *
	 * @param string $translation Translated text.
	 * @param string $text        Original text.
	 * @return string
	 */
	public function login_label( $translation, $text ) {
		if ( 'Username or email address' === $text ) {
			return __( 'Mobile number or email', 'sofreh-phone-accounts' );
		}
		// The sign-up form's heading and button: "Create account".
		if ( 'Register' === $text ) {
			return __( 'Create account', 'sofreh-phone-accounts' );
		}
		return $translation;
	}

	/**
	 * Hint above the login form.
	 */
	public function login_hint() {
		echo '<p class="sofreh-pa-hint">' . esc_html__( 'Bought with your mobile number? Sign in with that number and the password shown after your purchase.', 'sofreh-phone-accounts' ) . '</p>';
	}

	/**
	 * Remind new customers to complete their account.
	 */
	public function dashboard_notice() {
		if ( ! get_user_meta( get_current_user_id(), self::META_INCOMPLETE, true ) ) {
			return;
		}
		printf(
			'<div class="woocommerce-info sofreh-pa-complete">%1$s <a class="button" href="%2$s">%3$s</a></div>',
			esc_html__( 'Your account was created with your mobile number. Add your name and email and choose your own password.', 'sofreh-phone-accounts' ),
			esc_url( wc_get_account_endpoint_url( 'edit-account' ) ),
			esc_html__( 'Complete account', 'sofreh-phone-accounts' )
		);
	}

	/**
	 * Account details saved: the account is complete.
	 *
	 * @param int $user_id User ID.
	 */
	public function mark_complete( $user_id ) {
		delete_user_meta( $user_id, self::META_INCOMPLETE );
	}

	/*
	 * ---------------------------------------------------------------------
	 * 5. Manual sign-up
	 * ---------------------------------------------------------------------
	 */

	/**
	 * The posted mobile number on the registration form, normalized ('' when
	 * absent or invalid).
	 *
	 * @return string
	 */
	private function posted_register_mobile() {
		// phpcs:ignore WordPress.Security.NonceVerification.Missing -- WooCommerce verifies the registration nonce before these hooks run.
		$raw = isset( $_POST['sofreh_pa_mobile'] ) ? sanitize_text_field( wp_unslash( $_POST['sofreh_pa_mobile'] ) ) : '';
		return self::normalize_mobile( $raw );
	}

	/**
	 * Link to "Create account" on the My Account page; after signing up (or
	 * signing in there) the customer comes back to $return.
	 *
	 * @param string $return_url Page to return to.
	 * @return string
	 */
	public static function create_account_url( $return_url = '' ) {
		$url = add_query_arg( 'action', 'register', wc_get_page_permalink( 'myaccount' ) );
		if ( $return_url ) {
			$url = add_query_arg( 'redirect_to', rawurlencode( $return_url ), $url );
		}
		return $url;
	}

	/**
	 * Send the customer back where they came from (for example the checkout)
	 * after signing in or creating an account. Only addresses on this site.
	 */
	public function return_field() {
		if ( is_checkout() ) {
			return; // The checkout's own login form already returns to the checkout.
		}
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only return address, validated below.
		$target = isset( $_GET['redirect_to'] ) ? wp_validate_redirect( esc_url_raw( wp_unslash( $_GET['redirect_to'] ) ), '' ) : '';
		if ( $target ) {
			echo '<input type="hidden" name="redirect" value="' . esc_url( $target ) . '">';
		}
	}

	/**
	 * The account choice, shown at checkout to signed-out customers.
	 *
	 * @return string
	 */
	private function checkout_account_notice_html() {
		if ( is_user_logged_in() || 'yes' !== get_option( 'woocommerce_enable_myaccount_registration' ) ) {
			return '';
		}
		$link = sprintf(
			'<a class="sofreh-pa-create-link" href="%1$s">%2$s</a>',
			esc_url( self::create_account_url( wc_get_checkout_url() ) ),
			esc_html__( 'Create account', 'sofreh-phone-accounts' )
		);
		return '<div class="woocommerce-info sofreh-pa-checkout-account" role="note">' . sprintf(
			/* translators: %s: "Create account" link. */
			esc_html__( 'No account yet? %s first, or simply place your order: once your payment is confirmed, an account is created for you with your mobile number.', 'sofreh-phone-accounts' ),
			$link
		) . '</div>';
	}

	/**
	 * Classic checkout: the account choice above the form.
	 */
	public function checkout_account_notice() {
		echo $this->checkout_account_notice_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped while building.
	}

	/**
	 * Checkout block: the same account choice above the block.
	 *
	 * @param string $content Block HTML.
	 * @return string
	 */
	public function block_checkout_account_notice( $content ) {
		return $this->checkout_account_notice_html() . $content;
	}

	/**
	 * Mobile number field at the top of the registration form.
	 */
	public function register_mobile_field() {
		// phpcs:ignore WordPress.Security.NonceVerification.Missing -- Only re-fills the field after a failed submit.
		$value = isset( $_POST['sofreh_pa_mobile'] ) ? sanitize_text_field( wp_unslash( $_POST['sofreh_pa_mobile'] ) ) : '';
		?>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide sofreh-pa-register-mobile">
			<label for="reg_sofreh_pa_mobile"><?php esc_html_e( 'Mobile number', 'sofreh-phone-accounts' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'sofreh-phone-accounts' ); ?></span></label>
			<input type="tel" class="woocommerce-Input woocommerce-Input--text input-text" name="sofreh_pa_mobile" id="reg_sofreh_pa_mobile" autocomplete="tel" inputmode="tel" placeholder="09121234567" value="<?php echo esc_attr( $value ); ?>" required aria-required="true" aria-describedby="reg_sofreh_pa_mobile_desc">
			<span class="description" id="reg_sofreh_pa_mobile_desc"><?php esc_html_e( 'You will sign in with this number.', 'sofreh-phone-accounts' ); ?></span>
		</p>
		<?php
	}

	/**
	 * Validate the mobile number on registration.
	 *
	 * @param WP_Error $errors Errors.
	 * @return WP_Error
	 */
	public function register_validate( $errors ) {
		$mobile = $this->posted_register_mobile();
		if ( '' === $mobile ) {
			$errors->add( 'sofreh_pa_mobile', $this->invalid_mobile_message() );
		} elseif ( username_exists( $mobile ) ) {
			$errors->add( 'sofreh_pa_mobile_taken', __( 'An account with this mobile number already exists. Please sign in instead.', 'sofreh-phone-accounts' ) );
		}
		return $errors;
	}

	/**
	 * Use the mobile number as the username for accounts created on the
	 * registration form.
	 *
	 * @param array $data New customer data.
	 * @return array
	 */
	public function register_username( $data ) {
		// phpcs:ignore WordPress.Security.NonceVerification.Missing -- WooCommerce verified the registration nonce.
		if ( empty( $_POST['register'] ) ) {
			return $data;
		}
		$mobile = $this->posted_register_mobile();
		if ( '' !== $mobile && ! username_exists( $mobile ) ) {
			$data['user_login'] = $mobile;
		}
		return $data;
	}

	/**
	 * Save the mobile number to the new account's billing phone.
	 *
	 * @param int $user_id User ID.
	 */
	public function register_save_phone( $user_id ) {
		// phpcs:ignore WordPress.Security.NonceVerification.Missing -- WooCommerce verified the registration nonce.
		if ( empty( $_POST['register'] ) ) {
			return;
		}
		$mobile = $this->posted_register_mobile();
		if ( '' !== $mobile ) {
			update_user_meta( $user_id, 'billing_phone', $mobile );
		}
	}

	/*
	 * ---------------------------------------------------------------------
	 * Order tracking
	 * ---------------------------------------------------------------------
	 */

	/**
	 * URL of the tracking page, if it exists.
	 *
	 * @return string
	 */
	private function tracking_url() {
		$page_id = (int) get_option( self::OPTION_TRACKING_PAGE );
		return ( $page_id && 'publish' === get_post_status( $page_id ) ) ? get_permalink( $page_id ) : '';
	}

	/**
	 * [sofreh_order_tracking]: look up an order by tracking code and mobile.
	 *
	 * Only status, date, total and item names are shown; addresses and other
	 * personal details never are.
	 *
	 * @return string
	 */
	public function tracking_shortcode() {
		$result = null;
		$error  = '';
		$code   = '';
		$phone  = '';

		if ( isset( $_POST['sofreh_pa_track_nonce'] ) ) {
			if ( ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['sofreh_pa_track_nonce'] ) ), 'sofreh_pa_track' ) ) {
				$error = __( 'The form has expired. Please try again.', 'sofreh-phone-accounts' );
			} else {
				$code  = isset( $_POST['sofreh_pa_code'] ) ? sanitize_text_field( wp_unslash( $_POST['sofreh_pa_code'] ) ) : '';
				$phone = isset( $_POST['sofreh_pa_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['sofreh_pa_phone'] ) ) : '';

				$mobile   = self::normalize_mobile( $phone );
				$order_id = absint( preg_replace( '/\D/', '', self::normalize_mobile_digits_only( $code ) ) );
				/** This filter is documented in woocommerce/includes/shortcodes/class-wc-shortcode-order-tracking.php */
				$order_id = absint( apply_filters( 'woocommerce_shortcode_order_tracking_order_id', $order_id ) );
				$order    = $order_id ? wc_get_order( $order_id ) : false;

				if ( $order instanceof WC_Order && '' !== $mobile && hash_equals( self::normalize_mobile( $order->get_billing_phone() ), $mobile ) ) {
					$result = $order;
				} else {
					$error = __( 'No order matches this tracking code and mobile number.', 'sofreh-phone-accounts' );
				}
			}
		}

		ob_start();
		?>
		<div class="sofreh-pa-tracking">
			<form method="post" class="sofreh-pa-tracking__form">
				<p class="sofreh-pa-tracking__intro"><?php esc_html_e( 'Enter the tracking code shown after your purchase and the mobile number you ordered with.', 'sofreh-phone-accounts' ); ?></p>
				<p class="form-row">
					<label for="sofreh-pa-code"><?php esc_html_e( 'Tracking code', 'sofreh-phone-accounts' ); ?></label>
					<input type="text" inputmode="numeric" id="sofreh-pa-code" name="sofreh_pa_code" value="<?php echo esc_attr( $code ); ?>" required autocomplete="off">
				</p>
				<p class="form-row">
					<label for="sofreh-pa-phone"><?php esc_html_e( 'Mobile number', 'sofreh-phone-accounts' ); ?></label>
					<input type="tel" id="sofreh-pa-phone" name="sofreh_pa_phone" value="<?php echo esc_attr( $phone ); ?>" placeholder="09121234567" required autocomplete="tel">
				</p>
				<?php wp_nonce_field( 'sofreh_pa_track', 'sofreh_pa_track_nonce' ); ?>
				<p><button type="submit" class="button"><?php esc_html_e( 'Track order', 'sofreh-phone-accounts' ); ?></button></p>
			</form>

			<?php if ( $error ) : ?>
				<div class="woocommerce-error" role="alert"><?php echo esc_html( $error ); ?></div>
			<?php endif; ?>

			<?php if ( $result ) : ?>
				<section class="sofreh-pa-result" aria-live="polite">
					<h2>
						<?php
						/* translators: %s: order number. */
						printf( esc_html__( 'Order %s', 'sofreh-phone-accounts' ), esc_html( $result->get_order_number() ) );
						?>
					</h2>
					<dl>
						<div><dt><?php esc_html_e( 'Status', 'sofreh-phone-accounts' ); ?></dt><dd><mark class="sofreh-pa-status sofreh-pa-status--<?php echo esc_attr( $result->get_status() ); ?>"><?php echo esc_html( wc_get_order_status_name( $result->get_status() ) ); ?></mark></dd></div>
						<div><dt><?php esc_html_e( 'Date', 'sofreh-phone-accounts' ); ?></dt><dd><?php echo esc_html( $result->get_date_created() ? wc_format_datetime( $result->get_date_created() ) : '' ); ?></dd></div>
						<div><dt><?php esc_html_e( 'Total', 'sofreh-phone-accounts' ); ?></dt><dd><?php echo wp_kses_post( $result->get_formatted_order_total() ); ?></dd></div>
					</dl>
					<ul class="sofreh-pa-items">
						<?php foreach ( $result->get_items() as $item ) : ?>
							<li><?php echo esc_html( $item->get_name() ); ?> <span>× <?php echo esc_html( number_format_i18n( $item->get_quantity() ) ); ?></span></li>
						<?php endforeach; ?>
					</ul>
					<?php if ( is_user_logged_in() && get_current_user_id() === (int) $result->get_customer_id() ) : ?>
						<p><a class="button button--ghost" href="<?php echo esc_url( $result->get_view_order_url() ); ?>"><?php esc_html_e( 'View full order', 'sofreh-phone-accounts' ); ?></a></p>
					<?php endif; ?>
				</section>
			<?php endif; ?>
		</div>
		<?php
		return (string) ob_get_clean();
	}

	/**
	 * Persian/Arabic digits to ASCII (for the tracking code field).
	 *
	 * @param string $value Value.
	 * @return string
	 */
	private static function normalize_mobile_digits_only( $value ) {
		$map = array();
		for ( $i = 0; $i <= 9; $i++ ) {
			$map[ html_entity_decode( '&#' . ( 0x06F0 + $i ) . ';', ENT_QUOTES, 'UTF-8' ) ] = (string) $i;
			$map[ html_entity_decode( '&#' . ( 0x0660 + $i ) . ';', ENT_QUOTES, 'UTF-8' ) ] = (string) $i;
		}
		return strtr( (string) $value, $map );
	}
}
