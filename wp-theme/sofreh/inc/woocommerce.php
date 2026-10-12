<?php
/**
 * WooCommerce integration.
 *
 * Integration is done entirely through WooCommerce's documented hooks and
 * filters. The theme ships no files under /woocommerce, so there are no
 * template overrides to fall out of date when WooCommerce updates.
 *
 * Loaded from functions.php only while WooCommerce is active.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

/*
 * -------------------------------------------------------------------------
 * Assets
 * -------------------------------------------------------------------------
 */

// The theme styles every WooCommerce element itself (assets/css/woocommerce.css).
// Block styles (Cart, Checkout and other WooCommerce blocks) are untouched.
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Keep the header cart count in sync after cart changes and on cached pages.
 * Since WooCommerce 7.8 the fragments script is only enqueued on demand, and
 * the header cart link needs it on every page.
 */
function sofreh_wc_scripts() {
	wp_enqueue_script( 'wc-cart-fragments' );
}
add_action( 'wp_enqueue_scripts', 'sofreh_wc_scripts', 20 );

/*
 * -------------------------------------------------------------------------
 * Layout wrappers
 * -------------------------------------------------------------------------
 */

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/**
 * Whether the current view is a product listing (shop, category, tag,
 * attribute or product search).
 *
 * @return bool
 */
function sofreh_wc_is_listing() {
	return is_shop() || is_product_taxonomy();
}

/**
 * Open the theme wrapper around WooCommerce content.
 */
function sofreh_wc_wrapper_start() {
	$classes = array( 'container', 'store-layout' );
	if ( sofreh_wc_is_listing() ) {
		$classes[] = 'store-layout--listing';
	}
	if ( is_product() ) {
		$classes[] = 'store-layout--product';
	}
	echo '<div class="' . esc_attr( implode( ' ', $classes ) ) . '">';
	echo '<main id="main" class="site-main">';
}
add_action( 'woocommerce_before_main_content', 'sofreh_wc_wrapper_start', 10 );

/**
 * Close the wrapper; product listings get the filter sidebar beside them.
 */
function sofreh_wc_wrapper_end() {
	echo '</main>';
	if ( sofreh_wc_is_listing() ) {
		sofreh_wc_filters_panel();
	}
	echo '</div>';
}
add_action( 'woocommerce_after_main_content', 'sofreh_wc_wrapper_end', 10 );

/**
 * The filters panel: a sidebar on wide screens, a dialog-like drawer on
 * small ones (opened by the "Filters" button in the shop toolbar).
 */
function sofreh_wc_filters_panel() {
	?>
	<aside id="shop-filters" class="shop-filters" aria-labelledby="shop-filters-title">
		<div class="shop-filters__head">
			<h2 id="shop-filters-title" class="shop-filters__title"><?php esc_html_e( 'Filter products', 'sofreh' ); ?></h2>
			<button type="button" class="icon-button shop-filters__close" data-sofreh-close="shop-filters">
				<?php sofreh_icon( 'close' ); ?>
				<span class="screen-reader-text"><?php esc_html_e( 'Close filters', 'sofreh' ); ?></span>
			</button>
		</div>
		<div class="shop-filters__body">
			<?php
			if ( is_active_sidebar( 'shop-sidebar' ) ) {
				dynamic_sidebar( 'shop-sidebar' );
			} else {
				the_widget(
					'WC_Widget_Product_Categories',
					array(
						'title'              => __( 'Product categories', 'sofreh' ),
						'hierarchical'       => 1,
						'count'              => 1,
						'show_children_only' => 0,
						'hide_empty'         => 1,
					),
					array(
						'before_widget' => '<section class="widget woocommerce widget_product_categories">',
						'after_widget'  => '</section>',
						'before_title'  => '<h2 class="widget-title">',
						'after_title'   => '</h2>',
					)
				);
			}
			?>
		</div>
	</aside>
	<?php
}

/*
 * -------------------------------------------------------------------------
 * Breadcrumb
 * -------------------------------------------------------------------------
 */

/**
 * Breadcrumb markup: an accessible nav with a direction-aware chevron.
 *
 * @param array $defaults Defaults.
 * @return array
 */
