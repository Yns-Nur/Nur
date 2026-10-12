<?php
/**
 * Site header: brand, search, account and cart, the desktop category menu,
 * the mobile menu drawer and the mobile bottom tab bar.
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
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
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
		<div class="container hdr">
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

			<div class="hdr__search">
				<?php
				if ( $sofreh_has_wc ) {
					sofreh_product_search_form();
				} else {
					get_search_form();
				}
				?>
			</div>

			<div class="hdr__actions">
				<?php
				if ( $sofreh_has_wc ) {
					sofreh_account_link();
					echo sofreh_get_cart_link(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped inside the function.
				}
				?>
			</div>
		</div>

		<nav class="hdr-nav" aria-label="<?php esc_attr_e( 'Main menu', 'sofreh' ); ?>">
			<div class="container hdr-nav__inner">
				<?php if ( $sofreh_has_wc ) : ?>
					<div class="mega">
						<button type="button" class="mega__toggle" aria-expanded="false" aria-controls="mega-panel">
							<?php sofreh_icon( 'grid', 20 ); ?>
							<span><?php esc_html_e( 'Product categories', 'sofreh' ); ?></span>
						</button>
						<div id="mega-panel" class="mega__panel" hidden>
							<?php sofreh_category_tree( 'mega' ); ?>
						</div>
					</div>
					<span class="hdr-nav__sep" aria-hidden="true"></span>
				<?php endif; ?>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'menu primary-menu',
						'container'      => false,
						'depth'          => 2,
						'fallback_cb'    => 'sofreh_primary_menu_fallback',
					)
				);
				?>
			</div>
		</nav>
	</header>

	<div id="site-drawer" class="site-drawer">
		<div class="site-drawer__head">
			<span class="site-drawer__title"><?php esc_html_e( 'Menu', 'sofreh' ); ?></span>
			<button type="button" class="icon-button" data-sofreh-close="site-drawer">
				<?php sofreh_icon( 'close' ); ?>
				<span class="screen-reader-text"><?php esc_html_e( 'Close menu', 'sofreh' ); ?></span>
			</button>
		</div>
		<?php if ( $sofreh_has_wc ) : ?>
			<div class="site-drawer__section">
				<p class="site-drawer__label"><?php esc_html_e( 'Product categories', 'sofreh' ); ?></p>
				<?php sofreh_category_tree( 'drawer' ); ?>
			</div>
		<?php endif; ?>
		<nav class="site-drawer__section" aria-label="<?php esc_attr_e( 'Main menu', 'sofreh' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'        => 'drawer-menu',
					'menu_class'     => 'menu drawer-menu',
					'container'      => false,
					'depth'          => 2,
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>
	</div>

	<div class="drawer-backdrop" hidden data-sofreh-backdrop></div>

	<?php if ( $sofreh_has_wc ) : ?>
		<nav class="tabbar" aria-label="<?php esc_attr_e( 'Shortcuts', 'sofreh' ); ?>">
			<a class="tabbar__item<?php echo is_front_page() ? ' is-current' : ''; ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>"<?php echo is_front_page() ? ' aria-current="page"' : ''; ?>>
				<?php sofreh_icon( 'home', 24 ); ?><span><?php esc_html_e( 'Home', 'sofreh' ); ?></span>
			</a>
			<button type="button" class="tabbar__item" aria-controls="site-drawer" aria-expanded="false" data-sofreh-open="site-drawer">
				<?php sofreh_icon( 'grid', 24 ); ?><span><?php esc_html_e( 'Categories', 'sofreh' ); ?></span>
			</button>
			<?php echo sofreh_get_cart_link( 'tabbar' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped inside the function. ?>
			<a class="tabbar__item<?php echo is_account_page() ? ' is-current' : ''; ?>" href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"<?php echo is_account_page() ? ' aria-current="page"' : ''; ?>>
				<?php sofreh_icon( 'user', 24 ); ?><span><?php echo is_user_logged_in() ? esc_html__( 'My account', 'sofreh' ) : esc_html__( 'Log in', 'sofreh' ); ?></span>
			</a>
		</nav>
	<?php endif; ?>

	<div id="content" class="site-content">
