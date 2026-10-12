<?php
/**
 * Home: banner carousel (Appearance → Customize → Sofreh theme → Home page).
 *
 * Native horizontal scroll-snap, so it swipes on phones without a script;
 * theme.js adds dots, arrows and an autoplay that pauses on hover, focus and
 * touch, has a pause button, and never runs under reduced motion.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

$sofreh_slides = sofreh_banner_slides();
if ( empty( $sofreh_slides ) ) {
	return;
}
$sofreh_total = count( $sofreh_slides );
?>
<section class="banner" aria-roledescription="<?php esc_attr_e( 'carousel', 'sofreh' ); ?>" aria-label="<?php esc_attr_e( 'Featured', 'sofreh' ); ?>" data-sofreh-carousel>
	<div class="container">
		<div class="banner__frame">
			<div class="banner__track" id="banner-track">
				<?php foreach ( $sofreh_slides as $sofreh_i => $sofreh_slide ) : ?>
					<div class="banner__slide tone-<?php echo esc_attr( $sofreh_slide['tone'] ); ?>" role="group" aria-roledescription="<?php esc_attr_e( 'slide', 'sofreh' ); ?>" aria-label="<?php echo esc_attr( sprintf( /* translators: 1: slide number, 2: number of slides. */ __( '%1$s of %2$s', 'sofreh' ), number_format_i18n( $sofreh_i + 1 ), number_format_i18n( $sofreh_total ) ) ); ?>">
						<div class="banner__copy">
							<?php if ( 0 === $sofreh_i ) : ?>
								<h2 class="banner__title"><?php echo esc_html( $sofreh_slide['title'] ); ?></h2>
							<?php else : ?>
								<p class="banner__title"><?php echo esc_html( $sofreh_slide['title'] ); ?></p>
							<?php endif; ?>
							<?php if ( $sofreh_slide['text'] ) : ?>
								<p class="banner__text"><?php echo esc_html( $sofreh_slide['text'] ); ?></p>
							<?php endif; ?>
							<?php if ( $sofreh_slide['button'] ) : ?>
								<a class="banner__button" href="<?php echo esc_url( $sofreh_slide['link'] ); ?>"><?php echo esc_html( $sofreh_slide['button'] ); ?></a>
							<?php endif; ?>
						</div>
						<?php if ( $sofreh_slide['image'] ) : ?>
							<div class="banner__media">
								<?php
								echo wp_get_attachment_image(
									$sofreh_slide['image'],
									'woocommerce_single',
									false,
									array(
										'alt'           => '',
										'loading'       => 0 === $sofreh_i ? 'eager' : 'lazy',
										'fetchpriority' => 0 === $sofreh_i ? 'high' : 'auto',
										'sizes'         => '(max-width: 700px) 40vw, 360px',
									)
								);
								?>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>

			<?php if ( $sofreh_total > 1 ) : ?>
				<div class="banner__controls">
					<button type="button" class="banner__nav banner__nav--prev" data-carousel="prev" aria-controls="banner-track">
						<?php sofreh_icon( 'chevron', 20 ); ?><span class="screen-reader-text"><?php esc_html_e( 'Previous slide', 'sofreh' ); ?></span>
					</button>
					<div class="banner__dots">
						<?php for ( $sofreh_i = 0; $sofreh_i < $sofreh_total; $sofreh_i++ ) : ?>
							<button type="button" class="banner__dot<?php echo 0 === $sofreh_i ? ' is-current' : ''; ?>" data-carousel-to="<?php echo esc_attr( $sofreh_i ); ?>" aria-controls="banner-track">
								<span class="screen-reader-text"><?php echo esc_html( sprintf( /* translators: %s: slide number. */ __( 'Go to slide %s', 'sofreh' ), number_format_i18n( $sofreh_i + 1 ) ) ); ?></span>
							</button>
						<?php endfor; ?>
					</div>
					<button type="button" class="banner__pause" data-carousel="pause" aria-pressed="false">
						<span class="banner__pause-icon" aria-hidden="true"></span><span class="screen-reader-text"><?php esc_html_e( 'Pause slideshow', 'sofreh' ); ?></span>
					</button>
					<button type="button" class="banner__nav banner__nav--next" data-carousel="next" aria-controls="banner-track">
						<?php sofreh_icon( 'chevron', 20 ); ?><span class="screen-reader-text"><?php esc_html_e( 'Next slide', 'sofreh' ); ?></span>
					</button>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
