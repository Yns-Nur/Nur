<?php
/**
 * Customizer options (Appearance → Customize → Sofreh).
 *
 * Every setting is sanitized on save and escaped again on output.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

/**
 * Default values. Text defaults are translatable, so a Persian site starts in
 * Persian; the store owner should rewrite them to match their real policies.
 *
 * @return array
 */
function sofreh_customizer_defaults() {
	return array(
		'announcement'      => '',
		'hero_show'         => true,
		'hero_title'        => __( 'Refresh your kitchen', 'sofreh' ),
		'hero_text'         => __( 'Cookware, tableware and home basics for every day.', 'sofreh' ),
		'hero_button'       => __( 'See the products', 'sofreh' ),
		'hero_image'        => 0,
		'hero_link'         => '',
		'hero_tone'         => 'teal',
		'slide2_title'      => '',
		'slide2_text'       => '',
		'slide2_button'     => '',
		'slide2_image'      => 0,
		'slide2_link'       => '',
		'slide2_tone'       => 'ink',
		'slide3_title'      => '',
		'slide3_text'       => '',
		'slide3_button'     => '',
		'slide3_image'      => 0,
		'slide3_link'       => '',
		'slide3_tone'       => 'accent',
		'home_categories'   => true,
		'home_new'          => true,
		'home_sale'         => true,
		'home_best'         => true,
		'home_products_num' => 8,
		'trust_show'        => true,
		'trust_1'           => __( 'Delivery across the country', 'sofreh' ),
		'trust_2'           => __( 'Secure online payment', 'sofreh' ),
		'trust_3'           => __( 'Seven-day returns', 'sofreh' ),
		'trust_4'           => __( 'Support by phone and chat', 'sofreh' ),
		'footer_about'      => __( 'A store for home and kitchen goods.', 'sofreh' ),
		'contact_phone'     => '',
		'contact_email'     => '',
		'contact_address'   => '',
		'product_note'      => '',
	);
}

/**
 * Read one theme option with its default.
 *
 * @param string $key Option key.
 * @return mixed
 */
function sofreh_option( $key ) {
	$defaults = sofreh_customizer_defaults();
	return get_theme_mod( 'sofreh_' . $key, isset( $defaults[ $key ] ) ? $defaults[ $key ] : '' );
}

/**
 * Sanitize a checkbox.
 *
 * @param mixed $value Value.
 * @return bool
 */
function sofreh_sanitize_checkbox( $value ) {
	return (bool) $value;
}

/**
 * Sanitize the product count (4–16, in multiples that fill a row of four).
 *
 * @param mixed $value Value.
 * @return int
 */
function sofreh_sanitize_product_count( $value ) {
	$value = absint( $value );
	return in_array( $value, array( 4, 8, 12, 16 ), true ) ? $value : 8;
}

/**
 * Sanitize a banner tone.
 *
 * @param mixed $value Value.
 * @return string
 */
function sofreh_sanitize_tone( $value ) {
	return in_array( $value, array( 'teal', 'ink', 'accent' ), true ) ? $value : 'teal';
}

/**
 * The home banner slides that have a title, in order.
 *
 * @return array[]
 */
function sofreh_banner_slides() {
	$slides = array();
	foreach ( array( 'hero', 'slide2', 'slide3' ) as $key ) {
		$title = trim( (string) sofreh_option( $key . '_title' ) );
		if ( '' === $title ) {
			continue;
		}
		$link = (string) sofreh_option( $key . '_link' );
		if ( '' === $link && function_exists( 'wc_get_page_permalink' ) ) {
			$link = wc_get_page_permalink( 'shop' );
		}
		$slides[] = array(
			'title'  => $title,
			'text'   => (string) sofreh_option( $key . '_text' ),
			'button' => (string) sofreh_option( $key . '_button' ),
			'image'  => absint( sofreh_option( $key . '_image' ) ),
			'link'   => $link,
			'tone'   => sofreh_sanitize_tone( sofreh_option( $key . '_tone' ) ),
		);
	}
	return $slides;
}

/**
 * Register Customizer settings.
 *
 * @param WP_Customize_Manager $wp_customize Manager.
 */
