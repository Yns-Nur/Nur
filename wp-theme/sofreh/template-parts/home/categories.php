<?php
/**
 * Home: product categories, read from the store.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

$sofreh_terms = sofreh_get_product_categories( 0, 8 );

if ( empty( $sofreh_terms ) ) {
	return;
}
?>
<section id="home-categories" class="home-section home-categories" aria-labelledby="home-categories-title">
	<div class="container">
		<div class="section-head">
			<h2 id="home-categories-title" class="section-title"><?php esc_html_e( 'Shop by category', 'sofreh' ); ?></h2>
			<a class="section-link" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"><?php esc_html_e( 'All products', 'sofreh' ); ?></a>
		</div>

		<ul class="category-grid">
			<?php foreach ( $sofreh_terms as $sofreh_term ) : ?>
				<?php
				$sofreh_link = get_term_link( $sofreh_term );
				if ( is_wp_error( $sofreh_link ) ) {
					continue;
				}
				$sofreh_thumb = absint( get_term_meta( $sofreh_term->term_id, 'thumbnail_id', true ) );
				?>
				<li class="category-card">
					<a href="<?php echo esc_url( $sofreh_link ); ?>">
						<span class="arch arch--card">
							<?php if ( $sofreh_thumb ) : ?>
								<?php
								echo wp_get_attachment_image(
									$sofreh_thumb,
									'woocommerce_thumbnail',
									false,
									array(
										'class'   => 'arch__img',
										'alt'     => '',
										'loading' => 'lazy',
										'sizes'   => '(max-width: 600px) 45vw, 240px',
									)
								);
								?>
							<?php else : ?>
								<span class="arch__initial" aria-hidden="true"><?php echo esc_html( sofreh_initial( $sofreh_term->name ) ); ?></span>
							<?php endif; ?>
						</span>
						<span class="category-card__name"><?php echo esc_html( $sofreh_term->name ); ?></span>
						<span class="category-card__count">
							<?php
							printf(
								/* translators: %s: number of products. */
								esc_html( _n( '%s product', '%s products', $sofreh_term->count, 'sofreh' ) ),
								esc_html( number_format_i18n( $sofreh_term->count ) )
							);
							?>
						</span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
