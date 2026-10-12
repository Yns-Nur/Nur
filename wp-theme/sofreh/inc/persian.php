<?php
/**
 * Persian input handling.
 *
 * Persian keyboards type Persian digits (۰–۹) and some Android keyboards type
 * Arabic-Indic digits (٠–٩). WooCommerce validates phone numbers and postcodes
 * against ASCII digits only, so a customer typing their own phone number on a
 * Persian keyboard is told it is invalid. These filters convert the digits to
 * ASCII before WooCommerce validates and stores them; nothing else is changed.
 *
 * Display is unaffected: the bundled "Vazirmatn FD" face draws ASCII digits
 * with Persian glyphs, so prices and numbers still read as Persian.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

/**
 * Convert Persian and Arabic-Indic digits to ASCII digits.
 *
 * @param string $value Input.
 * @return string
 */
function sofreh_normalize_digits( $value ) {
	if ( ! is_string( $value ) || '' === $value ) {
		return $value;
	}
	static $map = null;
	if ( null === $map ) {
		$map = array();
		for ( $i = 0; $i <= 9; $i++ ) {
			$map[ html_entity_decode( '&#' . ( 0x06F0 + $i ) . ';', ENT_QUOTES, 'UTF-8' ) ] = (string) $i; // Persian.
			$map[ html_entity_decode( '&#' . ( 0x0660 + $i ) . ';', ENT_QUOTES, 'UTF-8' ) ] = (string) $i; // Arabic-Indic.
		}
	}
	return strtr( $value, $map );
}

/**
 * Whether a field key holds a phone number or postcode.
 *
 * @param string $key Field key, e.g. billing_phone.
 * @return bool
 */
function sofreh_is_numeric_field( $key ) {
	return (bool) preg_match( '/(^|_)(phone|postcode)$/', (string) $key );
}

/**
 * Classic checkout: normalize before WooCommerce validates the posted data.
 *
 * @param array $data Posted checkout data.
 * @return array
 */
function sofreh_normalize_checkout_posted_data( $data ) {
	foreach ( $data as $key => $value ) {
		if ( sofreh_is_numeric_field( $key ) && is_string( $value ) ) {
			$data[ $key ] = sofreh_normalize_digits( $value );
		}
	}
	return $data;
}
add_filter( 'woocommerce_checkout_posted_data', 'sofreh_normalize_checkout_posted_data' );

/**
 * My Account → Addresses form: WooCommerce reads these fields straight from
 * $_POST, so normalize them there before its form handler runs (priority 20
 * on template_redirect).
 */
function sofreh_normalize_account_address_post() {
	// phpcs:disable WordPress.Security.NonceVerification.Missing -- WooCommerce verifies the nonce in its own handler; this only rewrites digits.
	if ( empty( $_POST['action'] ) || 'edit_address' !== $_POST['action'] ) {
		return;
	}
	foreach ( $_POST as $key => $value ) {
		if ( sofreh_is_numeric_field( $key ) && is_string( $value ) ) {
			$_POST[ $key ] = sofreh_normalize_digits( wp_unslash( $value ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- WooCommerce sanitizes these fields itself.
		}
	}
	// phpcs:enable
}
add_action( 'template_redirect', 'sofreh_normalize_account_address_post', 5 );

/**
 * Block checkout (Store API): normalize address phone and postcode before the
 * request is validated. Runs for batched requests too, since each one is
 * dispatched individually.
 *
 * @param mixed           $result  Short-circuit value; passed through.
 * @param WP_REST_Server  $server  Server.
 * @param WP_REST_Request $request Request.
 * @return mixed
 */
function sofreh_normalize_store_api_request( $result, $server, $request ) {
	if ( 0 !== strpos( $request->get_route(), '/wc/store/' ) ) {
		return $result;
	}
	foreach ( array( 'billing_address', 'shipping_address' ) as $param ) {
		$address = $request->get_param( $param );
		if ( ! is_array( $address ) ) {
			continue;
		}
		foreach ( array( 'phone', 'postcode' ) as $field ) {
			if ( isset( $address[ $field ] ) && is_string( $address[ $field ] ) ) {
				$address[ $field ] = sofreh_normalize_digits( $address[ $field ] );
			}
		}
		$request->set_param( $param, $address );
	}
	return $result;
}
add_filter( 'rest_pre_dispatch', 'sofreh_normalize_store_api_request', 10, 3 );
