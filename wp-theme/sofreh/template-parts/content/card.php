<?php
/**
 * Card for a post, page or product in post lists and site-wide search.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

$sofreh_product = ( 'product' === get_post_type() && function_exists( 'wc_get_product' ) ) ? wc_get_product( get_the_ID() ) : null;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
	<a class="post-card__link" href="<?php the_permalink(); ?>">
		<span class="post-card__media">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail(
					'medium_large',
					array(
						'alt'     => '',
						'loading' => 'lazy',
					)
				);
			} elseif ( $sofreh_product ) {
				echo wc_placeholder_img( 'woocommerce_thumbnail', array( 'alt' => '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- WooCommerce builds this image tag.
			}
			?>
		</span>
		<span class="post-card__body">
			<?php if ( $sofreh_product ) : ?>
				<span class="post-card__type"><?php esc_html_e( 'Product', 'sofreh' ); ?></span>
			<?php elseif ( 'post' === get_post_type() ) : ?>
				<span class="post-card__type"><?php echo esc_html( get_the_date() ); ?></span>
			<?php endif; ?>
			<span class="post-card__title"><?php the_title(); ?></span>
			<?php if ( $sofreh_product ) : ?>
				<span class="price"><?php echo wp_kses_post( $sofreh_product->get_price_html() ); ?></span>
			<?php else : ?>
				<span class="post-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></span>
			<?php endif; ?>
		</span>
	</a>
</article>