function sofreh_customize_register( $wp_customize ) {
	$d = sofreh_customizer_defaults();

	$wp_customize->add_panel(
		'sofreh',
		array(
			'title'    => __( 'Sofreh theme', 'sofreh' ),
			'priority' => 30,
		)
	);

	$sections = array(
		'sofreh_header'  => __( 'Header', 'sofreh' ),
		'sofreh_home'    => __( 'Home page', 'sofreh' ),
		'sofreh_trust'   => __( 'Store promises', 'sofreh' ),
		'sofreh_product' => __( 'Product page', 'sofreh' ),
		'sofreh_footer'  => __( 'Footer and contact', 'sofreh' ),
	);
	foreach ( $sections as $id => $title ) {
		$wp_customize->add_section(
			$id,
			array(
				'title' => $title,
				'panel' => 'sofreh',
			)
		);
	}

	$add = function ( $key, $section, $label, $type = 'text', $sanitize = 'sanitize_text_field', $extra = array() ) use ( $wp_customize, $d ) {
		$wp_customize->add_setting(
			'sofreh_' . $key,
			array(
				'default'           => $d[ $key ],
				'sanitize_callback' => $sanitize,
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			'sofreh_' . $key,
			array_merge(
				array(
					'label'   => $label,
					'section' => $section,
					'type'    => $type,
				),
				$extra
			)
		);
	};

	$add( 'announcement', 'sofreh_header', __( 'Announcement bar text (leave empty to hide)', 'sofreh' ) );

	$add( 'hero_show', 'sofreh_home', __( 'Show the banner', 'sofreh' ), 'checkbox', 'sofreh_sanitize_checkbox' );

	$tones = array(
		'teal'   => __( 'Teal', 'sofreh' ),
		'ink'    => __( 'Dark', 'sofreh' ),
		'accent' => __( 'Red', 'sofreh' ),
	);
	foreach ( array(
		'hero'   => 1,
		'slide2' => 2,
		'slide3' => 3,
	) as $key => $n ) {
		/* translators: %d: banner slide number. */
		$prefix = sprintf( __( 'Banner %d', 'sofreh' ), $n );
		$add(
			$key . '_title',
			'sofreh_home',
			$prefix . ': ' . __( 'heading', 'sofreh' ),
			'text',
			'sanitize_text_field',
			1 === $n ? array() : array( 'description' => __( 'Leave empty to hide this slide.', 'sofreh' ) )
		);
		$add( $key . '_text', 'sofreh_home', $prefix . ': ' . __( 'text', 'sofreh' ), 'textarea', 'sanitize_textarea_field' );
		$add( $key . '_button', 'sofreh_home', $prefix . ': ' . __( 'button label', 'sofreh' ) );
		$add( $key . '_link', 'sofreh_home', $prefix . ': ' . __( 'link (empty = shop page)', 'sofreh' ), 'url', 'esc_url_raw' );
		$add( $key . '_tone', 'sofreh_home', $prefix . ': ' . __( 'background', 'sofreh' ), 'select', 'sofreh_sanitize_tone', array( 'choices' => $tones ) );

		$wp_customize->add_setting(
			'sofreh_' . $key . '_image',
			array(
				'default'           => 0,
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Media_Control(
				$wp_customize,
				'sofreh_' . $key . '_image',
				array(
					'label'       => $prefix . ': ' . __( 'image', 'sofreh' ),
					'description' => __( 'A product photo on a plain or transparent background works best (about 800 × 800 pixels).', 'sofreh' ),
					'section'     => 'sofreh_home',
					'mime_type'   => 'image',
				)
			)
		);
	}

	$add( 'home_categories', 'sofreh_home', __( 'Show product categories', 'sofreh' ), 'checkbox', 'sofreh_sanitize_checkbox' );
	$add( 'home_new', 'sofreh_home', __( 'Show newest products', 'sofreh' ), 'checkbox', 'sofreh_sanitize_checkbox' );
	$add( 'home_sale', 'sofreh_home', __( 'Show products on sale', 'sofreh' ), 'checkbox', 'sofreh_sanitize_checkbox' );
	$add( 'home_best', 'sofreh_home', __( 'Show best sellers', 'sofreh' ), 'checkbox', 'sofreh_sanitize_checkbox' );
	$add(
		'home_products_num',
		'sofreh_home',
		__( 'Products per home page section', 'sofreh' ),
		'select',
		'sofreh_sanitize_product_count',
		array(
			'choices' => array(
				4  => '4',
				8  => '8',
				12 => '12',
				16 => '16',
			),
		)
	);

	$add( 'trust_show', 'sofreh_trust', __( 'Show the promises strip on the home page', 'sofreh' ), 'checkbox', 'sofreh_sanitize_checkbox' );
	$trust_help = array( 'description' => __( 'Only state what your store actually offers. Leave a field empty to hide it.', 'sofreh' ) );
	$add( 'trust_1', 'sofreh_trust', __( 'Promise 1 (delivery)', 'sofreh' ), 'text', 'sanitize_text_field', $trust_help );
	$add( 'trust_2', 'sofreh_trust', __( 'Promise 2 (payment)', 'sofreh' ) );
	$add( 'trust_3', 'sofreh_trust', __( 'Promise 3 (returns)', 'sofreh' ) );
	$add( 'trust_4', 'sofreh_trust', __( 'Promise 4 (support)', 'sofreh' ) );

	$add(
		'product_note',
		'sofreh_product',
		__( 'Note under the add-to-cart button', 'sofreh' ),
		'textarea',
		'sanitize_textarea_field',
		array( 'description' => __( 'For example your shipping time or return policy. Leave empty to hide.', 'sofreh' ) )
	);

	$add( 'footer_about', 'sofreh_footer', __( 'About the store', 'sofreh' ), 'textarea', 'sanitize_textarea_field' );
	$add( 'contact_phone', 'sofreh_footer', __( 'Phone', 'sofreh' ) );
	$add( 'contact_email', 'sofreh_footer', __( 'Email', 'sofreh' ), 'email', 'sanitize_email' );
	$add( 'contact_address', 'sofreh_footer', __( 'Address', 'sofreh' ), 'textarea', 'sanitize_textarea_field' );
}
add_action( 'customize_register', 'sofreh_customize_register' );
