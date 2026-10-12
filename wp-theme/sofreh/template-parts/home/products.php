<?php
/**
 * Home: product sections.
 *
 * - Special offers: products actually on sale, as a red strip that scrolls
 *   sideways (WooCommerce's own [products] shortcode, so cards, prices, stock
 *   and add-to-cart buttons are WooCommerce's).
 * - Newest: the latest products, as a scrolling shelf.
 * - Best sellers: a numbered ranking, only from products that have sold.
 *
 * A section is printed only when it has real content.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

$sofreh_limit = max( 8, absint( sofreh_option( 'home_products_num' ) ) );
$sofreh_shop  = wc_get_page_permalink( 'shop' );

/**
 * Render a sideways-scrolling strip of WooCommerce product cards.
 *
 * @param string $id        Section ID.
 * @param string $title     Heading.
 * @param string $shortcode [products] shortcode.
 * @param string $modifier  Extra class.
 * @param string $more_url  "View all" link.
 */
$sofreh_strip = function ( $id, $title, $shortcode, $modifier, $more_url ) {
	$html = do_shortcode( $shortcode );
	if ( false === strpos( $html, 'class="products' ) ) {
		return;
	}
	?>
	<section class="home-section strip <?php echo esc_attr( $modifier ); ?>" aria-labelledby="<?php echo esc_attr( $id ); ?>">
		<div class="container">
			<div class="strip__frame">
				<div class="strip__head">
					<h2 id="<?php echo esc_attr( $id ); ?>" class="strip__title"><?php echo esc_html( $title ); ?></h2>
					<a class="strip__more" href="<?php echo esc_url( $more_url ); ?>"><?php esc_html_e( 'View all', 'sofreh' ); ?><?php sofreh_icon( 'chevron', 16 ); ?></a>
				</div>
				<div class="strip__body" data-sofreh-scroller>
					<?php echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Rendered by WooCommerce's [products] shortcode. ?>
					<button type="button" class="strip__arrow strip__arrow--prev" data-scroll="prev" tabindex="-1" aria-hidden="true"><?php sofreh_icon( 'chevron', 20 ); ?></button>
					<button type="button" class="strip__arrow strip__arrow--next" data-scroll="next" tabindex="-1" aria-hidden="true"><?php sofreh_icon( 'chevron', 20 ); ?></button>
				</div>
			</div>
		</div>
	</section>
	<?php
};

if ( sofreh_option( 'home_sale' ) && ! empty( wc_get_product_ids_on_sale() ) ) {
	$sofreh_strip( 'home-sale', __( 'Special offers', 'sofreh' ), sprintf( '[products limit="%d" on_sale="true" orderby="date" order="DESC"]', $sofreh_limit ), 'strip--deals', $sofreh_shop );
}

if ( sofreh_option( 'home_new' ) ) {
	$sofreh_strip( 'home-new', __( 'Newest products', 'sofreh' ), sprintf( '[products limit="%d" orderby="date" order="DESC"]', $sofreh_limit ), 'strip--shelf', add_query_arg( 'orderby', 'date', $sofreh_shop ) );
}

if ( sofreh_option( 'home_best' ) ) {
	$sofreh_best = wc_get_products(
		array(
			'status'     => 'publish',
			'visibility' => 'catalog',
			'limit'      => 9,
			'orderby'    => 'meta_value_num',
			'meta_key'   => 'total_sales', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key -- WooCommerce's own sales counter, limit 9.
			'order'      => 'DESC',
		)
	);
	$sofreh_best = array_values(
		array_filter(
			$sofreh_best,
			function ( $product ) {
				return $product->get_total_sales() > 0;
			}
		)
	);

	if ( $sofreh_best ) :
		?>
		<section class="home-section ranking" aria-labelledby="home-best">
			<div class="container">
				<div class="ranking__frame">
					<div class="strip__head">
						<h2 id="home-best" class="strip__title"><?php esc_html_e( 'Best sellers', 'sofreh' ); ?></h2>
						<a class="strip__more" href="<?php echo esc_url( add_query_arg( 'orderby', 'popularity', $sofreh_shop ) ); ?>"><?php esc_html_e( 'View all', 'sofreh' ); ?><?php sofreh_icon( 'chevron', 16 ); ?></a>
					</div>
					<ol class="ranking__list">
						<?php foreach ( $sofreh_best as $sofreh_product ) : ?>
							<li>
								<a class="ranking__item" href="<?php echo esc_url( $sofreh_product->get_permalink() ); ?>">
									<span class="ranking__img"><?php echo wp_kses_post( $sofreh_product->get_image( 'woocommerce_gallery_thumbnail', array( 'alt' => '' ) ) ); ?></span>
									<span class="ranking__body">
										<span class="ranking__name"><?php echo esc_html( $sofreh_product->get_name() ); ?></span>
										<span class="price"><?php echo wp_kses_post( $sofreh_product->get_price_html() ); ?></span>
									</span>
								</a>
							</li>
						<?php endforeach; ?>
					</ol>
				</div>
			</div>
		</section>
		<?php
	endif;
}
