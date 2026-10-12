<?php
/**
 * Small template helpers.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

/**
 * Product categories to feature in navigation and on the home page.
 *
 * Read from the store, never hard-coded: the merchant's own categories appear
 * as soon as they contain products. WooCommerce's default "Uncategorized"
 * bucket is left out.
 *
 * @param int $parent_id Parent term ID (0 for top level).
 * @param int $number Maximum number of terms (0 for all).
 * @return WP_Term[]
 */
function sofreh_get_product_categories( $parent_id = 0, $number = 0 ) {
	if ( ! taxonomy_exists( 'product_cat' ) ) {
		return array();
	}

	$terms = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'parent'     => absint( $parent_id ),
			'hide_empty' => true,
			'number'     => absint( $number ),
			'exclude'    => array( absint( get_option( 'default_product_cat', 0 ) ) ),
			'orderby'    => 'menu_order', // WooCommerce resolves this to its drag-and-drop category order.
		)
	);

	return is_wp_error( $terms ) ? array() : $terms;
}

/**
 * Fallback for the primary menu before the merchant has built one: a link to
 * the shop followed by the top-level product categories.
 *
 * @param array $args wp_nav_menu() arguments.
 */
function sofreh_primary_menu_fallback( $args ) {
	$items = array();

	if ( function_exists( 'wc_get_page_permalink' ) ) {
		$items[] = sprintf(
			'<li class="menu-item"><a href="%1$s">%2$s</a></li>',
			esc_url( wc_get_page_permalink( 'shop' ) ),
			esc_html__( 'All products', 'sofreh' )
		);

		foreach ( sofreh_get_product_categories( 0, 7 ) as $term ) {
			$link = get_term_link( $term );
			if ( is_wp_error( $link ) ) {
				continue;
			}
			$items[] = sprintf(
				'<li class="menu-item"><a href="%1$s">%2$s</a></li>',
				esc_url( $link ),
				esc_html( $term->name )
			);
		}
	} else {
		$items[] = sprintf(
			'<li class="menu-item"><a href="%1$s">%2$s</a></li>',
			esc_url( home_url( '/' ) ),
			esc_html__( 'Home', 'sofreh' )
		);
		foreach ( get_pages(
			array(
				'parent'      => 0,
				'number'      => 6,
				'sort_column' => 'menu_order',
			)
		) as $page ) {
			$items[] = sprintf(
				'<li class="menu-item"><a href="%1$s">%2$s</a></li>',
				esc_url( get_permalink( $page ) ),
				esc_html( get_the_title( $page ) )
			);
		}
	}

	printf(
		'<ul id="%1$s" class="%2$s">%3$s</ul>',
		esc_attr( $args['menu_id'] ),
		esc_attr( $args['menu_class'] ),
		wp_kses_post( implode( '', $items ) ) // Items are escaped as they are built; this keeps the output provably safe.
	);
}

/**
 * Post date and author line.
 */
function sofreh_posted_on() {
	printf(
		'<p class="entry-meta"><time datetime="%1$s">%2$s</time><span aria-hidden="true"> · </span><span class="author">%3$s</span></p>',
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_html( get_the_author() )
	);
}

/**
 * Numbered pagination for post lists.
 */
function sofreh_posts_pagination() {
	the_posts_pagination(
		array(
			'mid_size'           => 1,
			'prev_text'          => esc_html__( 'Previous', 'sofreh' ),
			'next_text'          => esc_html__( 'Next', 'sofreh' ),
			'screen_reader_text' => esc_html__( 'Posts navigation', 'sofreh' ),
		)
	);
}

/**
 * Initial letter of a name, used when a category has no image.
 *
 * @param string $name Name.
 * @return string
 */
function sofreh_initial( $name ) {
	$name = trim( wp_strip_all_tags( $name ) );
	return function_exists( 'mb_substr' ) ? mb_substr( $name, 0, 1 ) : substr( $name, 0, 1 );
}

/**
 * Product category tree for the desktop category menu ('mega') and the
 * mobile drawer ('drawer'). Built from the store's own categories: top
 * level as headings, their sub-categories beneath.
 *
 * The drawer uses native <details> disclosure, so it works without scripts.
 *
 * @param string $context 'mega' or 'drawer'.
 */
function sofreh_category_tree( $context = 'mega' ) {
	$parents = sofreh_get_product_categories( 0, 12 );
	if ( empty( $parents ) ) {
		return;
	}

	if ( 'mega' === $context ) {
		echo '<div class="mega__grid">';
		foreach ( $parents as $parent ) {
			$link = get_term_link( $parent );
			if ( is_wp_error( $link ) ) {
				continue;
			}
			echo '<div class="mega__col">';
			printf( '<a class="mega__parent" href="%1$s">%2$s %3$s</a>', esc_url( $link ), esc_html( $parent->name ), sofreh_get_icon( 'chevron', 14 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Fixed SVG string.
			$children = sofreh_get_product_categories( $parent->term_id, 8 );
			if ( $children ) {
				echo '<ul>';
				foreach ( $children as $child ) {
					$child_link = get_term_link( $child );
					if ( ! is_wp_error( $child_link ) ) {
						printf( '<li><a href="%1$s">%2$s</a></li>', esc_url( $child_link ), esc_html( $child->name ) );
					}
				}
				echo '</ul>';
			}
			echo '</div>';
		}
		echo '</div>';
		return;
	}

	echo '<ul class="cat-tree">';
	foreach ( $parents as $parent ) {
		$link = get_term_link( $parent );
		if ( is_wp_error( $link ) ) {
			continue;
		}
		$children = sofreh_get_product_categories( $parent->term_id, 12 );
		if ( ! $children ) {
			printf( '<li><a class="cat-tree__link" href="%1$s">%2$s</a></li>', esc_url( $link ), esc_html( $parent->name ) );
			continue;
		}
		echo '<li><details class="cat-tree__group"><summary>' . esc_html( $parent->name ) . sofreh_get_icon( 'down', 18 ) . '</summary><ul>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Fixed SVG string.
		printf(
			'<li><a class="cat-tree__all" href="%1$s">%2$s</a></li>',
			esc_url( $link ),
			/* translators: %s: category name. */
			esc_html( sprintf( __( 'All of %s', 'sofreh' ), $parent->name ) )
		);
		foreach ( $children as $child ) {
			$child_link = get_term_link( $child );
			if ( ! is_wp_error( $child_link ) ) {
				printf( '<li><a href="%1$s">%2$s</a></li>', esc_url( $child_link ), esc_html( $child->name ) );
			}
		}
		echo '</ul></details></li>';
	}
	echo '</ul>';
}
