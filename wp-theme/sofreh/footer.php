<?php
/**
 * Site footer.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

$sofreh_phone   = sofreh_option( 'contact_phone' );
$sofreh_email   = sofreh_option( 'contact_email' );
$sofreh_address = sofreh_option( 'contact_address' );
$sofreh_about   = sofreh_option( 'footer_about' );
?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="container site-footer__grid">
			<section class="site-footer__about">
				<p class="site-footer__name"><?php bloginfo( 'name' ); ?></p>
				<?php if ( '' !== trim( (string) $sofreh_about ) ) : ?>
					<p><?php echo nl2br( esc_html( $sofreh_about ) ); ?></p>
				<?php endif; ?>

				<?php if ( $sofreh_phone || $sofreh_email || $sofreh_address ) : ?>
					<ul class="contact-list">
						<?php if ( $sofreh_phone ) : ?>
							<li><?php sofreh_icon( 'phone', 18 ); ?><a href="<?php echo esc_url( 'tel:' . preg_replace( '/[^0-9+]/', '', sofreh_normalize_digits( $sofreh_phone ) ) ); ?>" dir="ltr"><?php echo esc_html( $sofreh_phone ); ?></a></li>
						<?php endif; ?>
						<?php if ( $sofreh_email ) : ?>
							<li><?php sofreh_icon( 'mail', 18 ); ?><a href="<?php echo esc_url( 'mailto:' . antispambot( $sofreh_email ) ); ?>" class="ltr-text"><?php echo esc_html( antispambot( $sofreh_email ) ); ?></a></li>
						<?php endif; ?>
						<?php if ( $sofreh_address ) : ?>
							<li><?php sofreh_icon( 'pin', 18 ); ?><span><?php echo nl2br( esc_html( $sofreh_address ) ); ?></span></li>
						<?php endif; ?>
					</ul>
				<?php endif; ?>
			</section>

			<?php for ( $sofreh_i = 1; $sofreh_i <= 3; $sofreh_i++ ) : ?>
				<?php if ( is_active_sidebar( 'footer-' . $sofreh_i ) ) : ?>
					<div class="site-footer__col">
						<?php dynamic_sidebar( 'footer-' . $sofreh_i ); ?>
					</div>
				<?php elseif ( 1 === $sofreh_i ) : ?>
					<?php
					// Until widgets are added, show the footer menu or the main store links.
					?>
					<nav class="site-footer__col" aria-label="<?php esc_attr_e( 'Footer menu', 'sofreh' ); ?>">
						<h2 class="footer-title"><?php esc_html_e( 'Quick links', 'sofreh' ); ?></h2>
						<?php
						if ( has_nav_menu( 'footer' ) ) {
							wp_nav_menu(
								array(
									'theme_location' => 'footer',
									'menu_class'     => 'footer-menu',
									'container'      => false,
									'depth'          => 1,
								)
							);
						} elseif ( sofreh_is_woocommerce_active() ) {
							echo '<ul class="footer-menu">';
							foreach ( array( 'shop', 'cart', 'myaccount' ) as $sofreh_page ) {
								$sofreh_page_id = wc_get_page_id( $sofreh_page );
								if ( $sofreh_page_id > 0 ) {
									printf( '<li><a href="%1$s">%2$s</a></li>', esc_url( get_permalink( $sofreh_page_id ) ), esc_html( get_the_title( $sofreh_page_id ) ) );
								}
							}
							$sofreh_privacy = get_privacy_policy_url();
							if ( $sofreh_privacy ) {
								printf( '<li><a href="%1$s">%2$s</a></li>', esc_url( $sofreh_privacy ), esc_html__( 'Privacy policy', 'sofreh' ) );
							}
							echo '</ul>';
						}
						?>
					</nav>
				<?php endif; ?>
			<?php endfor; ?>
		</div>

		<div class="site-footer__bottom">
			<p class="container">
				<?php
				printf(
					/* translators: 1: year, 2: site name. */
					esc_html__( '© %1$s %2$s. All rights reserved.', 'sofreh' ),
					esc_html( wp_date( 'Y' ) ),
					esc_html( get_bloginfo( 'name' ) )
				);
				?>
			</p>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
