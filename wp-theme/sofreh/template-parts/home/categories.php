<?php
/**
 * Home: product categories as round icons, read from the store.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

$sofreh_terms = sofreh_get_product_categories( 0, 12 );

if ( empty( $sofreh_terms ) ) {
	return;
}
?>
<section class="home-section cat-circles" aria-labelledby="home-categories-title">
	<div class="container">
		<h2 id="home-categories-title" class="screen-reader-text"><?php esc_html_e( 'Shop by category', 'sofreh' ); ?></h2>
		<ul class="cat-circles__list">
			<?php foreach ( $sofreh_terms as $sofreh_term ) : ?>
				<?php
				$sofreh_link = get_term_link( $sofreh_term );
				if ( is_wp_error( $sofreh_link ) ) {
					continue;
				}
				$sofreh_thumb = absint( get_term_meta( $sofreh_term->term_id, 'thumbnail_id', true ) );
				?>
				<li>
					<a class="cat-circle" href="<?php echo esc_url( $sofreh_link ); ?>">
						<span class="cat-circle__img">
							<?php if ( $sofreh_thumb ) : ?>
								<?php
								echo wp_get_attachment_image(
									$sofreh_thumb,
									'thumbnail',
									false,
									array(
										'alt'     => '',
										'loading' => 'lazy',
										'sizes'   => '96px',
									)
								);
								?>
							<?php else : ?>
								<span class="cat-circle__initial" aria-hidden="true"><?php echo esc_html( sofreh_initial( $sofreh_term->name ) ); ?></span>
							<?php endif; ?>
						</span>
						<span class="cat-circle__name"><?php echo esc_html( $sofreh_term->name ); ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