function sofreh_wc_breadcrumb_defaults( $defaults ) {
	$defaults['delimiter']   = '<span class="breadcrumb-sep" aria-hidden="true">' . sofreh_get_icon( 'chevron', 14 ) . '</span>';
	$defaults['wrap_before'] = '<nav class="woocommerce-breadcrumb breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', 'sofreh' ) . '">';
	$defaults['wrap_after']  = '</nav>';
	$defaults['home']        = __( 'Home', 'sofreh' );
	return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'sofreh_wc_breadcrumb_defaults' );

/*
 * -------------------------------------------------------------------------
 * Product listings
 * -------------------------------------------------------------------------
 */

/**
 * Child-category chips under the archive title, so shoppers can narrow down
 * without opening the filters. On the main shop page these are the top-level
 * categories. Skipped when WooCommerce is already set to show category tiles.
 */
function sofreh_wc_category_chips() {
	if ( is_search() || 'products' !== woocommerce_get_loop_display_mode() ) {
		return;
	}

	if ( is_shop() ) {
		$terms = sofreh_get_product_categories( 0 );
	} elseif ( is_product_category() ) {
		$terms = sofreh_get_product_categories( get_queried_object_id() );
	} else {
		return;
	}

	if ( empty( $terms ) ) {
		return;
	}

	echo '<nav class="category-chips" aria-label="' . esc_attr__( 'Categories', 'sofreh' ) . '"><ul>';
	foreach ( $terms as $term ) {
		$link = get_term_link( $term );
		if ( is_wp_error( $link ) ) {
			continue;
		}
		printf(
			'<li><a class="chip" href="%1$s">%2$s <span class="chip__count">%3$s</span></a></li>',
			esc_url( $link ),
			esc_html( $term->name ),
			esc_html( number_format_i18n( $term->count ) )
		);
	}
	echo '</ul></nav>';
}
add_action( 'woocommerce_archive_description', 'sofreh_wc_category_chips', 20 );

/**
 * Toolbar row: filter button, result count and sorting, grouped for layout.
 */
function sofreh_wc_toolbar_open() {
	echo '<div class="shop-toolbar">';
	if ( sofreh_wc_is_listing() ) {
		?>
		<button type="button" class="button button--ghost shop-toolbar__filters" aria-controls="shop-filters" aria-expanded="false" data-sofreh-open="shop-filters">
			<?php sofreh_icon( 'filter', 20 ); ?>
			<span><?php esc_html_e( 'Filters', 'sofreh' ); ?></span>
		</button>
		<?php
	}
}
add_action( 'woocommerce_before_shop_loop', 'sofreh_wc_toolbar_open', 15 );

/**
 * Close the toolbar row.
 */
function sofreh_wc_toolbar_close() {
	echo '</div>';
}
add_action( 'woocommerce_before_shop_loop', 'sofreh_wc_toolbar_close', 35 );

/**
 * Sort options as a row of links on wide screens, the way marketplace
 * listings present them. WooCommerce's own select stays for phones, where the
 * native picker is the better control. Both use WooCommerce's orderby values.
 */
