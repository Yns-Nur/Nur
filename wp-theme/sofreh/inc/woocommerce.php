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

/**
 * Category label above the product name: useful when a listing mixes
 * categories (search results, home page sections).
 */
function sofreh_wc_card_category() {
	global $product;
	if ( ! $product instanceof WC_Product ) {
		return;
	}
	$ids     = $product->get_category_ids();
	$default = absint( get_option( 'default_product_cat', 0 ) );
	foreach ( $ids as $id ) {
		if ( (int) $id === $default ) {
			continue;
		}
		$term = get_term( $id, 'product_cat' );
		if ( $term instanceof WP_Term ) {
			echo '<span class="product-card__cat">' . esc_html( $term->name ) . '</span>';
			return;
		}
	}
}
add_action( 'woocommerce_shop_loop_item_title', 'sofreh_wc_card_category', 5 );

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

	return '<span class="onsale">' . esc_html(
		/* translators: %s: discount percentage, e.g. 20. */
		sprintf( __( '%s%% off', 'sofreh' ), number_format_i18n( $percent ) )
	) . '</span>';
}
add_filter( 'woocommerce_sale_flash', 'sofreh_wc_sale_flash', 10, 3 );

/*
 * -------------------------------------------------------------------------
 * Single product
 * -------------------------------------------------------------------------
 */

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
 * Header cart link markup (also returned as an AJAX fragment).
 *
 * @return string
 */
function sofreh_get_cart_link() {
	$count = ( WC()->cart ) ? WC()->cart->get_cart_contents_count() : 0;
	$label = sprintf(
		/* translators: %s: number of items in the cart. */
		_n( 'Cart, %s item', 'Cart, %s items', $count, 'sofreh' ),
		number_format_i18n( $count )
	);

	return sprintf(
		'<a class="header-action header-cart" href="%1$s">%2$s<span class="header-action__label" aria-hidden="true">%3$s</span><span class="header-cart__count%4$s" aria-hidden="true">%5$s</span><span class="screen-reader-text">%6$s</span></a>',
		esc_url( wc_get_cart_url() ),
		sofreh_get_icon( 'bag' ),
		esc_html__( 'Cart', 'sofreh' ),
		$count ? '' : ' is-empty',
		esc_html( number_format_i18n( $count ) ),
		esc_html( $label )
	);
}

/**
 * Replace the header cart link after AJAX add-to-cart / cart updates.
 *
 * @param array $fragments Fragments.
 * @return array
 */
function sofreh_wc_cart_fragment( $fragments ) {
	$fragments['a.header-cart'] = sofreh_get_cart_link();
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'sofreh_wc_cart_fragment' );

/**
 * Header account link.
 */
function sofreh_account_link() {
	$logged_in = is_user_logged_in();
	printf(
		'<a class="header-action header-account" href="%1$s">%2$s<span class="header-action__label">%3$s</span></a>',
		esc_url( wc_get_page_permalink( 'myaccount' ) ),
		sofreh_get_icon( 'user' ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Fixed SVG string.
		$logged_in ? esc_html__( 'My account', 'sofreh' ) : esc_html__( 'Log in', 'sofreh' )
	);
}
