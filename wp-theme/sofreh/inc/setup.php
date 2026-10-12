<?php
/**
 * Theme supports, menus, widget areas.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

if ( ! isset( $content_width ) ) {
	$content_width = 760; // Matches settings.layout.contentSize in theme.json.
}

/**
 * Register theme features.
 */
function sofreh_setup() {
	load_theme_textdomain( 'sofreh', SOFREH_DIR . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 96,
			'width'       => 280,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'fbf8f3',
		)
	);

	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor.css' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary menu', 'sofreh' ),
			'footer'  => __( 'Footer menu', 'sofreh' ),
		)
	);

	// WooCommerce: declare support and the image sizes this layout is drawn for.
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width'         => 520,
			'single_image_width'            => 800,
			'gallery_thumbnail_image_width' => 160,
			'product_grid'                  => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'max_rows'        => 8,
				'default_columns' => 4,
				'min_columns'     => 2,
				'max_columns'     => 5,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'sofreh_setup' );

/**
 * Widget areas.
 */
function sofreh_widgets_init() {
	$shared = array(
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	);

	register_sidebar(
		array_merge(
			$shared,
			array(
				'id'          => 'sidebar-1', // Core's conventional ID: WordPress's default widgets land here, not in the shop filters.
				'name'        => __( 'Blog sidebar', 'sofreh' ),
				'description' => __( 'Shown beside blog posts and archives.', 'sofreh' ),
			)
		)
	);

	register_sidebar(
		array_merge(
			$shared,
			array(
				'id'          => 'shop-sidebar',
				'name'        => __( 'Shop filters', 'sofreh' ),
				'description' => __( 'Shown beside product listings (shop, categories, tags, product search). If empty, a product category list is shown instead.', 'sofreh' ),
			)
		)
	);

	for ( $i = 1; $i <= 3; $i++ ) {
		register_sidebar(
			array_merge(
				$shared,
				array(
					'id'           => 'footer-' . $i,
					/* translators: %d: footer column number. */
					'name'         => sprintf( __( 'Footer column %d', 'sofreh' ), $i ),
					'description'  => __( 'Use this for links, contact details or trust badges (for example an e-Namad badge via a Custom HTML widget).', 'sofreh' ),
					'before_title' => '<h2 class="footer-title">',
					'after_title'  => '</h2>',
				)
			)
		);
	}
}
add_action( 'widgets_init', 'sofreh_widgets_init' );

/**
 * Add useful body classes.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function sofreh_body_classes( $classes ) {
	if ( is_active_sidebar( 'sidebar-1' ) && ( is_home() || is_singular( 'post' ) || is_archive() ) && ! ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) ) {
		$classes[] = 'has-blog-sidebar';
	}
	return $classes;
}
add_filter( 'body_class', 'sofreh_body_classes' );
