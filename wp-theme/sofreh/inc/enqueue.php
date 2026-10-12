<?php
/**
 * Styles and scripts.
 *
 * Styles are written with CSS logical properties (margin-inline-start and so
 * on), so one stylesheet serves both RTL and LTR; no separate rtl.css is needed.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

/**
 * Cache-busting version for a theme asset.
 *
 * @param string $relative Path relative to the theme root.
 * @return string
 */
function sofreh_asset_version( $relative ) {
	$file = SOFREH_DIR . '/' . $relative;
	return file_exists( $file ) ? SOFREH_VERSION . '.' . filemtime( $file ) : SOFREH_VERSION;
}

/**
 * Front-end assets.
 */
function sofreh_enqueue_assets() {
	wp_enqueue_style( 'sofreh-main', SOFREH_URI . '/assets/css/main.css', array(), sofreh_asset_version( 'assets/css/main.css' ) );

	if ( sofreh_is_woocommerce_active() ) {
		wp_enqueue_style( 'sofreh-woocommerce', SOFREH_URI . '/assets/css/woocommerce.css', array( 'sofreh-main' ), sofreh_asset_version( 'assets/css/woocommerce.css' ) );
	}

	wp_enqueue_script(
		'sofreh-theme',
		SOFREH_URI . '/assets/js/theme.js',
		array(),
		sofreh_asset_version( 'assets/js/theme.js' ),
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);
	wp_localize_script(
		'sofreh-theme',
		'sofrehL10n',
		array(
			'increase' => __( 'Increase quantity', 'sofreh' ),
			'decrease' => __( 'Decrease quantity', 'sofreh' ),
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sofreh_enqueue_assets' );

/**
 * Preload the regular text weight: it is needed for the first paint on every page.
 */
function sofreh_preload_font() {
	printf(
		'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
		esc_url( SOFREH_URI . '/assets/fonts/Vazirmatn-FD-Regular.woff2' )
	);
}
add_action( 'wp_head', 'sofreh_preload_font', 2 );
