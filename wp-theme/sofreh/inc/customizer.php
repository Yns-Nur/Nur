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
		'hero_eyebrow'      => __( 'Home & kitchen', 'sofreh' ),
		'hero_title'        => __( 'Everything a warm home needs, in one place', 'sofreh' ),
		'hero_text'         => __( 'Cookware, tableware and home goods, chosen for everyday use. Browse by category or search for exactly what you need.', 'sofreh' ),
		'hero_button'       => __( 'Browse the shop', 'sofreh' ),
		'hero_image'        => 0,
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

	$add( 'hero_show', 'sofreh_home', __( 'Show the hero banner', 'sofreh' ), 'checkbox', 'sofreh_sanitize_checkbox' );
	$add( 'hero_eyebrow', 'sofreh_home', __( 'Hero: small label', 'sofreh' ) );
	$add( 'hero_title', 'sofreh_home', __( 'Hero: heading', 'sofreh' ) );
	$add( 'hero_text', 'sofreh_home', __( 'Hero: text', 'sofreh' ), 'textarea', 'sanitize_textarea_field' );
	$add( 'hero_button', 'sofreh_home', __( 'Hero: button label', 'sofreh' ) );

	$wp_customize->add_setting(
		'sofreh_hero_image',
		array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'sofreh_hero_image',
			array(
				'label'       => __( 'Hero: image', 'sofreh' ),
				'description' => __( 'A portrait image works best (about 900 × 1100 pixels). It is shown inside an arched frame.', 'sofreh' ),
				'section'     => 'sofreh_home',
				'mime_type'   => 'image',
			)
		)
	);

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
