<?php
/**
 * Home: hero banner.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

$sofreh_image_id = absint( sofreh_option( 'hero_image' ) );
$sofreh_eyebrow  = sofreh_option( 'hero_eyebrow' );
$sofreh_title    = sofreh_option( 'hero_title' );
$sofreh_text     = sofreh_option( 'hero_text' );
$sofreh_button   = sofreh_option( 'hero_button' );
$sofreh_shop_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
?>
<section class="hero" aria-labelledby="hero-title">
	<div class="container hero__inner">
		<div class="hero__copy">
			<?php if ( $sofreh_eyebrow ) : ?>
				<p class="eyebrow"><?php echo esc_html( $sofreh_eyebrow ); ?></p>
			<?php endif; ?>
			<h2 id="hero-title" class="hero__title"><?php echo esc_html( $sofreh_title ); ?></h2>
			<?php if ( $sofreh_text ) : ?>
				<p class="hero__text"><?php echo esc_html( $sofreh_text ); ?></p>
			<?php endif; ?>
			<div class="hero__actions">
				<?php if ( $sofreh_button ) : ?>
					<a class="button button--large" href="<?php echo esc_url( $sofreh_shop_url ); ?>"><?php echo esc_html( $sofreh_button ); ?></a>
				<?php endif; ?>
				<?php if ( sofreh_is_woocommerce_active() && sofreh_option( 'home_categories' ) ) : ?>
					<a class="button button--ghost button--large" href="#home-categories"><?php esc_html_e( 'See categories', 'sofreh' ); ?></a>
				<?php endif; ?>
			</div>
		</div>

		<div class="hero__media">
			<div class="arch arch--hero">
				<?php
				if ( $sofreh_image_id ) {
					echo wp_get_attachment_image(
						$sofreh_image_id,
						'large',
						false,
						array(
							'class'         => 'arch__img',
							'fetchpriority' => 'high',
							'loading'       => 'eager',
							'sizes'         => '(max-width: 800px) 90vw, 520px',
						)
					);
				} else {
					// Decorative tile pattern until the store owner picks a photo.
					echo '<div class="arch__pattern" aria-hidden="true"></div>';
				}
				?>
			</div>
		</div>
	</div>
</section>