function sofreh_wc_sort_links() {
	if ( ! woocommerce_products_will_display() || 1 >= (int) wc_get_loop_prop( 'total' ) ) {
		return;
	}
	$show_default = wc_get_loop_prop( 'is_search' ) ? 'relevance' : 'menu_order';
	/** This filter is documented in woocommerce/includes/wc-template-functions.php */
	$default = apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', $show_default ) );
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only sort parameter, same as WooCommerce's ordering form.
	$current = isset( $_GET['orderby'] ) ? sanitize_key( wp_unslash( $_GET['orderby'] ) ) : $default;
	$options = array(
		'menu_order' => __( 'Default', 'sofreh' ),
		'popularity' => __( 'Best selling', 'sofreh' ),
		'rating'     => __( 'Top rated', 'sofreh' ),
		'date'       => __( 'Newest', 'sofreh' ),
		'price'      => __( 'Cheapest', 'sofreh' ),
		'price-desc' => __( 'Most expensive', 'sofreh' ),
	);
	if ( wc_get_loop_prop( 'is_search' ) ) {
		$options = array_merge( array( 'relevance' => __( 'Most relevant', 'sofreh' ) ), $options );
		unset( $options['menu_order'] );
	}
	if ( ! wc_review_ratings_enabled() ) {
		unset( $options['rating'] );
	}
	$base = get_pagenum_link( 1, false );
	echo '<nav class="sort-links" aria-label="' . esc_attr__( 'Sort products', 'sofreh' ) . '">';
	echo '<span class="sort-links__label">' . sofreh_get_icon( 'filter', 18 ) . esc_html__( 'Sort by:', 'sofreh' ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Fixed SVG string.
	foreach ( $options as $id => $label ) {
		printf(
			'<a href="%1$s"%2$s>%3$s</a>',
			esc_url( add_query_arg( 'orderby', $id, $base ) ),
			$id === $current ? ' class="is-current" aria-current="true"' : '',
			esc_html( $label )
		);
	}
	echo '</nav>';
}
add_action( 'woocommerce_before_shop_loop', 'sofreh_wc_sort_links', 25 );

/**
 * Product card: wrap image and badges in a media frame.
 */
function sofreh_wc_card_media_open() {
	echo '<div class="product-card__media">';
}
add_action( 'woocommerce_before_shop_loop_item_title', 'sofreh_wc_card_media_open', 9 );

/**
 * Out-of-stock badge on cards.
 */
function sofreh_wc_card_stock_badge() {
	global $product;
	if ( $product instanceof WC_Product && ! $product->is_in_stock() ) {
		echo '<span class="badge badge--soldout">' . esc_html__( 'Out of stock', 'sofreh' ) . '</span>';
	}
}
add_action( 'woocommerce_before_shop_loop_item_title', 'sofreh_wc_card_stock_badge', 10 );

/**
 * Close the media frame.
 */
function sofreh_wc_card_media_close() {
	echo '</div>';
}
add_action( 'woocommerce_before_shop_loop_item_title', 'sofreh_wc_card_media_close', 11 );

/*
 * The discount badge sits beside the price, as on Iranian marketplaces,
 * instead of over the product photo: one price row of badge, price and old
 * price, with WooCommerce's own badge and price output inside it.
 */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

/**
 * Open the card's price row and print the discount badge.
 */
function sofreh_wc_card_price_open() {
	echo '<div class="product-card__price">';
	woocommerce_show_product_loop_sale_flash();
}
add_action( 'woocommerce_after_shop_loop_item_title', 'sofreh_wc_card_price_open', 9 );

/**
 * Close the card's price row.
 */
function sofreh_wc_card_price_close() {
	echo '</div>';
}
add_action( 'woocommerce_after_shop_loop_item_title', 'sofreh_wc_card_price_close', 11 );


/**
 * Sale badge shows the discount ("20% off") when it can be computed.
 *
 * @param string     $html    Default badge.
 * @param WP_Post    $post    Post.
 * @param WC_Product $product Product.
 * @return string
 */
function sofreh_wc_sale_flash( $html, $post, $product ) {
	$percent = 0;

	if ( $product instanceof WC_Product_Variable ) {
		$prices = $product->get_variation_prices();
		foreach ( $prices['regular_price'] as $id => $regular ) {
			$sale = isset( $prices['sale_price'][ $id ] ) ? (float) $prices['sale_price'][ $id ] : 0;
			if ( (float) $regular > 0 && $sale < (float) $regular ) {
				$percent = max( $percent, ( (float) $regular - $sale ) / (float) $regular * 100 );
			}
		}
	} elseif ( $product instanceof WC_Product && ! $product->is_type( 'grouped' ) ) {
		$regular = (float) $product->get_regular_price();
		$sale    = (float) $product->get_sale_price();
		if ( $regular > 0 && $sale < $regular ) {
			$percent = ( $regular - $sale ) / $regular * 100;
		}
	}

	$percent = (int) round( $percent );
	if ( $percent < 1 ) {
		return '<span class="onsale">' . esc_html__( 'Sale', 'sofreh' ) . '</span>';
	}

	// Short "20%" pill beside the price; screen readers hear "20% off".
	return sprintf(
		'<span class="onsale"><span aria-hidden="true">%1$s</span><span class="screen-reader-text">%2$s</span></span>',
		esc_html(
			/* translators: %s: discount percentage, e.g. 20. Shown in a small badge. */
			sprintf( __( '%s%%', 'sofreh' ), number_format_i18n( $percent ) )
		),
		esc_html(
			/* translators: %s: discount percentage, e.g. 20. */
			sprintf( __( '%s%% off', 'sofreh' ), number_format_i18n( $percent ) )
		)
	);
}
add_filter( 'woocommerce_sale_flash', 'sofreh_wc_sale_flash', 10, 3 );

/**
 * Escape product price HTML for output while keeping WooCommerce's <bdi>
 * wrapper. wp_kses_post() strips <bdi>; without that isolation the currency
 * name lands on the wrong side of the amount in right-to-left text.
 *
 * @param string $html Price HTML from WC_Product::get_price_html().
 * @return string
 */
function sofreh_kses_price( $html ) {
	$allowed                      = wp_kses_allowed_html( 'post' );
	$allowed['bdi']               = array();
	$allowed['span']['translate'] = true;
	return wp_kses( $html, $allowed );
}

/**
 * Variable products whose options cost different amounts show "From <lowest
 * price>" instead of a two-price range, which wraps badly in narrow product
 * cards and on phones. The chosen option's own price still appears as soon as
 * the customer picks it (WooCommerce's variation price).
 *
 * @param string              $price   Price HTML.
 * @param WC_Product_Variable $product Product.
 * @return string
 */
function sofreh_wc_variable_price_html( $price, $product ) {
	if ( is_admin() && ! wp_doing_ajax() ) {
		return $price;
	}
	$prices = $product->get_variation_prices( true );
	if ( empty( $prices['price'] ) ) {
		return $price;
	}
	$min = current( $prices['price'] );
	$max = end( $prices['price'] );
	if ( $min === $max ) {
		return $price;
	}
	return '<span class="price-from">' . sprintf(
		/* translators: %s: lowest price of the product's options. */
		esc_html__( 'From %s', 'sofreh' ),
		wc_price( $min )
	) . '</span>' . $product->get_price_suffix();
}
add_filter( 'woocommerce_variable_price_html', 'sofreh_wc_variable_price_html', 10, 2 );

/*
 * -------------------------------------------------------------------------
 * Single product
 * -------------------------------------------------------------------------
 */

// The price and discount badge move into the buy box, next to the add-to-cart form.
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

/**
 * Open the buy box: price, stock, quantity and add to cart, the store note.
 */
function sofreh_wc_buy_box_open() {
	echo '<div class="buy-box" id="buy-box"><div class="buy-box__price">';
	woocommerce_show_product_sale_flash();
	woocommerce_template_single_price();
	echo '</div>';
}
add_action( 'woocommerce_single_product_summary', 'sofreh_wc_buy_box_open', 25 );

/**
 * Close the buy box.
 */
function sofreh_wc_buy_box_close() {
	echo '</div>';
}
add_action( 'woocommerce_single_product_summary', 'sofreh_wc_buy_box_close', 36 );

/**
 * Phones: a bar fixed above the tab bar with the price and the add-to-cart
 * action, shown once the buy box has scrolled out of view. Its button
 * presses the real add-to-cart button (or scrolls to the options for
 * products that need a choice first), so WooCommerce's own form handles it.
 */
function sofreh_wc_sticky_buy_bar() {
	global $product;
	if ( ! $product instanceof WC_Product || ! $product->is_purchasable() || ! $product->is_in_stock() ) {
		return;
	}
	$needs_choice = $product->is_type( 'variable' ) || $product->is_type( 'grouped' );
	?>
	<div class="buy-bar" hidden data-sofreh-buybar>
		<div class="buy-bar__price"><?php echo sofreh_kses_price( $product->get_price_html() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped by sofreh_kses_price(). ?></div>
		<button type="button" class="button buy-bar__button" data-sofreh-buy="<?php echo $needs_choice ? 'choose' : 'add'; ?>">
			<?php echo $needs_choice ? esc_html__( 'Choose options', 'sofreh' ) : esc_html__( 'Add to cart', 'sofreh' ); ?>
		</button>
	</div>
	<?php
}
add_action( 'woocommerce_after_single_product', 'sofreh_wc_sticky_buy_bar' );

/**
 * Store note (shipping/returns) under the add-to-cart form.
 */
function sofreh_wc_product_note() {
	$note = sofreh_option( 'product_note' );
	if ( '' === trim( (string) $note ) ) {
		return;
	}
	echo '<div class="product-note">' . sofreh_get_icon( 'truck', 22 ) . '<p>' . nl2br( esc_html( $note ) ) . '</p></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Icon markup is a fixed string.
}
add_action( 'woocommerce_single_product_summary', 'sofreh_wc_product_note', 35 );

/**
 * Classic checkout: WooCommerce's section titles are h3s directly under the
 * page's h1. A visually hidden h2 keeps the heading outline in order for
 * screen readers without overriding the checkout template.
 */
function sofreh_wc_checkout_heading() {
	echo '<h2 class="screen-reader-text">' . esc_html__( 'Your details', 'sofreh' ) . '</h2>';
}
add_action( 'woocommerce_checkout_before_customer_details', 'sofreh_wc_checkout_heading' );

/**
 * Related products: one row of four.
 *
 * @param array $args Args.
 * @return array
 */
function sofreh_wc_related_args( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns']        = 4;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'sofreh_wc_related_args' );

/**
 * Upsells: one row of four.
 *
 * @param array $args Args.
 * @return array
 */
function sofreh_wc_upsell_args( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns']        = 4;
	return $args;
}
add_filter( 'woocommerce_upsell_display_args', 'sofreh_wc_upsell_args' );

add_filter(
	'woocommerce_cross_sells_columns',
	function () {
		return 2;
	}
);
add_filter(
	'woocommerce_cross_sells_total',
	function () {
		return 2;
	}
);

/*
 * -------------------------------------------------------------------------
 * Header: product search and cart link
 * -------------------------------------------------------------------------
 */

/**
 * Product search form (see searchform.php).
 *
 * @param string $aria_label Accessible name of the search landmark; pages
 *                           with a second search form pass a distinct one.
 */
function sofreh_product_search_form( $aria_label = '' ) {
	get_search_form(
		array(
			'sofreh_product' => true,
			'aria_label'     => $aria_label,
		)
	);
}

/**
 * Cart link markup, for the header or the mobile tab bar. Both are returned
 * as AJAX fragments, so they update after add to cart and cart changes.
 *
 * @param string $context 'header' or 'tabbar'.
 * @return string
 */
function sofreh_get_cart_link( $context = 'header' ) {
	$count = ( WC()->cart ) ? WC()->cart->get_cart_contents_count() : 0;
	$label = sprintf(
		/* translators: %s: number of items in the cart. */
		_n( 'Cart, %s item', 'Cart, %s items', $count, 'sofreh' ),
		number_format_i18n( $count )
	);
	$badge   = sprintf(
		'<span class="cart-count%1$s" aria-hidden="true">%2$s</span>',
		$count ? '' : ' is-empty',
		esc_html( number_format_i18n( $count ) )
	);
	$current = is_cart() ? ' aria-current="page"' : '';

	if ( 'tabbar' === $context ) {
		return sprintf(
			'<a class="tabbar__item tabbar-cart%1$s" href="%2$s"%3$s><span class="tabbar__icon">%4$s%5$s</span><span aria-hidden="true">%6$s</span><span class="screen-reader-text">%7$s</span></a>',
			is_cart() ? ' is-current' : '',
			esc_url( wc_get_cart_url() ),
			$current,
			sofreh_get_icon( 'bag', 24 ),
			$badge,
			esc_html__( 'Cart', 'sofreh' ),
			esc_html( $label )
		);
	}

	return sprintf(
		'<a class="header-action header-cart" href="%1$s"%2$s>%3$s%4$s<span class="screen-reader-text">%5$s</span></a>',
		esc_url( wc_get_cart_url() ),
		$current,
		sofreh_get_icon( 'bag' ),
		$badge,
		esc_html( $label )
	);
}

/**
 * Replace both cart links after AJAX add-to-cart / cart updates.
 *
 * @param array $fragments Fragments.
 * @return array
 */
function sofreh_wc_cart_fragment( $fragments ) {
	$fragments['a.header-cart'] = sofreh_get_cart_link( 'header' );
	$fragments['a.tabbar-cart'] = sofreh_get_cart_link( 'tabbar' );
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'sofreh_wc_cart_fragment' );

/**
 * Header account link: "Log in | Create account" for visitors, "My account" after.
 */
function sofreh_account_link() {
	if ( is_user_logged_in() ) {
		printf(
			'<a class="header-action header-account" href="%1$s">%2$s<span class="header-action__label">%3$s</span></a>',
			esc_url( wc_get_page_permalink( 'myaccount' ) ),
			sofreh_get_icon( 'user' ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Fixed SVG string.
			esc_html__( 'My account', 'sofreh' )
		);
		return;
	}
	printf(
		'<a class="header-action header-account header-account--guest" href="%1$s">%2$s<span class="header-action__label">%3$s</span></a>',
		esc_url( wc_get_page_permalink( 'myaccount' ) ),
		sofreh_get_icon( 'user' ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Fixed SVG string.
		esc_html__( 'Log in | Create account', 'sofreh' )
	);
}

/*
 * -------------------------------------------------------------------------
 * Log in / Create account
 * -------------------------------------------------------------------------
 */

/**
 * Is sign-up offered on the My Account page?
 *
 * @return bool
 */
function sofreh_wc_registration_open() {
	return 'yes' === get_option( 'woocommerce_enable_myaccount_registration' );
}

/**
 * Tabs over WooCommerce's own login and sign-up forms: «ورود» and
 * «ساخت حساب». The script moves them into the panel and shows one form at a
 * time; without it both forms stay visible side by side.
 */
function sofreh_wc_auth_tabs() {
	if ( ! sofreh_wc_registration_open() || is_checkout() ) {
		return;
	}
	// phpcs:disable WordPress.Security.NonceVerification -- Only chooses which tab opens first.
	$initial = ( isset( $_POST['register'] ) || ( isset( $_GET['action'] ) && 'register' === $_GET['action'] ) ) ? 'register' : 'login';
	// phpcs:enable
	?>
	<div class="auth-tabs" role="tablist" aria-label="<?php esc_attr_e( 'Your account', 'sofreh' ); ?>" data-sofreh-auth-tabs data-initial="<?php echo esc_attr( $initial ); ?>" hidden>
		<button type="button" class="auth-tabs__tab" role="tab" id="auth-tab-login" data-tab="login"><?php esc_html_e( 'Log in', 'sofreh' ); ?></button>
		<button type="button" class="auth-tabs__tab" role="tab" id="auth-tab-register" data-tab="register"><?php esc_html_e( 'Create account', 'sofreh' ); ?></button>
	</div>
	<?php
}
add_action( 'woocommerce_before_customer_login_form', 'sofreh_wc_auth_tabs' );

/**
 * "No account yet? Create account" under the login form, and the way back
 * under the sign-up form.
 */
function sofreh_wc_auth_switch_to_register() {
	if ( ! sofreh_wc_registration_open() || is_checkout() ) {
		return;
	}
	printf(
		'<p class="auth-switch">%1$s <a href="%2$s" data-sofreh-auth-switch="register">%3$s</a></p>',
		esc_html__( 'No account yet?', 'sofreh' ),
		esc_url( add_query_arg( 'action', 'register' ) ),
		esc_html__( 'Create account', 'sofreh' )
	);
}
add_action( 'woocommerce_login_form_end', 'sofreh_wc_auth_switch_to_register', 20 );

/**
 * "Already have an account? Log in" under the sign-up form.
 */
function sofreh_wc_auth_switch_to_login() {
	if ( is_checkout() ) {
		return;
	}
	printf(
		'<p class="auth-switch">%1$s <a href="%2$s" data-sofreh-auth-switch="login">%3$s</a></p>',
		esc_html__( 'Already have an account?', 'sofreh' ),
		esc_url( remove_query_arg( 'action' ) ),
		esc_html__( 'Log in', 'sofreh' )
	);
}
add_action( 'woocommerce_register_form_end', 'sofreh_wc_auth_switch_to_login', 20 );
