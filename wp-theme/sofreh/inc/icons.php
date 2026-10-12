<?php
/**
 * Inline SVG icons. Icons are decorative: they are always aria-hidden and the
 * control that holds them carries its own accessible name.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

/**
 * Return the markup for one icon.
 *
 * The SVG paths are fixed strings defined below, never user input, so the
 * returned markup is safe to echo.
 *
 * @param string $name Icon name.
 * @param int    $size Pixel size.
 * @return string
 */
function sofreh_get_icon( $name, $size = 24 ) {
	$paths = array(
		'search'  => '<circle cx="11" cy="11" r="7"/><path d="m20 20-3.6-3.6"/>',
		'user'    => '<circle cx="12" cy="8" r="4"/><path d="M4 20c1.4-3.6 4.4-5.5 8-5.5s6.6 1.9 8 5.5"/>',
		'bag'     => '<path d="M5 8h14l-1.2 12H6.2z"/><path d="M9 8V6.5a3 3 0 0 1 6 0V8"/>',
		'menu'    => '<path d="M4 7h16M4 12h16M4 17h16"/>',
		'close'   => '<path d="m6 6 12 12M18 6 6 18"/>',
		'filter'  => '<path d="M4 6h16M7 12h10M10 18h4"/>',
		'chevron' => '<path d="m15 6-6 6 6 6"/>',
		'plus'    => '<path d="M12 5v14M5 12h14"/>',
		'minus'   => '<path d="M5 12h14"/>',
		'truck'   => '<path d="M3 6h11v10H3z"/><path d="M14 10h4l3 3v3h-7"/><circle cx="7" cy="17.5" r="1.8"/><circle cx="17" cy="17.5" r="1.8"/>',
		'shield'  => '<path d="M12 3 5 6v5c0 4.4 3 8.3 7 10 4-1.7 7-5.6 7-10V6z"/><path d="m9 12 2 2 4-4"/>',
		'return'  => '<path d="M4 9h11a5 5 0 0 1 0 10H8"/><path d="m8 5-4 4 4 4"/>',
		'support' => '<path d="M5 13v-1a7 7 0 0 1 14 0v1"/><rect x="3.5" y="13" width="4" height="6" rx="1.5"/><rect x="16.5" y="13" width="4" height="6" rx="1.5"/><path d="M18.5 19c0 1.2-1.5 2-4 2"/>',
		'phone'   => '<path d="M6.5 3.5h3l1.5 4-2 1.5a11 11 0 0 0 6 6l1.5-2 4 1.5v3a2 2 0 0 1-2 2A16 16 0 0 1 4.5 5.5a2 2 0 0 1 2-2z"/>',
		'mail'    => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m4 7 8 6 8-6"/>',
		'pin'     => '<path d="M12 21s-6.5-6-6.5-11a6.5 6.5 0 0 1 13 0c0 5-6.5 11-6.5 11z"/><circle cx="12" cy="10" r="2.3"/>',
		'home'    => '<path d="M4 10.5 12 4l8 6.5V20a1 1 0 0 1-1 1h-4.5v-6h-5v6H5a1 1 0 0 1-1-1z"/>',
		'grid'    => '<rect x="4" y="4" width="6.5" height="6.5" rx="1.5"/><rect x="13.5" y="4" width="6.5" height="6.5" rx="1.5"/><rect x="4" y="13.5" width="6.5" height="6.5" rx="1.5"/><rect x="13.5" y="13.5" width="6.5" height="6.5" rx="1.5"/>',
		'up'      => '<path d="m6 14 6-6 6 6"/>',
		'down'    => '<path d="m6 10 6 6 6-6"/>',
		'check'   => '<path d="m5 12.5 4.5 4.5L19 7.5"/>',
		'box'     => '<path d="M4 8 12 4l8 4v8l-8 4-8-4z"/><path d="m4 8 8 4 8-4M12 12v8"/>',
		'percent' => '<path d="M19 5 5 19"/><circle cx="7" cy="7" r="2.5"/><circle cx="17" cy="17" r="2.5"/>',
	);

	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}

	return sprintf(
		'<svg class="icon icon-%1$s" width="%2$d" height="%2$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%3$s</svg>',
		esc_attr( $name ),
		absint( $size ),
		$paths[ $name ]
	);
}

/**
 * Allowed SVG markup for wp_kses() when icon markup passes through a filter.
 *
 * @return array
 */
function sofreh_svg_kses() {
	$shape = array(
		'd'      => true,
		'cx'     => true,
		'cy'     => true,
		'r'      => true,
		'x'      => true,
		'y'      => true,
		'rx'     => true,
		'width'  => true,
		'height' => true,
	);
	return array(
		'svg'    => array(
			'class'           => true,
			'width'           => true,
			'height'          => true,
			'viewbox'         => true,
			'fill'            => true,
			'stroke'          => true,
			'stroke-width'    => true,
			'stroke-linecap'  => true,
			'stroke-linejoin' => true,
			'aria-hidden'     => true,
			'focusable'       => true,
		),
		'path'   => $shape,
		'circle' => $shape,
		'rect'   => $shape,
	);
}

/**
 * Echo an icon.
 *
 * @param string $name Icon name.
 * @param int    $size Pixel size.
 */
function sofreh_icon( $name, $size = 24 ) {
	echo wp_kses( sofreh_get_icon( $name, $size ), sofreh_svg_kses() );
}
