<?php
/**
 * Plugin Name:       Sofreh Phone Accounts
 * Plugin URI:        https://github.com/yns-nur/nur/tree/main/wp-theme/sofreh-phone-accounts
 * Description:       Customers buy with just their mobile number. A customer account is created automatically when the order is placed, and the order confirmation page shows the order tracking code together with the login details (mobile number as username, plus a generated password). Adds an order-tracking form that works with order number and mobile number. Companion to the Sofreh theme, but works with any theme.
 * Version:           1.0.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Requires Plugins:  woocommerce
 * WC requires at least: 9.0
 * WC tested up to:   11.2
 * Author:            Younes Nur
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       sofreh-phone-accounts
 * Domain Path:       /languages
 *
 * @package SofrehPhoneAccounts
 */

defined( 'ABSPATH' ) || exit;

define( 'SOFREH_PA_VERSION', '1.0.0' );
define( 'SOFREH_PA_FILE', __FILE__ );
define( 'SOFREH_PA_DIR', plugin_dir_path( __FILE__ ) );
define( 'SOFREH_PA_URL', plugin_dir_url( __FILE__ ) );

require SOFREH_PA_DIR . 'includes/class-sofreh-phone-accounts.php';

// Declare compatibility with WooCommerce order storage (HPOS) and the Cart/Checkout blocks.
add_action(
	'before_woocommerce_init',
	function () {
		if ( class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', SOFREH_PA_FILE, true );
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'cart_checkout_blocks', SOFREH_PA_FILE, true );
		}
	}
);

add_action(
	'plugins_loaded',
	function () {
		if ( class_exists( 'WooCommerce' ) ) {
			Sofreh_Phone_Accounts::instance();
		}
	}
);

register_activation_hook( __FILE__, array( 'Sofreh_Phone_Accounts', 'activate' ) );
