<?php
/**
 * Site header.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

$sofreh_has_wc = sofreh_is_woocommerce_active();
$sofreh_notice = sofreh_option( 'announcement' );
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'sofreh' ); ?></a>

<div id="page" class="site">

	<?php if ( '' !== trim( (string) $sofreh_notice ) ) : ?>
		<div class="announcement"><p class="container"><?php echo esc_html( $sofreh_notice ); ?></p></div>
	<?php endif; ?>

	<header id="masthead" class="site-header">
		<div class="container site-header__bar">
			<button type="button" class="icon-button menu-toggle" aria-controls="site-drawer" aria-expanded="false" data-sofreh-open="site-drawer">
				<?php sofreh_icon( 'menu' ); ?>
				<span class="screen-reader-text"><?php esc_html_e( 'Open menu', 'sofreh' ); ?></span>
			</button>

			<div class="site-branding">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				<?php endif; ?>
				<?php if ( is_front_page() ) : ?>
					<h1 class="screen-reader-text"><?php bloginfo( 'name' ); ?></h1>
				<?php endif; ?>
			</div>

			<div class="site-header__search">
				<?php
				if ( $sofreh_has_wc ) {
					sofreh_product_search_form();
				} else {
					get_search_form();
				}
				?>
			</div>

			<div class="site-header__actions">
				<?php
				if ( $sofreh_has_wc ) {
					sofreh_account_link();
					echo sofreh_get_cart_link(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped inside the function.
				}
				?>
			</div>
		</div>

		<div class="site-nav-wrap">
			<div id="site-drawer" class="site-drawer">
				<div class="site-drawer__head">
					<span class="site-drawer__title"><?php esc_html_e( 'Menu', 'sofreh' ); ?></span>
					<button type="button" class="icon-button" data-sofreh-close="site-drawer">
						<?php sofreh_icon( 'close' ); ?>
						<span class="screen-reader-text"><?php esc_html_e( 'Close menu', 'sofreh' ); ?></span>
					</button>
				</div>

				<div class="site-drawer__search">
					<?php
					if ( $sofreh_has_wc ) {
						sofreh_product_search_form();
					} else {
						get_search_form();
					}
					?>
				</div>

				<nav class="container primary-nav" aria-label="<?php esc_attr_e( 'Main menu', 'sofreh' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'menu_id'        => 'primary-menu',
							'menu_class'     => 'menu primary-menu',
							'container'      => false,
							'depth'          => 3,
							'fallback_cb'    => 'sofreh_primary_menu_fallback',
						)
					);
					?>
				</nav>
			</div>
		</div>
	</header>

	<div class="drawer-backdrop" hidden data-sofreh-backdrop></div>

	<div id="content" class="site-content">
