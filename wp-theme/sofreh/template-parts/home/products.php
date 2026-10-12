<?php
/**
 * Home: product sections (newest, on sale, best sellers).
 *
 * Uses WooCommerce's own [products] shortcode, so the cards, prices, stock,
 * add-to-cart buttons and catalog visibility rules are exactly WooCommerce's.
 * A section is only printed when it has something real to show: "On sale"
 * needs products on sale, and "Best sellers" needs products that have sold.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

$sofreh_limit    = absint( sofreh_option( 'home_products_num' ) );
$sofreh_sections = array();

if ( sofreh_option( 'home_new' ) ) {
	$sofreh_sections[] = array(
		'id'        => 'home-new',
		'title'     => __( 'Newest products', 'sofreh' ),
		'shortcode' => sprintf( '[products limit="%d" columns="4" orderby="date" order="DESC"]', $sofreh_limit ),
		'show'      => true,
	);
}

if ( sofreh_option( 'home_sale' ) ) {
	$sofreh_sections[] = array(
		'id'        => 'home-sale',
		'title'     => __( 'On sale', 'sofreh' ),
		'shortcode' => sprintf( '[products limit="%d" columns="4" on_sale="true"]', $sofreh_limit ),
		'show'      => ! empty( wc_get_product_ids_on_sale() ),
	);
}

if ( sofreh_option( 'home_best' ) ) {
	$sofreh_has_sales  = get_posts(
		array(
			'post_type'      => 'product',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'no_found_rows'  => true,
			'meta_query'     => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query -- One indexed lookup, limit 1.
				array(
					'key'     => 'total_sales',
					'value'   => 0,
					'compare' => '>',
					'type'    => 'NUMERIC',
				),
			),
		)
	);
	$sofreh_sections[] = array(
		'id'        => 'home-best',
		'title'     => __( 'Best sellers', 'sofreh' ),
		'shortcode' => sprintf( '[products limit="%d" columns="4" best_selling="true"]', $sofreh_limit ),
		'show'      => ! empty( $sofreh_has_sales ),
	);
}

foreach ( $sofreh_sections as $sofreh_section ) :
	if ( ! $sofreh_section['show'] ) {
		continue;
	}
	$sofreh_html = do_shortcode( $sofreh_section['shortcode'] );
	if ( false === strpos( $sofreh_html, 'class="products' ) ) {
		continue; // No visible products.
	}
	?>
	<section class="home-section home-products" aria-labelledby="<?php echo esc_attr( $sofreh_section['id'] ); ?>">
		<div class="container">
			<div class="section-head">
				<h2 id="<?php echo esc_attr( $sofreh_section['id'] ); ?>" class="section-title"><?php echo esc_html( $sofreh_section['title'] ); ?></h2>
				<a class="section-link" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"><?php esc_html_e( 'View all', 'sofreh' ); ?></a>
			</div>
			<?php echo $sofreh_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Rendered by WooCommerce's [products] shortcode. ?>
		</div>
	</section>
	<?php
endforeach;
