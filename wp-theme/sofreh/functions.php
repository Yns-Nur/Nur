<?php
/**
 * Sofreh theme bootstrap.
 *
 * Every feature lives in a file under inc/. WooCommerce integration is only
 * loaded while WooCommerce is active, so the theme also works (as a plain
 * Persian blog/site theme) without it.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

define( 'SOFREH_VERSION', '1.0.0' );
define( 'SOFREH_DIR', get_template_directory() );
define( 'SOFREH_URI', get_template_directory_uri() );

require SOFREH_DIR . '/inc/setup.php';
require SOFREH_DIR . '/inc/icons.php';
require SOFREH_DIR . '/inc/template-tags.php';
require SOFREH_DIR . '/inc/enqueue.php';
require SOFREH_DIR . '/inc/customizer.php';
require SOFREH_DIR . '/inc/persian.php';

/**
 * Whether WooCommerce is active and loaded.
 *
 * @return bool
 */
function sofreh_is_woocommerce_active() {
	return class_exists( 'WooCommerce' );
}

if ( sofreh_is_woocommerce_active() ) {
	require SOFREH_DIR . '/inc/woocommerce.php';
}
