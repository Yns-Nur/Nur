# Sofreh: complete source, labelled by path

Every hand-written file of the theme (`sofreh/`) and the companion plugin (`sofreh-phone-accounts/`), in full.
Generated from the files in this folder, so it always matches the installable zips built by `build.sh`.

Not reproduced here (binary or generated): the Vazirmatn `.woff2` fonts and their licence `OFL.txt`, `screenshot.png`,
and the translation files generated from the `.po` sources with WP-CLI:
`wp i18n make-pot` (`.pot`), `wp i18n make-mo` (`.mo`) and `wp i18n make-php` (`.l10n.php`).

## Directory structure

```
wp-theme/
  build.sh
sofreh/
  404.php
  comments.php
  footer.php
  front-page.php
  functions.php
  header.php
  index.php
  page.php
  readme.txt
  screenshot.png
  search.php
  searchform.php
  sidebar.php
  single.php
  style.css
  theme.json
  assets/
    css/
      editor.css
      main.css
      woocommerce.css
    fonts/
      OFL.txt
      Vazirmatn-FD-Bold.woff2
      Vazirmatn-FD-Medium.woff2
      Vazirmatn-FD-Regular.woff2
      Vazirmatn-Regular.woff2
    images/
    js/
      theme.js
  inc/
    customizer.php
    enqueue.php
    icons.php
    persian.php
    setup.php
    template-tags.php
    woocommerce.php
  languages/
    fa_IR.l10n.php
    fa_IR.mo
    fa_IR.po
    sofreh.pot
  sample-data/
    sample-products.csv
  template-parts/
    content/
      card.php
      category-links.php
      none.php
    home/
      categories.php
      hero.php
      products.php
      trust.php
sofreh-phone-accounts/
  readme.txt
  sofreh-phone-accounts.php
  assets/
    sofreh-phone-accounts.css
    sofreh-phone-accounts.js
  includes/
    class-sofreh-phone-accounts.php
  languages/
    sofreh-phone-accounts-fa_IR.l10n.php
    sofreh-phone-accounts-fa_IR.mo
    sofreh-phone-accounts-fa_IR.po
    sofreh-phone-accounts.pot
```

## Files

- [`sofreh/404.php`](#sofreh404php)
- [`sofreh/comments.php`](#sofrehcommentsphp)
- [`sofreh/footer.php`](#sofrehfooterphp)
- [`sofreh/front-page.php`](#sofrehfront-pagephp)
- [`sofreh/functions.php`](#sofrehfunctionsphp)
- [`sofreh/header.php`](#sofrehheaderphp)
- [`sofreh/index.php`](#sofrehindexphp)
- [`sofreh/page.php`](#sofrehpagephp)
- [`sofreh/readme.txt`](#sofrehreadmetxt)
- [`sofreh/search.php`](#sofrehsearchphp)
- [`sofreh/searchform.php`](#sofrehsearchformphp)
- [`sofreh/sidebar.php`](#sofrehsidebarphp)
- [`sofreh/single.php`](#sofrehsinglephp)
- [`sofreh/style.css`](#sofrehstylecss)
- [`sofreh/theme.json`](#sofrehthemejson)
- [`sofreh/assets/css/editor.css`](#sofrehassetscsseditorcss)
- [`sofreh/assets/css/main.css`](#sofrehassetscssmaincss)
- [`sofreh/assets/css/woocommerce.css`](#sofrehassetscsswoocommercecss)
- [`sofreh/assets/js/theme.js`](#sofrehassetsjsthemejs)
- [`sofreh/inc/customizer.php`](#sofrehinccustomizerphp)
- [`sofreh/inc/enqueue.php`](#sofrehincenqueuephp)
- [`sofreh/inc/icons.php`](#sofrehinciconsphp)
- [`sofreh/inc/persian.php`](#sofrehincpersianphp)
- [`sofreh/inc/setup.php`](#sofrehincsetupphp)
- [`sofreh/inc/template-tags.php`](#sofrehinctemplate-tagsphp)
- [`sofreh/inc/woocommerce.php`](#sofrehincwoocommercephp)
- [`sofreh/languages/fa_IR.po`](#sofrehlanguagesfa_irpo)
- [`sofreh/sample-data/sample-products.csv`](#sofrehsample-datasample-productscsv)
- [`sofreh/template-parts/content/card.php`](#sofrehtemplate-partscontentcardphp)
- [`sofreh/template-parts/content/category-links.php`](#sofrehtemplate-partscontentcategory-linksphp)
- [`sofreh/template-parts/content/none.php`](#sofrehtemplate-partscontentnonephp)
- [`sofreh/template-parts/home/categories.php`](#sofrehtemplate-partshomecategoriesphp)
- [`sofreh/template-parts/home/hero.php`](#sofrehtemplate-partshomeherophp)
- [`sofreh/template-parts/home/products.php`](#sofrehtemplate-partshomeproductsphp)
- [`sofreh/template-parts/home/trust.php`](#sofrehtemplate-partshometrustphp)
- [`sofreh-phone-accounts/readme.txt`](#sofreh-phone-accountsreadmetxt)
- [`sofreh-phone-accounts/sofreh-phone-accounts.php`](#sofreh-phone-accountssofreh-phone-accountsphp)
- [`sofreh-phone-accounts/assets/sofreh-phone-accounts.css`](#sofreh-phone-accountsassetssofreh-phone-accountscss)
- [`sofreh-phone-accounts/assets/sofreh-phone-accounts.js`](#sofreh-phone-accountsassetssofreh-phone-accountsjs)
- [`sofreh-phone-accounts/includes/class-sofreh-phone-accounts.php`](#sofreh-phone-accountsincludesclass-sofreh-phone-accountsphp)
- [`sofreh-phone-accounts/languages/sofreh-phone-accounts-fa_IR.po`](#sofreh-phone-accountslanguagessofreh-phone-accounts-fa_irpo)
- [`build.sh`](#buildsh)

### sofreh/404.php

```php
<?php
/**
 * Not found.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<div class="container reading-page">
	<main id="main" class="site-main not-found">
		<p class="not-found__code" aria-hidden="true">404</p>
		<h1 class="page-title"><?php esc_html_e( 'This page could not be found', 'sofreh' ); ?></h1>
		<p><?php esc_html_e( 'The link may be broken or the page may have moved. Try a search, or start from one of the categories below.', 'sofreh' ); ?></p>
		<div class="search-again">
			<?php
			if ( sofreh_is_woocommerce_active() ) {
				sofreh_product_search_form( __( 'Search the store', 'sofreh' ) );
			} else {
				get_search_form();
			}
			?>
		</div>
		<?php get_template_part( 'template-parts/content/category-links' ); ?>
	</main>
</div>
<?php
get_footer();
```

### sofreh/comments.php

```php
<?php
/**
 * Comments on posts and pages. Product reviews use WooCommerce's own template.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

if ( post_password_required() ) {
	return;
}
?>
<section id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$sofreh_count = get_comments_number();
			printf(
				/* translators: %s: number of comments. */
				esc_html( _n( '%s comment', '%s comments', $sofreh_count, 'sofreh' ) ),
				esc_html( number_format_i18n( $sofreh_count ) )
			);
			?>
		</h2>
		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 48,
				)
			);
			?>
		</ol>
		<?php
		the_comments_navigation(
			array(
				'prev_text' => esc_html__( 'Older comments', 'sofreh' ),
				'next_text' => esc_html__( 'Newer comments', 'sofreh' ),
			)
		);
		?>
	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'sofreh' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>
</section>
```

### sofreh/footer.php

```php
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
		<div class="container site-footer__top">
			<a class="back-to-top" href="#page"><?php esc_html_e( 'Back to top', 'sofreh' ); ?><?php sofreh_icon( 'up', 18 ); ?></a>
		</div>
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
```

### sofreh/front-page.php

```php
<?php
/**
 * Home page.
 *
 * Built from the store's own data: categories and product sections are
 * queried from WooCommerce, and every section can be switched off in
 * Appearance → Customize → Sofreh theme → Home page. If the home page is set
 * to show latest posts, the post list follows the store sections.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main" class="site-main home">
	<?php
	if ( sofreh_option( 'hero_show' ) ) {
		get_template_part( 'template-parts/home/hero' );
	}

	if ( sofreh_is_woocommerce_active() ) {
		if ( sofreh_option( 'home_categories' ) ) {
			get_template_part( 'template-parts/home/categories' );
		}
		get_template_part( 'template-parts/home/products' );
		if ( sofreh_option( 'trust_show' ) ) {
			get_template_part( 'template-parts/home/trust' );
		}
	}

	if ( 'page' === get_option( 'show_on_front' ) ) {
		while ( have_posts() ) {
			the_post();
			if ( '' !== trim( get_the_content() ) ) {
				?>
				<section class="home-section">
					<div class="container entry-content">
						<?php the_content(); ?>
					</div>
				</section>
				<?php
			}
		}
	} elseif ( have_posts() ) {
		?>
		<section class="home-section" aria-labelledby="home-posts-title">
			<div class="container">
				<div class="strip__frame posts-frame">
					<div class="strip__head">
						<h2 id="home-posts-title" class="strip__title"><?php esc_html_e( 'From the blog', 'sofreh' ); ?></h2>
					</div>
					<div class="post-grid">
						<?php
						$sofreh_n = 0;
						while ( have_posts() && $sofreh_n < 4 ) {
							the_post();
							get_template_part( 'template-parts/content/card' );
							++$sofreh_n;
						}
						?>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
	?>
</main>
<?php
get_footer();
```

### sofreh/functions.php

```php
<?php
/**
 * Sofreh theme bootstrap.
 *
 * Every feature lives in a file under inc/. WooCommerce integration is only
 * loaded while WooCommerce is active, so the theme also works (as a plain
 * Persian blog/site theme) without it.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

define( 'SOFREH_VERSION', '2.1.0' );
define( 'SOFREH_DIR', get_template_directory() );
define( 'SOFREH_URI', get_template_directory_uri() );

require SOFREH_DIR . '/inc/setup.php';
require SOFREH_DIR . '/inc/icons.php';
require SOFREH_DIR . '/inc/template-tags.php';
require SOFREH_DIR . '/inc/enqueue.php';
require SOFREH_DIR . '/inc/customizer.php';
require SOFREH_DIR . '/inc/persian.php';

/**
 * Whether WooCommerce is active and loaded.
 *
 * @return bool
 */
function sofreh_is_woocommerce_active() {
	return class_exists( 'WooCommerce' );
}

if ( sofreh_is_woocommerce_active() ) {
	require SOFREH_DIR . '/inc/woocommerce.php';
}
```

### sofreh/header.php

```php
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
```

### sofreh/index.php

```php
<?php
/**
 * Fallback template: blog index and any view without a more specific template.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<div class="container content-layout">
	<main id="main" class="site-main">
		<header class="page-header">
			<?php if ( is_home() && ! is_front_page() ) : ?>
				<h1 class="page-title"><?php single_post_title(); ?></h1>
			<?php elseif ( is_archive() ) : ?>
				<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
				<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
			<?php else : ?>
				<h1 class="page-title"><?php esc_html_e( 'Latest posts', 'sofreh' ); ?></h1>
			<?php endif; ?>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="post-grid">
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content/card' );
				}
				?>
			</div>
			<?php sofreh_posts_pagination(); ?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content/none' ); ?>
		<?php endif; ?>
	</main>
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
```

### sofreh/page.php

```php
<?php
/**
 * Pages. Store pages (cart, checkout, my account) get the wide layout their
 * tables and two-column forms need; other pages keep a reading measure.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

$sofreh_is_store_page = function_exists( 'is_cart' ) && ( is_cart() || is_checkout() || is_account_page() );

get_header();
?>
<div class="container <?php echo $sofreh_is_store_page ? 'store-page' : 'reading-page'; ?>">
	<main id="main" class="site-main">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="page-header">
					<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
				</header>
				<?php if ( ! $sofreh_is_store_page && has_post_thumbnail() ) : ?>
					<figure class="entry-thumbnail"><?php the_post_thumbnail( 'large' ); ?></figure>
				<?php endif; ?>
				<div class="entry-content">
					<?php
					the_content();
					wp_link_pages(
						array(
							'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'sofreh' ) . '">',
							'after'  => '</nav>',
						)
					);
					?>
				</div>
			</article>
			<?php
			if ( ! $sofreh_is_store_page && ( comments_open() || get_comments_number() ) ) {
				comments_template();
			}
		endwhile;
		?>
	</main>
</div>
<?php
get_footer();
```

### sofreh/readme.txt

```text
=== Sofreh ===
Contributors: yns-nur
Requires at least: 6.7
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 2.1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Tags: e-commerce, rtl-language-support, translation-ready, custom-logo, custom-menu, featured-images, footer-widgets, right-sidebar, theme-options, threaded-comments, wide-blocks, block-styles

A Persian, right-to-left WooCommerce theme for home and kitchen stores.

== Description ==

Sofreh (سفره) is a storefront theme designed right-to-left and phone-first for
Persian shops that sell home and kitchen goods. It follows the layout Iranian
shoppers already know from the big marketplaces, so nothing has to be learned:

* Header with the product search front and centre, account and cart; a
  category mega menu on desktop and a category drawer on phones; a fixed bottom
  tab bar on phones (home, categories, cart, account).
* Home page: a swipeable banner (up to three slides, set in the Customizer), round
  category shortcuts, a lapis-and-plum "special offers" band of products that are really
  on sale, a newest-products shelf and a numbered best-seller list. Every section
  is built from the store's own data and only appears when it has content.
* Listings: sort links, category chips, a filters panel (a drawer on phones),
  discount-percent badges and stock badges.
* Product page: gallery, details and a sticky buy box side by side on desktop;
  a sticky buy bar above the tab bar on phones.
* Classic and block-based cart, checkout and account pages styled to match.
* WooCommerce integration through hooks only: no template overrides to fall out
  of date.
* Persian (fa_IR) translation included; WooCommerce and WordPress strings come
  from their official language packs.
* Persian digits everywhere via the bundled Vazirmatn FD typeface, while stored
  data stays in ASCII digits. Phone numbers and postcodes typed on a Persian
  keyboard are accepted on the classic checkout, the Checkout block and the
  account address form.
* Its own palette: lapis for actions, saffron for offers, plum and a fine
  khatam (8-point star) pattern on the banner and the offers band.
* Restrained motion (banner swipe, add-to-cart flight to the cart, cart count
  bump, drawers and menus) that switches off under "reduce motion".
* Keyboard-accessible menus and drawers; WCAG 2.1 AA colour contrast.

For phone-number checkout with automatic account creation, install the
companion plugin "Sofreh Phone Accounts" (shipped alongside this theme).

== Installation ==

1. Set the site language to فارسی (Settings → General) and update translations
   (Dashboard → Updates) so WordPress and WooCommerce are in Persian.
2. Upload the theme (Appearance → Themes → Add New → Upload) and activate it.
3. Install and activate WooCommerce, then set currency (Toman or Rial) and the
   store address in WooCommerce → Settings.
4. Adjust the banner slides, home sections, promises strip, product page note
   and contact details in Appearance → Customize → Sofreh theme.
5. Optional: import sample-data/sample-products.csv with WooCommerce's product
   importer to preview the theme. Every sample item is marked "(نمونه)".

== Frequently Asked Questions ==

= Does the theme require WooCommerce? =

No, it works as a Persian blog theme without it. The store features appear once
WooCommerce is active.

= Can I show Jalali (Persian calendar) dates? =

The theme uses WordPress's date functions, so a Jalali date plugin works with it.

== Changelog ==

= 2.1.0 =
* Own colour identity: lapis, saffron and plum on a warm porcelain ground, red
  for errors only; khatam pattern on the banner and offers band, saffron star
  before section titles, jewel line on the header, saffron discount tags.
* My Account: «ورود» / «ساخت حساب» tabs; header link «ورود | ساخت حساب».
* Order confirmation: tracking code and account confirmation side by side.

= 2.0.0 =
* Redesign from scratch: phone-first marketplace layout (search-first header,
  category mega menu and drawer, bottom tab bar, banner carousel, deals strip,
  best-seller ranking, sticky buy box and buy bar, sort links).
* Variable products show "From <lowest price>" instead of a two-price range.

= 1.0.0 =
* First release.

== Copyright ==

Sofreh WordPress Theme, Copyright 2026 Younes Nur.
Sofreh is distributed under the terms of the GNU GPL v2 or later.

This program is free software: you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation, either version 2 of the License, or (at your option) any later
version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE. See the GNU General Public License for more details.

Sofreh bundles the following third-party resources:

Vazirmatn font, Copyright 2015 The Vazirmatn Project Authors
License: SIL Open Font License 1.1 (assets/fonts/OFL.txt)
Source: https://github.com/rastikerdar/vazirmatn

Icons: drawn for this theme, GPLv2 or later.

Screenshot: the product and hero images shown are placeholder artwork made for
this theme (GPLv2 or later); they are not included as theme assets.
```

### sofreh/search.php

```php
<?php
/**
 * Site-wide search results. Product-only searches (from the header search
 * box) are rendered by WooCommerce as a product listing instead; this
 * template also surfaces matching products when someone searches everything.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<div class="container reading-page reading-page--wide">
	<main id="main" class="site-main">
		<header class="page-header">
			<h1 class="page-title">
				<?php
				/* translators: %s: search query. */
				printf( esc_html__( 'Search results for “%s”', 'sofreh' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
				?>
			</h1>
			<div class="search-again"><?php get_search_form(); ?></div>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="post-grid">
				<?php
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content/card' );
				}
				?>
			</div>
			<?php sofreh_posts_pagination(); ?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content/none' ); ?>
		<?php endif; ?>
	</main>
</div>
<?php
get_footer();
```

### sofreh/searchform.php

```php
<?php
/**
 * Search form.
 *
 * Used for site search and, with $args['sofreh_product'] set, for the
 * product search in the header (adds post_type=product so WooCommerce shows
 * a product listing). Going through get_search_form() keeps both filterable.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

$sofreh_args    = isset( $args ) && is_array( $args ) ? $args : array();
$sofreh_product = ! empty( $sofreh_args['sofreh_product'] ) && post_type_exists( 'product' );
$sofreh_id      = wp_unique_id( $sofreh_product ? 'product-search-' : 'search-' );

if ( ! empty( $sofreh_args['aria_label'] ) ) {
	$sofreh_label = $sofreh_args['aria_label'];
} else {
	$sofreh_label = $sofreh_product ? __( 'Product search', 'sofreh' ) : __( 'Site search', 'sofreh' );
}
?>
<form role="search" method="get" class="search-form<?php echo $sofreh_product ? ' product-search' : ''; ?>" action="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( $sofreh_label ); ?>">
	<label class="screen-reader-text" for="<?php echo esc_attr( $sofreh_id ); ?>"><?php echo $sofreh_product ? esc_html__( 'Search products', 'sofreh' ) : esc_html__( 'Search', 'sofreh' ); ?></label>
	<input type="search" id="<?php echo esc_attr( $sofreh_id ); ?>" class="search-field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php echo $sofreh_product ? esc_attr__( 'Search products…', 'sofreh' ) : esc_attr__( 'Search…', 'sofreh' ); ?>"<?php echo $sofreh_product ? ' autocomplete="off"' : ''; ?>>
	<?php if ( $sofreh_product ) : ?>
		<input type="hidden" name="post_type" value="product">
	<?php endif; ?>
	<button type="submit" class="search-submit">
		<?php sofreh_icon( 'search', 20 ); ?>
		<span class="screen-reader-text"><?php esc_html_e( 'Search', 'sofreh' ); ?></span>
	</button>
</form>
```

### sofreh/sidebar.php

```php
<?php
/**
 * Blog sidebar.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<aside class="blog-sidebar" aria-label="<?php esc_attr_e( 'Sidebar', 'sofreh' ); ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
```

### sofreh/single.php

```php
<?php
/**
 * Single blog post. Single products use WooCommerce's own template.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<div class="container content-layout">
	<main id="main" class="site-main">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-entry' ); ?>>
				<header class="page-header">
					<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
					<?php sofreh_posted_on(); ?>
				</header>
				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="entry-thumbnail"><?php the_post_thumbnail( 'large' ); ?></figure>
				<?php endif; ?>
				<div class="entry-content">
					<?php
					the_content();
					wp_link_pages(
						array(
							'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'sofreh' ) . '">',
							'after'  => '</nav>',
						)
					);
					?>
				</div>
				<footer class="entry-footer">
					<?php the_tags( '<p class="entry-tags"><span>' . esc_html__( 'Tags:', 'sofreh' ) . '</span> ', '، ', '</p>' ); ?>
				</footer>
			</article>
			<?php
			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-label">' . esc_html__( 'Previous post', 'sofreh' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-label">' . esc_html__( 'Next post', 'sofreh' ) . '</span> <span class="nav-title">%title</span>',
				)
			);
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile;
		?>
	</main>
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
```

### sofreh/style.css

```css
/*
Theme Name: Sofreh
Theme URI: https://github.com/yns-nur/nur/tree/main/wp-theme/sofreh
Author: Younes Nur
Author URI: https://github.com/yns-nur
Description: A Persian, right-to-left WooCommerce theme for home and kitchen stores, built phone-first in the familiar Iranian marketplace layout and its own lapis, saffron and plum palette: product search up front, a category mega menu and drawer, a swipeable banner, a special-offers band, a numbered best-seller list, a sticky buy box and buy bar on product pages, and a bottom tab bar on phones. Styles the classic and block cart, checkout and account pages. Ships with the Vazirmatn typeface and a full Persian (fa_IR) translation.
Version: 2.1.0
Requires at least: 6.7
Tested up to: 7.1
Requires PHP: 7.4
WC requires at least: 9.0
WC tested up to: 11.2
License: GNU General Public License v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: sofreh
Domain Path: /languages
Tags: e-commerce, rtl-language-support, translation-ready, custom-logo, custom-menu, featured-images, footer-widgets, right-sidebar, theme-options, threaded-comments, wide-blocks, block-styles

Sofreh is distributed under the terms of the GNU GPL v2 or later.
The bundled Vazirmatn font is licensed under the SIL Open Font License 1.1
(see assets/fonts/OFL.txt).

All theme styles live in assets/css/. This file only carries the theme header,
which WordPress requires; it is intentionally not enqueued.
*/
```

### sofreh/theme.json

```json
{
	"$schema": "https://schemas.wp.org/wp/6.7/theme.json",
	"version": 3,
	"settings": {
		"appearanceTools": true,
		"useRootPaddingAwareAlignments": false,
		"layout": {
			"contentSize": "760px",
			"wideSize": "1280px"
		},
		"color": {
			"defaultPalette": false,
			"defaultGradients": false,
			"defaultDuotone": false,
			"custom": true,
			"palette": [
				{
					"slug": "ground",
					"name": "Porcelain",
					"color": "#F7F4EF"
				},
				{
					"slug": "surface",
					"name": "Surface",
					"color": "#FFFFFF"
				},
				{
					"slug": "line",
					"name": "Line",
					"color": "#EAE6DF"
				},
				{
					"slug": "ink",
					"name": "Ink",
					"color": "#191D34"
				},
				{
					"slug": "muted",
					"name": "Muted",
					"color": "#5E6275"
				},
				{
					"slug": "accent",
					"name": "Lapis",
					"color": "#2D48C0"
				},
				{
					"slug": "accent-deep",
					"name": "Lapis deep",
					"color": "#1E339B"
				},
				{
					"slug": "accent-soft",
					"name": "Lapis soft",
					"color": "#E9F0FF"
				},
				{
					"slug": "saffron",
					"name": "Saffron",
					"color": "#FAAB35"
				},
				{
					"slug": "plum",
					"name": "Plum",
					"color": "#67237A"
				},
				{
					"slug": "success",
					"name": "Success",
					"color": "#1A7F45"
				}
			]
		},
		"typography": {
			"defaultFontSizes": false,
			"fluid": true,
			"lineHeight": true,
			"fontFamilies": [
				{
					"slug": "vazirmatn",
					"name": "Vazirmatn",
					"fontFamily": "\"Vazirmatn FD\", Tahoma, \"Segoe UI\", sans-serif",
					"fontFace": [
						{
							"fontFamily": "Vazirmatn FD",
							"fontWeight": "400",
							"fontStyle": "normal",
							"fontDisplay": "swap",
							"src": [
								"file:./assets/fonts/Vazirmatn-FD-Regular.woff2"
							]
						},
						{
							"fontFamily": "Vazirmatn FD",
							"fontWeight": "500",
							"fontStyle": "normal",
							"fontDisplay": "swap",
							"src": [
								"file:./assets/fonts/Vazirmatn-FD-Medium.woff2"
							]
						},
						{
							"fontFamily": "Vazirmatn FD",
							"fontWeight": "700",
							"fontStyle": "normal",
							"fontDisplay": "swap",
							"src": [
								"file:./assets/fonts/Vazirmatn-FD-Bold.woff2"
							]
						},
						{
							"fontFamily": "Vazirmatn",
							"fontWeight": "400",
							"fontStyle": "normal",
							"fontDisplay": "swap",
							"src": [
								"file:./assets/fonts/Vazirmatn-Regular.woff2"
							]
						}
					]
				}
			],
			"fontSizes": [
				{
					"slug": "small",
					"name": "Small",
					"size": "0.875rem",
					"fluid": false
				},
				{
					"slug": "medium",
					"name": "Medium",
					"size": "1rem",
					"fluid": false
				},
				{
					"slug": "large",
					"name": "Large",
					"size": "1.25rem",
					"fluid": {
						"min": "1.125rem",
						"max": "1.25rem"
					}
				},
				{
					"slug": "x-large",
					"name": "Extra large",
					"size": "1.75rem",
					"fluid": {
						"min": "1.375rem",
						"max": "1.75rem"
					}
				},
				{
					"slug": "xx-large",
					"name": "Huge",
					"size": "2.5rem",
					"fluid": {
						"min": "1.75rem",
						"max": "2.5rem"
					}
				}
			]
		},
		"spacing": {
			"units": [
				"px",
				"rem",
				"%",
				"vw"
			]
		}
	},
	"styles": {
		"color": {
			"background": "var(--wp--preset--color--ground)",
			"text": "var(--wp--preset--color--ink)"
		},
		"typography": {
			"fontFamily": "var(--wp--preset--font-family--vazirmatn)",
			"fontSize": "var(--wp--preset--font-size--medium)",
			"lineHeight": "1.8"
		},
		"elements": {
			"link": {
				"color": {
					"text": "var(--wp--preset--color--accent)"
				},
				":hover": {
					"color": {
						"text": "var(--wp--preset--color--accent-deep)"
					}
				}
			},
			"heading": {
				"typography": {
					"fontWeight": "700",
					"lineHeight": "1.45"
				},
				"color": {
					"text": "var(--wp--preset--color--ink)"
				}
			},
			"button": {
				"color": {
					"background": "var(--wp--preset--color--accent)",
					"text": "var(--wp--preset--color--surface)"
				},
				"border": {
					"radius": "6px",
					"width": "0"
				},
				"typography": {
					"fontWeight": "700",
					"fontSize": "0.9375rem",
					"lineHeight": "1.5"
				},
				"spacing": {
					"padding": {
						"top": "0.75rem",
						"bottom": "0.75rem",
						"left": "1.5rem",
						"right": "1.5rem"
					}
				},
				":hover": {
					"color": {
						"background": "var(--wp--preset--color--accent-deep)",
						"text": "var(--wp--preset--color--surface)"
					}
				},
				":focus": {
					"color": {
						"background": "var(--wp--preset--color--accent-deep)",
						"text": "var(--wp--preset--color--surface)"
					}
				}
			}
		}
	}
}
```

### sofreh/assets/css/editor.css

```css
/*
 * Editor styles: theme.json already provides fonts, colours and buttons to
 * the block editor; this only matches the front-end reading measure.
 */
.editor-styles-wrapper {
	line-height: 1.8;
	font-feature-settings: "ss01"; /* Persian digits, see main.css. */
}

.editor-styles-wrapper blockquote {
	border-inline-start: 2px solid var(--wp--preset--color--line);
	padding-inline-start: 1.2em;
	color: var(--wp--preset--color--muted);
}
```

### sofreh/assets/css/main.css

```css
/*
 * Sofreh — base styles.
 *
 * Direction: the familiar Iranian marketplace storefront, made with care,
 * in the store's own colours: lapis (لاجوردی) for actions and the brand,
 * saffron (زعفرانی) for offers, plum as the deep jewel partner, on a warm
 * porcelain ground. A fine 8-point-star (khatam) line pattern marks the
 * banner and the offers band. Hairline dividers, Vazirmatn throughout.
 * Phone first.
 *
 * Logical properties (inline-start/end) keep one stylesheet correct in RTL
 * (Persian) and LTR.
 *
 * Persian typography:
 * - No letter-spacing or text-transform on Persian text.
 * - "Vazirmatn FD" draws ASCII digits as Persian digits through its "ss01"
 *   set, switched on explicitly so isolated numbers (an old price, a badge)
 *   cannot fall back to Latin shapes. Stored data keeps ASCII digits. Email,
 *   URL and password fields use plain "Vazirmatn" with the feature off.
 */

/* ------------------------------------------------------------------ */
/* Tokens                                                              */
/* ------------------------------------------------------------------ */

:root {
	/* Neutrals: warm porcelain ground, indigo-tinted ink. */
	--c-ground: #f7f4ef;
	--c-surface: #ffffff;
	--c-line: #eae6df;
	--c-line-strong: #d6d0c7;
	--c-ink: #191d34;
	--c-muted: #5e6275;

	/* Lapis: actions, links, current state, the wordmark (white on it 7.5:1). */
	--c-accent: #2d48c0;
	--c-accent-deep: #1e339b;
	--c-accent-soft: #e9f0ff;

	/* Saffron: offers only — discount tags, the cart count, the section star (ink on it 8.6:1). */
	--c-saffron: #faab35;
	--c-saffron-soft: #fff0d0;

	/* Plum: the deep partner in the banner and the offers band. */
	--c-plum: #67237a;

	/* Status. Red now means errors and nothing else. */
	--c-error: #b32228;
	--c-error-soft: #ffece9;
	--c-success: #1a7f45;
	--c-success-soft: #e7f5ec;
	--c-warning-soft: #fff4e0;
	--c-warning-ink: #7a4d00;
	--c-info-soft: #e9f0ff;
	--c-star: #faab35;
	--c-focus: #1e339b;

	/* Signature: khatam line pattern (light on colour, dark on light) and the solid star mark. */
	--pattern-light: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='64' height='64' viewBox='0 0 64 64'%3E%3Cpath d='M32.0 12.0L37.2 19.5L46.1 17.9L44.5 26.8L52.0 32.0L44.5 37.2L46.1 46.1L37.2 44.5L32.0 52.0L26.8 44.5L17.9 46.1L19.5 37.2L12.0 32.0L19.5 26.8L17.9 17.9L26.8 19.5Z M0.0 -20.0L5.2 -12.5L14.1 -14.1L12.5 -5.2L20.0 0.0L12.5 5.2L14.1 14.1L5.2 12.5L0.0 20.0L-5.2 12.5L-14.1 14.1L-12.5 5.2L-20.0 0.0L-12.5 -5.2L-14.1 -14.1L-5.2 -12.5Z M64.0 -20.0L69.2 -12.5L78.1 -14.1L76.5 -5.2L84.0 0.0L76.5 5.2L78.1 14.1L69.2 12.5L64.0 20.0L58.8 12.5L49.9 14.1L51.5 5.2L44.0 0.0L51.5 -5.2L49.9 -14.1L58.8 -12.5Z M0.0 44.0L5.2 51.5L14.1 49.9L12.5 58.8L20.0 64.0L12.5 69.2L14.1 78.1L5.2 76.5L0.0 84.0L-5.2 76.5L-14.1 78.1L-12.5 69.2L-20.0 64.0L-12.5 58.8L-14.1 49.9L-5.2 51.5Z M64.0 44.0L69.2 51.5L78.1 49.9L76.5 58.8L84.0 64.0L76.5 69.2L78.1 78.1L69.2 76.5L64.0 84.0L58.8 76.5L49.9 78.1L51.5 69.2L44.0 64.0L51.5 58.8L49.9 49.9L58.8 51.5Z' fill='none' stroke='%23fff' stroke-opacity='0.13' stroke-width='1'/%3E%3C/svg%3E");
	--pattern-dark: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='64' height='64' viewBox='0 0 64 64'%3E%3Cpath d='M32.0 12.0L37.2 19.5L46.1 17.9L44.5 26.8L52.0 32.0L44.5 37.2L46.1 46.1L37.2 44.5L32.0 52.0L26.8 44.5L17.9 46.1L19.5 37.2L12.0 32.0L19.5 26.8L17.9 17.9L26.8 19.5Z M0.0 -20.0L5.2 -12.5L14.1 -14.1L12.5 -5.2L20.0 0.0L12.5 5.2L14.1 14.1L5.2 12.5L0.0 20.0L-5.2 12.5L-14.1 14.1L-12.5 5.2L-20.0 0.0L-12.5 -5.2L-14.1 -14.1L-5.2 -12.5Z M64.0 -20.0L69.2 -12.5L78.1 -14.1L76.5 -5.2L84.0 0.0L76.5 5.2L78.1 14.1L69.2 12.5L64.0 20.0L58.8 12.5L49.9 14.1L51.5 5.2L44.0 0.0L51.5 -5.2L49.9 -14.1L58.8 -12.5Z M0.0 44.0L5.2 51.5L14.1 49.9L12.5 58.8L20.0 64.0L12.5 69.2L14.1 78.1L5.2 76.5L0.0 84.0L-5.2 76.5L-14.1 78.1L-12.5 69.2L-20.0 64.0L-12.5 58.8L-14.1 49.9L-5.2 51.5Z M64.0 44.0L69.2 51.5L78.1 49.9L76.5 58.8L84.0 64.0L76.5 69.2L78.1 78.1L69.2 76.5L64.0 84.0L58.8 76.5L49.9 78.1L51.5 69.2L44.0 64.0L51.5 58.8L49.9 49.9L58.8 51.5Z' fill='none' stroke='%23191d34' stroke-opacity='0.09' stroke-width='1'/%3E%3C/svg%3E");
	--mark-star: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M12.0 1.0L14.4 6.3L19.8 4.2L17.7 9.6L23.0 12.0L17.7 14.4L19.8 19.8L14.4 17.7L12.0 23.0L9.6 17.7L4.2 19.8L6.3 14.4L1.0 12.0L6.3 9.6L4.2 4.2L9.6 6.3Z'/%3E%3C/svg%3E");

	--font: "Vazirmatn FD", Tahoma, "Segoe UI", sans-serif;
	--font-latin-digits: "Vazirmatn", Tahoma, "Segoe UI", sans-serif;

	--r-s: 6px;
	--r: 10px;
	--r-l: 16px;
	--shadow-s: 0 1px 2px rgb(25 29 52 / 6%);
	--shadow: 0 2px 6px rgb(25 29 52 / 6%), 0 12px 32px -12px rgb(25 29 52 / 18%);

	--container: 1336px;
	--gutter: clamp(12px, 3vw, 24px);
	--gap: clamp(12px, 2vw, 20px);
	--tabbar-h: 0px;
	--ease-out: cubic-bezier(0.22, 1, 0.36, 1);
}

@media (max-width: 960px) {
	:root {
		--tabbar-h: 64px;
	}
}

/* ------------------------------------------------------------------ */
/* Base                                                                */
/* ------------------------------------------------------------------ */

*,
*::before,
*::after {
	box-sizing: border-box;
}

html {
	-webkit-text-size-adjust: 100%;
	text-size-adjust: 100%;
	scroll-padding-top: 130px;
	scrollbar-color: var(--c-line-strong) transparent;
}

body {
	margin: 0;
	padding-bottom: calc(var(--tabbar-h) + env(safe-area-inset-bottom, 0px));
	background: var(--c-ground);
	color: var(--c-ink);
	font-family: var(--font);
	font-size: 1rem;
	line-height: 1.8;
	font-feature-settings: "ss01";
	text-rendering: optimizeLegibility;
	-webkit-font-smoothing: antialiased;
	overflow-wrap: break-word;
}

::selection {
	background: var(--c-accent);
	color: #fff;
}

html.has-open-drawer,
html.has-open-drawer body {
	overflow: hidden;
}

img,
svg,
video {
	max-width: 100%;
	height: auto;
	vertical-align: middle;
}

h1,
h2,
h3,
h4,
h5,
h6 {
	margin: 0 0 0.5em;
	font-weight: 700;
	line-height: 1.5;
	color: var(--c-ink);
	text-wrap: balance;
}

h1 { font-size: clamp(1.35rem, 1.1rem + 1vw, 1.75rem); }
h2 { font-size: clamp(1.15rem, 1rem + 0.6vw, 1.4rem); }
h3 { font-size: 1.125rem; }
h4,
h5,
h6 { font-size: 1rem; }

p,
ul,
ol,
dl,
blockquote,
figure,
table {
	margin: 0 0 1.2em;
}

ul,
ol {
	padding-inline-start: 1.4em;
}

/* Text links in lapis: 7.5:1 on white, 6.8:1 on the porcelain ground. */
a {
	color: var(--c-accent);
	text-decoration-thickness: 1px;
	text-underline-offset: 0.3em;
}

a:hover {
	color: var(--c-accent-deep);
}

hr {
	border: 0;
	border-top: 1px solid var(--c-line);
	margin: 2em 0;
}

blockquote {
	margin-inline: 0;
	padding: 0.4em 1.2em;
	border-inline-start: 2px solid var(--c-line-strong);
	color: var(--c-muted);
}

table {
	width: 100%;
	border-collapse: collapse;
	font-variant-numeric: tabular-nums;
}

th,
td {
	padding: 0.75em;
	text-align: start;
	border-bottom: 1px solid var(--c-line);
}

code,
kbd,
pre {
	font-family: ui-monospace, "SFMono-Regular", Menlo, Consolas, monospace;
	font-feature-settings: normal;
	font-size: 0.9em;
	direction: ltr;
	unicode-bidi: isolate;
}

pre {
	overflow: auto;
	padding: 1em;
	background: var(--c-ground);
	border-radius: var(--r-s);
	text-align: left;
}

:focus-visible {
	outline: 2px solid var(--c-focus);
	outline-offset: 2px;
	border-radius: 4px;
}

.ltr-text {
	direction: ltr;
	unicode-bidi: isolate;
	display: inline-block;
}

.screen-reader-text {
	border: 0;
	clip: rect(1px, 1px, 1px, 1px);
	clip-path: inset(50%);
	height: 1px;
	width: 1px;
	margin: -1px;
	overflow: hidden;
	padding: 0;
	position: absolute !important;
	white-space: nowrap;
	word-wrap: normal !important;
}

.skip-link:focus {
	clip: auto;
	clip-path: none;
	width: auto;
	height: auto;
	margin: 0;
	inset-block-start: 8px;
	inset-inline-start: 8px;
	z-index: 1000;
	padding: 12px 20px;
	background: var(--c-surface);
	color: var(--c-ink);
	border-radius: var(--r);
	box-shadow: var(--shadow);
	font-weight: 700;
}

@media (prefers-reduced-motion: reduce) {
	*,
	*::before,
	*::after {
		animation-duration: 0.01ms !important;
		animation-iteration-count: 1 !important;
		transition-duration: 0.01ms !important;
		scroll-behavior: auto !important;
	}
}

/* ------------------------------------------------------------------ */
/* Layout                                                              */
/* ------------------------------------------------------------------ */

.container {
	width: 100%;
	max-width: var(--container);
	margin-inline: auto;
	padding-inline: var(--gutter);
}

.site-content {
	min-height: 50vh;
}

.reading-page,
.store-page,
.content-layout {
	padding-block: var(--gap) 48px;
}

.panel-surface,
.reading-page > .site-main {
	background: var(--c-surface);
	border-radius: var(--r-l);
	padding: clamp(16px, 3vw, 32px);
	box-shadow: var(--shadow-s);
}

.reading-page > .site-main {
	max-width: 860px;
	margin-inline: auto;
}

.reading-page--wide > .site-main {
	max-width: none;
}

.content-layout {
	display: grid;
	gap: var(--gap);
}

.content-layout > .site-main {
	min-width: 0;
}

.has-blog-sidebar .content-layout {
	grid-template-columns: minmax(0, 1fr) 300px;
}

@media (max-width: 960px) {
	.has-blog-sidebar .content-layout {
		grid-template-columns: minmax(0, 1fr);
	}
}

.page-header {
	margin-block-end: 20px;
}

.page-title {
	margin: 0;
}

.archive-description {
	color: var(--c-muted);
	margin-block-start: 6px;
}

.entry-content > * + * {
	margin-block-start: 1.2em;
}

.entry-content > :first-child {
	margin-block-start: 0;
}

.alignleft {
	float: left;
	margin: 0 1.5em 1em 0;
}

.alignright {
	float: right;
	margin: 0 0 1em 1.5em;
}

.aligncenter {
	display: block;
	margin-inline: auto;
}

.wp-caption-text,
figcaption,
.gallery-caption {
	font-size: 0.875rem;
	color: var(--c-muted);
	margin-block-start: 0.5em;
}

.entry-thumbnail img {
	border-radius: var(--r);
	width: 100%;
}

.entry-meta {
	color: var(--c-muted);
	font-size: 0.875rem;
	margin: 6px 0 0;
}

/* ------------------------------------------------------------------ */
/* Buttons and forms                                                   */
/* ------------------------------------------------------------------ */

.button,
button.button,
input[type="submit"],
input[type="button"],
.wp-element-button {
	display: inline-flex;
	align-items: center;
	justify-content: center;
	gap: 0.5em;
	min-height: 44px;
	padding: 0.55em 1.25em;
	border: 1px solid transparent;
	border-radius: var(--r-s);
	background: var(--c-accent);
	color: #fff;
	font: inherit;
	font-size: 0.9375rem;
	font-weight: 700;
	line-height: 1.5;
	text-decoration: none;
	cursor: pointer;
	transition: background-color 0.15s ease, border-color 0.15s ease, color 0.15s ease, transform 0.12s ease;
}

.button:hover,
button.button:hover,
input[type="submit"]:hover,
input[type="button"]:hover {
	background: var(--c-accent-deep);
	color: #fff;
}

.button:active,
button.button:active,
input[type="submit"]:active,
.wp-element-button:active {
	transform: scale(0.98);
}

.button--ghost,
.button.button--ghost {
	background: var(--c-surface);
	border-color: var(--c-line-strong);
	color: var(--c-ink);
}

.button--ghost:hover,
.button.button--ghost:hover {
	background: var(--c-surface);
	border-color: var(--c-ink);
	color: var(--c-ink);
}

.button:disabled,
.button.disabled,
button:disabled {
	opacity: 0.5;
	cursor: not-allowed;
}

.icon-button {
	display: inline-grid;
	place-items: center;
	width: 44px;
	height: 44px;
	padding: 0;
	border: 0;
	border-radius: var(--r);
	background: transparent;
	color: var(--c-ink);
	cursor: pointer;
}

.icon-button:hover {
	background: var(--c-ground);
}

label {
	display: inline-block;
	margin-block-end: 6px;
	font-size: 0.9375rem;
	font-weight: 500;
}

input[type="text"],
input[type="email"],
input[type="url"],
input[type="password"],
input[type="search"],
input[type="number"],
input[type="tel"],
input[type="date"],
select,
textarea {
	width: 100%;
	min-height: 46px;
	padding: 0.55em 0.9em;
	border: 1px solid var(--c-line-strong);
	border-radius: var(--r-s);
	background: var(--c-surface);
	color: var(--c-ink);
	font: inherit;
	line-height: 1.5;
	caret-color: var(--c-accent);
	transition: border-color 0.15s ease, box-shadow 0.15s ease;
}

textarea {
	min-height: 120px;
	resize: vertical;
}

input:focus,
select:focus,
textarea:focus {
	outline: none;
	border-color: var(--c-focus);
	box-shadow: 0 0 0 3px rgb(45 72 192 / 20%);
}

input[type="email"],
input[type="url"],
input[type="password"] {
	font-family: var(--font-latin-digits);
	font-feature-settings: normal;
	direction: ltr;
	text-align: left;
}

input[type="tel"] {
	direction: ltr;
}

input[type="tel"]:placeholder-shown,
input[type="email"]:placeholder-shown,
input[type="url"]:placeholder-shown,
input[type="password"]:placeholder-shown {
	text-align: right;
}

input[type="checkbox"],
input[type="radio"] {
	width: 18px;
	height: 18px;
	accent-color: var(--c-accent);
	vertical-align: middle;
	margin: 0;
	margin-inline-end: 8px;
}

select {
	appearance: none;
	background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1.5 6 6.5l5-5' fill='none' stroke='%235e6275' stroke-width='1.6' stroke-linecap='round'/%3E%3C/svg%3E");
	background-repeat: no-repeat;
	background-position: left 14px center;
	padding-inline-end: 2.4em;
}

html:not([dir="rtl"]) select {
	background-position: right 14px center;
}

::placeholder {
	color: var(--c-muted); /* 6:1 on white, 5.5:1 on the porcelain ground. */
	opacity: 1;
}

/* Search */
.search-form {
	position: relative;
	display: flex;
	align-items: center;
}

.search-form .search-field {
	padding-inline: 44px 14px;
	background: var(--c-ground);
	border-color: transparent;
	border-radius: var(--r);
}

.search-form .search-field:focus {
	background: var(--c-surface);
}

.search-form .search-submit {
	position: absolute;
	inset-inline-start: 4px;
	inset-block: 4px;
	width: 40px;
	display: grid;
	place-items: center;
	border: 0;
	border-radius: var(--r-s);
	background: transparent;
	color: var(--c-muted);
	cursor: pointer;
}

.search-form .search-submit:hover {
	color: var(--c-ink);
}

input[type="search"]::-webkit-search-cancel-button {
	-webkit-appearance: none;
}

/* ------------------------------------------------------------------ */
/* Header                                                              */
/* ------------------------------------------------------------------ */

.announcement {
	background: var(--c-ink);
	color: #fff;
	font-size: 0.8125rem;
	text-align: center;
}

.announcement p {
	margin: 0;
	padding-block: 7px;
}

.site-header {
	position: sticky;
	top: 0;
	z-index: 50;
	background: var(--c-surface);
	box-shadow: 0 1px 0 var(--c-line);
	transition: box-shadow 0.25s ease, transform 0.3s var(--ease-out);
}

.admin-bar .site-header {
	top: var(--wp-admin--admin-bar--height, 32px);
}

@media (max-width: 600px) {
	.admin-bar .site-header {
		top: 0;
	}
}

/* Signature: a thin line along the top of the header, lapis at the start (right in RTL) through plum to saffron. */
.site-header::before {
	content: "";
	display: block;
	height: 3px;
	background: linear-gradient(90deg, var(--c-saffron), var(--c-plum) 45%, var(--c-accent));
}

.site-header.is-scrolled {
	box-shadow: 0 1px 0 var(--c-line), 0 8px 20px -16px rgb(25 29 52 / 40%);
}

.hdr {
	display: grid;
	grid-template-columns: auto auto minmax(0, 1fr) auto;
	grid-template-areas: "menu brand search actions";
	align-items: center;
	gap: 8px 20px;
	min-height: 72px;
}

.menu-toggle { grid-area: menu; display: none; }
.site-branding { grid-area: brand; }
.hdr__search { grid-area: search; max-width: 640px; width: 100%; }
.hdr__actions { grid-area: actions; display: flex; align-items: center; gap: 8px; }

.site-title {
	display: block;
	color: var(--c-accent);
	font-size: 1.6rem;
	font-weight: 700;
	line-height: 1.2;
	text-decoration: none;
}

.site-title:hover {
	color: var(--c-accent-deep);
}

.custom-logo {
	display: block;
	max-height: 44px;
	width: auto;
}

.hdr__search .search-field {
	min-height: 48px;
}

.header-action {
	position: relative;
	display: inline-flex;
	align-items: center;
	gap: 8px;
	min-height: 44px;
	padding-inline: 10px;
	border-radius: var(--r);
	color: var(--c-ink);
	font-size: 0.875rem;
	font-weight: 500;
	text-decoration: none;
}

.header-action:hover {
	background: var(--c-ground);
	color: var(--c-ink);
}

.header-account--guest {
	border: 1px solid var(--c-line-strong);
	padding-inline: 12px 14px;
}

.header-cart {
	padding-inline: 8px;
}

.header-cart + .header-account,
.header-account + .header-cart {
	margin-inline-start: 4px;
}

.hdr__actions .header-cart {
	padding-inline: 10px;
}

/* The count sits on the bag's top corner and only clips its edge. */
.cart-count {
	position: absolute;
	inset-block-start: 3px;
	inset-inline-end: -3px;
	display: inline-grid;
	place-items: center;
	min-width: 18px;
	height: 18px;
	padding-inline: 4px;
	border-radius: 9px;
	background: var(--c-saffron);
	color: var(--c-ink);
	font-size: 0.75rem;
	font-weight: 700;
	line-height: 1;
	box-shadow: 0 0 0 2px var(--c-surface);
}

.cart-count.is-empty {
	display: none;
}

/* Category menu row (desktop) */
.hdr-nav__inner {
	display: flex;
	align-items: center;
	gap: 4px;
	min-height: 44px;
}

.hdr-nav__sep {
	width: 1px;
	height: 20px;
	background: var(--c-line-strong);
	margin-inline: 8px;
}

.mega {
	position: static;
}

.mega__toggle {
	display: inline-flex;
	align-items: center;
	gap: 8px;
	min-height: 44px;
	padding: 0 8px;
	border: 0;
	background: none;
	color: var(--c-ink);
	font: inherit;
	font-size: 0.875rem;
	font-weight: 700;
	cursor: pointer;
	box-shadow: inset 0 -2px 0 transparent;
	transition: box-shadow 0.2s ease;
}

.mega__toggle[aria-expanded="true"],
.mega__toggle:hover {
	box-shadow: inset 0 -2px 0 var(--c-accent);
}

.mega__panel {
	position: absolute;
	inset-inline: 0;
	top: 100%;
	z-index: 60;
	background: var(--c-surface);
	border-top: 1px solid var(--c-line);
	box-shadow: 0 24px 40px -24px rgb(25 29 52 / 35%);
	padding-block: 24px 28px;
	animation: sofreh-drop 0.22s var(--ease-out);
}

.mega__grid {
	width: 100%;
	max-width: var(--container);
	margin-inline: auto;
	padding-inline: var(--gutter);
	display: grid;
	grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
	gap: 20px 32px;
}

.mega__parent {
	display: inline-flex;
	align-items: center;
	gap: 4px;
	margin-bottom: 6px;
	color: var(--c-ink);
	font-weight: 700;
	font-size: 0.9375rem;
	text-decoration: none;
}

.mega__parent:hover {
	color: var(--c-accent);
}

.mega__col ul {
	margin: 0;
	padding: 0;
	list-style: none;
}

.mega__col li a {
	display: block;
	padding: 4px 12px;
	color: var(--c-muted);
	font-size: 0.875rem;
	text-decoration: none;
}

.mega__col li a:hover {
	color: var(--c-ink);
}

.primary-menu {
	display: flex;
	flex-wrap: wrap;
	gap: 0;
	margin: 0;
	padding: 0;
	list-style: none;
}

.primary-menu > li {
	position: relative;
}

.primary-menu a {
	display: block;
	padding: 10px 10px;
	color: var(--c-muted);
	font-size: 0.875rem;
	text-decoration: none;
	line-height: 1.7;
}

.primary-menu a:hover,
.primary-menu .current-menu-item > a {
	color: var(--c-ink);
}

.primary-menu .sub-menu {
	position: absolute;
	inset-inline-start: 0;
	top: 100%;
	z-index: 61;
	min-width: 220px;
	margin: 0;
	padding: 8px;
	list-style: none;
	background: var(--c-surface);
	border: 1px solid var(--c-line);
	border-radius: var(--r);
	box-shadow: var(--shadow);
	opacity: 0;
	visibility: hidden;
	transform: translateY(4px);
	transition: opacity 0.15s ease, transform 0.15s ease, visibility 0.15s;
}

.primary-menu li:hover > .sub-menu,
.primary-menu li:focus-within > .sub-menu {
	opacity: 1;
	visibility: visible;
	transform: none;
}

.primary-menu .sub-menu a {
	border-radius: var(--r-s);
}

.primary-menu .sub-menu a:hover {
	background: var(--c-ground);
}

@keyframes sofreh-drop {
	from {
		opacity: 0;
		transform: translateY(-6px);
	}
}

/* Drawer (mobile menu) */
.site-drawer {
	position: fixed;
	inset-block: 0;
	inset-inline-start: 0;
	z-index: 100;
	width: min(86vw, 360px);
	overflow-y: auto;
	overscroll-behavior: contain;
	background: var(--c-surface);
	box-shadow: var(--shadow);
	transform: translateX(100%);
	visibility: hidden;
	transition: transform 0.28s var(--ease-out), visibility 0.28s;
}

html:not([dir="rtl"]) .site-drawer {
	transform: translateX(-100%);
}

.site-drawer.is-open {
	transform: none !important;
	visibility: visible;
	transition: transform 0.28s var(--ease-out), visibility 0s;
}

.site-drawer__head {
	position: sticky;
	top: 0;
	display: flex;
	align-items: center;
	justify-content: space-between;
	padding: 10px 16px;
	background: var(--c-surface);
	border-bottom: 1px solid var(--c-line);
}

.site-drawer__title {
	font-weight: 700;
}

.site-drawer__section {
	padding: 12px 8px;
	border-bottom: 1px solid var(--c-line);
}

.site-drawer__label {
	margin: 0 8px 4px;
	color: var(--c-muted);
	font-size: 0.8125rem;
	font-weight: 500;
}

.cat-tree,
.cat-tree ul,
.drawer-menu,
.drawer-menu .sub-menu {
	margin: 0;
	padding: 0;
	list-style: none;
}

.cat-tree a,
.cat-tree summary,
.drawer-menu a {
	display: flex;
	align-items: center;
	justify-content: space-between;
	min-height: 48px;
	padding: 8px 12px;
	border-radius: var(--r-s);
	color: var(--c-ink);
	font-size: 0.9375rem;
	text-decoration: none;
	cursor: pointer;
}

.cat-tree summary {
	list-style: none;
	font-weight: 500;
}

.cat-tree summary::-webkit-details-marker {
	display: none;
}

.cat-tree summary .icon {
	color: var(--c-muted);
	transition: transform 0.2s ease;
}

.cat-tree details[open] summary .icon {
	transform: rotate(180deg);
}

.cat-tree details ul {
	padding-inline-start: 12px;
	margin-bottom: 6px;
	border-inline-start: 1px solid var(--c-line);
	margin-inline-start: 12px;
}

.cat-tree details ul a {
	min-height: 42px;
	color: var(--c-muted);
	font-size: 0.875rem;
}

.cat-tree .cat-tree__all {
	color: var(--c-accent);
	font-weight: 500;
}

.cat-tree a:hover,
.cat-tree summary:hover,
.drawer-menu a:hover {
	background: var(--c-ground);
}

.drawer-menu .sub-menu {
	padding-inline-start: 16px;
}

.drawer-backdrop {
	position: fixed;
	inset: 0;
	z-index: 90;
	background: rgb(20 22 26 / 45%);
	animation: sofreh-fade 0.25s ease both;
}

@keyframes sofreh-fade {
	from {
		opacity: 0;
	}
}

/* Mobile bottom tab bar */
.tabbar {
	display: none;
}

@media (max-width: 960px) {
	.hdr {
		grid-template-columns: auto minmax(0, 1fr) auto;
		grid-template-areas:
			"menu brand actions"
			"search search search";
		gap: 4px 8px;
		min-height: 0;
		padding-block: 6px 10px;
	}

	.menu-toggle {
		display: inline-grid;
		margin-inline-start: -8px;
	}

	.site-branding {
		justify-self: start;
	}

	.site-title {
		font-size: 1.35rem;
	}

	.hdr__search {
		max-width: none;
	}

	.hdr__search .search-field {
		min-height: 44px;
	}

	.hdr-nav {
		display: none;
	}

	.hdr__actions .header-cart,
	.hdr__actions .header-account {
		border: 0;
		padding-inline: 8px;
	}

	.hdr__actions .header-account .header-action__label {
		position: absolute;
		width: 1px;
		height: 1px;
		overflow: hidden;
		clip-path: inset(50%);
		white-space: nowrap;
	}

	.tabbar {
		position: fixed;
		inset-inline: 0;
		bottom: 0;
		z-index: 80;
		display: grid;
		grid-template-columns: repeat(4, 1fr);
		height: calc(var(--tabbar-h) + env(safe-area-inset-bottom, 0px));
		padding-bottom: env(safe-area-inset-bottom, 0px);
		background: var(--c-surface);
		box-shadow: 0 -1px 0 var(--c-line), 0 -8px 24px -18px rgb(25 29 52 / 40%);
	}

	.tabbar__item {
		position: relative;
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		gap: 2px;
		border: 0;
		background: none;
		color: var(--c-muted);
		font: inherit;
		font-size: 0.6875rem;
		font-weight: 500;
		text-decoration: none;
		cursor: pointer;
	}

	.tabbar__item.is-current,
	.tabbar__item[aria-current="page"] {
		color: var(--c-accent);
		font-weight: 700;
	}

	.tabbar__item.is-current::before {
		content: "";
		position: absolute;
		top: 0;
		width: 24px;
		height: 4px;
		border-radius: 0 0 4px 4px;
		background: var(--c-accent);
	}

	.tabbar__icon {
		position: relative;
		display: inline-grid;
	}

	.tabbar .cart-count {
		inset-block: -5px auto;
		inset-inline-end: -13px;
	}
}

@media (min-width: 961px) {
	.site-drawer,
	.drawer-backdrop {
		display: none !important;
	}
}

/* ------------------------------------------------------------------ */
/* Home                                                                */
/* ------------------------------------------------------------------ */

.home-section {
	margin-block-start: var(--gap);
}

.home > :last-child {
	margin-block-end: 40px;
}

/* Banner carousel */
.banner {
	padding-block-start: var(--gap);
}

.banner__frame {
	position: relative;
	border-radius: var(--r-l);
	overflow: hidden;
}

.banner__track {
	display: flex;
	overflow-x: auto;
	scroll-snap-type: x mandatory;
	scroll-behavior: smooth;
	scrollbar-width: none;
	overscroll-behavior-x: contain;
}

.banner__track::-webkit-scrollbar {
	display: none;
}

.banner__slide {
	position: relative;
	flex: 0 0 100%;
	scroll-snap-align: start;
	display: grid;
	grid-template-columns: minmax(0, 1fr) auto;
	align-items: center;
	gap: 16px;
	min-height: clamp(200px, 30vw, 340px);
	padding: clamp(20px, 4vw, 56px);
	color: #fff;
}

/* Banner tones: jewel colours under the khatam line pattern. */
.banner__slide.tone-lapis {
	background:
		var(--pattern-light) 0 0 / 64px,
		radial-gradient(120% 140% at 100% 0%, #4562dc 0%, var(--c-accent) 42%, var(--c-accent-deep) 100%);
}

.banner__slide.tone-plum {
	background:
		var(--pattern-light) 0 0 / 64px,
		radial-gradient(120% 140% at 100% 0%, #8a3aa0 0%, var(--c-plum) 50%, #4a1859 100%);
}

.banner__slide.tone-saffron {
	color: var(--c-ink);
	background:
		var(--pattern-dark) 0 0 / 64px,
		radial-gradient(120% 140% at 100% 0%, #ffc56a 0%, var(--c-saffron) 55%, #f29a1f 100%);
}

.banner__slide.tone-saffron .banner__title {
	color: var(--c-ink);
}

.banner__slide.tone-saffron .banner__text {
	color: rgb(25 29 52 / 82%);
}

.banner__slide.tone-saffron .banner__button {
	background: var(--c-ink);
	color: #fff;
}

.banner__title {
	margin: 0 0 6px;
	color: #fff;
	font-size: clamp(1.35rem, 1rem + 1.8vw, 2.4rem);
	font-weight: 700;
	line-height: 1.4;
}

.banner__text {
	max-width: 40ch;
	margin: 0 0 18px;
	color: rgb(255 255 255 / 95%); /* ≥4.5:1 even on the lightest corner of the lapis banner. */
	font-size: clamp(0.875rem, 0.8rem + 0.3vw, 1.0625rem);
}

.banner__button {
	display: inline-flex;
	align-items: center;
	min-height: 42px;
	padding: 0 18px;
	border-radius: var(--r-s);
	background: #fff;
	color: var(--c-ink);
	font-size: 0.9375rem;
	font-weight: 700;
	text-decoration: none;
	transition: transform 0.15s ease;
}

.banner__button:hover {
	color: var(--c-ink);
	transform: translateY(-1px);
}

.banner__media {
	width: clamp(120px, 26vw, 340px);
}

.banner__media img {
	display: block;
	width: 100%;
	aspect-ratio: 1;
	object-fit: cover;
	border-radius: var(--r);
	box-shadow: 0 18px 40px -20px rgb(0 0 0 / 50%);
}

.banner__controls {
	position: absolute;
	inset-inline: 0;
	bottom: 12px;
	display: flex;
	align-items: center;
	justify-content: center;
	gap: 8px;
	pointer-events: none;
}

.banner__controls > * {
	pointer-events: auto;
}

.banner__dots {
	display: flex;
	gap: 6px;
	padding: 6px 8px;
	border-radius: 999px;
	background: rgb(0 0 0 / 22%);
}

.banner__dot {
	width: 8px;
	height: 8px;
	padding: 0;
	border: 0;
	border-radius: 999px;
	background: rgb(255 255 255 / 60%);
	cursor: pointer;
	transition: width 0.3s var(--ease-out), background-color 0.3s ease;
}

.banner__dot.is-current {
	width: 22px;
	background: #fff;
}

.banner__nav,
.banner__pause {
	display: inline-grid;
	place-items: center;
	width: 36px;
	height: 36px;
	padding: 0;
	border: 0;
	border-radius: 50%;
	background: rgb(255 255 255 / 92%);
	color: var(--c-ink);
	box-shadow: var(--shadow-s);
	cursor: pointer;
}

.banner__nav--next .icon {
	transform: none;
}

.banner__nav--prev .icon {
	transform: scaleX(-1);
}

.banner__pause-icon {
	width: 10px;
	height: 12px;
	border-inline: 3px solid var(--c-ink);
}

/* Play triangle: media controls point right in both directions. */
.banner__pause[aria-pressed="true"] .banner__pause-icon {
	border-inline: 0;
	background: var(--c-ink);
	clip-path: polygon(0 0, 100% 50%, 0 100%);
	transform: translateX(1px);
}

@media (max-width: 700px) {
	.banner {
		padding-block-start: 12px;
	}

	.banner__slide {
		align-items: end;
		padding-bottom: 48px;
	}

	.banner__nav {
		display: none;
	}

	.banner__pause {
		width: 30px;
		height: 30px;
	}
}

/* Category circles */
/* The panel is the list itself, so it keeps the page gutters at every width. */
.cat-circles__list {
	display: flex;
	gap: clamp(12px, 3vw, 28px);
	justify-content: space-around;
	margin: 0;
	padding: 18px clamp(12px, 2vw, 20px);
	list-style: none;
	overflow-x: auto;
	scrollbar-width: none;
	background: var(--c-surface);
	border-radius: var(--r-l);
	box-shadow: var(--shadow-s);
}

.cat-circles__list::-webkit-scrollbar {
	display: none;
}

.cat-circle {
	display: flex;
	flex-direction: column;
	align-items: center;
	gap: 8px;
	width: clamp(72px, 18vw, 104px);
	color: var(--c-ink);
	font-size: 0.8125rem;
	font-weight: 500;
	line-height: 1.5;
	text-align: center;
	text-decoration: none;
}

.cat-circle__img {
	display: grid;
	place-items: center;
	width: clamp(64px, 16vw, 92px);
	aspect-ratio: 1;
	border-radius: 50%;
	overflow: hidden;
	background: var(--c-ground);
	transition: transform 0.25s var(--ease-out), box-shadow 0.25s ease;
}

.cat-circle__img img {
	width: 100%;
	height: 100%;
	object-fit: cover;
}

.cat-circle:hover .cat-circle__img {
	transform: translateY(-3px);
	box-shadow: 0 0 0 2px var(--c-surface), 0 0 0 4px var(--c-line-strong);
}

.cat-circle:hover {
	color: var(--c-ink);
}

.cat-circle__initial {
	color: var(--c-accent);
	font-size: 1.6rem;
	font-weight: 700;
}

/* Store promises */
.trust-strip__list {
	background: var(--c-surface);
	border-radius: var(--r-l);
	box-shadow: var(--shadow-s);
}

.trust-strip__list {
	padding-inline: 16px !important;
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
	gap: 12px 24px;
	margin: 0;
	padding: 20px 0;
	list-style: none;
}

.trust-strip li {
	display: flex;
	flex-direction: column;
	align-items: center;
	gap: 6px;
	color: var(--c-muted);
	font-size: 0.8125rem;
	font-weight: 500;
	text-align: center;
}

.trust-strip .icon {
	color: var(--c-ink);
}

/* Phones: two by two, icon beside its line, so the promises stay one glance. */
@media (max-width: 560px) {
	.trust-strip__list {
		grid-template-columns: 1fr 1fr;
		gap: 16px 12px;
		padding-block: 16px;
	}

	.trust-strip li {
		flex-direction: row;
		gap: 8px;
		text-align: start;
		line-height: 1.6;
	}

	.trust-strip .icon {
		flex: none;
	}
}

/* Blog posts on the home page sit in the same frame as the shelves. */
.posts-frame .post-grid {
	padding-inline: clamp(14px, 2vw, 20px);
	grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
}

/* Inside the frame, posts are cells, not cards: no second border or shadow. */
.posts-frame .post-card {
	box-shadow: none;
	border-radius: 0;
	background: none;
}

.posts-frame .post-card__media {
	border-radius: var(--r);
	overflow: hidden;
}

.posts-frame .post-card__body {
	padding-inline: 0;
}

/* Section frames shared by product strips and ranking */
.strip__frame,
.ranking__frame {
	background: var(--c-surface);
	border-radius: var(--r-l);
	padding: 16px 0 16px;
	box-shadow: var(--shadow-s);
}

.strip__head {
	display: flex;
	align-items: center;
	justify-content: space-between;
	gap: 12px;
	padding-inline: clamp(14px, 2vw, 20px);
	margin-bottom: 10px;
}

.strip__title {
	display: flex;
	align-items: center;
	gap: 8px;
	margin: 0;
	font-size: clamp(1rem, 0.9rem + 0.4vw, 1.2rem);
}

/* Signature: a small saffron khatam star before each section title. */
.strip__title::before {
	content: "";
	flex: none;
	width: 14px;
	height: 14px;
	background: var(--c-saffron);
	-webkit-mask: var(--mark-star) center / contain no-repeat;
	mask: var(--mark-star) center / contain no-repeat;
}

.strip__more {
	display: inline-flex;
	align-items: center;
	gap: 2px;
	color: var(--c-accent);
	font-size: 0.8125rem;
	font-weight: 700;
	text-decoration: none;
}

.strip__more .icon {
	transition: transform 0.2s var(--ease-out);
}

.strip__more:hover .icon {
	transform: translateX(-3px);
}

html:not([dir="rtl"]) .strip__more:hover .icon {
	transform: scaleX(-1) translateX(-3px);
}

/* Special offers: lapis into plum under the khatam pattern. */
.strip--deals .strip__frame {
	background:
		var(--pattern-light) 0 0 / 64px,
		linear-gradient(110deg, var(--c-accent) 0%, #4a37b0 48%, var(--c-plum) 100%);
}

/* White focus rings only where the band's colour is behind them, not in its white cells. */
.strip--deals .strip__head :focus-visible,
.strip--deals .strip__arrow:focus-visible,
.banner__slide:not(.tone-saffron) :focus-visible {
	outline-color: #fff;
}

.strip--deals .strip__title,
.strip--deals .strip__more {
	color: #fff;
}

/* Best sellers ranking */
.ranking__list {
	display: grid;
	grid-template-columns: repeat(3, minmax(0, 1fr));
	margin: 0;
	padding: 0 clamp(14px, 2vw, 20px);
	list-style: none;
	counter-reset: rank;
}

.ranking__list li {
	counter-increment: rank;
	border-bottom: 1px solid var(--c-line);
}

.ranking__item {
	display: flex;
	align-items: center;
	gap: 12px;
	padding: 12px 8px;
	color: var(--c-ink);
	text-decoration: none;
}

.ranking__item::after {
	content: counter(rank);
	order: -1;
	flex: none;
	width: 28px;
	color: var(--c-ink);
	font-size: 1.75rem;
	font-weight: 700;
	line-height: 1;
	text-align: center;
}

.ranking__img img {
	width: 72px;
	height: 72px;
	object-fit: cover;
	border-radius: var(--r-s);
}

.ranking__body {
	display: flex;
	flex-direction: column;
	gap: 2px;
	min-width: 0;
}

.ranking__name {
	font-size: 0.875rem;
	line-height: 1.6;
	display: -webkit-box;
	-webkit-line-clamp: 2;
	-webkit-box-orient: vertical;
	overflow: hidden;
}

.ranking__item:hover .ranking__name {
	color: var(--c-accent);
}

.ranking .price {
	font-size: 0.875rem;
}

@media (max-width: 900px) {
	.ranking__list {
		grid-template-columns: minmax(0, 1fr);
	}
}

/* ------------------------------------------------------------------ */
/* Chips, posts, pagination, comments, widgets                         */
/* ------------------------------------------------------------------ */

.category-chips ul {
	display: flex;
	gap: 8px;
	margin: 14px 0 0;
	padding: 0;
	list-style: none;
	overflow-x: auto;
	scrollbar-width: none;
}

.category-chips ul::-webkit-scrollbar {
	display: none;
}

.chip {
	display: inline-flex;
	align-items: center;
	gap: 6px;
	min-height: 38px;
	padding: 4px 14px;
	border: 1px solid var(--c-line-strong);
	border-radius: 999px;
	background: var(--c-surface);
	color: var(--c-ink);
	font-size: 0.8125rem;
	text-decoration: none;
	white-space: nowrap;
	transition: border-color 0.15s ease, color 0.15s ease;
}

.chip:hover {
	border-color: var(--c-ink);
	color: var(--c-ink);
}

.chip__count {
	color: var(--c-muted);
	font-size: 0.75rem;
}

.post-grid {
	display: grid;
	grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
	gap: var(--gap);
}

.post-card {
	background: var(--c-surface);
	border-radius: var(--r);
	overflow: hidden;
	box-shadow: var(--shadow-s);
	transition: box-shadow 0.2s ease;
}

.post-card:hover {
	box-shadow: var(--shadow);
}

.post-card__link {
	display: flex;
	flex-direction: column;
	height: 100%;
	color: inherit;
	text-decoration: none;
}

.post-card__media {
	display: block;
	aspect-ratio: 16 / 10;
	background: var(--c-ground);
}

.post-card__media img {
	width: 100%;
	height: 100%;
	object-fit: cover;
}

.post-card__body {
	display: flex;
	flex-direction: column;
	gap: 4px;
	padding: 14px 16px 18px;
}

.post-card__type {
	color: var(--c-muted);
	font-size: 0.75rem;
}

.post-card__title {
	font-weight: 700;
	line-height: 1.6;
}

.post-card__excerpt {
	color: var(--c-muted);
	font-size: 0.875rem;
}

.sticky .post-card__title::before {
	content: "";
	display: inline-block;
	width: 0.9em;
	height: 0.9em;
	margin-inline-end: 6px;
	vertical-align: -0.05em;
	background: var(--c-star);
	-webkit-mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='m12 2.8 2.8 5.7 6.3.9-4.6 4.4 1.1 6.3L12 17.1l-5.6 3 1.1-6.3-4.6-4.4 6.3-.9z'/%3E%3C/svg%3E") center / contain no-repeat;
	mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='m12 2.8 2.8 5.7 6.3.9-4.6 4.4 1.1 6.3L12 17.1l-5.6 3 1.1-6.3-4.6-4.4 6.3-.9z'/%3E%3C/svg%3E") center / contain no-repeat;
}

.entry-tags span {
	color: var(--c-muted);
}

.post-navigation .nav-links {
	display: grid;
	grid-template-columns: 1fr 1fr;
	gap: 12px;
	margin-block: 32px;
}

.post-navigation a {
	display: block;
	padding: 14px;
	border: 1px solid var(--c-line);
	border-radius: var(--r);
	text-decoration: none;
	color: var(--c-ink);
}

.post-navigation .nav-next {
	text-align: end;
}

.post-navigation .nav-label {
	display: block;
	color: var(--c-muted);
	font-size: 0.75rem;
}

.pagination .nav-links,
.page-links {
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
	gap: 6px;
	margin-block-start: 32px;
}

.pagination .page-numbers,
.page-links a,
.page-links > span {
	display: inline-grid;
	place-items: center;
	min-width: 40px;
	min-height: 40px;
	padding-inline: 10px;
	border-radius: var(--r-s);
	color: var(--c-ink);
	text-decoration: none;
}

.pagination .page-numbers:hover {
	background: var(--c-surface);
}

.pagination .page-numbers.current {
	background: var(--c-ink);
	color: #fff;
}

.comments-area {
	margin-block-start: 40px;
	padding-block-start: 28px;
	border-top: 1px solid var(--c-line);
}

.comment-list {
	padding: 0;
	list-style: none;
}

.comment-list .children {
	list-style: none;
	padding-inline-start: 24px;
}

.comment-body {
	margin-block-end: 14px;
	padding: 14px;
	border: 1px solid var(--c-line);
	border-radius: var(--r);
}

.bypostauthor > .comment-body {
	border-color: var(--c-line-strong);
}

.comment-author .avatar {
	border-radius: 50%;
	margin-inline-end: 10px;
}

.comment-metadata {
	font-size: 0.75rem;
}

.comment-metadata a {
	color: var(--c-muted);
}

.comment-form p {
	margin-block-end: 14px;
}

.widget {
	margin-block-end: 28px;
}

.widget-title {
	margin-block-end: 10px;
	font-size: 0.9375rem;
}

.widget ul {
	margin: 0;
	padding: 0;
	list-style: none;
}

.widget li {
	padding-block: 5px;
}

.widget li a {
	color: var(--c-ink);
	text-decoration: none;
}

.widget li a:hover {
	color: var(--c-accent);
}

.blog-sidebar {
	background: var(--c-surface);
	border-radius: var(--r-l);
	padding: 20px;
	align-self: start;
	box-shadow: var(--shadow-s);
}

.no-results,
.not-found {
	text-align: center;
}

.no-results .category-chips ul,
.not-found .category-chips ul {
	justify-content: center;
	flex-wrap: wrap;
}

.not-found__code {
	margin: 0;
	color: #8b9098; /* Large text: 3.2:1 on white. */
	font-size: clamp(3.5rem, 10vw, 6rem);
	font-weight: 700;
	line-height: 1;
}

.search-again {
	max-width: 520px;
	margin: 20px auto 0;
}

/* ------------------------------------------------------------------ */
/* Footer                                                              */
/* ------------------------------------------------------------------ */

.site-footer {
	margin-block-start: 40px;
	background: var(--c-surface);
	border-top: 1px solid var(--c-line);
	color: var(--c-muted);
	font-size: 0.875rem;
}

.site-footer__top {
	display: flex;
	justify-content: flex-end;
	padding-block: 16px 0;
}

.back-to-top {
	display: inline-flex;
	align-items: center;
	gap: 6px;
	padding: 6px 12px;
	border: 1px solid var(--c-line-strong);
	border-radius: var(--r-s);
	color: var(--c-muted);
	font-size: 0.8125rem;
	text-decoration: none;
}

.back-to-top:hover {
	color: var(--c-ink);
	border-color: var(--c-ink);
}

.site-footer a {
	color: var(--c-muted);
	text-decoration: none;
}

.site-footer a:hover {
	color: var(--c-ink);
}

.site-footer__grid {
	display: grid;
	grid-template-columns: minmax(0, 1.4fr) repeat(3, minmax(0, 1fr));
	gap: 28px;
	padding-block: 24px 36px;
}

.site-footer__name {
	margin: 0 0 6px;
	color: var(--c-accent);
	font-size: 1.25rem;
	font-weight: 700;
}

.footer-title,
.site-footer .widget-title {
	margin-block-end: 10px;
	color: var(--c-ink);
	font-size: 0.9375rem;
}

.footer-menu {
	margin: 0;
	padding: 0;
	list-style: none;
}

.footer-menu li {
	padding-block: 4px;
}

.contact-list {
	margin: 14px 0 0;
	padding: 0;
	list-style: none;
}

.contact-list li {
	display: flex;
	align-items: flex-start;
	gap: 10px;
	padding-block: 4px;
}

.contact-list .icon {
	flex-shrink: 0;
	margin-block-start: 5px;
}

.site-footer__bottom {
	border-top: 1px solid var(--c-line);
	font-size: 0.8125rem;
}

.site-footer__bottom p {
	margin: 0;
	padding-block: 14px;
}

@media (max-width: 900px) {
	.site-footer__grid {
		grid-template-columns: repeat(2, minmax(0, 1fr));
	}

	.site-footer__about {
		grid-column: 1 / -1;
	}
}

@media (max-width: 520px) {
	.site-footer__grid {
		grid-template-columns: minmax(0, 1fr);
	}
}

/* Directional icons point "forward" for the reading direction. */
html:not([dir="rtl"]) .icon-chevron {
	transform: scaleX(-1);
}

/* ------------------------------------------------------------------ */
/* Motion: the one authored moment is add to cart                     */
/* ------------------------------------------------------------------ */

/* The product image that flies to the cart (created by theme.js). */
.fly-to-cart {
	position: fixed;
	z-index: 200;
	border-radius: var(--r);
	object-fit: cover;
	pointer-events: none;
	box-shadow: var(--shadow);
}

@keyframes sofreh-bump {
	30% {
		transform: scale(1.4);
	}

	60% {
		transform: scale(0.92);
	}
}

.cart-count.is-bumped {
	animation: sofreh-bump 0.5s var(--ease-out);
}

/* Printing an order confirmation shows only the page. */
@media print {
	.site-header,
	.tabbar,
	.drawer-backdrop,
	.site-footer,
	.buy-bar,
	.sofreh-pa-copy {
		display: none !important;
	}

	body {
		padding: 0;
		background: #fff;
	}
}
```

### sofreh/assets/css/woocommerce.css

```css
/*
 * Sofreh — WooCommerce styles.
 *
 * WooCommerce's general/layout/smallscreen stylesheets are switched off
 * (woocommerce_enqueue_styles), so every classic WooCommerce element is
 * styled here, in the marketplace convention: white panels on the grey
 * ground, hairline product cells, prices and discounts set for scanning.
 * WooCommerce Blocks keep their own styles and take colours, type and
 * buttons from theme.json; only documented hooks are touched below.
 */

/* ------------------------------------------------------------------ */
/* Store layout                                                        */
/* ------------------------------------------------------------------ */

.store-layout {
	padding-block: 12px 40px;
}

.store-layout--listing {
	display: grid;
	grid-template-columns: 280px minmax(0, 1fr);
	grid-template-areas: "filters main";
	gap: var(--gap);
	align-items: start;
}

.store-layout--listing > .site-main {
	grid-area: main;
	min-width: 0;
}

.store-layout--listing > .shop-filters {
	grid-area: filters;
	position: sticky;
	top: 140px;
}

/* Breadcrumbs */
.woocommerce-breadcrumb {
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	gap: 2px 4px;
	margin-block: 4px 12px;
	color: var(--c-muted);
	font-size: 0.8125rem;
}

.woocommerce-breadcrumb a {
	color: var(--c-muted);
	text-decoration: none;
}

.woocommerce-breadcrumb a:hover {
	color: var(--c-ink);
}

.breadcrumb-sep {
	display: inline-flex;
	color: var(--c-line-strong);
}

/* Archive header: a white panel holding the title, description and chips */
.woocommerce-products-header {
	margin-block-end: 12px;
	padding: 16px clamp(14px, 2vw, 20px);
	background: var(--c-surface);
	border-radius: var(--r-l);
	box-shadow: var(--shadow-s);
}

.woocommerce-products-header__title {
	margin: 0;
	font-size: clamp(1.15rem, 1rem + 0.6vw, 1.45rem);
}

.term-description,
.page-description {
	max-width: 72ch;
	margin-block-start: 4px;
	color: var(--c-muted);
	font-size: 0.875rem;
}

.term-description p:last-child,
.page-description p:last-child {
	margin-block-end: 0;
}

/* Toolbar: sort links (desktop) or select + filters (phones), result count */
.shop-toolbar {
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	gap: 8px 16px;
	padding: 4px clamp(14px, 2vw, 20px);
	background: var(--c-surface);
	border-radius: var(--r-l) var(--r-l) 0 0;
	border-bottom: 1px solid var(--c-line);
}

.woocommerce-notices-wrapper + .shop-toolbar {
	margin-top: 0;
}

.sort-links {
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	gap: 4px 20px;
	font-size: 0.8125rem;
}

.sort-links__label {
	display: inline-flex;
	align-items: center;
	gap: 6px;
	color: var(--c-ink);
	font-weight: 700;
}

.sort-links a {
	padding-block: 12px;
	color: var(--c-muted);
	text-decoration: none;
	box-shadow: inset 0 -2px 0 transparent;
	transition: color 0.15s ease, box-shadow 0.2s ease;
}

.sort-links a:hover {
	color: var(--c-ink);
}

.sort-links a.is-current {
	color: var(--c-accent);
	font-weight: 700;
	box-shadow: inset 0 -2px 0 var(--c-accent);
}

.woocommerce-result-count {
	margin: 0;
	margin-inline-start: auto;
	color: var(--c-muted);
	font-size: 0.8125rem;
}

.woocommerce-ordering {
	display: none;
	margin: 0;
}

.woocommerce-ordering select {
	min-height: 40px;
	font-size: 0.875rem;
	background-color: var(--c-ground);
	border-color: transparent;
}

.shop-toolbar .shop-toolbar__filters {
	display: none;
	min-height: 40px;
	font-size: 0.875rem;
}

/* Filters panel */
.shop-filters {
	background: var(--c-surface);
	border-radius: var(--r-l);
	padding: 16px 18px;
	box-shadow: var(--shadow-s);
}

.shop-filters__head {
	display: flex;
	align-items: center;
	justify-content: space-between;
	margin-block-end: 6px;
}

.shop-filters__title {
	margin: 0;
	font-size: 1rem;
}

.shop-filters__close {
	display: none;
}

.shop-filters .widget {
	margin-block-end: 0;
	padding-block: 12px;
	border-top: 1px solid var(--c-line);
}

.shop-filters .widget-title {
	font-size: 0.875rem;
	margin-block-end: 6px;
}

.widget_product_categories .product-categories,
.widget_product_categories .children {
	margin: 0;
	padding: 0;
	list-style: none;
}

.widget_product_categories .children {
	padding-inline-start: 12px;
	margin-inline-start: 4px;
	border-inline-start: 1px solid var(--c-line);
}

.widget_product_categories .cat-item {
	padding-block: 3px;
	font-size: 0.875rem;
}

.widget_product_categories .current-cat > a {
	color: var(--c-accent);
	font-weight: 700;
}

.widget_product_categories .count {
	color: var(--c-muted);
	font-size: 0.75rem;
}

@media (max-width: 960px) {
	.store-layout--listing {
		display: block;
	}

	.sort-links {
		display: none;
	}

	.woocommerce-ordering {
		display: block;
		flex: 1 1 160px;
	}

	.shop-toolbar {
		padding-block: 10px;
	}

	.shop-toolbar .shop-toolbar__filters {
		display: inline-flex;
	}

	.woocommerce-result-count {
		flex-basis: 100%;
		order: 3;
		margin: 0;
	}

	.shop-filters {
		position: fixed !important;
		inset-block: 0;
		inset-inline-start: 0;
		z-index: 100;
		width: min(86vw, 360px);
		overflow-y: auto;
		overscroll-behavior: contain;
		border-radius: 0;
		box-shadow: var(--shadow);
		transform: translateX(100%);
		visibility: hidden;
		transition: transform 0.28s var(--ease-out), visibility 0.28s;
	}

	html:not([dir="rtl"]) .shop-filters {
		transform: translateX(-100%);
	}

	.shop-filters.is-open {
		transform: none !important;
		visibility: visible;
		transition: transform 0.28s var(--ease-out), visibility 0s;
	}

	.shop-filters__close {
		display: inline-grid;
	}
}

/* ------------------------------------------------------------------ */
/* Prices, ratings, badges                                             */
/* ------------------------------------------------------------------ */

.price {
	color: var(--c-ink);
	font-weight: 700;
	font-variant-numeric: tabular-nums;
}

.price del {
	color: var(--c-muted);
	font-weight: 400;
	font-size: 0.8em;
}

.price ins {
	text-decoration: none;
}

.woocommerce-Price-currencySymbol {
	font-weight: 400;
	font-size: 0.78em;
	margin-inline: 0.2em;
	color: var(--c-muted);
}

.onsale,
.badge {
	position: absolute;
	inset-block-start: 10px;
	inset-inline-start: 10px;
	z-index: 2;
	display: inline-block;
	padding: 1px 8px;
	border-radius: 999px;
	background: var(--c-ink);
	color: #fff;
	font-size: 0.75rem;
	font-weight: 700;
	line-height: 1.8;
}

/* Discount tag: saffron with ink type, squared at its inner end like a price tag. */
.onsale {
	background: var(--c-saffron);
	color: var(--c-ink);
	border-start-end-radius: 4px;
	border-end-end-radius: 4px;
}

.badge--soldout {
	inset-inline-start: auto;
	inset-inline-end: 10px;
	background: var(--c-muted);
}

/*
 * Star rating: five stars painted from one SVG mask (no icon font, no text
 * glyphs). The filled layer is clipped to the rating width WooCommerce sets.
 */
.star-rating {
	--star: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='m12 2.8 2.8 5.7 6.3.9-4.6 4.4 1.1 6.3L12 17.1l-5.6 3 1.1-6.3-4.6-4.4 6.3-.9z'/%3E%3C/svg%3E");
	position: relative;
	display: inline-block;
	overflow: hidden;
	width: 5.5em;
	height: 1.1em;
	font-size: 0.8125rem;
	line-height: 1;
	color: transparent;
}

.star-rating::before,
.star-rating span::before {
	content: "";
	position: absolute;
	inset-block: 0;
	inset-inline-start: 0;
	width: 5.5em;
	-webkit-mask: var(--star) 0 0 / 1.1em 1.1em repeat-x;
	mask: var(--star) 0 0 / 1.1em 1.1em repeat-x;
}

.star-rating::before {
	background: var(--c-line-strong);
}

.star-rating span {
	position: absolute;
	inset-block: 0;
	inset-inline-start: 0;
	overflow: hidden;
	padding-top: 1.5em;
}

.star-rating span::before {
	background: var(--c-star);
}

/* The mask repeats from the left, so in RTL the filled part grows from the right. */
[dir="rtl"] .star-rating::before,
[dir="rtl"] .star-rating span::before {
	-webkit-mask-position: 100% 0;
	mask-position: 100% 0;
}

/* ------------------------------------------------------------------ */
/* Product cards                                                       */
/* ------------------------------------------------------------------ */

ul.products {
	display: grid;
	grid-template-columns: repeat(4, minmax(0, 1fr));
	margin: 0 0 24px;
	padding: 0;
	list-style: none;
	background: var(--c-surface);
	border-radius: 0 0 var(--r-l) var(--r-l);
	overflow: hidden;
	box-shadow: var(--shadow-s);
}

ul.products.columns-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
ul.products.columns-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
ul.products.columns-5 { grid-template-columns: repeat(5, minmax(0, 1fr)); }

/* The cell grid: hairlines between products, none at the outer edge. */
ul.products li.product {
	position: relative;
	display: flex;
	flex-direction: column;
	margin: 0;
	padding: 14px 14px 16px;
	box-shadow: 1px 0 0 var(--c-line), 0 1px 0 var(--c-line);
	transition: box-shadow 0.2s ease;
}

ul.products li.product:hover {
	z-index: 1;
	box-shadow: 0 0 0 1px var(--c-line), 0 12px 32px -14px rgb(25 29 52 / 28%);
}

.store-layout--listing ul.products[class*="columns-"] {
	grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
}

@media (max-width: 1100px) {
	ul.products[class*="columns-"] {
		grid-template-columns: repeat(3, minmax(0, 1fr));
	}
}

@media (max-width: 700px) {
	ul.products[class*="columns-"],
	.store-layout--listing ul.products[class*="columns-"] {
		grid-template-columns: repeat(2, minmax(0, 1fr));
	}

	ul.products li.product {
		padding: 10px 10px 12px;
	}
}

ul.products li.product .woocommerce-loop-product__link {
	display: flex;
	flex-direction: column;
	flex: 1;
	color: inherit;
	text-decoration: none;
}

.product-card__media {
	position: relative;
	margin-block-end: 10px;
	aspect-ratio: 1;
	overflow: hidden;
	border-radius: var(--r-s);
	background: var(--c-ground);
}

.product-card__media img {
	display: block;
	width: 100%;
	height: 100%;
	object-fit: cover;
	transition: transform 0.4s var(--ease-out);
}

ul.products li.product:hover .product-card__media img {
	transform: scale(1.04);
}

ul.products li.product .woocommerce-loop-product__title {
	margin: 0 0 6px;
	font-size: 0.8125rem;
	font-weight: 500;
	line-height: 1.75;
	height: 3.5em;
	display: -webkit-box;
	-webkit-line-clamp: 2;
	-webkit-box-orient: vertical;
	overflow: hidden;
}

ul.products li.product .star-rating {
	margin-block-end: 4px;
}

/*
 * Price row: discount badge at the start, price at the end, old price under
 * the price. The .price span dissolves into the row's grid so its parts can
 * be placed; WooCommerce's screen-reader texts stay out of the layout.
 */
ul.products li.product .product-card__price {
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	gap: 0 6px;
	margin-top: auto;
	font-size: 0.9375rem;
}

ul.products li.product .product-card__price .price {
	display: contents;
}

ul.products li.product .product-card__price .onsale {
	position: static;
	order: 1;
	padding-inline: 7px;
}

/* The price keeps to the end of the row, and wraps under the badge on very narrow cards. */
ul.products li.product .product-card__price ins,
ul.products li.product .product-card__price .price > .woocommerce-Price-amount,
ul.products li.product .product-card__price .price-from {
	order: 2;
	margin-inline-start: auto;
	white-space: nowrap;
}

ul.products li.product .product-card__price del {
	order: 3;
	flex-basis: 100%;
	line-height: 1.6;
	text-align: end;
}

/* Cards without an old price keep that line empty, so prices line up across a row. */
ul.products li.product .product-card__price:not(:has(del))::after {
	content: "";
	order: 3;
	flex-basis: 100%;
	height: 1.6em;
	font-size: 0.8em;
}

ul.products li.product .button {
	width: 100%;
	min-height: 38px;
	margin-block-start: 10px;
	padding-inline: 10px;
	background: var(--c-surface);
	border-color: var(--c-line-strong);
	color: var(--c-ink);
	font-size: 0.8125rem;
}

ul.products li.product .button:hover {
	border-color: var(--c-accent);
	background: var(--c-accent);
	color: #fff;
}

ul.products li.product .added_to_cart {
	display: block;
	margin-block-start: 6px;
	color: var(--c-accent);
	font-size: 0.8125rem;
	font-weight: 700;
	text-align: center;
	text-decoration: none;
	animation: sofreh-fade 0.3s ease both;
}

.button.loading {
	position: relative;
	color: transparent !important;
	pointer-events: none;
}

.button.loading::after {
	content: "";
	position: absolute;
	inset: 0;
	margin: auto;
	width: 16px;
	height: 16px;
	border: 2px solid var(--c-accent);
	border-inline-end-color: transparent;
	border-radius: 50%;
	animation: sofreh-spin 0.7s linear infinite;
}

.single_add_to_cart_button.loading::after,
.checkout-button.loading::after,
#place_order.loading::after,
ul.products li.product .button.loading::after {
	border-color: currentColor;
	border-inline-end-color: transparent;
}

ul.products li.product .button.loading {
	background: var(--c-accent);
	border-color: var(--c-accent);
}

ul.products li.product .button.loading::after {
	border-color: #fff;
	border-inline-end-color: transparent;
}

.button.added::after {
	content: "";
	display: inline-block;
	vertical-align: -0.2em;
	width: 16px;
	height: 16px;
	margin-inline-start: 6px;
	background: currentColor;
	-webkit-mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23000' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m5 12.5 4.5 4.5L19 7.5'/%3E%3C/svg%3E") center / contain no-repeat;
	mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23000' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m5 12.5 4.5 4.5L19 7.5'/%3E%3C/svg%3E") center / contain no-repeat;
}

@keyframes sofreh-spin {
	to {
		transform: rotate(360deg);
	}
}

/* Category tiles inside the grid (when WooCommerce shows them) */
ul.products li.product-category {
	text-align: center;
}

ul.products li.product-category a {
	color: var(--c-ink);
	text-decoration: none;
}

ul.products li.product-category img {
	width: 72%;
	margin-inline: auto;
	aspect-ratio: 1;
	object-fit: cover;
	border-radius: 50%;
	background: var(--c-ground);
}

ul.products li.product-category .woocommerce-loop-category__title {
	margin: 10px 0 0;
	font-size: 0.875rem;
}

ul.products li.product-category mark.count {
	background: none;
	color: var(--c-muted);
	font-weight: 400;
}

/* ------------------------------------------------------------------ */
/* Home strips: product cards in a row that scrolls sideways           */
/* ------------------------------------------------------------------ */

.strip__body {
	position: relative;
}

.strip__body .woocommerce {
	display: contents;
}

.strip__body ul.products {
	display: flex;
	gap: 0;
	margin: 0;
	padding: 0 clamp(14px, 2vw, 20px) 4px;
	overflow-x: auto;
	scroll-snap-type: x proximity;
	scroll-padding-inline: clamp(14px, 2vw, 20px);
	scrollbar-width: none;
	background: none;
	border-radius: 0;
	box-shadow: none;
	overscroll-behavior-x: contain;
}

.strip__body ul.products::-webkit-scrollbar {
	display: none;
}

.strip__body ul.products li.product {
	flex: 0 0 clamp(158px, 42vw, 200px);
	scroll-snap-align: start;
	box-shadow: 1px 0 0 var(--c-line);
}

.strip__body ul.products li.product:last-child {
	box-shadow: none;
}

.strip--deals .strip__body ul.products {
	gap: 4px;
}

.strip--deals .strip__body ul.products li.product {
	background: var(--c-surface);
	box-shadow: none;
}

.strip--deals .strip__body ul.products li.product:first-child {
	border-radius: var(--r) 0 0 var(--r);
}

html[dir="rtl"] .strip--deals .strip__body ul.products li.product:first-child {
	border-radius: 0 var(--r) var(--r) 0;
}

.strip--deals .strip__body ul.products li.product:last-child {
	border-radius: 0 var(--r) var(--r) 0;
}

html[dir="rtl"] .strip--deals .strip__body ul.products li.product:last-child {
	border-radius: var(--r) 0 0 var(--r);
}

.strip__arrow {
	position: absolute;
	top: 40%;
	z-index: 3;
	display: none;
	place-items: center;
	width: 40px;
	height: 40px;
	padding: 0;
	border: 1px solid var(--c-line);
	border-radius: 50%;
	background: var(--c-surface);
	color: var(--c-ink);
	box-shadow: var(--shadow);
	cursor: pointer;
	transition: opacity 0.2s ease, transform 0.2s ease;
}

.strip__arrow:hover {
	transform: scale(1.06);
}

.strip__arrow--prev {
	inset-inline-start: 8px;
}

.strip__arrow--prev .icon {
	transform: scaleX(-1);
}

.strip__arrow--next {
	inset-inline-end: 8px;
}

.strip__arrow[disabled] {
	opacity: 0;
	pointer-events: none;
}

@media (hover: hover) and (min-width: 961px) {
	.strip__arrow {
		display: grid;
	}
}

/* Pagination */
.woocommerce-pagination {
	margin-block-start: 8px;
}

.woocommerce-pagination ul.page-numbers {
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
	gap: 6px;
	margin: 0;
	padding: 0;
	list-style: none;
}

.woocommerce-pagination .page-numbers a,
.woocommerce-pagination .page-numbers span {
	display: inline-grid;
	place-items: center;
	min-width: 40px;
	min-height: 40px;
	padding-inline: 10px;
	border-radius: var(--r-s);
	color: var(--c-ink);
	text-decoration: none;
	font-variant-numeric: tabular-nums;
}

.woocommerce-pagination .page-numbers a:hover {
	background: var(--c-surface);
}

.woocommerce-pagination .page-numbers span.current {
	background: var(--c-ink);
	color: #fff;
}

/* ------------------------------------------------------------------ */
/* Notices                                                             */
/* ------------------------------------------------------------------ */

.woocommerce-notices-wrapper:empty {
	display: none;
}

/*
 * WooCommerce moves focus to a new notice so screen readers announce it.
 * The notice is a tabindex="-1" landing spot, not a control, so it gets no ring.
 */
.woocommerce-notices-wrapper:focus,
.woocommerce-NoticeGroup:focus,
.woocommerce-message:focus,
.woocommerce-info:focus,
.woocommerce-error:focus {
	outline: none;
}

.woocommerce-message,
.woocommerce-info,
.woocommerce-error,
.woocommerce-noreviews,
p.no-comments {
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	gap: 6px 14px;
	margin: 0 0 14px;
	padding: 12px 16px;
	border-radius: var(--r);
	list-style: none;
	font-size: 0.9375rem;
	line-height: 1.7;
	animation: sofreh-fade 0.3s ease both;
}

.woocommerce-message {
	background: var(--c-success-soft);
	color: #155c34;
}

.woocommerce-info,
.woocommerce-noreviews,
p.no-comments {
	background: var(--c-info-soft);
	color: #1d3f6b;
}

.woocommerce-error {
	flex-direction: column;
	align-items: stretch;
	background: var(--c-error-soft);
	color: #8c211d;
}

.woocommerce-error li {
	margin: 0;
}

.woocommerce-message a:not(.button),
.woocommerce-info a:not(.button),
.woocommerce-error a {
	color: inherit;
	font-weight: 700;
}

.woocommerce-message .button,
.woocommerce-info .button {
	order: 2;
	margin-inline-start: auto;
	min-height: 36px;
	padding: 2px 14px;
	background: var(--c-surface);
	color: var(--c-ink);
	border-color: var(--c-line-strong);
	font-size: 0.8125rem;
}

.woocommerce-store-notice,
p.demo_store {
	position: fixed;
	inset-inline: 0;
	bottom: var(--tabbar-h);
	z-index: 79;
	margin: 0;
	padding: 10px var(--gutter);
	background: var(--c-ink);
	color: #fff;
	font-size: 0.875rem;
	text-align: center;
}

.woocommerce-store-notice a {
	color: #fff;
	margin-inline-start: 12px;
}

/* ------------------------------------------------------------------ */
/* Single product                                                      */
/* ------------------------------------------------------------------ */

.store-layout--product div.product {
	display: grid;
	grid-template-columns: minmax(0, 0.9fr) minmax(0, 1.5fr);
	gap: clamp(16px, 3vw, 36px);
	align-items: start;
	padding: clamp(14px, 2.5vw, 28px);
	background: var(--c-surface);
	border-radius: var(--r-l);
	box-shadow: var(--shadow-s);
}

div.product {
	position: relative;
}

div.product > .woocommerce-tabs,
div.product > .related,
div.product > .upsells,
div.product > section {
	grid-column: 1 / -1;
}


/* Summary: the facts beside the buy box */
.store-layout--product .summary {
	display: grid;
	grid-template-columns: minmax(0, 1fr) minmax(260px, 320px);
	grid-auto-flow: dense;
	column-gap: clamp(16px, 2.5vw, 32px);
	align-content: start;
}

.store-layout--product .summary > * {
	grid-column: 1;
}

.store-layout--product .summary > .buy-box {
	grid-column: 2;
	grid-row: 1 / span 12;
	position: sticky;
	top: 140px;
}

@media (max-width: 1180px) {
	.store-layout--product div.product {
		grid-template-columns: minmax(0, 1fr) minmax(0, 1.2fr);
	}

	.store-layout--product .summary {
		grid-template-columns: minmax(0, 1fr);
	}

	.store-layout--product .summary > .buy-box {
		grid-column: 1;
		grid-row: auto;
		position: static;
	}
}

@media (max-width: 760px) {
	.store-layout--product div.product {
		grid-template-columns: minmax(0, 1fr);
		padding: 0 0 16px;
		background: none;
		box-shadow: none;
	}

	.store-layout--product div.product > .woocommerce-product-gallery,
	.store-layout--product div.product > .summary {
		padding: 14px;
		background: var(--c-surface);
		border-radius: var(--r-l);
	}
}

/* Gallery */
.woocommerce-product-gallery {
	position: relative;
	margin: 0;
	opacity: 1 !important;
}

.woocommerce-product-gallery__wrapper {
	margin: 0;
}

.woocommerce-product-gallery__image img {
	display: block;
	width: 100%;
	height: auto;
	border-radius: var(--r);
}

.woocommerce-product-gallery .flex-viewport {
	border-radius: var(--r);
}

.woocommerce-product-gallery__trigger {
	position: absolute;
	inset-block-start: 10px;
	inset-inline-end: 10px;
	z-index: 5;
	display: grid;
	place-items: center;
	width: 40px;
	height: 40px;
	border-radius: 50%;
	background: var(--c-surface);
	box-shadow: var(--shadow-s);
	font-size: 0;
	text-decoration: none;
}

/* WooCommerce puts a magnifier emoji inside; the theme draws its own icon. */
.woocommerce-product-gallery__trigger > * {
	display: none;
}

.woocommerce-product-gallery__trigger::before {
	content: "";
	width: 13px;
	height: 13px;
	border: 2px solid var(--c-ink);
	border-radius: 50%;
	transform: translate(-1px, -1px);
}

.woocommerce-product-gallery__trigger::after {
	content: "";
	position: absolute;
	width: 2px;
	height: 6px;
	background: var(--c-ink);
	transform: translate(6px, 6px) rotate(-45deg);
}

.woocommerce-product-gallery .flex-control-thumbs {
	display: flex;
	gap: 8px;
	margin: 10px 0 0;
	padding: 0;
	list-style: none;
	overflow-x: auto;
}

.woocommerce-product-gallery .flex-control-thumbs li {
	flex: 0 0 64px;
	margin: 0;
}

.woocommerce-product-gallery .flex-control-thumbs img {
	display: block;
	width: 100%;
	border-radius: var(--r-s);
	border: 1px solid var(--c-line);
	opacity: 0.7;
	cursor: pointer;
	transition: opacity 0.15s ease, border-color 0.15s ease;
}

.woocommerce-product-gallery .flex-control-thumbs img:hover,
.woocommerce-product-gallery .flex-control-thumbs img.flex-active {
	opacity: 1;
	border-color: var(--c-ink);
}

/* Product facts */
.summary .product_title {
	margin: 0 0 8px;
	font-size: clamp(1.1rem, 0.95rem + 0.7vw, 1.45rem);
	line-height: 1.6;
}

.woocommerce-product-rating {
	display: flex;
	align-items: center;
	gap: 8px;
	margin-block-end: 12px;
	padding-block-end: 12px;
	border-bottom: 1px solid var(--c-line);
	font-size: 0.8125rem;
}

.woocommerce-review-link {
	color: var(--c-accent);
	text-decoration: none;
}

.woocommerce-product-details__short-description {
	margin-block-end: 16px;
	color: var(--c-muted);
	font-size: 0.9375rem;
}

.woocommerce-product-details__short-description > :last-child {
	margin-block-end: 0;
}

.product_meta {
	display: flex;
	flex-direction: column;
	gap: 2px;
	padding-block-start: 12px;
	border-top: 1px solid var(--c-line);
	color: var(--c-muted);
	font-size: 0.8125rem;
}

.product_meta .sku {
	direction: ltr;
	unicode-bidi: isolate;
	font-family: var(--font-latin-digits);
	font-feature-settings: normal;
}

.product_meta a {
	color: var(--c-ink);
	text-decoration: none;
}

.product_meta a:hover {
	color: var(--c-accent);
}

/* Buy box */
.buy-box {
	display: flex;
	flex-direction: column;
	gap: 10px;
	margin-block-end: 16px;
	padding: 16px;
	background: var(--c-ground);
	border-radius: var(--r);
}

.buy-box__price {
	display: flex;
	align-items: center;
	gap: 10px;
}

.buy-box__price .onsale {
	position: static;
	flex: none;
	font-size: 0.8125rem;
}

.buy-box__price .price {
	display: flex;
	flex: 1;
	flex-wrap: wrap;
	align-items: baseline;
	justify-content: flex-end;
	gap: 2px 10px;
	margin: 0;
	font-size: 1.375rem;
}

.buy-box__price .price del {
	order: -1;
	font-size: 0.9375rem;
}

.buy-box__price .price ins {
	color: var(--c-ink);
}

.stock {
	margin: 0;
	font-size: 0.875rem;
	font-weight: 500;
}

.stock.in-stock {
	color: var(--c-success);
}

.stock.out-of-stock {
	color: var(--c-error);
}

form.cart {
	display: flex;
	flex-wrap: wrap;
	align-items: stretch;
	gap: 8px;
	margin: 0;
}

form.cart .single_add_to_cart_button {
	flex: 1 1 160px;
	min-height: 48px;
	font-size: 0.9375rem;
}

form.cart.variations_form,
form.cart.grouped_form {
	display: block;
}

.woocommerce-variation-add-to-cart {
	display: flex;
	flex-wrap: wrap;
	gap: 8px;
}

table.variations {
	margin-block-end: 8px;
	border: 0;
}

table.variations th,
table.variations td {
	display: block;
	padding: 0;
	border: 0;
}

table.variations th {
	margin-block-end: 4px;
}

table.variations td {
	margin-block-end: 8px;
}

table.variations label {
	margin: 0;
	font-size: 0.875rem;
}

.reset_variations {
	display: inline-block;
	margin-block-start: 6px;
	font-size: 0.8125rem;
}

.single_variation_wrap .woocommerce-variation {
	margin-block-end: 8px;
}

.single_variation_wrap .woocommerce-variation:not(:has(.price, p)) {
	margin: 0;
}

/* WooCommerce hides "Clear" with visibility; take it out of the flow too. */
.reset_variations[style*="hidden"] {
	display: none;
}

.woocommerce-variation-price .price {
	font-size: 1.15rem;
}

.group_table {
	margin-block-end: 12px;
	background: var(--c-surface);
	border-radius: var(--r-s);
}

.group_table td {
	vertical-align: middle;
}

/* Quantity stepper */
.quantity {
	display: inline-flex;
	align-items: stretch;
	border: 1px solid var(--c-line-strong);
	border-radius: var(--r-s);
	background: var(--c-surface);
	overflow: hidden;
}

.quantity .qty {
	width: 3.4em;
	min-height: 46px;
	padding: 0 4px;
	border: 0;
	border-radius: 0;
	text-align: center;
	font-weight: 700;
	-moz-appearance: textfield;
	appearance: textfield;
}

.quantity .qty:focus {
	box-shadow: none;
}

.quantity:focus-within {
	border-color: var(--c-focus);
	box-shadow: 0 0 0 3px rgb(45 72 192 / 20%);
}

.quantity .qty::-webkit-outer-spin-button,
.quantity .qty::-webkit-inner-spin-button {
	-webkit-appearance: none;
	margin: 0;
}

.quantity:not(.has-steppers) .qty {
	-moz-appearance: auto;
	appearance: auto;
}

.qty-step {
	width: 38px;
	border: 0;
	background: transparent;
	color: var(--c-accent);
	font: inherit;
	font-size: 1.25rem;
	font-weight: 700;
	line-height: 1;
	cursor: pointer;
	transition: background-color 0.15s ease;
}

.qty-step::before {
	content: "";
	display: block;
	width: 18px;
	height: 18px;
	margin: auto;
	background: currentColor;
	-webkit-mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23000' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M12 5v14M5 12h14'/%3E%3C/svg%3E") center / contain no-repeat;
	mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23000' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M12 5v14M5 12h14'/%3E%3C/svg%3E") center / contain no-repeat;
}

.qty-step--minus::before {
	-webkit-mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23000' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M5 12h14'/%3E%3C/svg%3E") center / contain no-repeat;
	mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23000' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M5 12h14'/%3E%3C/svg%3E") center / contain no-repeat;
}

.qty-step:hover {
	background: var(--c-accent-soft);
}

.qty-step:active {
	transform: scale(0.94);
}

.product-note {
	display: flex;
	gap: 10px;
	align-items: flex-start;
	margin: 0;
	padding-block-start: 10px;
	border-top: 1px solid var(--c-line);
	color: var(--c-muted);
	font-size: 0.8125rem;
}

.product-note .icon {
	flex-shrink: 0;
	margin-block-start: 2px;
	color: var(--c-ink);
}

.product-note p {
	margin: 0;
}

/* Phones: the sticky buy bar above the tab bar */
.buy-bar {
	position: fixed;
	inset-inline: 0;
	bottom: calc(var(--tabbar-h) + env(safe-area-inset-bottom, 0px));
	z-index: 79;
	display: flex;
	align-items: center;
	justify-content: space-between;
	gap: 12px;
	padding: 10px var(--gutter);
	background: var(--c-surface);
	box-shadow: 0 -1px 0 var(--c-line), 0 -10px 24px -18px rgb(25 29 52 / 45%);
	animation: sofreh-rise-in 0.3s var(--ease-out);
}

.buy-bar[hidden] {
	display: none !important;
}

.buy-bar__price {
	font-weight: 700;
	font-size: 1.0625rem;
}

.buy-bar__price del {
	display: block;
	font-size: 0.75rem;
}

.buy-bar__button {
	flex: 0 0 auto;
	min-width: 46%;
	min-height: 46px;
}

@keyframes sofreh-rise-in {
	from {
		transform: translateY(100%);
	}
}

@media (min-width: 761px) {
	.buy-bar {
		display: none !important;
	}
}

/* Tabs */
.woocommerce-tabs {
	margin-block-start: clamp(16px, 3vw, 28px);
	padding-block-start: 4px;
	border-top: 1px solid var(--c-line);
}

.woocommerce-tabs ul.tabs {
	position: sticky;
	top: 116px;
	z-index: 4;
	display: flex;
	gap: 4px;
	margin: 0 0 18px;
	padding: 0;
	list-style: none;
	background: var(--c-surface);
	border-bottom: 1px solid var(--c-line);
	overflow-x: auto;
	scrollbar-width: none;
}

.woocommerce-tabs ul.tabs li {
	flex: none;
	margin: 0;
}

.woocommerce-tabs ul.tabs li a {
	display: block;
	padding: 12px 14px;
	color: var(--c-muted);
	font-size: 0.875rem;
	font-weight: 500;
	text-decoration: none;
	box-shadow: inset 0 -2px 0 transparent;
	transition: color 0.15s ease, box-shadow 0.2s ease;
}

.woocommerce-tabs ul.tabs li a:hover {
	color: var(--c-ink);
}

.woocommerce-tabs ul.tabs li.active a {
	color: var(--c-accent);
	box-shadow: inset 0 -2px 0 var(--c-accent);
}

.woocommerce-Tabs-panel {
	max-width: 860px;
	font-size: 0.9375rem;
}

.woocommerce-Tabs-panel > h2:first-child {
	font-size: 1.05rem;
}

.woocommerce-product-attributes {
	border: 1px solid var(--c-line);
	border-radius: var(--r);
	overflow: hidden;
	border-collapse: separate;
	border-spacing: 0;
}

.woocommerce-product-attributes th {
	width: 30%;
	background: var(--c-ground);
	color: var(--c-muted);
	font-weight: 500;
}

.woocommerce-product-attributes p {
	margin: 0;
}

.woocommerce-product-attributes tr:last-child th,
.woocommerce-product-attributes tr:last-child td {
	border-bottom: 0;
}

/* Reviews */
#reviews .commentlist {
	margin: 0 0 28px;
	padding: 0;
	list-style: none;
}

#reviews .commentlist li {
	padding-block: 14px;
	border-bottom: 1px solid var(--c-line);
}

#reviews .comment_container {
	display: flex;
	gap: 12px;
}

#reviews .comment_container .avatar {
	flex-shrink: 0;
	width: 40px;
	height: 40px;
	border-radius: 50%;
}

#reviews .comment-text {
	flex: 1;
}

#reviews .comment-text .star-rating {
	float: inline-end;
}

#reviews .comment-text .meta {
	margin-block-end: 4px;
	color: var(--c-muted);
	font-size: 0.8125rem;
}

#reviews .woocommerce-review__author {
	color: var(--c-ink);
}

#reviews .description p:last-child {
	margin: 0;
}

#review_form_wrapper {
	padding: 18px;
	border-radius: var(--r);
	background: var(--c-ground);
}

#review_form .comment-reply-title {
	display: block;
	margin-block-end: 10px;
	font-size: 1rem;
	font-weight: 700;
}

#review_form p {
	margin-block-end: 14px;
}

p.stars {
	margin: 0;
}

p.stars span {
	display: inline-flex;
	gap: 2px;
}

p.stars a {
	position: relative;
	display: inline-block;
	width: 32px;
	height: 32px;
	overflow: hidden;
	color: transparent;
	text-decoration: none;
	font-size: 0;
}

p.stars a::before {
	content: "";
	position: absolute;
	inset: 3px;
	background: var(--c-line-strong);
	-webkit-mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='m12 2.8 2.8 5.7 6.3.9-4.6 4.4 1.1 6.3L12 17.1l-5.6 3 1.1-6.3-4.6-4.4 6.3-.9z'/%3E%3C/svg%3E") center / contain no-repeat;
	mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='m12 2.8 2.8 5.7 6.3.9-4.6 4.4 1.1 6.3L12 17.1l-5.6 3 1.1-6.3-4.6-4.4 6.3-.9z'/%3E%3C/svg%3E") center / contain no-repeat;
}

p.stars.selected a::before {
	background: var(--c-star);
}

p.stars.selected a.active ~ a::before {
	background: var(--c-line-strong);
}

p.stars:hover a::before,
p.stars.selected:hover a::before,
p.stars.selected:hover a.active ~ a::before {
	background: var(--c-star);
}

p.stars:hover a:hover ~ a::before,
p.stars.selected:hover a:hover ~ a::before {
	background: var(--c-line-strong);
}

/* Related and upsells */
.related,
.upsells {
	margin-block-start: clamp(20px, 3vw, 32px);
}

.related > h2,
.upsells > h2,
.cross-sells > h2 {
	font-size: 1.05rem;
}

.related ul.products,
.upsells ul.products {
	border: 1px solid var(--c-line);
	border-radius: var(--r);
	box-shadow: none;
}

/* ------------------------------------------------------------------ */
/* Tables (cart, orders, account)                                      */
/* ------------------------------------------------------------------ */

.shop_table {
	width: 100%;
	margin-block-end: 20px;
	border: 1px solid var(--c-line);
	border-radius: var(--r);
	border-collapse: separate;
	border-spacing: 0;
	background: var(--c-surface);
	overflow: hidden;
	font-size: 0.9375rem;
}

.shop_table th {
	background: var(--c-ground);
	color: var(--c-muted);
	font-weight: 500;
	font-size: 0.8125rem;
}

.shop_table th,
.shop_table td {
	padding: 12px 14px;
	vertical-align: middle;
}

.shop_table tbody tr:last-child > *,
.shop_table tfoot tr:last-child > * {
	border-bottom: 0;
}

.shop_table tfoot th {
	background: transparent;
	color: var(--c-ink);
}

.shop_table .order-total .amount {
	font-size: 1.1rem;
	color: var(--c-ink);
}

/*
 * Store pages (cart, checkout, account, order received) have no outer panel:
 * each part is its own white panel on the grey ground, never a box in a box.
 */
.store-panel,
.woocommerce-cart-form,
.cart-collaterals .cart_totals,
form.checkout #customer_details,
form.checkout_coupon,
.woocommerce-checkout form.woocommerce-form-login.login,
#customer_login > .u-column1,
#customer_login > .u-column2,
.woocommerce-account .woocommerce > .woocommerce-form-login,
.woocommerce-ResetPassword,
.woocommerce-MyAccount-navigation,
.woocommerce-MyAccount-content,
.woocommerce-order-details,
.woocommerce-customer-details,
.wc-block-cart__main,
.wc-block-cart__sidebar,
.wc-block-checkout__main,
.wc-block-checkout__sidebar {
	background: var(--c-surface);
	border-radius: var(--r-l);
	box-shadow: var(--shadow-s);
}

.woocommerce-cart-form,
.woocommerce-MyAccount-navigation {
	overflow: hidden;
}

.cart-collaterals .cart_totals,
form.checkout #customer_details,
form.checkout_coupon,
.woocommerce-checkout form.woocommerce-form-login.login,
#customer_login > .u-column1,
#customer_login > .u-column2,
.woocommerce-account .woocommerce > .woocommerce-form-login,
.woocommerce-ResetPassword,
.woocommerce-MyAccount-content,
.woocommerce-order-details,
.woocommerce-customer-details,
.wc-block-cart__main,
.wc-block-cart__sidebar,
.wc-block-checkout__main,
.wc-block-checkout__sidebar {
	padding: clamp(16px, 2.5vw, 24px);
}

.woocommerce-order-details,
.woocommerce-customer-details {
	margin-block-end: var(--gap);
}

.woocommerce-order-details__title,
.woocommerce-column__title {
	margin-block-start: 0;
	font-size: 1.05rem;
}

/* Tables inside a panel lose their own frame. */
.woocommerce-cart-form .shop_table,
.woocommerce-order-details .shop_table,
.woocommerce-MyAccount-content .shop_table {
	border: 0;
	border-radius: 0;
}

/* Classic cart */
.woocommerce-cart-form {
	margin-block-end: 24px;
}

.woocommerce-cart-form .product-thumbnail img {
	width: 80px;
	border-radius: var(--r-s);
	background: var(--c-ground);
}

.woocommerce-cart-form .product-name a {
	color: var(--c-ink);
	font-weight: 500;
	text-decoration: none;
}

.woocommerce-cart-form .product-name a:hover {
	color: var(--c-accent);
}

.woocommerce-cart-form .product-name .variation {
	display: grid;
	grid-template-columns: auto 1fr;
	gap: 0 8px;
	margin: 4px 0 0;
	color: var(--c-muted);
	font-size: 0.8125rem;
}

.woocommerce-cart-form .product-name .variation dd,
.woocommerce-cart-form .product-name .variation p {
	margin: 0;
}

/* Remove links: WooCommerce prints a "×" character; the theme's close icon replaces it. */
a.remove {
	display: inline-grid;
	place-items: center;
	width: 36px;
	height: 36px;
	border-radius: 50%;
	color: var(--c-muted) !important;
	font-size: 0;
	line-height: 1;
	text-decoration: none;
}

a.remove::before {
	content: "";
	width: 18px;
	height: 18px;
	background: currentColor;
	-webkit-mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23000' stroke-width='1.6' stroke-linecap='round'%3E%3Cpath d='M6 6l12 12M18 6 6 18'/%3E%3C/svg%3E") center / contain no-repeat;
	mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23000' stroke-width='1.6' stroke-linecap='round'%3E%3Cpath d='M6 6l12 12M18 6 6 18'/%3E%3C/svg%3E") center / contain no-repeat;
}

a.remove:hover {
	background: var(--c-error-soft);
	color: var(--c-error) !important;
}

.woocommerce-cart-form td.actions {
	background: var(--c-ground);
}

.woocommerce-cart-form td.actions .coupon {
	display: flex;
	flex-wrap: wrap;
	gap: 8px;
	float: inline-start;
}

.woocommerce-cart-form td.actions .coupon .input-text {
	width: 200px;
}

.woocommerce-cart-form td.actions > .button {
	float: inline-end;
}

.woocommerce-cart-form td.actions .coupon .button,
.woocommerce-cart-form td.actions > .button {
	background: var(--c-surface);
	border-color: var(--c-line-strong);
	color: var(--c-ink);
}

.cart-collaterals {
	display: grid;
	grid-template-columns: minmax(0, 1fr) minmax(0, 380px);
	gap: var(--gap);
	align-items: start;
}

.cart-collaterals .cart_totals {
	grid-column: 2;
}

.cart-collaterals .cross-sells {
	grid-column: 1;
	grid-row: 1;
}

.cart_totals h2 {
	font-size: 1.05rem;
}

.cart_totals .shop_table {
	border: 0;
	background: none;
	border-radius: 0;
}

.cart_totals .shop_table th {
	background: transparent;
	padding-inline-start: 0;
}

.cart_totals .shop_table td {
	text-align: end;
	padding-inline-end: 0;
}

.woocommerce-shipping-methods {
	margin: 0;
	padding: 0;
	list-style: none;
	text-align: start;
}

.woocommerce-shipping-methods li {
	margin-block-end: 6px;
}

.woocommerce-shipping-destination,
.woocommerce-shipping-calculator {
	margin: 6px 0 0;
	text-align: start;
	font-size: 0.8125rem;
}

.shipping-calculator-form {
	margin-block-start: 10px;
}

.wc-proceed-to-checkout .checkout-button {
	display: flex;
	width: 100%;
	min-height: 50px;
	font-size: 1rem;
}

.cart-empty.woocommerce-info {
	justify-content: center;
	padding-block: 28px;
	font-size: 1.05rem;
}

.return-to-shop {
	text-align: center;
}

@media (max-width: 860px) {
	.cart-collaterals {
		grid-template-columns: minmax(0, 1fr);
	}

	.cart-collaterals .cart_totals,
	.cart-collaterals .cross-sells {
		grid-column: 1;
		grid-row: auto;
	}
}

/* Responsive tables: rows become cards, each cell labelled by data-title. */
@media (max-width: 760px) {
	.shop_table_responsive thead {
		display: none;
	}

	.shop_table_responsive,
	.shop_table_responsive tbody,
	.shop_table_responsive tr,
	.shop_table_responsive td,
	.shop_table_responsive tbody th {
		display: block;
	}

	.shop_table_responsive tr {
		border-bottom: 1px solid var(--c-line);
	}

	.shop_table_responsive tbody tr:last-child {
		border-bottom: 0;
	}

	.shop_table_responsive td {
		display: flex;
		align-items: center;
		justify-content: space-between;
		gap: 14px;
		padding: 9px 14px;
		border-bottom: 1px dashed var(--c-line);
		text-align: end;
	}

	.shop_table_responsive tr td:last-child {
		border-bottom: 0;
	}

	.shop_table_responsive td::before {
		content: attr(data-title);
		flex-shrink: 0;
		color: var(--c-muted);
		font-size: 0.8125rem;
		text-align: start;
	}

	.shop_table_responsive td:not([data-title])::before,
	.shop_table_responsive td.actions::before,
	.shop_table_responsive td.product-remove::before,
	.shop_table_responsive td.product-thumbnail::before {
		display: none;
	}

	/*
	 * Phone cart: photo at the start, name and price beside it, the remove
	 * button at the end; quantity stepper and line total share the last row.
	 */
	.woocommerce-cart-form .shop_table_responsive tr.woocommerce-cart-form__cart-item {
		display: grid;
		grid-template-columns: 72px minmax(0, 1fr) auto;
		grid-template-areas:
			"thumb name remove"
			"thumb price price"
			"qty qty subtotal";
		align-items: center;
		gap: 4px 12px;
		padding: 14px;
	}

	.woocommerce-cart-form tr.woocommerce-cart-form__cart-item > td {
		display: block;
		padding: 0;
		border: 0;
		text-align: start;
	}

	.woocommerce-cart-form tr.woocommerce-cart-form__cart-item > td::before {
		display: none;
	}

	.woocommerce-cart-form td.product-thumbnail {
		grid-area: thumb;
		align-self: start;
	}

	.woocommerce-cart-form .product-thumbnail img {
		width: 72px;
	}

	.woocommerce-cart-form td.product-name {
		grid-area: name;
		line-height: 1.7;
	}

	.woocommerce-cart-form td.product-remove {
		grid-area: remove;
		align-self: start;
		margin-block-start: -6px;
		margin-inline-end: -8px;
	}

	.woocommerce-cart-form td.product-price {
		grid-area: price;
		color: var(--c-muted);
		font-size: 0.8125rem;
	}

	.woocommerce-cart-form td.product-quantity {
		grid-area: qty;
		margin-block-start: 8px;
	}

	.woocommerce-cart-form td.product-subtotal {
		grid-area: subtotal;
		margin-block-start: 8px;
		font-weight: 700;
		text-align: end;
	}

	.woocommerce-cart-form td.actions {
		display: block;
	}

	.woocommerce-cart-form td.actions .coupon {
		float: none;
		margin-block-end: 10px;
	}

	.woocommerce-cart-form td.actions .coupon .input-text {
		flex: 1;
		width: auto;
	}

	.woocommerce-cart-form td.actions .coupon .button,
	.woocommerce-cart-form td.actions > .button {
		float: none;
		width: 100%;
	}

	.cart_totals .shop_table_responsive td::before {
		display: none;
	}

	.cart_totals .shop_table_responsive tr {
		display: flex;
		justify-content: space-between;
		gap: 12px;
	}

	.cart_totals .shop_table_responsive th {
		display: block;
		border: 0;
	}

	.cart_totals .shop_table_responsive td {
		border: 0;
		padding-inline: 0;
		justify-content: flex-end;
	}

	.cart_totals .shop_table_responsive tr.woocommerce-shipping-totals {
		flex-direction: column;
	}

	.cart_totals .shop_table_responsive tr.woocommerce-shipping-totals td {
		flex-direction: column;
		align-items: flex-start;
		text-align: start;
	}
}

/* ------------------------------------------------------------------ */
/* Forms (checkout, account, address)                                  */
/* ------------------------------------------------------------------ */

.form-row {
	margin: 0 0 14px;
}

.form-row label {
	display: block;
}

.form-row .required {
	color: var(--c-error);
	text-decoration: none;
	border: 0;
}

.form-row .optional {
	color: var(--c-muted);
	font-weight: 400;
	font-size: 0.875em;
}

.form-row .description {
	display: block;
	margin-block-start: 4px;
	color: var(--c-muted);
	font-size: 0.8125rem;
}

.woocommerce-billing-fields__field-wrapper,
.woocommerce-shipping-fields__field-wrapper,
.woocommerce-address-fields__field-wrapper,
.woocommerce-EditAccountForm,
.shipping-calculator-form {
	display: grid;
	grid-template-columns: repeat(2, minmax(0, 1fr));
	column-gap: 14px;
}

.woocommerce-billing-fields__field-wrapper > *,
.woocommerce-shipping-fields__field-wrapper > *,
.woocommerce-address-fields__field-wrapper > *,
.woocommerce-EditAccountForm > *,
.shipping-calculator-form > * {
	grid-column: 1 / -1;
}

.woocommerce-billing-fields__field-wrapper > .form-row-first,
.woocommerce-shipping-fields__field-wrapper > .form-row-first,
.woocommerce-address-fields__field-wrapper > .form-row-first,
.woocommerce-EditAccountForm > .form-row-first {
	grid-column: 1;
}

.woocommerce-billing-fields__field-wrapper > .form-row-last,
.woocommerce-shipping-fields__field-wrapper > .form-row-last,
.woocommerce-address-fields__field-wrapper > .form-row-last,
.woocommerce-EditAccountForm > .form-row-last {
	grid-column: 2;
}

@media (max-width: 600px) {
	.woocommerce-billing-fields__field-wrapper > .form-row-first,
	.woocommerce-shipping-fields__field-wrapper > .form-row-first,
	.woocommerce-address-fields__field-wrapper > .form-row-first,
	.woocommerce-EditAccountForm > .form-row-first,
	.woocommerce-billing-fields__field-wrapper > .form-row-last,
	.woocommerce-shipping-fields__field-wrapper > .form-row-last,
	.woocommerce-address-fields__field-wrapper > .form-row-last,
	.woocommerce-EditAccountForm > .form-row-last {
		grid-column: 1 / -1;
	}
}

.woocommerce-input-wrapper {
	display: block;
}

.form-row.woocommerce-invalid input.input-text,
.form-row.woocommerce-invalid select,
.form-row.woocommerce-invalid .select2-selection {
	border-color: var(--c-error) !important;
}

.checkout-inline-error-message {
	margin: 4px 0 0;
	color: var(--c-error);
	font-size: 0.8125rem;
}

.woocommerce-form__label-for-checkbox,
.woocommerce-form__label-for-radio {
	display: inline-flex;
	align-items: center;
	font-weight: 400;
	cursor: pointer;
}

/*
 * WooCommerce inserts the strength meter when the password field changes,
 * which for a pasted or autofilled password is the moment the customer
 * presses "Register". If the meter pushed the button down, that click would
 * land beside it and be lost, so the meter gets a reserved slot instead.
 */
.form-row:has(> .password-input) {
	position: relative;
	padding-block-end: 32px;
}

.woocommerce-form-login .form-row:has(> .password-input) {
	padding-block-end: 0;
}

.form-row:has(> .password-input) .woocommerce-password-strength {
	position: absolute;
	inset-inline: 0;
	bottom: 0;
}

.woocommerce-password-strength {
	margin-block-start: 6px;
	padding: 2px 10px;
	border-radius: var(--r-s);
	font-size: 0.75rem;
	line-height: 1.6;
}

.woocommerce-password-strength:empty {
	display: none;
}

.woocommerce-password-strength.short,
.woocommerce-password-strength.bad {
	background: var(--c-error-soft);
	color: #8c211d;
}

.woocommerce-password-strength.good {
	background: var(--c-warning-soft);
	color: var(--c-warning-ink);
}

.woocommerce-password-strength.strong {
	background: var(--c-success-soft);
	color: #155c34;
}

.woocommerce-password-hint {
	display: block;
	margin-block-start: 6px;
	color: var(--c-muted);
	font-size: 0.75rem;
}

.password-input {
	position: relative;
	display: block;
}

.show-password-input {
	position: absolute;
	inset-block: 0;
	right: 4px;
	width: 40px;
	border: 0;
	background: transparent;
	color: var(--c-muted);
	cursor: pointer;
}

.show-password-input::before {
	content: "";
	display: inline-block;
	width: 18px;
	height: 12px;
	border: 1.6px solid currentColor;
	border-radius: 50% / 60%;
	box-shadow: inset 0 0 0 3px var(--c-surface), inset 0 0 0 6px currentColor;
}

.show-password-input.display-password::before {
	opacity: 0.5;
}

/* Select2 / SelectWoo */
.select2-container {
	width: 100% !important;
}

.select2-container .select2-selection--single {
	height: 46px;
	border: 1px solid var(--c-line-strong);
	border-radius: var(--r-s);
	background: var(--c-surface);
}

.select2-container .select2-selection--single .select2-selection__rendered {
	padding-inline: 14px 36px;
	line-height: 44px;
	color: var(--c-ink);
}

.select2-container .select2-selection--single .select2-selection__arrow {
	inset-block-start: 0;
	height: 44px;
	width: 36px;
}

.select2-container .select2-selection--single .select2-selection__arrow b {
	display: none;
}

.select2-container .select2-selection--single .select2-selection__arrow::before {
	content: "";
	position: absolute;
	inset: 0;
	background: var(--c-muted);
	-webkit-mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23000' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E") center / 18px no-repeat;
	mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23000' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E") center / 18px no-repeat;
}

.select2-container--focus .select2-selection--single,
.select2-container--open .select2-selection--single {
	border-color: var(--c-focus);
	box-shadow: 0 0 0 3px rgb(45 72 192 / 20%);
}

.select2-dropdown {
	border-color: var(--c-line-strong);
	border-radius: var(--r-s);
	overflow: hidden;
	font-family: var(--font);
}

.select2-container--default .select2-results__option--highlighted[aria-selected],
.select2-container--default .select2-results__option--highlighted[data-selected] {
	background: var(--c-ink);
}

/* ------------------------------------------------------------------ */
/* Classic checkout                                                    */
/* ------------------------------------------------------------------ */

.woocommerce-form-coupon-toggle .woocommerce-info,
.woocommerce-form-login-toggle .woocommerce-info {
	margin-block-end: 12px;
}

form.checkout_coupon,
.woocommerce-checkout form.woocommerce-form-login.login {
	margin-block-end: 20px;
}

form.checkout_coupon {
	display: flex;
	flex-wrap: wrap;
	align-items: flex-end;
	gap: 10px;
}

form.checkout_coupon > p:first-child {
	flex-basis: 100%;
	margin: 0;
}

form.checkout_coupon .form-row {
	margin: 0;
}

form.checkout_coupon .form-row-first {
	flex: 1 1 220px;
}

form.checkout {
	display: grid;
	grid-template-columns: minmax(0, 1.4fr) minmax(0, 1fr);
	grid-template-areas:
		"details heading"
		"details review";
	grid-template-rows: auto 1fr;
	column-gap: clamp(20px, 3vw, 36px);
	align-items: start;
}

form.checkout > .woocommerce-NoticeGroup,
form.checkout > .woocommerce-notices-wrapper {
	grid-column: 1 / -1;
}

form.checkout #customer_details {
	grid-area: details;
}

/* Heading and review are two grid items drawn as one panel: each clips its shadow at the seam. */
form.checkout #order_review_heading {
	grid-area: heading;
	margin: 0;
	padding: clamp(16px, 2.5vw, 24px) clamp(16px, 2.5vw, 24px) 0;
	background: var(--c-surface);
	border-radius: var(--r-l) var(--r-l) 0 0;
	box-shadow: var(--shadow-s);
	clip-path: inset(-4px -4px 0 -4px);
	font-size: 1.05rem;
}

form.checkout #order_review {
	grid-area: review;
	padding: 8px clamp(16px, 2.5vw, 24px) clamp(16px, 2.5vw, 24px);
	background: var(--c-surface);
	border-radius: 0 0 var(--r-l) var(--r-l);
	box-shadow: var(--shadow-s);
	clip-path: inset(0 -4px -4px -4px);
}

form.checkout #customer_details {
	margin-block-end: var(--gap);
}

form.checkout #customer_details .col-2 {
	margin-block-end: 0;
}

/* Shipping method in the review table sits with the other values. */
.woocommerce-checkout-review-order-table .woocommerce-shipping-totals td {
	text-align: end;
}

.woocommerce-checkout-review-order-table .woocommerce-shipping-methods {
	text-align: end;
}

form.checkout .col2-set .col-1,
form.checkout .col2-set .col-2 {
	margin-block-end: 20px;
}

form.checkout h3 {
	font-size: 1.05rem;
}

.woocommerce-checkout-review-order-table {
	border: 0;
	border-radius: 0;
	background: none;
}

.woocommerce-checkout-review-order-table th,
.woocommerce-checkout-review-order-table td {
	padding-inline: 0;
	background: transparent;
	border-bottom-color: var(--c-line-strong);
}

.woocommerce-checkout-review-order-table td:last-child,
.woocommerce-checkout-review-order-table th:last-child {
	text-align: end;
}

.woocommerce-checkout-review-order-table .product-quantity {
	color: var(--c-muted);
	font-weight: 400;
}

#payment {
	margin-block-start: 14px;
}

#payment ul.payment_methods {
	margin: 0 0 14px;
	padding: 0;
	list-style: none;
}

#payment ul.payment_methods > li {
	margin-block-end: 8px;
	padding: 12px 14px;
	border: 1px solid var(--c-line);
	border-radius: var(--r);
	background: var(--c-surface);
	transition: border-color 0.15s ease;
}

#payment ul.payment_methods > li:has(input:checked) {
	border-color: var(--c-ink);
}

#payment ul.payment_methods > li > label {
	display: inline;
	margin: 0;
	cursor: pointer;
}

#payment ul.payment_methods > li img {
	max-height: 24px;
	margin-inline-start: 8px;
}

#payment .payment_box {
	margin-block-start: 8px;
	color: var(--c-muted);
	font-size: 0.875rem;
}

#payment .payment_box p:last-child {
	margin: 0;
}

#payment .place-order {
	margin: 0;
}

.woocommerce-terms-and-conditions-wrapper {
	margin-block-end: 14px;
	font-size: 0.8125rem;
	color: var(--c-muted);
}

.woocommerce-privacy-policy-text p {
	margin-block-end: 10px;
}

#place_order {
	width: 100%;
	min-height: 52px;
	font-size: 1rem;
}

@media (max-width: 900px) {
	form.checkout {
		grid-template-columns: minmax(0, 1fr);
		grid-template-areas:
			"details"
			"heading"
			"review";
	}
}

/* Order received / order details */
.woocommerce-order {
	max-width: 920px;
}

.woocommerce-thankyou-order-received {
	padding: 14px 16px;
	border-radius: var(--r);
	background: var(--c-success-soft);
	color: #155c34;
	font-weight: 700;
}

ul.order_details,
.woocommerce-order-overview {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
	gap: 10px;
	margin: 0 0 24px;
	padding: 0;
	list-style: none;
}

ul.order_details li {
	padding: 12px 14px;
	border-radius: var(--r);
	background: var(--c-surface);
	box-shadow: var(--shadow-s);
	color: var(--c-muted);
	font-size: 0.8125rem;
}

ul.order_details li strong {
	display: block;
	margin-block-start: 2px;
	color: var(--c-ink);
	font-size: 0.9375rem;
}

.woocommerce-customer-details address {
	font-style: normal;
	line-height: 1.9;
}

.woocommerce-columns--addresses,
.woocommerce-Addresses {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
	gap: 20px;
}

/* ------------------------------------------------------------------ */
/* My account                                                          */
/* ------------------------------------------------------------------ */

.woocommerce-account .woocommerce:has(> .woocommerce-MyAccount-navigation) {
	display: grid;
	grid-template-columns: 250px minmax(0, 1fr);
	gap: clamp(20px, 3vw, 36px);
	align-items: start;
}

.woocommerce-MyAccount-navigation ul {
	margin: 0;
	padding: 6px;
	list-style: none;
}

.woocommerce-MyAccount-navigation li + li {
	border-top: 1px solid var(--c-line);
}

.woocommerce-MyAccount-navigation a {
	display: block;
	padding: 11px 12px;
	color: var(--c-ink);
	font-size: 0.875rem;
	text-decoration: none;
	border-radius: var(--r-s);
}

.woocommerce-MyAccount-navigation a:hover {
	background: var(--c-ground);
}

.woocommerce-MyAccount-navigation .is-active a {
	background: var(--c-accent-soft);
	color: var(--c-accent-deep);
	font-weight: 700;
}

.woocommerce-MyAccount-navigation-link--customer-logout a {
	color: var(--c-muted);
}

.woocommerce-MyAccount-content > p:first-of-type {
	margin-block-start: 0;
}

.woocommerce-Address {
	padding-block-start: 12px;
	border-top: 1px solid var(--c-line);
}

.woocommerce-Address-title {
	display: flex;
	align-items: baseline;
	justify-content: space-between;
	gap: 12px;
}

.woocommerce-Address-title h2,
.woocommerce-Address-title h3 {
	font-size: 1rem;
}

.woocommerce-Address address {
	font-style: normal;
	line-height: 1.9;
}

.woocommerce-orders-table .button,
.woocommerce-MyAccount-content .shop_table .button {
	min-height: 34px;
	padding: 2px 12px;
	font-size: 0.8125rem;
	margin-block: 2px;
}

.woocommerce-EditAccountForm fieldset {
	margin: 6px 0 14px;
	padding: 14px 0 0;
	border: 0;
	border-top: 1px solid var(--c-line);
}

.woocommerce-EditAccountForm legend {
	padding-inline: 6px;
	font-weight: 700;
}

#account_display_name_description {
	display: block;
	margin-block-start: 4px;
	color: var(--c-muted);
	font-size: 0.75rem;
}

/* Login / register */
#customer_login,
.woocommerce-account .u-columns.col2-set {
	display: grid;
	grid-template-columns: repeat(2, minmax(0, 1fr));
	gap: clamp(16px, 3vw, 32px);
}

#customer_login h2 {
	margin-block-start: 0;
}

/*
 * «ورود» / «ساخت حساب»: with the script, one panel holds both forms under two
 * tabs (WooCommerce's headings stay for screen readers).
 */
#customer_login.has-tabs {
	display: block;
	max-width: 560px;
	margin-inline: auto;
	padding: clamp(8px, 2vw, 16px) clamp(16px, 3vw, 28px) clamp(20px, 3vw, 28px);
	background: var(--c-surface);
	border-radius: var(--r-l);
	box-shadow: var(--shadow-s);
}

#customer_login.has-tabs > .u-column1,
#customer_login.has-tabs > .u-column2 {
	padding: 0;
	background: none;
	box-shadow: none;
}

#customer_login.has-tabs > [hidden] {
	display: none !important;
}

#customer_login.has-tabs h2 {
	position: absolute;
	width: 1px;
	height: 1px;
	overflow: hidden;
	clip-path: inset(50%);
	white-space: nowrap;
}

.auth-tabs {
	display: grid;
	grid-template-columns: 1fr 1fr;
	margin: 0 0 20px;
	box-shadow: inset 0 -1px 0 var(--c-line);
}

.auth-tabs[hidden] {
	display: none;
}

.auth-tabs__tab {
	min-height: 52px;
	padding: 0 12px;
	border: 0;
	background: none;
	color: var(--c-muted);
	font: inherit;
	font-size: 1rem;
	font-weight: 700;
	cursor: pointer;
	box-shadow: inset 0 -2px 0 transparent;
	transition: color 0.15s ease, box-shadow 0.25s var(--ease-out);
}

.auth-tabs__tab:hover {
	color: var(--c-ink);
}

.auth-tabs__tab[aria-selected="true"] {
	color: var(--c-accent);
	box-shadow: inset 0 -3px 0 var(--c-accent);
}

.auth-switch {
	margin: 16px 0 0;
	color: var(--c-muted);
	font-size: 0.875rem;
	text-align: center;
}

.auth-switch a {
	font-weight: 700;
}

/* Checkout: the account choice for signed-out customers. */
.sofreh-pa-checkout-account .sofreh-pa-create-link {
	font-weight: 700;
}

.woocommerce-account .woocommerce > h2,
#customer_login h2 {
	font-size: 1.1rem;
}

.woocommerce-form-login__rememberme {
	margin-block-end: 10px;
}

.woocommerce-form-login__submit,
.woocommerce-form-register__submit {
	width: 100%;
	margin-block-start: 4px;
}

.woocommerce-LostPassword {
	margin: 14px 0 0;
	text-align: center;
	font-size: 0.875rem;
}

.woocommerce-ResetPassword {
	max-width: 520px;
}

@media (max-width: 860px) {
	.woocommerce-account .woocommerce:has(> .woocommerce-MyAccount-navigation),
	#customer_login,
	.woocommerce-account .u-columns.col2-set {
		grid-template-columns: minmax(0, 1fr);
	}

	.woocommerce-MyAccount-navigation ul {
		display: flex;
		gap: 2px;
		overflow-x: auto;
		scrollbar-width: none;
	}

	.woocommerce-MyAccount-navigation li {
		flex-shrink: 0;
	}

	.woocommerce-MyAccount-navigation li + li {
		border-top: 0;
	}

	.woocommerce-MyAccount-navigation .is-active a {
		background: none;
		box-shadow: inset 0 -2px 0 var(--c-accent);
		border-radius: 0;
	}
}

/* ------------------------------------------------------------------ */
/* Widgets on store pages                                              */
/* ------------------------------------------------------------------ */

.widget_price_filter .price_slider {
	margin-block: 14px 18px;
}

.widget_price_filter .ui-slider {
	position: relative;
	height: 4px;
	margin-inline: 9px;
	border-radius: 4px;
	background: var(--c-line);
}

.widget_price_filter .ui-slider .ui-slider-range {
	position: absolute;
	height: 100%;
	border-radius: 4px;
	background: var(--c-accent);
}

.widget_price_filter .ui-slider .ui-slider-handle {
	position: absolute;
	top: -8px;
	z-index: 2;
	width: 20px;
	height: 20px;
	margin-inline-start: -10px;
	border: 2px solid var(--c-accent);
	border-radius: 50%;
	background: var(--c-surface);
	cursor: grab;
}

html[dir="rtl"] .widget_price_filter .ui-slider .ui-slider-handle {
	margin-inline-start: 0;
	margin-inline-end: -10px;
}

.widget_price_filter .price_slider_amount {
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	justify-content: space-between;
	gap: 8px;
	font-size: 0.8125rem;
}

.widget_price_filter .price_slider_amount .button {
	min-height: 36px;
	padding: 2px 14px;
	font-size: 0.8125rem;
}

.widget_price_filter .price_slider_amount input {
	display: none;
}

.widget_layered_nav li,
.wc-layered-nav-rating {
	display: flex;
	justify-content: space-between;
}

.widget_layered_nav .chosen a,
.widget_layered_nav_filters .chosen a {
	color: var(--c-accent);
	font-weight: 700;
}

.widget_layered_nav_filters ul {
	display: flex;
	flex-wrap: wrap;
	gap: 6px;
}

.widget_layered_nav_filters li a::before {
	content: "";
	display: inline-block;
	width: 14px;
	height: 14px;
	margin-inline-end: 4px;
	vertical-align: -0.15em;
	background: currentColor;
	-webkit-mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23000' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 6 12 12M18 6 6 18'/%3E%3C/svg%3E") center / contain no-repeat;
	mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23000' stroke-width='1.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 6 12 12M18 6 6 18'/%3E%3C/svg%3E") center / contain no-repeat;
}

.widget_product_search .woocommerce-product-search {
	display: flex;
	gap: 8px;
}

.widget .product_list_widget li {
	display: flow-root;
	padding-block: 8px;
}

.widget .product_list_widget img {
	float: inline-start;
	width: 56px;
	margin-inline-end: 12px;
	border-radius: var(--r-s);
}

.widget_shopping_cart .buttons {
	display: flex;
	gap: 8px;
}

/* ------------------------------------------------------------------ */
/* WooCommerce Blocks (Cart, Checkout): documented hooks only          */
/* ------------------------------------------------------------------ */

.wp-block-woocommerce-cart,
.wp-block-woocommerce-checkout {
	font-family: var(--font);
}

.wc-block-cart__submit-container {
	background-color: var(--c-surface);
}

.wc-block-components-order-summary-item__quantity {
	background-color: var(--c-surface);
	border-color: var(--c-ink);
	box-shadow: 0 0 0 2px var(--c-surface);
	color: var(--c-ink);
}

.wc-block-components-button:not(.is-link) {
	border-radius: var(--r-s);
	font-weight: 700;
}

/* ------------------------------------------------------------------ */
/* Phone accounts: confirmation card, tracking page, login hint         */
/* (markup from the companion "Sofreh Phone Accounts" plugin)          */
/* ------------------------------------------------------------------ */

.sofreh-pa-card {
	margin: 0 0 24px;
	padding: 0; /* The plugin's fallback styles pad and frame the card; the theme's rows carry their own padding. */
	border: 0;
	border-radius: var(--r-l);
	background: var(--c-surface);
	box-shadow: var(--shadow-s);
	overflow: hidden;
	animation: sofreh-rise 0.5s var(--ease-out) both;
}

/* Tracking code and account confirmation side by side on wide screens. */
@media (min-width: 900px) {
	.sofreh-pa-card--split {
		display: grid;
		grid-template-columns: minmax(0, 1fr) minmax(0, 1.2fr);
	}

	.sofreh-pa-card--split .sofreh-pa-card__row + .sofreh-pa-card__row {
		border-top: 0;
		border-inline-start: 1px solid var(--c-line);
	}

	.sofreh-pa-card--split .sofreh-pa-card__row--tracking {
		gap: 14px;
	}

	.sofreh-pa-card--split .sofreh-pa-card__row--tracking {
		flex-direction: column;
		align-items: flex-start;
		justify-content: center;
	}

	.sofreh-pa-card--split .sofreh-pa-card__row--tracking > div {
		flex: none;
	}
}

.sofreh-pa-card__subtitle--done,
.sofreh-pa-card__subtitle--waiting {
	display: flex;
	align-items: center;
	gap: 8px;
}

.sofreh-pa-card__subtitle--done::before {
	content: "";
	flex: none;
	width: 24px;
	height: 24px;
	border-radius: 50%;
	background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23fff' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 12.5 4 4 8-9'/%3E%3C/svg%3E") center / 14px no-repeat, var(--c-accent);
	animation: sofreh-pop 0.4s var(--ease-out) 0.35s both;
}

.sofreh-pa-card__subtitle--waiting::before {
	content: "";
	flex: none;
	width: 10px;
	height: 10px;
	margin-inline: 4px;
	border-radius: 50%;
	background: var(--c-saffron);
	box-shadow: 0 0 0 5px var(--c-saffron-soft);
}

@keyframes sofreh-rise {
	from {
		opacity: 0;
		transform: translateY(12px);
	}
}

.sofreh-pa-card__row {
	padding: clamp(16px, 2.5vw, 22px);
}

.sofreh-pa-card .sofreh-pa-card__row + .sofreh-pa-card__row {
	margin-top: 0;
	padding-top: clamp(16px, 2.5vw, 22px);
	border-top: 1px solid var(--c-line);
}

.sofreh-pa-card__row--tracking {
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	justify-content: space-between;
	gap: 14px 20px;
	background: var(--c-success-soft);
}

.sofreh-pa-card__row--tracking::before {
	content: "";
	flex-shrink: 0;
	width: 44px;
	height: 44px;
	border-radius: 50%;
	background:
		url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23fff' stroke-width='2.6' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 12.5 4 4 8-9'/%3E%3C/svg%3E") center / 24px no-repeat,
		var(--c-success);
	animation: sofreh-pop 0.4s var(--ease-out) 0.2s both;
}

@keyframes sofreh-pop {
	from {
		opacity: 0;
		transform: scale(0.5);
	}
}

.sofreh-pa-card__row--tracking > div {
	flex: 1 1 240px;
}

.sofreh-pa-card__title {
	margin: 0 0 2px;
	font-size: 1.05rem;
}

.sofreh-pa-card__subtitle {
	margin: 0 0 2px;
	font-size: 1rem;
}

.sofreh-pa-card__help {
	margin: 0;
	color: var(--c-muted);
	font-size: 0.875rem;
}

.sofreh-pa-card__row--tracking .sofreh-pa-card__help {
	color: #2d5b40;
}

.sofreh-pa-value {
	display: inline-flex;
	align-items: center;
	gap: 8px;
}

.sofreh-pa-value code {
	direction: ltr;
	unicode-bidi: isolate;
	padding: 6px 12px;
	border: 1px dashed var(--c-line-strong);
	border-radius: var(--r-s);
	background: var(--c-surface);
	color: var(--c-ink);
	font-family: var(--font-latin-digits);
	font-feature-settings: normal;
	font-size: 1.0625rem;
	font-weight: 700;
	user-select: all;
}

.sofreh-pa-value--large code {
	font-size: 1.35rem;
	padding: 6px 16px;
}

.sofreh-pa-copy {
	position: relative;
	display: inline-grid;
	min-width: 60px;
	min-height: 36px;
	padding: 2px 12px;
	border: 1px solid var(--c-line-strong);
	border-radius: var(--r-s);
	background: var(--c-surface);
	color: var(--c-ink);
	font: inherit;
	font-size: 0.8125rem;
	cursor: pointer;
}

.sofreh-pa-copy > span {
	grid-area: 1 / 1;
	place-self: center;
}

.sofreh-pa-copy:hover {
	border-color: var(--c-ink);
}

.sofreh-pa-copy__done {
	visibility: hidden;
	color: var(--c-success);
	font-weight: 700;
}

.sofreh-pa-copy.is-copied {
	border-color: var(--c-success);
}

.sofreh-pa-copy.is-copied .sofreh-pa-copy__idle {
	visibility: hidden;
}

.sofreh-pa-copy.is-copied .sofreh-pa-copy__done {
	display: inline;
	visibility: visible;
	animation: sofreh-pop 0.25s var(--ease-out);
}

.sofreh-pa-credentials {
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
	gap: 12px;
	margin: 14px 0;
}

.sofreh-pa-credentials > div {
	padding: 12px 14px;
	border-radius: var(--r);
	background: var(--c-ground);
}

.sofreh-pa-credentials dt {
	margin-block-end: 6px;
	color: var(--c-muted);
	font-size: 0.8125rem;
}

.sofreh-pa-credentials dd {
	margin: 0;
}

.sofreh-pa-card__warning {
	margin: 0 0 14px;
	padding: 10px 12px;
	border-radius: var(--r-s);
	background: var(--c-warning-soft);
	color: var(--c-warning-ink);
	font-size: 0.8125rem;
}

.sofreh-pa-card__actions {
	display: flex;
	flex-wrap: wrap;
	gap: 8px;
	margin: 0;
}

.sofreh-pa-hint {
	margin-block-end: 14px;
	padding: 10px 12px;
	border-radius: var(--r-s);
	background: var(--c-info-soft);
	color: #1d3f6b;
	font-size: 0.8125rem;
}

.sofreh-pa-complete .button {
	margin-inline-start: auto;
}

.sofreh-pa-tracking {
	max-width: 540px;
}

.sofreh-pa-tracking__form {
	margin-block-end: 20px;
}

.sofreh-pa-tracking__intro {
	color: var(--c-muted);
	font-size: 0.9375rem;
}

.sofreh-pa-tracking__form .button {
	width: 100%;
}

.sofreh-pa-result {
	padding: clamp(16px, 2.5vw, 22px);
	border: 1px solid var(--c-line);
	border-radius: var(--r);
	animation: sofreh-rise 0.4s var(--ease-out) both;
}

.sofreh-pa-result h2 {
	font-size: 1.05rem;
}

.sofreh-pa-result dl {
	display: grid;
	gap: 6px;
	margin: 0 0 14px;
}

.sofreh-pa-result dl > div {
	display: flex;
	justify-content: space-between;
	gap: 16px;
	padding-block-end: 6px;
	border-bottom: 1px dashed var(--c-line);
	font-size: 0.9375rem;
}

.sofreh-pa-result dt {
	color: var(--c-muted);
}

.sofreh-pa-result dd {
	margin: 0;
	font-weight: 500;
}

.sofreh-pa-status {
	padding: 1px 10px;
	border-radius: 999px;
	background: var(--c-ground);
	color: var(--c-ink);
}

.sofreh-pa-status--processing,
.sofreh-pa-status--completed {
	background: var(--c-success-soft);
	color: #155c34;
}

.sofreh-pa-status--cancelled,
.sofreh-pa-status--failed,
.sofreh-pa-status--refunded {
	background: var(--c-error-soft);
	color: #8c211d;
}

.sofreh-pa-items {
	margin: 0 0 14px;
	padding: 0;
	list-style: none;
	font-size: 0.9375rem;
}

.sofreh-pa-items li {
	padding-block: 3px;
}

.sofreh-pa-items span {
	color: var(--c-muted);
}

/* Registration: the mobile field leads the form */
.sofreh-pa-register-mobile input {
	direction: ltr;
}
```

### sofreh/assets/js/theme.js

```js
/**
 * Sofreh theme behaviour. No dependencies; loaded deferred.
 *
 * 1. Drawers: the mobile menu and the mobile filters panel.
 * 2. Desktop category menu.
 * 3. Banner carousel and sideways product shelves.
 * 4. Add to cart: the product image flies to the cart, the count bumps.
 * 5. Product page: sticky buy bar on phones.
 * 6. Quantity steppers (− / +) around WooCommerce quantity inputs.
 * 7. Persian/Arabic digits typed into phone and postcode fields become ASCII.
 * 8. Header shadow on scroll; cart counts after Cart/Checkout block changes.
 *
 * Everything degrades to working HTML: the carousel and shelves scroll
 * natively, the drawer category list uses <details>, the forms post.
 */
( function () {
	'use strict';

	var l10n = window.sofrehL10n || { increase: '+', decrease: '−', pause: 'Pause', play: 'Play' };
	var reduceMotion = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
	var isRtl = document.documentElement.dir === 'rtl';
	var focusableSelector = 'a[href], button:not([disabled]), input:not([disabled]):not([type="hidden"]), select:not([disabled]), textarea:not([disabled]), summary, [tabindex]:not([tabindex="-1"])';

	/* ------------------------------------------------------------------ */
	/* 1. Drawers                                                          */
	/* ------------------------------------------------------------------ */

	var backdrop = document.querySelector( '[data-sofreh-backdrop]' );
	var openDrawer = null;
	var lastOpener = null;

	function isDrawerMode( panel ) {
		return window.getComputedStyle( panel ).position === 'fixed';
	}

	function setOpeners( id, expanded ) {
		document.querySelectorAll( '[aria-controls="' + id + '"][data-sofreh-open]' ).forEach( function ( el ) {
			el.setAttribute( 'aria-expanded', expanded ? 'true' : 'false' );
		} );
	}

	function openPanel( panel, opener ) {
		if ( ! panel || ! isDrawerMode( panel ) ) {
			return;
		}
		if ( openDrawer ) {
			closePanel( openDrawer, false );
		}
		openDrawer = panel;
		lastOpener = opener || null;
		panel.classList.add( 'is-open' );
		panel.setAttribute( 'role', 'dialog' );
		panel.setAttribute( 'aria-modal', 'true' );
		if ( ! panel.hasAttribute( 'aria-labelledby' ) ) {
			var title = panel.querySelector( '.site-drawer__title' );
			if ( title ) {
				panel.setAttribute( 'aria-label', title.textContent.trim() );
			}
		}
		setOpeners( panel.id, true );
		document.documentElement.classList.add( 'has-open-drawer' );
		if ( backdrop ) {
			backdrop.hidden = false;
		}
		window.requestAnimationFrame( function () {
			var first = panel.querySelector( focusableSelector );
			if ( first ) {
				first.focus();
			}
		} );
	}

	function closePanel( panel, restoreFocus ) {
		if ( ! panel ) {
			return;
		}
		panel.classList.remove( 'is-open' );
		panel.removeAttribute( 'role' );
		panel.removeAttribute( 'aria-modal' );
		setOpeners( panel.id, false );
		document.documentElement.classList.remove( 'has-open-drawer' );
		if ( backdrop ) {
			backdrop.hidden = true;
		}
		if ( openDrawer === panel ) {
			openDrawer = null;
		}
		if ( restoreFocus !== false && lastOpener ) {
			lastOpener.focus();
		}
	}

	document.addEventListener( 'click', function ( event ) {
		var opener = event.target.closest( '[data-sofreh-open]' );
		if ( opener ) {
			event.preventDefault();
			openPanel( document.getElementById( opener.getAttribute( 'data-sofreh-open' ) ), opener );
			return;
		}
		var closer = event.target.closest( '[data-sofreh-close]' );
		if ( closer ) {
			event.preventDefault();
			closePanel( document.getElementById( closer.getAttribute( 'data-sofreh-close' ) ) );
			return;
		}
		if ( openDrawer && event.target === backdrop ) {
			closePanel( openDrawer );
		}
	} );

	document.addEventListener( 'keydown', function ( event ) {
		if ( ! openDrawer ) {
			return;
		}
		if ( event.key === 'Escape' ) {
			closePanel( openDrawer );
			return;
		}
		if ( event.key === 'Tab' ) {
			var items = Array.prototype.filter.call( openDrawer.querySelectorAll( focusableSelector ), function ( el ) {
				return el.offsetWidth > 0 || el.offsetHeight > 0;
			} );
			if ( ! items.length ) {
				return;
			}
			var first = items[ 0 ];
			var last = items[ items.length - 1 ];
			if ( event.shiftKey && document.activeElement === first ) {
				event.preventDefault();
				last.focus();
			} else if ( ! event.shiftKey && document.activeElement === last ) {
				event.preventDefault();
				first.focus();
			}
		}
	} );

	window.addEventListener( 'resize', function () {
		if ( openDrawer && ! isDrawerMode( openDrawer ) ) {
			closePanel( openDrawer, false );
		}
	} );

	/* ------------------------------------------------------------------ */
	/* 2. Desktop category menu                                            */
	/* ------------------------------------------------------------------ */

	var mega = document.querySelector( '.mega' );
	if ( mega ) {
		var megaToggle = mega.querySelector( '.mega__toggle' );
		var megaPanel = mega.querySelector( '.mega__panel' );
		var hoverTimer = null;

		var openedAt = 0;
		var setMega = function ( open ) {
			if ( open && megaPanel.hidden ) {
				openedAt = Date.now();
			}
			megaPanel.hidden = ! open;
			megaToggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		};

		megaToggle.addEventListener( 'click', function () {
			// A click right after hover opened the menu means "open", not "close".
			if ( ! megaPanel.hidden && Date.now() - openedAt < 600 ) {
				return;
			}
			setMega( megaPanel.hidden );
		} );
		// Hover intent for mouse users; a short delay stops the menu flashing
		// open when the pointer only crosses the button.
		mega.addEventListener( 'mouseenter', function () {
			window.clearTimeout( hoverTimer );
			hoverTimer = window.setTimeout( function () {
				setMega( true );
			}, 120 );
		} );
		mega.addEventListener( 'mouseleave', function () {
			window.clearTimeout( hoverTimer );
			hoverTimer = window.setTimeout( function () {
				setMega( false );
			}, 160 );
		} );
		megaPanel.addEventListener( 'mouseenter', function () {
			window.clearTimeout( hoverTimer );
		} );
		document.addEventListener( 'keydown', function ( event ) {
			if ( event.key === 'Escape' && ! megaPanel.hidden ) {
				setMega( false );
				megaToggle.focus();
			}
		} );
		document.addEventListener( 'focusin', function ( event ) {
			if ( ! megaPanel.hidden && ! mega.contains( event.target ) ) {
				setMega( false );
			}
		} );
		document.addEventListener( 'click', function ( event ) {
			if ( ! megaPanel.hidden && ! mega.contains( event.target ) ) {
				setMega( false );
			}
		} );
	}

	/* ------------------------------------------------------------------ */
	/* 3. Banner carousel and product shelves                              */
	/* ------------------------------------------------------------------ */

	// Scroll position of slide i in a horizontally scrolling track, in the
	// track's writing direction (RTL tracks scroll into negative values).
	function slideOffset( track, i ) {
		return ( isRtl ? -1 : 1 ) * track.clientWidth * i;
	}

	document.querySelectorAll( '[data-sofreh-carousel]' ).forEach( function ( carousel ) {
		var track = carousel.querySelector( '.banner__track' );
		var slides = track ? track.children : [];
		if ( ! track || slides.length < 2 ) {
			return;
		}
		var dots = carousel.querySelectorAll( '[data-carousel-to]' );
		var pauseButton = carousel.querySelector( '[data-carousel="pause"]' );
		var current = 0;
		var timer = null;
		var userPaused = reduceMotion;
		var hovering = false;

		function go( i ) {
			current = ( i + slides.length ) % slides.length;
			track.scrollTo( { left: slideOffset( track, current ), behavior: reduceMotion ? 'auto' : 'smooth' } );
		}

		function syncDots() {
			var i = Math.round( Math.abs( track.scrollLeft ) / track.clientWidth );
			current = Math.max( 0, Math.min( slides.length - 1, i ) );
			dots.forEach( function ( dot, n ) {
				dot.classList.toggle( 'is-current', n === current );
				dot.setAttribute( 'aria-current', n === current ? 'true' : 'false' );
			} );
		}

		function schedule() {
			window.clearInterval( timer );
			if ( userPaused || hovering ) {
				return;
			}
			timer = window.setInterval( function () {
				go( current + 1 );
			}, 6000 );
		}

		var scrollTimer = null;
		track.addEventListener( 'scroll', function () {
			window.clearTimeout( scrollTimer );
			scrollTimer = window.setTimeout( syncDots, 80 );
		}, { passive: true } );

		carousel.addEventListener( 'click', function ( event ) {
			var dot = event.target.closest( '[data-carousel-to]' );
			if ( dot ) {
				go( parseInt( dot.getAttribute( 'data-carousel-to' ), 10 ) );
				schedule();
				return;
			}
			var nav = event.target.closest( '[data-carousel]' );
			if ( ! nav ) {
				return;
			}
			var action = nav.getAttribute( 'data-carousel' );
			if ( action === 'next' ) {
				go( current + 1 );
				schedule();
			} else if ( action === 'prev' ) {
				go( current - 1 );
				schedule();
			} else if ( action === 'pause' ) {
				userPaused = ! userPaused;
				nav.setAttribute( 'aria-pressed', userPaused ? 'true' : 'false' );
				schedule();
			}
		} );

		// Autoplay pauses while the visitor is pointing at, touching or
		// focused inside the banner, and never starts under reduced motion.
		carousel.addEventListener( 'mouseenter', function () {
			hovering = true;
			schedule();
		} );
		carousel.addEventListener( 'mouseleave', function () {
			hovering = false;
			schedule();
		} );
		carousel.addEventListener( 'focusin', function () {
			hovering = true;
			schedule();
		} );
		carousel.addEventListener( 'focusout', function () {
			hovering = false;
			schedule();
		} );
		track.addEventListener( 'touchstart', function () {
			hovering = true;
			schedule();
		}, { passive: true } );
		track.addEventListener( 'touchend', function () {
			hovering = false;
			schedule();
		}, { passive: true } );

		if ( pauseButton ) {
			pauseButton.setAttribute( 'aria-pressed', userPaused ? 'true' : 'false' );
			if ( reduceMotion ) {
				pauseButton.hidden = true;
			}
		}
		syncDots();
		schedule();
	} );

	document.querySelectorAll( '[data-sofreh-scroller]' ).forEach( function ( shelf ) {
		var list = shelf.querySelector( 'ul.products' );
		var prev = shelf.querySelector( '[data-scroll="prev"]' );
		var next = shelf.querySelector( '[data-scroll="next"]' );
		if ( ! list || ! prev || ! next ) {
			return;
		}
		function update() {
			var max = list.scrollWidth - list.clientWidth;
			var pos = Math.abs( list.scrollLeft );
			prev.disabled = pos < 4;
			next.disabled = pos > max - 4;
		}
		function by( direction ) {
			var step = list.clientWidth * 0.8 * direction * ( isRtl ? -1 : 1 );
			list.scrollBy( { left: step, behavior: reduceMotion ? 'auto' : 'smooth' } );
		}
		prev.addEventListener( 'click', function () {
			by( -1 );
		} );
		next.addEventListener( 'click', function () {
			by( 1 );
		} );
		list.addEventListener( 'scroll', update, { passive: true } );
		window.addEventListener( 'resize', update );
		update();
	} );

	/* ------------------------------------------------------------------ */
	/* 4. Add to cart: flight and count bump                               */
	/* ------------------------------------------------------------------ */

	function visibleCartTarget() {
		var candidates = document.querySelectorAll( '.tabbar-cart .tabbar__icon, .header-cart' );
		for ( var i = 0; i < candidates.length; i++ ) {
			var r = candidates[ i ].getBoundingClientRect();
			if ( r.width > 0 && r.height > 0 ) {
				return candidates[ i ];
			}
		}
		return null;
	}

	// The image of the product whose button was pressed flies into the cart.
	function flyToCart( sourceImg ) {
		var target = visibleCartTarget();
		if ( reduceMotion || ! sourceImg || ! target || ! sourceImg.animate ) {
			return;
		}
		var from = sourceImg.getBoundingClientRect();
		var to = target.getBoundingClientRect();
		if ( ! from.width ) {
			return;
		}
		var ghost = sourceImg.cloneNode( false );
		ghost.removeAttribute( 'srcset' );
		ghost.removeAttribute( 'sizes' );
		ghost.className = 'fly-to-cart';
		ghost.setAttribute( 'alt', '' );
		ghost.style.left = from.left + 'px';
		ghost.style.top = from.top + 'px';
		ghost.style.width = from.width + 'px';
		ghost.style.height = from.height + 'px';
		document.body.appendChild( ghost );
		var dx = ( to.left + to.width / 2 ) - ( from.left + from.width / 2 );
		var dy = ( to.top + to.height / 2 ) - ( from.top + from.height / 2 );
		var animation = ghost.animate( [
			{ transform: 'translate(0, 0) scale(1)', opacity: 1, borderRadius: '10px' },
			{ transform: 'translate(' + ( dx * 0.45 ) + 'px, ' + ( dy * 0.2 - 60 ) + 'px) scale(0.55)', opacity: 1, borderRadius: '30%', offset: 0.45 },
			{ transform: 'translate(' + dx + 'px, ' + dy + 'px) scale(0.12)', opacity: 0.3, borderRadius: '50%' },
		], { duration: 700, easing: 'cubic-bezier(0.4, 0, 0.2, 1)' } );
		animation.onfinish = function () {
			ghost.remove();
		};
	}

	var pendingFlight = null;
	document.addEventListener( 'click', function ( event ) {
		var button = event.target.closest( '.add_to_cart_button.ajax_add_to_cart' );
		if ( button ) {
			var card = button.closest( 'li.product' );
			pendingFlight = card ? card.querySelector( '.product-card__media img' ) : null;
		}
	}, true );

	var lastCount = null;
	function readCount() {
		var el = document.querySelector( '.cart-count' );
		return el ? el.textContent.trim() : null;
	}
	lastCount = readCount();

	function bumpIfChanged() {
		var now = readCount();
		if ( now !== null && lastCount !== null && now !== lastCount && ! reduceMotion ) {
			document.querySelectorAll( '.cart-count' ).forEach( function ( el ) {
				el.classList.remove( 'is-bumped' );
				void el.offsetWidth; // Restart the animation.
				el.classList.add( 'is-bumped' );
			} );
		}
		lastCount = now;
	}

	if ( window.jQuery ) {
		window.jQuery( document.body ).on( 'added_to_cart', function () {
			flyToCart( pendingFlight );
			pendingFlight = null;
			window.setTimeout( bumpIfChanged, reduceMotion ? 0 : 600 );
		} );
		window.jQuery( document.body ).on( 'removed_from_cart wc_fragments_refreshed wc_fragments_loaded', bumpIfChanged );
	}

	/* ------------------------------------------------------------------ */
	/* 5. Product page: sticky buy bar (phones)                            */
	/* ------------------------------------------------------------------ */

	var buyBar = document.querySelector( '[data-sofreh-buybar]' );
	var buyBox = document.getElementById( 'buy-box' );
	if ( buyBar && buyBox && 'IntersectionObserver' in window ) {
		new IntersectionObserver( function ( entries ) {
			// Show the bar only once the buy box has scrolled up and away.
			var e = entries[ 0 ];
			buyBar.hidden = e.isIntersecting || e.boundingClientRect.top > 0;
		} ).observe( buyBox );

		buyBar.addEventListener( 'click', function ( event ) {
			var button = event.target.closest( '[data-sofreh-buy]' );
			if ( ! button ) {
				return;
			}
			var real = buyBox.querySelector( '.single_add_to_cart_button' );
			if ( button.getAttribute( 'data-sofreh-buy' ) === 'add' && real && ! real.disabled && ! real.classList.contains( 'disabled' ) ) {
				real.click();
			} else {
				buyBox.scrollIntoView( { behavior: reduceMotion ? 'auto' : 'smooth', block: 'center' } );
				var firstChoice = buyBox.querySelector( 'select, input.qty' );
				if ( firstChoice ) {
					window.setTimeout( function () {
						firstChoice.focus( { preventScroll: true } );
					}, reduceMotion ? 0 : 400 );
				}
			}
		} );
	}

	/* ------------------------------------------------------------------ */
	/* 6. Quantity steppers                                                */
	/* ------------------------------------------------------------------ */

	function decimals( n ) {
		var s = String( n );
		return s.indexOf( '.' ) === -1 ? 0 : s.length - s.indexOf( '.' ) - 1;
	}

	function makeButton( kind, label ) {
		var b = document.createElement( 'button' );
		b.type = 'button';
		b.className = 'qty-step qty-step--' + kind;
		b.setAttribute( 'aria-label', label );
		b.setAttribute( 'data-qty-step', kind );
		return b;
	}

	function enhanceQuantities( root ) {
		( root || document ).querySelectorAll( '.quantity' ).forEach( function ( wrap ) {
			var input = wrap.querySelector( 'input.qty' );
			if ( ! input || input.type === 'hidden' || wrap.classList.contains( 'has-steppers' ) ) {
				return;
			}
			wrap.classList.add( 'has-steppers' );
			wrap.insertBefore( makeButton( 'plus', l10n.increase ), input );
			wrap.appendChild( makeButton( 'minus', l10n.decrease ) );
		} );
	}

	document.addEventListener( 'click', function ( event ) {
		var button = event.target.closest( '[data-qty-step]' );
		if ( ! button ) {
			return;
		}
		var input = button.parentNode.querySelector( 'input.qty' );
		if ( ! input || input.disabled || input.readOnly ) {
			return;
		}
		var step = parseFloat( input.step );
		if ( ! step || step <= 0 ) {
			step = 1;
		}
		var min = input.min === '' ? 0 : parseFloat( input.min );
		var max = input.max === '' ? Infinity : parseFloat( input.max );
		var value = parseFloat( input.value );
		if ( isNaN( value ) ) {
			value = isNaN( min ) ? 0 : min;
		}
		value += button.getAttribute( 'data-qty-step' ) === 'plus' ? step : -step;
		if ( ! isNaN( min ) ) {
			value = Math.max( value, min );
		}
		value = Math.min( value, max );
		input.value = value.toFixed( decimals( step ) );
		// WooCommerce's cart script enables "Update cart" on these events.
		input.dispatchEvent( new Event( 'input', { bubbles: true } ) );
		input.dispatchEvent( new Event( 'change', { bubbles: true } ) );
	} );

	enhanceQuantities();

	if ( 'MutationObserver' in window ) {
		var pending = false;
		new MutationObserver( function () {
			if ( pending ) {
				return;
			}
			pending = true;
			window.requestAnimationFrame( function () {
				pending = false;
				enhanceQuantities();
			} );
		} ).observe( document.body, { childList: true, subtree: true } );
	}

	/* ------------------------------------------------------------------ */
	/* 7. Digits in phone and postcode fields                              */
	/* ------------------------------------------------------------------ */

	// WooCommerce validates these in the browser (the block checkout even
	// blocks the order with "Please enter a valid postcode"), before the
	// server-side normalization in inc/persian.php can run. So digits are
	// converted as they are typed or pasted. The theme font draws ASCII
	// digits with Persian shapes, so the customer sees no change.
	var digitFields = 'input[type="tel"], input[name$="postcode"], input[id$="-postcode"], input[autocomplete="postal-code"], input[autocomplete="tel"], input[name="sofreh_pa_mobile"]';
	var nonAsciiDigit = /[۰-۹٠-٩]/;

	function toAsciiDigits( value ) {
		return value.replace( /[۰-۹٠-٩]/g, function ( d ) {
			var code = d.charCodeAt( 0 );
			return String( code >= 0x06F0 ? code - 0x06F0 : code - 0x0660 );
		} );
	}

	function isDigitField( el ) {
		return el && el.matches && el.matches( digitFields );
	}

	// Typing and pasting: replace the inserted text before it lands. Using
	// insertText keeps the browser's native input event, which React-based
	// forms (Cart and Checkout blocks) rely on to update their state.
	document.addEventListener( 'beforeinput', function ( event ) {
		if ( ! isDigitField( event.target ) ) {
			return;
		}
		var text = event.data;
		if ( ! text && event.dataTransfer ) {
			text = event.dataTransfer.getData( 'text/plain' );
		}
		if ( ! text || ! nonAsciiDigit.test( text ) ) {
			return;
		}
		event.preventDefault();
		document.execCommand( 'insertText', false, toAsciiDigits( text ) );
	}, true );

	// Fallback for values set without a beforeinput event (autofill, scripts)
	// on classic forms, whose state is the field value itself.
	document.addEventListener( 'input', function ( event ) {
		var field = event.target;
		if ( ! isDigitField( field ) || field.closest( '.wc-block-components-form, .wp-block-woocommerce-checkout, .wp-block-woocommerce-cart' ) ) {
			return;
		}
		var fixed = toAsciiDigits( field.value );
		if ( fixed !== field.value ) {
			var start = field.selectionStart;
			var end = field.selectionEnd;
			field.value = fixed;
			try {
				field.setSelectionRange( start, end );
			} catch ( e ) {} // Not every input type supports selection.
		}
	}, true );

	/* ------------------------------------------------------------------ */
	/* 8. Header shadow; cart counts after block cart changes              */
	/* ------------------------------------------------------------------ */

	var header = document.getElementById( 'masthead' );
	if ( header ) {
		var onScroll = function () {
			header.classList.toggle( 'is-scrolled', window.scrollY > 4 );
		};
		window.addEventListener( 'scroll', onScroll, { passive: true } );
		onScroll();
	}

	function refreshFragments() {
		if ( window.jQuery ) {
			window.jQuery( document.body ).trigger( 'wc_fragment_refresh' );
		}
	}
	document.body.addEventListener( 'wc-blocks_added_to_cart', refreshFragments );
	document.body.addEventListener( 'wc-blocks_removed_from_cart', refreshFragments );

	/* ------------------------------------------------------------------ */
	/* 9. My account: «ورود» / «ساخت حساب» tabs                            */
	/* ------------------------------------------------------------------ */

	// WooCommerce prints the login and sign-up forms side by side; the tabs
	// show one at a time inside a single panel. Without this script both
	// forms simply stay visible.
	var authTabs = document.querySelector( '[data-sofreh-auth-tabs]' );
	var authBox = document.getElementById( 'customer_login' );
	if ( authTabs && authBox ) {
		var panels = {
			login: authBox.querySelector( '.u-column1' ),
			register: authBox.querySelector( '.u-column2' ),
		};
		if ( panels.login && panels.register ) {
			var tabs = {
				login: authTabs.querySelector( '[data-tab="login"]' ),
				register: authTabs.querySelector( '[data-tab="register"]' ),
			};
			[ 'login', 'register' ].forEach( function ( name ) {
				panels[ name ].id = panels[ name ].id || 'auth-panel-' + name;
				panels[ name ].setAttribute( 'role', 'tabpanel' );
				panels[ name ].setAttribute( 'aria-labelledby', tabs[ name ].id );
				tabs[ name ].setAttribute( 'aria-controls', panels[ name ].id );
			} );

			var showTab = function ( name, focusTab ) {
				[ 'login', 'register' ].forEach( function ( other ) {
					var on = other === name;
					tabs[ other ].setAttribute( 'aria-selected', on ? 'true' : 'false' );
					tabs[ other ].tabIndex = on ? 0 : -1;
					panels[ other ].hidden = ! on;
				} );
				if ( focusTab ) {
					tabs[ name ].focus();
				}
			};

			authBox.insertBefore( authTabs, authBox.firstChild );
			authTabs.hidden = false;
			authBox.classList.add( 'has-tabs' );
			showTab( authTabs.getAttribute( 'data-initial' ) === 'register' ? 'register' : 'login' );

			authTabs.addEventListener( 'click', function ( event ) {
				var tab = event.target.closest( '[data-tab]' );
				if ( tab ) {
					showTab( tab.getAttribute( 'data-tab' ) );
				}
			} );
			// Arrow keys move between the two tabs, whatever the direction.
			authTabs.addEventListener( 'keydown', function ( event ) {
				if ( [ 'ArrowLeft', 'ArrowRight', 'Home', 'End' ].indexOf( event.key ) === -1 ) {
					return;
				}
				event.preventDefault();
				var current = tabs.login.getAttribute( 'aria-selected' ) === 'true' ? 'login' : 'register';
				var next = event.key === 'Home' ? 'login' : event.key === 'End' ? 'register' : ( current === 'login' ? 'register' : 'login' );
				showTab( next, true );
			} );
			authBox.addEventListener( 'click', function ( event ) {
				var link = event.target.closest( '[data-sofreh-auth-switch]' );
				if ( link ) {
					event.preventDefault();
					showTab( link.getAttribute( 'data-sofreh-auth-switch' ), true );
				}
			} );
		}
	}
}() );
```

### sofreh/inc/customizer.php

```php
<?php
/**
 * Customizer options (Appearance → Customize → Sofreh).
 *
 * Every setting is sanitized on save and escaped again on output.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

/**
 * Default values. Text defaults are translatable, so a Persian site starts in
 * Persian; the store owner should rewrite them to match their real policies.
 *
 * @return array
 */
function sofreh_customizer_defaults() {
	return array(
		'announcement'      => '',
		'hero_show'         => true,
		'hero_title'        => __( 'Refresh your kitchen', 'sofreh' ),
		'hero_text'         => __( 'Cookware, tableware and home basics for every day.', 'sofreh' ),
		'hero_button'       => __( 'See the products', 'sofreh' ),
		'hero_image'        => 0,
		'hero_link'         => '',
		'hero_tone'         => 'lapis',
		'slide2_title'      => '',
		'slide2_text'       => '',
		'slide2_button'     => '',
		'slide2_image'      => 0,
		'slide2_link'       => '',
		'slide2_tone'       => 'plum',
		'slide3_title'      => '',
		'slide3_text'       => '',
		'slide3_button'     => '',
		'slide3_image'      => 0,
		'slide3_link'       => '',
		'slide3_tone'       => 'saffron',
		'home_categories'   => true,
		'home_new'          => true,
		'home_sale'         => true,
		'home_best'         => true,
		'home_products_num' => 8,
		'trust_show'        => true,
		// Promises are store policy, so none are claimed until the store writes them.
		'trust_1'           => '',
		'trust_2'           => '',
		'trust_3'           => '',
		'trust_4'           => '',
		'footer_about'      => __( 'A store for home and kitchen goods.', 'sofreh' ),
		'contact_phone'     => '',
		'contact_email'     => '',
		'contact_address'   => '',
		'product_note'      => '',
	);
}

/**
 * Read one theme option with its default.
 *
 * @param string $key Option key.
 * @return mixed
 */
function sofreh_option( $key ) {
	$defaults = sofreh_customizer_defaults();
	return get_theme_mod( 'sofreh_' . $key, isset( $defaults[ $key ] ) ? $defaults[ $key ] : '' );
}

/**
 * Sanitize a checkbox.
 *
 * @param mixed $value Value.
 * @return bool
 */
function sofreh_sanitize_checkbox( $value ) {
	return (bool) $value;
}

/**
 * Sanitize the product count (4–16, in multiples that fill a row of four).
 *
 * @param mixed $value Value.
 * @return int
 */
function sofreh_sanitize_product_count( $value ) {
	$value = absint( $value );
	return in_array( $value, array( 4, 8, 12, 16 ), true ) ? $value : 8;
}

/**
 * Sanitize a banner tone.
 *
 * @param mixed $value Value.
 * @return string
 */
function sofreh_sanitize_tone( $value ) {
	// Tones saved by theme 2.0 (teal, dark, red) map onto the current palette.
	$legacy = array(
		'teal'   => 'lapis',
		'ink'    => 'plum',
		'accent' => 'saffron',
	);
	if ( isset( $legacy[ $value ] ) ) {
		return $legacy[ $value ];
	}
	return in_array( $value, array( 'lapis', 'plum', 'saffron' ), true ) ? $value : 'lapis';
}

/**
 * The home banner slides that have a title, in order.
 *
 * @return array[]
 */
function sofreh_banner_slides() {
	$slides = array();
	foreach ( array( 'hero', 'slide2', 'slide3' ) as $key ) {
		$title = trim( (string) sofreh_option( $key . '_title' ) );
		if ( '' === $title ) {
			continue;
		}
		$link = (string) sofreh_option( $key . '_link' );
		if ( '' === $link && function_exists( 'wc_get_page_permalink' ) ) {
			$link = wc_get_page_permalink( 'shop' );
		}
		$slides[] = array(
			'title'  => $title,
			'text'   => (string) sofreh_option( $key . '_text' ),
			'button' => (string) sofreh_option( $key . '_button' ),
			'image'  => absint( sofreh_option( $key . '_image' ) ),
			'link'   => $link,
			'tone'   => sofreh_sanitize_tone( sofreh_option( $key . '_tone' ) ),
		);
	}
	return $slides;
}

/**
 * Register Customizer settings.
 *
 * @param WP_Customize_Manager $wp_customize Manager.
 */
function sofreh_customize_register( $wp_customize ) {
	$d = sofreh_customizer_defaults();

	$wp_customize->add_panel(
		'sofreh',
		array(
			'title'    => __( 'Sofreh theme', 'sofreh' ),
			'priority' => 30,
		)
	);

	$sections = array(
		'sofreh_header'  => __( 'Header', 'sofreh' ),
		'sofreh_home'    => __( 'Home page', 'sofreh' ),
		'sofreh_trust'   => __( 'Store promises', 'sofreh' ),
		'sofreh_product' => __( 'Product page', 'sofreh' ),
		'sofreh_footer'  => __( 'Footer and contact', 'sofreh' ),
	);
	foreach ( $sections as $id => $title ) {
		$wp_customize->add_section(
			$id,
			array(
				'title' => $title,
				'panel' => 'sofreh',
			)
		);
	}

	$add = function ( $key, $section, $label, $type = 'text', $sanitize = 'sanitize_text_field', $extra = array() ) use ( $wp_customize, $d ) {
		$wp_customize->add_setting(
			'sofreh_' . $key,
			array(
				'default'           => $d[ $key ],
				'sanitize_callback' => $sanitize,
				'transport'         => 'refresh',
			)
		);
		$wp_customize->add_control(
			'sofreh_' . $key,
			array_merge(
				array(
					'label'   => $label,
					'section' => $section,
					'type'    => $type,
				),
				$extra
			)
		);
	};

	$add( 'announcement', 'sofreh_header', __( 'Announcement bar text (leave empty to hide)', 'sofreh' ) );

	$add( 'hero_show', 'sofreh_home', __( 'Show the banner', 'sofreh' ), 'checkbox', 'sofreh_sanitize_checkbox' );

	$tones = array(
		'lapis'   => __( 'Lapis', 'sofreh' ),
		'plum'    => __( 'Plum', 'sofreh' ),
		'saffron' => __( 'Saffron', 'sofreh' ),
	);
	foreach ( array(
		'hero'   => 1,
		'slide2' => 2,
		'slide3' => 3,
	) as $key => $n ) {
		/* translators: %d: banner slide number. */
		$prefix = sprintf( __( 'Banner %d', 'sofreh' ), $n );
		$add(
			$key . '_title',
			'sofreh_home',
			$prefix . ': ' . __( 'heading', 'sofreh' ),
			'text',
			'sanitize_text_field',
			1 === $n ? array() : array( 'description' => __( 'Leave empty to hide this slide.', 'sofreh' ) )
		);
		$add( $key . '_text', 'sofreh_home', $prefix . ': ' . __( 'text', 'sofreh' ), 'textarea', 'sanitize_textarea_field' );
		$add( $key . '_button', 'sofreh_home', $prefix . ': ' . __( 'button label', 'sofreh' ) );
		$add( $key . '_link', 'sofreh_home', $prefix . ': ' . __( 'link (empty = shop page)', 'sofreh' ), 'url', 'esc_url_raw' );
		$add( $key . '_tone', 'sofreh_home', $prefix . ': ' . __( 'background', 'sofreh' ), 'select', 'sofreh_sanitize_tone', array( 'choices' => $tones ) );

		$wp_customize->add_setting(
			'sofreh_' . $key . '_image',
			array(
				'default'           => 0,
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Media_Control(
				$wp_customize,
				'sofreh_' . $key . '_image',
				array(
					'label'       => $prefix . ': ' . __( 'image', 'sofreh' ),
					'description' => __( 'A product photo on a plain or transparent background works best (about 800 × 800 pixels).', 'sofreh' ),
					'section'     => 'sofreh_home',
					'mime_type'   => 'image',
				)
			)
		);
	}

	$add( 'home_categories', 'sofreh_home', __( 'Show product categories', 'sofreh' ), 'checkbox', 'sofreh_sanitize_checkbox' );
	$add( 'home_new', 'sofreh_home', __( 'Show newest products', 'sofreh' ), 'checkbox', 'sofreh_sanitize_checkbox' );
	$add( 'home_sale', 'sofreh_home', __( 'Show products on sale', 'sofreh' ), 'checkbox', 'sofreh_sanitize_checkbox' );
	$add( 'home_best', 'sofreh_home', __( 'Show best sellers', 'sofreh' ), 'checkbox', 'sofreh_sanitize_checkbox' );
	$add(
		'home_products_num',
		'sofreh_home',
		__( 'Products per home page section', 'sofreh' ),
		'select',
		'sofreh_sanitize_product_count',
		array(
			'choices' => array(
				4  => '4',
				8  => '8',
				12 => '12',
				16 => '16',
			),
		)
	);

	$add( 'trust_show', 'sofreh_trust', __( 'Show the promises strip on the home page', 'sofreh' ), 'checkbox', 'sofreh_sanitize_checkbox' );
	$trust_help     = array( 'description' => __( 'Only state what your store actually offers. Leave a field empty to hide it.', 'sofreh' ) );
	$trust_examples = array(
		1 => array( __( 'Promise 1 (delivery)', 'sofreh' ), __( 'e.g. Delivery across the country', 'sofreh' ) ),
		2 => array( __( 'Promise 2 (payment)', 'sofreh' ), __( 'e.g. Pay on delivery', 'sofreh' ) ),
		3 => array( __( 'Promise 3 (returns)', 'sofreh' ), __( 'e.g. Seven-day returns', 'sofreh' ) ),
		4 => array( __( 'Promise 4 (support)', 'sofreh' ), __( 'e.g. Support by phone', 'sofreh' ) ),
	);
	foreach ( $trust_examples as $n => $trust_example ) {
		$extra = array( 'input_attrs' => array( 'placeholder' => $trust_example[1] ) );
		if ( 1 === $n ) {
			$extra += $trust_help;
		}
		$add( 'trust_' . $n, 'sofreh_trust', $trust_example[0], 'text', 'sanitize_text_field', $extra );
	}

	$add(
		'product_note',
		'sofreh_product',
		__( 'Note under the add-to-cart button', 'sofreh' ),
		'textarea',
		'sanitize_textarea_field',
		array( 'description' => __( 'For example your shipping time or return policy. Leave empty to hide.', 'sofreh' ) )
	);

	$add( 'footer_about', 'sofreh_footer', __( 'About the store', 'sofreh' ), 'textarea', 'sanitize_textarea_field' );
	$add( 'contact_phone', 'sofreh_footer', __( 'Phone', 'sofreh' ) );
	$add( 'contact_email', 'sofreh_footer', __( 'Email', 'sofreh' ), 'email', 'sanitize_email' );
	$add( 'contact_address', 'sofreh_footer', __( 'Address', 'sofreh' ), 'textarea', 'sanitize_textarea_field' );
}
add_action( 'customize_register', 'sofreh_customize_register' );
```

### sofreh/inc/enqueue.php

```php
<?php
/**
 * Styles and scripts.
 *
 * Styles are written with CSS logical properties (margin-inline-start and so
 * on), so one stylesheet serves both RTL and LTR; no separate rtl.css is needed.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

/**
 * Cache-busting version for a theme asset.
 *
 * @param string $relative Path relative to the theme root.
 * @return string
 */
function sofreh_asset_version( $relative ) {
	$file = SOFREH_DIR . '/' . $relative;
	return file_exists( $file ) ? SOFREH_VERSION . '.' . filemtime( $file ) : SOFREH_VERSION;
}

/**
 * Front-end assets.
 */
function sofreh_enqueue_assets() {
	wp_enqueue_style( 'sofreh-main', SOFREH_URI . '/assets/css/main.css', array(), sofreh_asset_version( 'assets/css/main.css' ) );

	if ( sofreh_is_woocommerce_active() ) {
		wp_enqueue_style( 'sofreh-woocommerce', SOFREH_URI . '/assets/css/woocommerce.css', array( 'sofreh-main' ), sofreh_asset_version( 'assets/css/woocommerce.css' ) );
	}

	wp_enqueue_script(
		'sofreh-theme',
		SOFREH_URI . '/assets/js/theme.js',
		array(),
		sofreh_asset_version( 'assets/js/theme.js' ),
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);
	wp_localize_script(
		'sofreh-theme',
		'sofrehL10n',
		array(
			'increase' => __( 'Increase quantity', 'sofreh' ),
			'decrease' => __( 'Decrease quantity', 'sofreh' ),
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'sofreh_enqueue_assets' );

/**
 * Preload the regular text weight: it is needed for the first paint on every page.
 */
function sofreh_preload_font() {
	printf(
		'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
		esc_url( SOFREH_URI . '/assets/fonts/Vazirmatn-FD-Regular.woff2' )
	);
}
add_action( 'wp_head', 'sofreh_preload_font', 2 );
```

### sofreh/inc/icons.php

```php
<?php
/**
 * Inline SVG icons. Icons are decorative: they are always aria-hidden and the
 * control that holds them carries its own accessible name.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

/**
 * Return the markup for one icon.
 *
 * The SVG paths are fixed strings defined below, never user input, so the
 * returned markup is safe to echo.
 *
 * @param string $name Icon name.
 * @param int    $size Pixel size.
 * @return string
 */
function sofreh_get_icon( $name, $size = 24 ) {
	$paths = array(
		'search'  => '<circle cx="11" cy="11" r="7"/><path d="m20 20-3.6-3.6"/>',
		'user'    => '<circle cx="12" cy="8" r="4"/><path d="M4 20c1.4-3.6 4.4-5.5 8-5.5s6.6 1.9 8 5.5"/>',
		'bag'     => '<path d="M5 8h14l-1.2 12H6.2z"/><path d="M9 8V6.5a3 3 0 0 1 6 0V8"/>',
		'menu'    => '<path d="M4 7h16M4 12h16M4 17h16"/>',
		'close'   => '<path d="m6 6 12 12M18 6 6 18"/>',
		'filter'  => '<path d="M4 6h16M7 12h10M10 18h4"/>',
		'chevron' => '<path d="m15 6-6 6 6 6"/>',
		'plus'    => '<path d="M12 5v14M5 12h14"/>',
		'minus'   => '<path d="M5 12h14"/>',
		'truck'   => '<path d="M3 6h11v10H3z"/><path d="M14 10h4l3 3v3h-7"/><circle cx="7" cy="17.5" r="1.8"/><circle cx="17" cy="17.5" r="1.8"/>',
		'shield'  => '<path d="M12 3 5 6v5c0 4.4 3 8.3 7 10 4-1.7 7-5.6 7-10V6z"/><path d="m9 12 2 2 4-4"/>',
		'return'  => '<path d="M4 9h11a5 5 0 0 1 0 10H8"/><path d="m8 5-4 4 4 4"/>',
		'support' => '<path d="M5 13v-1a7 7 0 0 1 14 0v1"/><rect x="3.5" y="13" width="4" height="6" rx="1.5"/><rect x="16.5" y="13" width="4" height="6" rx="1.5"/><path d="M18.5 19c0 1.2-1.5 2-4 2"/>',
		'phone'   => '<path d="M6.5 3.5h3l1.5 4-2 1.5a11 11 0 0 0 6 6l1.5-2 4 1.5v3a2 2 0 0 1-2 2A16 16 0 0 1 4.5 5.5a2 2 0 0 1 2-2z"/>',
		'mail'    => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m4 7 8 6 8-6"/>',
		'pin'     => '<path d="M12 21s-6.5-6-6.5-11a6.5 6.5 0 0 1 13 0c0 5-6.5 11-6.5 11z"/><circle cx="12" cy="10" r="2.3"/>',
		'home'    => '<path d="M4 10.5 12 4l8 6.5V20a1 1 0 0 1-1 1h-4.5v-6h-5v6H5a1 1 0 0 1-1-1z"/>',
		'grid'    => '<rect x="4" y="4" width="6.5" height="6.5" rx="1.5"/><rect x="13.5" y="4" width="6.5" height="6.5" rx="1.5"/><rect x="4" y="13.5" width="6.5" height="6.5" rx="1.5"/><rect x="13.5" y="13.5" width="6.5" height="6.5" rx="1.5"/>',
		'up'      => '<path d="m6 14 6-6 6 6"/>',
		'down'    => '<path d="m6 10 6 6 6-6"/>',
		'check'   => '<path d="m5 12.5 4.5 4.5L19 7.5"/>',
		'box'     => '<path d="M4 8 12 4l8 4v8l-8 4-8-4z"/><path d="m4 8 8 4 8-4M12 12v8"/>',
		'percent' => '<path d="M19 5 5 19"/><circle cx="7" cy="7" r="2.5"/><circle cx="17" cy="17" r="2.5"/>',
	);

	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}

	return sprintf(
		'<svg class="icon icon-%1$s" width="%2$d" height="%2$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%3$s</svg>',
		esc_attr( $name ),
		absint( $size ),
		$paths[ $name ]
	);
}

/**
 * Allowed SVG markup for wp_kses() when icon markup passes through a filter.
 *
 * @return array
 */
function sofreh_svg_kses() {
	$shape = array(
		'd'      => true,
		'cx'     => true,
		'cy'     => true,
		'r'      => true,
		'x'      => true,
		'y'      => true,
		'rx'     => true,
		'width'  => true,
		'height' => true,
	);
	return array(
		'svg'    => array(
			'class'           => true,
			'width'           => true,
			'height'          => true,
			'viewbox'         => true,
			'fill'            => true,
			'stroke'          => true,
			'stroke-width'    => true,
			'stroke-linecap'  => true,
			'stroke-linejoin' => true,
			'aria-hidden'     => true,
			'focusable'       => true,
		),
		'path'   => $shape,
		'circle' => $shape,
		'rect'   => $shape,
	);
}

/**
 * Echo an icon.
 *
 * @param string $name Icon name.
 * @param int    $size Pixel size.
 */
function sofreh_icon( $name, $size = 24 ) {
	echo wp_kses( sofreh_get_icon( $name, $size ), sofreh_svg_kses() );
}
```

### sofreh/inc/persian.php

```php
<?php
/**
 * Persian input handling.
 *
 * Persian keyboards type Persian digits (۰–۹) and some Android keyboards type
 * Arabic-Indic digits (٠–٩). WooCommerce validates phone numbers and postcodes
 * against ASCII digits only, so a customer typing their own phone number on a
 * Persian keyboard is told it is invalid. These filters convert the digits to
 * ASCII before WooCommerce validates and stores them; nothing else is changed.
 *
 * Display is unaffected: the bundled "Vazirmatn FD" face draws ASCII digits
 * with Persian glyphs, so prices and numbers still read as Persian.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

/**
 * Convert Persian and Arabic-Indic digits to ASCII digits.
 *
 * @param string $value Input.
 * @return string
 */
function sofreh_normalize_digits( $value ) {
	if ( ! is_string( $value ) || '' === $value ) {
		return $value;
	}
	static $map = null;
	if ( null === $map ) {
		$map = array();
		for ( $i = 0; $i <= 9; $i++ ) {
			$map[ html_entity_decode( '&#' . ( 0x06F0 + $i ) . ';', ENT_QUOTES, 'UTF-8' ) ] = (string) $i; // Persian.
			$map[ html_entity_decode( '&#' . ( 0x0660 + $i ) . ';', ENT_QUOTES, 'UTF-8' ) ] = (string) $i; // Arabic-Indic.
		}
	}
	return strtr( $value, $map );
}

/**
 * Whether a field key holds a phone number or postcode.
 *
 * @param string $key Field key, e.g. billing_phone.
 * @return bool
 */
function sofreh_is_numeric_field( $key ) {
	return (bool) preg_match( '/(^|_)(phone|postcode)$/', (string) $key );
}

/**
 * Classic checkout: normalize before WooCommerce validates the posted data.
 *
 * @param array $data Posted checkout data.
 * @return array
 */
function sofreh_normalize_checkout_posted_data( $data ) {
	foreach ( $data as $key => $value ) {
		if ( sofreh_is_numeric_field( $key ) && is_string( $value ) ) {
			$data[ $key ] = sofreh_normalize_digits( $value );
		}
	}
	return $data;
}
add_filter( 'woocommerce_checkout_posted_data', 'sofreh_normalize_checkout_posted_data' );

/**
 * My Account → Addresses form: WooCommerce reads these fields straight from
 * $_POST, so normalize them there before its form handler runs (priority 20
 * on template_redirect).
 */
function sofreh_normalize_account_address_post() {
	// phpcs:disable WordPress.Security.NonceVerification.Missing -- WooCommerce verifies the nonce in its own handler; this only rewrites digits.
	if ( empty( $_POST['action'] ) || 'edit_address' !== $_POST['action'] ) {
		return;
	}
	foreach ( $_POST as $key => $value ) {
		if ( sofreh_is_numeric_field( $key ) && is_string( $value ) ) {
			$_POST[ $key ] = sofreh_normalize_digits( wp_unslash( $value ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- WooCommerce sanitizes these fields itself.
		}
	}
	// phpcs:enable
}
add_action( 'template_redirect', 'sofreh_normalize_account_address_post', 5 );

/**
 * Block checkout (Store API): normalize address phone and postcode before the
 * request is validated. Runs for batched requests too, since each one is
 * dispatched individually.
 *
 * @param mixed           $result  Short-circuit value; passed through.
 * @param WP_REST_Server  $server  Server.
 * @param WP_REST_Request $request Request.
 * @return mixed
 */
function sofreh_normalize_store_api_request( $result, $server, $request ) {
	if ( 0 !== strpos( $request->get_route(), '/wc/store/' ) ) {
		return $result;
	}
	foreach ( array( 'billing_address', 'shipping_address' ) as $param ) {
		$address = $request->get_param( $param );
		if ( ! is_array( $address ) ) {
			continue;
		}
		foreach ( array( 'phone', 'postcode' ) as $field ) {
			if ( isset( $address[ $field ] ) && is_string( $address[ $field ] ) ) {
				$address[ $field ] = sofreh_normalize_digits( $address[ $field ] );
			}
		}
		$request->set_param( $param, $address );
	}
	return $result;
}
add_filter( 'rest_pre_dispatch', 'sofreh_normalize_store_api_request', 10, 3 );
```

### sofreh/inc/setup.php

```php
<?php
/**
 * Theme supports, menus, widget areas.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

if ( ! isset( $content_width ) ) {
	$content_width = 760; // Matches settings.layout.contentSize in theme.json.
}

/**
 * Register theme features.
 */
function sofreh_setup() {
	load_theme_textdomain( 'sofreh', SOFREH_DIR . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 96,
			'width'       => 280,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'fbf8f3',
		)
	);

	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor.css' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary menu', 'sofreh' ),
			'footer'  => __( 'Footer menu', 'sofreh' ),
		)
	);

	// WooCommerce: declare support and the image sizes this layout is drawn for.
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width'         => 520,
			'single_image_width'            => 800,
			'gallery_thumbnail_image_width' => 160,
			'product_grid'                  => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'max_rows'        => 8,
				'default_columns' => 4,
				'min_columns'     => 2,
				'max_columns'     => 5,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'sofreh_setup' );

/**
 * Widget areas.
 */
function sofreh_widgets_init() {
	$shared = array(
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	);

	register_sidebar(
		array_merge(
			$shared,
			array(
				'id'          => 'sidebar-1', // Core's conventional ID: WordPress's default widgets land here, not in the shop filters.
				'name'        => __( 'Blog sidebar', 'sofreh' ),
				'description' => __( 'Shown beside blog posts and archives.', 'sofreh' ),
			)
		)
	);

	register_sidebar(
		array_merge(
			$shared,
			array(
				'id'          => 'shop-sidebar',
				'name'        => __( 'Shop filters', 'sofreh' ),
				'description' => __( 'Shown beside product listings (shop, categories, tags, product search). If empty, a product category list is shown instead.', 'sofreh' ),
			)
		)
	);

	for ( $i = 1; $i <= 3; $i++ ) {
		register_sidebar(
			array_merge(
				$shared,
				array(
					'id'           => 'footer-' . $i,
					/* translators: %d: footer column number. */
					'name'         => sprintf( __( 'Footer column %d', 'sofreh' ), $i ),
					'description'  => __( 'Use this for links, contact details or trust badges (for example an e-Namad badge via a Custom HTML widget).', 'sofreh' ),
					'before_title' => '<h2 class="footer-title">',
					'after_title'  => '</h2>',
				)
			)
		);
	}
}
add_action( 'widgets_init', 'sofreh_widgets_init' );

/**
 * Add useful body classes.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function sofreh_body_classes( $classes ) {
	if ( is_active_sidebar( 'sidebar-1' ) && ( is_home() || is_singular( 'post' ) || is_archive() ) && ! ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) ) {
		$classes[] = 'has-blog-sidebar';
	}
	return $classes;
}
add_filter( 'body_class', 'sofreh_body_classes' );
```

### sofreh/inc/template-tags.php

```php
<?php
/**
 * Small template helpers.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

/**
 * Product categories to feature in navigation and on the home page.
 *
 * Read from the store, never hard-coded: the merchant's own categories appear
 * as soon as they contain products. WooCommerce's default "Uncategorized"
 * bucket is left out.
 *
 * @param int $parent_id Parent term ID (0 for top level).
 * @param int $number Maximum number of terms (0 for all).
 * @return WP_Term[]
 */
function sofreh_get_product_categories( $parent_id = 0, $number = 0 ) {
	if ( ! taxonomy_exists( 'product_cat' ) ) {
		return array();
	}

	$terms = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'parent'     => absint( $parent_id ),
			'hide_empty' => true,
			'number'     => absint( $number ),
			'exclude'    => array( absint( get_option( 'default_product_cat', 0 ) ) ),
			'orderby'    => 'menu_order', // WooCommerce resolves this to its drag-and-drop category order.
		)
	);

	return is_wp_error( $terms ) ? array() : $terms;
}

/**
 * Fallback for the primary menu before the merchant has built one: a link to
 * the shop followed by the top-level product categories.
 *
 * @param array $args wp_nav_menu() arguments.
 */
function sofreh_primary_menu_fallback( $args ) {
	$items = array();

	if ( function_exists( 'wc_get_page_permalink' ) ) {
		$items[] = sprintf(
			'<li class="menu-item"><a href="%1$s">%2$s</a></li>',
			esc_url( wc_get_page_permalink( 'shop' ) ),
			esc_html__( 'All products', 'sofreh' )
		);

		foreach ( sofreh_get_product_categories( 0, 7 ) as $term ) {
			$link = get_term_link( $term );
			if ( is_wp_error( $link ) ) {
				continue;
			}
			$items[] = sprintf(
				'<li class="menu-item"><a href="%1$s">%2$s</a></li>',
				esc_url( $link ),
				esc_html( $term->name )
			);
		}
	} else {
		$items[] = sprintf(
			'<li class="menu-item"><a href="%1$s">%2$s</a></li>',
			esc_url( home_url( '/' ) ),
			esc_html__( 'Home', 'sofreh' )
		);
		foreach ( get_pages(
			array(
				'parent'      => 0,
				'number'      => 6,
				'sort_column' => 'menu_order',
			)
		) as $page ) {
			$items[] = sprintf(
				'<li class="menu-item"><a href="%1$s">%2$s</a></li>',
				esc_url( get_permalink( $page ) ),
				esc_html( get_the_title( $page ) )
			);
		}
	}

	printf(
		'<ul id="%1$s" class="%2$s">%3$s</ul>',
		esc_attr( $args['menu_id'] ),
		esc_attr( $args['menu_class'] ),
		wp_kses_post( implode( '', $items ) ) // Items are escaped as they are built; this keeps the output provably safe.
	);
}

/**
 * Post date and author line.
 */
function sofreh_posted_on() {
	printf(
		'<p class="entry-meta"><time datetime="%1$s">%2$s</time><span aria-hidden="true"> · </span><span class="author">%3$s</span></p>',
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_html( get_the_author() )
	);
}

/**
 * Numbered pagination for post lists.
 */
function sofreh_posts_pagination() {
	the_posts_pagination(
		array(
			'mid_size'           => 1,
			'prev_text'          => esc_html__( 'Previous', 'sofreh' ),
			'next_text'          => esc_html__( 'Next', 'sofreh' ),
			'screen_reader_text' => esc_html__( 'Posts navigation', 'sofreh' ),
		)
	);
}

/**
 * Initial letter of a name, used when a category has no image.
 *
 * @param string $name Name.
 * @return string
 */
function sofreh_initial( $name ) {
	$name = trim( wp_strip_all_tags( $name ) );
	return function_exists( 'mb_substr' ) ? mb_substr( $name, 0, 1 ) : substr( $name, 0, 1 );
}

/**
 * Product category tree for the desktop category menu ('mega') and the
 * mobile drawer ('drawer'). Built from the store's own categories: top
 * level as headings, their sub-categories beneath.
 *
 * The drawer uses native <details> disclosure, so it works without scripts.
 *
 * @param string $context 'mega' or 'drawer'.
 */
function sofreh_category_tree( $context = 'mega' ) {
	$parents = sofreh_get_product_categories( 0, 12 );
	if ( empty( $parents ) ) {
		return;
	}

	if ( 'mega' === $context ) {
		echo '<div class="mega__grid">';
		foreach ( $parents as $parent ) {
			$link = get_term_link( $parent );
			if ( is_wp_error( $link ) ) {
				continue;
			}
			echo '<div class="mega__col">';
			printf( '<a class="mega__parent" href="%1$s">%2$s %3$s</a>', esc_url( $link ), esc_html( $parent->name ), sofreh_get_icon( 'chevron', 14 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Fixed SVG string.
			$children = sofreh_get_product_categories( $parent->term_id, 8 );
			if ( $children ) {
				echo '<ul>';
				foreach ( $children as $child ) {
					$child_link = get_term_link( $child );
					if ( ! is_wp_error( $child_link ) ) {
						printf( '<li><a href="%1$s">%2$s</a></li>', esc_url( $child_link ), esc_html( $child->name ) );
					}
				}
				echo '</ul>';
			}
			echo '</div>';
		}
		echo '</div>';
		return;
	}

	echo '<ul class="cat-tree">';
	foreach ( $parents as $parent ) {
		$link = get_term_link( $parent );
		if ( is_wp_error( $link ) ) {
			continue;
		}
		$children = sofreh_get_product_categories( $parent->term_id, 12 );
		if ( ! $children ) {
			printf( '<li><a class="cat-tree__link" href="%1$s">%2$s</a></li>', esc_url( $link ), esc_html( $parent->name ) );
			continue;
		}
		echo '<li><details class="cat-tree__group"><summary>' . esc_html( $parent->name ) . sofreh_get_icon( 'down', 18 ) . '</summary><ul>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Fixed SVG string.
		printf(
			'<li><a class="cat-tree__all" href="%1$s">%2$s</a></li>',
			esc_url( $link ),
			/* translators: %s: category name. */
			esc_html( sprintf( __( 'All of %s', 'sofreh' ), $parent->name ) )
		);
		foreach ( $children as $child ) {
			$child_link = get_term_link( $child );
			if ( ! is_wp_error( $child_link ) ) {
				printf( '<li><a href="%1$s">%2$s</a></li>', esc_url( $child_link ), esc_html( $child->name ) );
			}
		}
		echo '</ul></details></li>';
	}
	echo '</ul>';
}
```

### sofreh/inc/woocommerce.php

```php
<?php
/**
 * WooCommerce integration.
 *
 * Integration is done entirely through WooCommerce's documented hooks and
 * filters. The theme ships no files under /woocommerce, so there are no
 * template overrides to fall out of date when WooCommerce updates.
 *
 * Loaded from functions.php only while WooCommerce is active.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

/*
 * -------------------------------------------------------------------------
 * Assets
 * -------------------------------------------------------------------------
 */

// The theme styles every WooCommerce element itself (assets/css/woocommerce.css).
// Block styles (Cart, Checkout and other WooCommerce blocks) are untouched.
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Keep the header cart count in sync after cart changes and on cached pages.
 * Since WooCommerce 7.8 the fragments script is only enqueued on demand, and
 * the header cart link needs it on every page.
 */
function sofreh_wc_scripts() {
	wp_enqueue_script( 'wc-cart-fragments' );
}
add_action( 'wp_enqueue_scripts', 'sofreh_wc_scripts', 20 );

/*
 * -------------------------------------------------------------------------
 * Layout wrappers
 * -------------------------------------------------------------------------
 */

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/**
 * Whether the current view is a product listing (shop, category, tag,
 * attribute or product search).
 *
 * @return bool
 */
function sofreh_wc_is_listing() {
	return is_shop() || is_product_taxonomy();
}

/**
 * Open the theme wrapper around WooCommerce content.
 */
function sofreh_wc_wrapper_start() {
	$classes = array( 'container', 'store-layout' );
	if ( sofreh_wc_is_listing() ) {
		$classes[] = 'store-layout--listing';
	}
	if ( is_product() ) {
		$classes[] = 'store-layout--product';
	}
	echo '<div class="' . esc_attr( implode( ' ', $classes ) ) . '">';
	echo '<main id="main" class="site-main">';
}
add_action( 'woocommerce_before_main_content', 'sofreh_wc_wrapper_start', 10 );

/**
 * Close the wrapper; product listings get the filter sidebar beside them.
 */
function sofreh_wc_wrapper_end() {
	echo '</main>';
	if ( sofreh_wc_is_listing() ) {
		sofreh_wc_filters_panel();
	}
	echo '</div>';
}
add_action( 'woocommerce_after_main_content', 'sofreh_wc_wrapper_end', 10 );

/**
 * The filters panel: a sidebar on wide screens, a dialog-like drawer on
 * small ones (opened by the "Filters" button in the shop toolbar).
 */
function sofreh_wc_filters_panel() {
	?>
	<aside id="shop-filters" class="shop-filters" aria-labelledby="shop-filters-title">
		<div class="shop-filters__head">
			<h2 id="shop-filters-title" class="shop-filters__title"><?php esc_html_e( 'Filter products', 'sofreh' ); ?></h2>
			<button type="button" class="icon-button shop-filters__close" data-sofreh-close="shop-filters">
				<?php sofreh_icon( 'close' ); ?>
				<span class="screen-reader-text"><?php esc_html_e( 'Close filters', 'sofreh' ); ?></span>
			</button>
		</div>
		<div class="shop-filters__body">
			<?php
			if ( is_active_sidebar( 'shop-sidebar' ) ) {
				dynamic_sidebar( 'shop-sidebar' );
			} else {
				the_widget(
					'WC_Widget_Product_Categories',
					array(
						'title'              => __( 'Product categories', 'sofreh' ),
						'hierarchical'       => 1,
						'count'              => 1,
						'show_children_only' => 0,
						'hide_empty'         => 1,
					),
					array(
						'before_widget' => '<section class="widget woocommerce widget_product_categories">',
						'after_widget'  => '</section>',
						'before_title'  => '<h2 class="widget-title">',
						'after_title'   => '</h2>',
					)
				);
			}
			?>
		</div>
	</aside>
	<?php
}

/*
 * -------------------------------------------------------------------------
 * Breadcrumb
 * -------------------------------------------------------------------------
 */

/**
 * Breadcrumb markup: an accessible nav with a direction-aware chevron.
 *
 * @param array $defaults Defaults.
 * @return array
 */
function sofreh_wc_breadcrumb_defaults( $defaults ) {
	$defaults['delimiter']   = '<span class="breadcrumb-sep" aria-hidden="true">' . sofreh_get_icon( 'chevron', 14 ) . '</span>';
	$defaults['wrap_before'] = '<nav class="woocommerce-breadcrumb breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', 'sofreh' ) . '">';
	$defaults['wrap_after']  = '</nav>';
	$defaults['home']        = __( 'Home', 'sofreh' );
	return $defaults;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'sofreh_wc_breadcrumb_defaults' );

/*
 * -------------------------------------------------------------------------
 * Product listings
 * -------------------------------------------------------------------------
 */

/**
 * Child-category chips under the archive title, so shoppers can narrow down
 * without opening the filters. On the main shop page these are the top-level
 * categories. Skipped when WooCommerce is already set to show category tiles.
 */
function sofreh_wc_category_chips() {
	if ( is_search() || 'products' !== woocommerce_get_loop_display_mode() ) {
		return;
	}

	if ( is_shop() ) {
		$terms = sofreh_get_product_categories( 0 );
	} elseif ( is_product_category() ) {
		$terms = sofreh_get_product_categories( get_queried_object_id() );
	} else {
		return;
	}

	if ( empty( $terms ) ) {
		return;
	}

	echo '<nav class="category-chips" aria-label="' . esc_attr__( 'Categories', 'sofreh' ) . '"><ul>';
	foreach ( $terms as $term ) {
		$link = get_term_link( $term );
		if ( is_wp_error( $link ) ) {
			continue;
		}
		printf(
			'<li><a class="chip" href="%1$s">%2$s <span class="chip__count">%3$s</span></a></li>',
			esc_url( $link ),
			esc_html( $term->name ),
			esc_html( number_format_i18n( $term->count ) )
		);
	}
	echo '</ul></nav>';
}
add_action( 'woocommerce_archive_description', 'sofreh_wc_category_chips', 20 );

/**
 * Toolbar row: filter button, result count and sorting, grouped for layout.
 */
function sofreh_wc_toolbar_open() {
	echo '<div class="shop-toolbar">';
	if ( sofreh_wc_is_listing() ) {
		?>
		<button type="button" class="button button--ghost shop-toolbar__filters" aria-controls="shop-filters" aria-expanded="false" data-sofreh-open="shop-filters">
			<?php sofreh_icon( 'filter', 20 ); ?>
			<span><?php esc_html_e( 'Filters', 'sofreh' ); ?></span>
		</button>
		<?php
	}
}
add_action( 'woocommerce_before_shop_loop', 'sofreh_wc_toolbar_open', 15 );

/**
 * Close the toolbar row.
 */
function sofreh_wc_toolbar_close() {
	echo '</div>';
}
add_action( 'woocommerce_before_shop_loop', 'sofreh_wc_toolbar_close', 35 );

/**
 * Sort options as a row of links on wide screens, the way marketplace
 * listings present them. WooCommerce's own select stays for phones, where the
 * native picker is the better control. Both use WooCommerce's orderby values.
 */
function sofreh_wc_sort_links() {
	if ( ! woocommerce_products_will_display() || 1 >= (int) wc_get_loop_prop( 'total' ) ) {
		return;
	}
	$show_default = wc_get_loop_prop( 'is_search' ) ? 'relevance' : 'menu_order';
	/** This filter is documented in woocommerce/includes/wc-template-functions.php */
	$default = apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', $show_default ) );
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only sort parameter, same as WooCommerce's ordering form.
	$current = isset( $_GET['orderby'] ) ? sanitize_key( wp_unslash( $_GET['orderby'] ) ) : $default;
	$options = array(
		'menu_order' => __( 'Default', 'sofreh' ),
		'popularity' => __( 'Best selling', 'sofreh' ),
		'rating'     => __( 'Top rated', 'sofreh' ),
		'date'       => __( 'Newest', 'sofreh' ),
		'price'      => __( 'Cheapest', 'sofreh' ),
		'price-desc' => __( 'Most expensive', 'sofreh' ),
	);
	if ( wc_get_loop_prop( 'is_search' ) ) {
		$options = array_merge( array( 'relevance' => __( 'Most relevant', 'sofreh' ) ), $options );
		unset( $options['menu_order'] );
	}
	if ( ! wc_review_ratings_enabled() ) {
		unset( $options['rating'] );
	}
	$base = get_pagenum_link( 1, false );
	echo '<nav class="sort-links" aria-label="' . esc_attr__( 'Sort products', 'sofreh' ) . '">';
	echo '<span class="sort-links__label">' . sofreh_get_icon( 'filter', 18 ) . esc_html__( 'Sort by:', 'sofreh' ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Fixed SVG string.
	foreach ( $options as $id => $label ) {
		printf(
			'<a href="%1$s"%2$s>%3$s</a>',
			esc_url( add_query_arg( 'orderby', $id, $base ) ),
			$id === $current ? ' class="is-current" aria-current="true"' : '',
			esc_html( $label )
		);
	}
	echo '</nav>';
}
add_action( 'woocommerce_before_shop_loop', 'sofreh_wc_sort_links', 25 );

/**
 * Product card: wrap image and badges in a media frame.
 */
function sofreh_wc_card_media_open() {
	echo '<div class="product-card__media">';
}
add_action( 'woocommerce_before_shop_loop_item_title', 'sofreh_wc_card_media_open', 9 );

/**
 * Out-of-stock badge on cards.
 */
function sofreh_wc_card_stock_badge() {
	global $product;
	if ( $product instanceof WC_Product && ! $product->is_in_stock() ) {
		echo '<span class="badge badge--soldout">' . esc_html__( 'Out of stock', 'sofreh' ) . '</span>';
	}
}
add_action( 'woocommerce_before_shop_loop_item_title', 'sofreh_wc_card_stock_badge', 10 );

/**
 * Close the media frame.
 */
function sofreh_wc_card_media_close() {
	echo '</div>';
}
add_action( 'woocommerce_before_shop_loop_item_title', 'sofreh_wc_card_media_close', 11 );

/*
 * The discount badge sits beside the price, as on Iranian marketplaces,
 * instead of over the product photo: one price row of badge, price and old
 * price, with WooCommerce's own badge and price output inside it.
 */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

/**
 * Open the card's price row and print the discount badge.
 */
function sofreh_wc_card_price_open() {
	echo '<div class="product-card__price">';
	woocommerce_show_product_loop_sale_flash();
}
add_action( 'woocommerce_after_shop_loop_item_title', 'sofreh_wc_card_price_open', 9 );

/**
 * Close the card's price row.
 */
function sofreh_wc_card_price_close() {
	echo '</div>';
}
add_action( 'woocommerce_after_shop_loop_item_title', 'sofreh_wc_card_price_close', 11 );


/**
 * Sale badge shows the discount ("20% off") when it can be computed.
 *
 * @param string     $html    Default badge.
 * @param WP_Post    $post    Post.
 * @param WC_Product $product Product.
 * @return string
 */
function sofreh_wc_sale_flash( $html, $post, $product ) {
	$percent = 0;

	if ( $product instanceof WC_Product_Variable ) {
		$prices = $product->get_variation_prices();
		foreach ( $prices['regular_price'] as $id => $regular ) {
			$sale = isset( $prices['sale_price'][ $id ] ) ? (float) $prices['sale_price'][ $id ] : 0;
			if ( (float) $regular > 0 && $sale < (float) $regular ) {
				$percent = max( $percent, ( (float) $regular - $sale ) / (float) $regular * 100 );
			}
		}
	} elseif ( $product instanceof WC_Product && ! $product->is_type( 'grouped' ) ) {
		$regular = (float) $product->get_regular_price();
		$sale    = (float) $product->get_sale_price();
		if ( $regular > 0 && $sale < $regular ) {
			$percent = ( $regular - $sale ) / $regular * 100;
		}
	}

	$percent = (int) round( $percent );
	if ( $percent < 1 ) {
		return '<span class="onsale">' . esc_html__( 'Sale', 'sofreh' ) . '</span>';
	}

	// Short "20%" pill beside the price; screen readers hear "20% off".
	return sprintf(
		'<span class="onsale"><span aria-hidden="true">%1$s</span><span class="screen-reader-text">%2$s</span></span>',
		esc_html(
			/* translators: %s: discount percentage, e.g. 20. Shown in a small badge. */
			sprintf( __( '%s%%', 'sofreh' ), number_format_i18n( $percent ) )
		),
		esc_html(
			/* translators: %s: discount percentage, e.g. 20. */
			sprintf( __( '%s%% off', 'sofreh' ), number_format_i18n( $percent ) )
		)
	);
}
add_filter( 'woocommerce_sale_flash', 'sofreh_wc_sale_flash', 10, 3 );

/**
 * Escape product price HTML for output while keeping WooCommerce's <bdi>
 * wrapper. wp_kses_post() strips <bdi>; without that isolation the currency
 * name lands on the wrong side of the amount in right-to-left text.
 *
 * @param string $html Price HTML from WC_Product::get_price_html().
 * @return string
 */
function sofreh_kses_price( $html ) {
	$allowed                      = wp_kses_allowed_html( 'post' );
	$allowed['bdi']               = array();
	$allowed['span']['translate'] = true;
	return wp_kses( $html, $allowed );
}

/**
 * Variable products whose options cost different amounts show "From <lowest
 * price>" instead of a two-price range, which wraps badly in narrow product
 * cards and on phones. The chosen option's own price still appears as soon as
 * the customer picks it (WooCommerce's variation price).
 *
 * @param string              $price   Price HTML.
 * @param WC_Product_Variable $product Product.
 * @return string
 */
function sofreh_wc_variable_price_html( $price, $product ) {
	if ( is_admin() && ! wp_doing_ajax() ) {
		return $price;
	}
	$prices = $product->get_variation_prices( true );
	if ( empty( $prices['price'] ) ) {
		return $price;
	}
	$min = current( $prices['price'] );
	$max = end( $prices['price'] );
	if ( $min === $max ) {
		return $price;
	}
	return '<span class="price-from">' . sprintf(
		/* translators: %s: lowest price of the product's options. */
		esc_html__( 'From %s', 'sofreh' ),
		wc_price( $min )
	) . '</span>' . $product->get_price_suffix();
}
add_filter( 'woocommerce_variable_price_html', 'sofreh_wc_variable_price_html', 10, 2 );

/*
 * -------------------------------------------------------------------------
 * Single product
 * -------------------------------------------------------------------------
 */

// The price and discount badge move into the buy box, next to the add-to-cart form.
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

/**
 * Open the buy box: price, stock, quantity and add to cart, the store note.
 */
function sofreh_wc_buy_box_open() {
	echo '<div class="buy-box" id="buy-box"><div class="buy-box__price">';
	woocommerce_show_product_sale_flash();
	woocommerce_template_single_price();
	echo '</div>';
}
add_action( 'woocommerce_single_product_summary', 'sofreh_wc_buy_box_open', 25 );

/**
 * Close the buy box.
 */
function sofreh_wc_buy_box_close() {
	echo '</div>';
}
add_action( 'woocommerce_single_product_summary', 'sofreh_wc_buy_box_close', 36 );

/**
 * Phones: a bar fixed above the tab bar with the price and the add-to-cart
 * action, shown once the buy box has scrolled out of view. Its button
 * presses the real add-to-cart button (or scrolls to the options for
 * products that need a choice first), so WooCommerce's own form handles it.
 */
function sofreh_wc_sticky_buy_bar() {
	global $product;
	if ( ! $product instanceof WC_Product || ! $product->is_purchasable() || ! $product->is_in_stock() ) {
		return;
	}
	$needs_choice = $product->is_type( 'variable' ) || $product->is_type( 'grouped' );
	?>
	<div class="buy-bar" hidden data-sofreh-buybar>
		<div class="buy-bar__price"><?php echo sofreh_kses_price( $product->get_price_html() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped by sofreh_kses_price(). ?></div>
		<button type="button" class="button buy-bar__button" data-sofreh-buy="<?php echo $needs_choice ? 'choose' : 'add'; ?>">
			<?php echo $needs_choice ? esc_html__( 'Choose options', 'sofreh' ) : esc_html__( 'Add to cart', 'sofreh' ); ?>
		</button>
	</div>
	<?php
}
add_action( 'woocommerce_after_single_product', 'sofreh_wc_sticky_buy_bar' );

/**
 * Store note (shipping/returns) under the add-to-cart form.
 */
function sofreh_wc_product_note() {
	$note = sofreh_option( 'product_note' );
	if ( '' === trim( (string) $note ) ) {
		return;
	}
	echo '<div class="product-note">' . sofreh_get_icon( 'truck', 22 ) . '<p>' . nl2br( esc_html( $note ) ) . '</p></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Icon markup is a fixed string.
}
add_action( 'woocommerce_single_product_summary', 'sofreh_wc_product_note', 35 );

/**
 * Classic checkout: WooCommerce's section titles are h3s directly under the
 * page's h1. A visually hidden h2 keeps the heading outline in order for
 * screen readers without overriding the checkout template.
 */
function sofreh_wc_checkout_heading() {
	echo '<h2 class="screen-reader-text">' . esc_html__( 'Your details', 'sofreh' ) . '</h2>';
}
add_action( 'woocommerce_checkout_before_customer_details', 'sofreh_wc_checkout_heading' );

/**
 * Related products: one row of four.
 *
 * @param array $args Args.
 * @return array
 */
function sofreh_wc_related_args( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns']        = 4;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'sofreh_wc_related_args' );

/**
 * Upsells: one row of four.
 *
 * @param array $args Args.
 * @return array
 */
function sofreh_wc_upsell_args( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns']        = 4;
	return $args;
}
add_filter( 'woocommerce_upsell_display_args', 'sofreh_wc_upsell_args' );

add_filter(
	'woocommerce_cross_sells_columns',
	function () {
		return 2;
	}
);
add_filter(
	'woocommerce_cross_sells_total',
	function () {
		return 2;
	}
);

/*
 * -------------------------------------------------------------------------
 * Header: product search and cart link
 * -------------------------------------------------------------------------
 */

/**
 * Product search form (see searchform.php).
 *
 * @param string $aria_label Accessible name of the search landmark; pages
 *                           with a second search form pass a distinct one.
 */
function sofreh_product_search_form( $aria_label = '' ) {
	get_search_form(
		array(
			'sofreh_product' => true,
			'aria_label'     => $aria_label,
		)
	);
}

/**
 * Cart link markup, for the header or the mobile tab bar. Both are returned
 * as AJAX fragments, so they update after add to cart and cart changes.
 *
 * @param string $context 'header' or 'tabbar'.
 * @return string
 */
function sofreh_get_cart_link( $context = 'header' ) {
	$count = ( WC()->cart ) ? WC()->cart->get_cart_contents_count() : 0;
	$label = sprintf(
		/* translators: %s: number of items in the cart. */
		_n( 'Cart, %s item', 'Cart, %s items', $count, 'sofreh' ),
		number_format_i18n( $count )
	);
	$badge   = sprintf(
		'<span class="cart-count%1$s" aria-hidden="true">%2$s</span>',
		$count ? '' : ' is-empty',
		esc_html( number_format_i18n( $count ) )
	);
	$current = is_cart() ? ' aria-current="page"' : '';

	if ( 'tabbar' === $context ) {
		return sprintf(
			'<a class="tabbar__item tabbar-cart%1$s" href="%2$s"%3$s><span class="tabbar__icon">%4$s%5$s</span><span aria-hidden="true">%6$s</span><span class="screen-reader-text">%7$s</span></a>',
			is_cart() ? ' is-current' : '',
			esc_url( wc_get_cart_url() ),
			$current,
			sofreh_get_icon( 'bag', 24 ),
			$badge,
			esc_html__( 'Cart', 'sofreh' ),
			esc_html( $label )
		);
	}

	return sprintf(
		'<a class="header-action header-cart" href="%1$s"%2$s>%3$s%4$s<span class="screen-reader-text">%5$s</span></a>',
		esc_url( wc_get_cart_url() ),
		$current,
		sofreh_get_icon( 'bag' ),
		$badge,
		esc_html( $label )
	);
}

/**
 * Replace both cart links after AJAX add-to-cart / cart updates.
 *
 * @param array $fragments Fragments.
 * @return array
 */
function sofreh_wc_cart_fragment( $fragments ) {
	$fragments['a.header-cart'] = sofreh_get_cart_link( 'header' );
	$fragments['a.tabbar-cart'] = sofreh_get_cart_link( 'tabbar' );
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'sofreh_wc_cart_fragment' );

/**
 * Header account link: "Log in | Create account" for visitors, "My account" after.
 */
function sofreh_account_link() {
	if ( is_user_logged_in() ) {
		printf(
			'<a class="header-action header-account" href="%1$s">%2$s<span class="header-action__label">%3$s</span></a>',
			esc_url( wc_get_page_permalink( 'myaccount' ) ),
			sofreh_get_icon( 'user' ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Fixed SVG string.
			esc_html__( 'My account', 'sofreh' )
		);
		return;
	}
	printf(
		'<a class="header-action header-account header-account--guest" href="%1$s">%2$s<span class="header-action__label">%3$s</span></a>',
		esc_url( wc_get_page_permalink( 'myaccount' ) ),
		sofreh_get_icon( 'user' ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Fixed SVG string.
		esc_html__( 'Log in | Create account', 'sofreh' )
	);
}

/*
 * -------------------------------------------------------------------------
 * Log in / Create account
 * -------------------------------------------------------------------------
 */

/**
 * Is sign-up offered on the My Account page?
 *
 * @return bool
 */
function sofreh_wc_registration_open() {
	return 'yes' === get_option( 'woocommerce_enable_myaccount_registration' );
}

/**
 * Tabs over WooCommerce's own login and sign-up forms: «ورود» and
 * «ساخت حساب». The script moves them into the panel and shows one form at a
 * time; without it both forms stay visible side by side.
 */
function sofreh_wc_auth_tabs() {
	if ( ! sofreh_wc_registration_open() || is_checkout() ) {
		return;
	}
	// phpcs:disable WordPress.Security.NonceVerification -- Only chooses which tab opens first.
	$initial = ( isset( $_POST['register'] ) || ( isset( $_GET['action'] ) && 'register' === $_GET['action'] ) ) ? 'register' : 'login';
	// phpcs:enable
	?>
	<div class="auth-tabs" role="tablist" aria-label="<?php esc_attr_e( 'Your account', 'sofreh' ); ?>" data-sofreh-auth-tabs data-initial="<?php echo esc_attr( $initial ); ?>" hidden>
		<button type="button" class="auth-tabs__tab" role="tab" id="auth-tab-login" data-tab="login"><?php esc_html_e( 'Log in', 'sofreh' ); ?></button>
		<button type="button" class="auth-tabs__tab" role="tab" id="auth-tab-register" data-tab="register"><?php esc_html_e( 'Create account', 'sofreh' ); ?></button>
	</div>
	<?php
}
add_action( 'woocommerce_before_customer_login_form', 'sofreh_wc_auth_tabs' );

/**
 * "No account yet? Create account" under the login form, and the way back
 * under the sign-up form.
 */
function sofreh_wc_auth_switch_to_register() {
	if ( ! sofreh_wc_registration_open() || is_checkout() ) {
		return;
	}
	printf(
		'<p class="auth-switch">%1$s <a href="%2$s" data-sofreh-auth-switch="register">%3$s</a></p>',
		esc_html__( 'No account yet?', 'sofreh' ),
		esc_url( add_query_arg( 'action', 'register' ) ),
		esc_html__( 'Create account', 'sofreh' )
	);
}
add_action( 'woocommerce_login_form_end', 'sofreh_wc_auth_switch_to_register', 20 );

/**
 * "Already have an account? Log in" under the sign-up form.
 */
function sofreh_wc_auth_switch_to_login() {
	if ( is_checkout() ) {
		return;
	}
	printf(
		'<p class="auth-switch">%1$s <a href="%2$s" data-sofreh-auth-switch="login">%3$s</a></p>',
		esc_html__( 'Already have an account?', 'sofreh' ),
		esc_url( remove_query_arg( 'action' ) ),
		esc_html__( 'Log in', 'sofreh' )
	);
}
add_action( 'woocommerce_register_form_end', 'sofreh_wc_auth_switch_to_login', 20 );
```

### sofreh/languages/fa_IR.po

```po
# Persian translation for the Sofreh theme.
# This file is distributed under the GNU General Public License v2 or later.
msgid ""
msgstr ""
"Project-Id-Version: Sofreh 2.1.0\n"
"Report-Msgid-Bugs-To: https://wordpress.org/support/theme/sofreh\n"
"Last-Translator: FULL NAME <EMAIL@ADDRESS>\n"
"Language-Team: Persian\n"
"Language: fa_IR\n"
"MIME-Version: 1.0\n"
"Content-Type: text/plain; charset=UTF-8\n"
"Content-Transfer-Encoding: 8bit\n"
"Plural-Forms: nplurals=2; plural=(n > 1);\n"
"POT-Creation-Date: 2026-10-12T18:33:25+00:00\n"
"PO-Revision-Date: 2026-10-12 12:00+0330\n"
"X-Generator: WP-CLI 2.12.0\n"
"X-Domain: sofreh\n"

#. Theme Name of the theme
#: style.css:2
msgid "Sofreh"
msgstr "سفره"

#. Theme URI of the theme
#: style.css:3
msgid "https://github.com/yns-nur/nur/tree/main/wp-theme/sofreh"
msgstr "https://github.com/yns-nur/nur/tree/main/wp-theme/sofreh"

#. Description of the theme
#: style.css:6
msgid "A Persian, right-to-left WooCommerce theme for home and kitchen stores, built phone-first in the familiar Iranian marketplace layout and its own lapis, saffron and plum palette: product search up front, a category mega menu and drawer, a swipeable banner, a special-offers band, a numbered best-seller list, a sticky buy box and buy bar on product pages, and a bottom tab bar on phones. Styles the classic and block cart, checkout and account pages. Ships with the Vazirmatn typeface and a full Persian (fa_IR) translation."
msgstr "پوسته‌ای فارسی و راست‌به‌چپ برای فروشگاه‌های ووکامرسی لوازم خانه و آشپزخانه، با اولویت موبایل، در چیدمان آشنای فروشگاه‌های اینترنتی ایرانی و با رنگ‌های خودش (لاجوردی، زعفرانی و آلویی): جست‌وجوی محصول در بالای صفحه، منوی دسته‌بندی‌ها و کشوی دسته‌ها، بنر قابل کشیدن، نوار پیشنهادهای ویژه، فهرست شماره‌دار پرفروش‌ترین‌ها، جعبهٔ خرید و نوار خرید چسبان در صفحهٔ محصول و نوار پایینی در موبایل. سبد خرید، تسویه حساب و حساب کاربری (کلاسیک و بلوکی) را هماهنگ می‌کند. همراه با قلم وزیرمتن و ترجمهٔ کامل فارسی."

#. Author of the theme
#: style.css:4
msgid "Younes Nur"
msgstr "یونس نور"

#. Author URI of the theme
#: style.css:5
msgid "https://github.com/yns-nur"
msgstr "https://github.com/yns-nur"

#: 404.php:15
msgid "This page could not be found"
msgstr "این صفحه پیدا نشد"

#: 404.php:16
msgid "The link may be broken or the page may have moved. Try a search, or start from one of the categories below."
msgstr "ممکن است پیوند خراب باشد یا صفحه جابه‌جا شده باشد. جستجو کنید یا از یکی از دسته‌های زیر شروع کنید."

#: 404.php:20
msgid "Search the store"
msgstr "جستجو در فروشگاه"

#. translators: %s: number of comments.
#: comments.php:21
#, php-format
msgid "%s comment"
msgid_plural "%s comments"
msgstr[0] "%s دیدگاه"
msgstr[1] "%s دیدگاه"

#: comments.php:40
msgid "Older comments"
msgstr "دیدگاه‌های قدیمی‌تر"

#: comments.php:41
msgid "Newer comments"
msgstr "دیدگاه‌های تازه‌تر"

#: comments.php:48
msgid "Comments are closed."
msgstr "امکان ثبت دیدگاه بسته شده است."

#: footer.php:19
msgid "Back to top"
msgstr "بازگشت به بالا"

#: footer.php:52
#: inc/setup.php:53
msgid "Footer menu"
msgstr "فهرست پانویس"

#: footer.php:53
msgid "Quick links"
msgstr "دسترسی سریع"

#: footer.php:74
msgid "Privacy policy"
msgstr "حریم خصوصی"

#. translators: 1: year, 2: site name.
#: footer.php:89
#, php-format
msgid "© %1$s %2$s. All rights reserved."
msgstr "© %1$s %2$s. همهٔ حقوق محفوظ است."

#: front-page.php:52
msgid "From the blog"
msgstr "از وبلاگ"

#: header.php:23
msgid "Skip to content"
msgstr "پرش به محتوا"

#: header.php:35
msgid "Open menu"
msgstr "باز کردن فهرست"

#: header.php:69
#: header.php:113
msgid "Main menu"
msgstr "فهرست اصلی"

#: header.php:75
#: header.php:109
#: inc/woocommerce.php:106
#: template-parts/content/category-links.php:15
msgid "Product categories"
msgstr "دسته‌بندی محصولات"

#: header.php:101
msgid "Menu"
msgstr "فهرست"

#: header.php:104
msgid "Close menu"
msgstr "بستن فهرست"

#: header.php:132
msgid "Shortcuts"
msgstr "دسترسی سریع"

#: header.php:134
#: inc/template-tags.php:71
#: inc/woocommerce.php:142
msgid "Home"
msgstr "خانه"

#: header.php:137
#: inc/woocommerce.php:175
msgid "Categories"
msgstr "دسته‌ها"

#: header.php:141
#: inc/woocommerce.php:605
msgid "My account"
msgstr "حساب من"

#: header.php:141
#: inc/woocommerce.php:646
#: inc/woocommerce.php:681
msgid "Log in"
msgstr "ورود"

#: inc/customizer.php:22
msgid "Refresh your kitchen"
msgstr "آشپزخانه‌ات را تازه کن"

#: inc/customizer.php:23
msgid "Cookware, tableware and home basics for every day."
msgstr "ظروف پخت‌وپز، سرو و لوازم ضروری خانه برای هر روز."

#: inc/customizer.php:24
msgid "See the products"
msgstr "دیدن محصولات"

#: inc/customizer.php:51
msgid "A store for home and kitchen goods."
msgstr "فروشگاه لوازم خانه و آشپزخانه."

#: inc/customizer.php:149
msgid "Sofreh theme"
msgstr "پوستهٔ سفره"

#: inc/customizer.php:155
msgid "Header"
msgstr "سربرگ"

#: inc/customizer.php:156
msgid "Home page"
msgstr "صفحهٔ اصلی"

#: inc/customizer.php:157
#: template-parts/home/trust.php:28
msgid "Store promises"
msgstr "تعهدهای فروشگاه"

#: inc/customizer.php:158
msgid "Product page"
msgstr "صفحهٔ محصول"

#: inc/customizer.php:159
msgid "Footer and contact"
msgstr "پانویس و تماس"

#: inc/customizer.php:193
msgid "Announcement bar text (leave empty to hide)"
msgstr "متن نوار اطلاع‌رسانی (برای پنهان شدن خالی بگذارید)"

#: inc/customizer.php:195
msgid "Show the banner"
msgstr "نمایش بنر"

#: inc/customizer.php:198
msgid "Lapis"
msgstr "لاجوردی"

#: inc/customizer.php:199
msgid "Plum"
msgstr "آلویی"

#: inc/customizer.php:200
msgid "Saffron"
msgstr "زعفرانی"

#. translators: %d: banner slide number.
#: inc/customizer.php:208
#, php-format
msgid "Banner %d"
msgstr "بنر %d"

#: inc/customizer.php:212
msgid "heading"
msgstr "عنوان"

#: inc/customizer.php:215
msgid "Leave empty to hide this slide."
msgstr "برای پنهان کردن این اسلاید خالی بگذارید."

#: inc/customizer.php:217
msgid "text"
msgstr "متن"

#: inc/customizer.php:218
msgid "button label"
msgstr "متن دکمه"

#: inc/customizer.php:219
msgid "link (empty = shop page)"
msgstr "پیوند (خالی = صفحهٔ فروشگاه)"

#: inc/customizer.php:220
msgid "background"
msgstr "رنگ پس‌زمینه"

#: inc/customizer.php:234
msgid "image"
msgstr "تصویر"

#: inc/customizer.php:235
msgid "A product photo on a plain or transparent background works best (about 800 × 800 pixels)."
msgstr "عکس محصول روی زمینهٔ ساده یا شفاف بهترین نتیجه را دارد (حدود ۸۰۰ × ۸۰۰ پیکسل)."

#: inc/customizer.php:243
msgid "Show product categories"
msgstr "نمایش دسته‌بندی محصولات"

#: inc/customizer.php:244
msgid "Show newest products"
msgstr "نمایش جدیدترین محصولات"

#: inc/customizer.php:245
msgid "Show products on sale"
msgstr "نمایش محصولات تخفیف‌دار"

#: inc/customizer.php:246
msgid "Show best sellers"
msgstr "نمایش پرفروش‌ترین‌ها"

#: inc/customizer.php:250
msgid "Products per home page section"
msgstr "تعداد محصول در هر بخش صفحهٔ اصلی"

#: inc/customizer.php:263
msgid "Show the promises strip on the home page"
msgstr "نمایش نوار تعهدها در صفحهٔ اصلی"

#: inc/customizer.php:264
msgid "Only state what your store actually offers. Leave a field empty to hide it."
msgstr "فقط چیزی را بنویسید که فروشگاه شما واقعاً ارائه می‌دهد. برای پنهان کردن هر مورد، آن را خالی بگذارید."

#: inc/customizer.php:266
msgid "Promise 1 (delivery)"
msgstr "تعهد ۱ (ارسال)"

#: inc/customizer.php:266
msgid "e.g. Delivery across the country"
msgstr "مثلاً ارسال به سراسر کشور"

#: inc/customizer.php:267
msgid "Promise 2 (payment)"
msgstr "تعهد ۲ (پرداخت)"

#: inc/customizer.php:267
msgid "e.g. Pay on delivery"
msgstr "مثلاً پرداخت در محل"

#: inc/customizer.php:268
msgid "Promise 3 (returns)"
msgstr "تعهد ۳ (بازگشت کالا)"

#: inc/customizer.php:268
msgid "e.g. Seven-day returns"
msgstr "مثلاً هفت روز ضمانت بازگشت"

#: inc/customizer.php:269
msgid "Promise 4 (support)"
msgstr "تعهد ۴ (پشتیبانی)"

#: inc/customizer.php:269
msgid "e.g. Support by phone"
msgstr "مثلاً پشتیبانی تلفنی"

#: inc/customizer.php:282
msgid "Note under the add-to-cart button"
msgstr "یادداشت زیر دکمهٔ افزودن به سبد"

#: inc/customizer.php:285
msgid "For example your shipping time or return policy. Leave empty to hide."
msgstr "برای نمونه زمان ارسال یا شرایط بازگشت کالا. برای پنهان شدن خالی بگذارید."

#: inc/customizer.php:288
msgid "About the store"
msgstr "دربارهٔ فروشگاه"

#: inc/customizer.php:289
msgid "Phone"
msgstr "تلفن"

#: inc/customizer.php:290
msgid "Email"
msgstr "ایمیل"

#: inc/customizer.php:291
msgid "Address"
msgstr "نشانی"

#: inc/enqueue.php:48
msgid "Increase quantity"
msgstr "افزایش تعداد"

#: inc/enqueue.php:49
msgid "Decrease quantity"
msgstr "کاهش تعداد"

#: inc/setup.php:52
msgid "Primary menu"
msgstr "فهرست اصلی"

#: inc/setup.php:96
msgid "Blog sidebar"
msgstr "ستون کناری وبلاگ"

#: inc/setup.php:97
msgid "Shown beside blog posts and archives."
msgstr "کنار نوشته‌ها و بایگانی‌های وبلاگ نمایش داده می‌شود."

#: inc/setup.php:107
msgid "Shop filters"
msgstr "فیلترهای فروشگاه"

#: inc/setup.php:108
msgid "Shown beside product listings (shop, categories, tags, product search). If empty, a product category list is shown instead."
msgstr "کنار فهرست محصولات نمایش داده می‌شود (فروشگاه، دسته‌ها، برچسب‌ها، جستجوی محصول). اگر خالی باشد، فهرست دسته‌بندی محصولات نمایش داده می‌شود."

#. translators: %d: footer column number.
#: inc/setup.php:120
#, php-format
msgid "Footer column %d"
msgstr "ستون پانویس %d"

#: inc/setup.php:121
msgid "Use this for links, contact details or trust badges (for example an e-Namad badge via a Custom HTML widget)."
msgstr "برای پیوندها، اطلاعات تماس یا نمادهای اعتماد (مثلاً نماد اعتماد الکترونیکی با ابزارک «HTML سفارشی») استفاده کنید."

#: inc/template-tags.php:53
msgid "All products"
msgstr "همهٔ محصولات"

#: inc/template-tags.php:115
msgid "Previous"
msgstr "قبلی"

#: inc/template-tags.php:116
msgid "Next"
msgstr "بعدی"

#: inc/template-tags.php:117
msgid "Posts navigation"
msgstr "پیمایش نوشته‌ها"

#. translators: %s: category name.
#: inc/template-tags.php:190
#, php-format
msgid "All of %s"
msgstr "همهٔ %s"

#: inc/woocommerce.php:92
msgid "Filter products"
msgstr "فیلتر محصولات"

#: inc/woocommerce.php:95
msgid "Close filters"
msgstr "بستن فیلترها"

#: inc/woocommerce.php:140
msgid "Breadcrumb"
msgstr "مسیر صفحه"

#: inc/woocommerce.php:201
msgid "Filters"
msgstr "فیلترها"

#: inc/woocommerce.php:231
msgid "Default"
msgstr "پیش‌فرض"

#: inc/woocommerce.php:232
msgid "Best selling"
msgstr "پرفروش‌ترین"

#: inc/woocommerce.php:233
msgid "Top rated"
msgstr "محبوب‌ترین"

#: inc/woocommerce.php:234
msgid "Newest"
msgstr "جدیدترین"

#: inc/woocommerce.php:235
msgid "Cheapest"
msgstr "ارزان‌ترین"

#: inc/woocommerce.php:236
msgid "Most expensive"
msgstr "گران‌ترین"

#: inc/woocommerce.php:239
msgid "Most relevant"
msgstr "مرتبط‌ترین"

#: inc/woocommerce.php:246
msgid "Sort products"
msgstr "مرتب‌سازی محصولات"

#: inc/woocommerce.php:247
msgid "Sort by:"
msgstr "مرتب‌سازی:"

#: inc/woocommerce.php:274
msgid "Out of stock"
msgstr "ناموجود"

#: inc/woocommerce.php:341
msgid "Sale"
msgstr "حراج"

#. translators: %s: discount percentage, e.g. 20. Shown in a small badge.
#: inc/woocommerce.php:349
#, php-format
msgid "%s%%"
msgstr "%s٪"

#. translators: %s: discount percentage, e.g. 20.
#: inc/woocommerce.php:353
#, php-format
msgid "%s%% off"
msgstr "%s٪ تخفیف"

#. translators: %s: lowest price of the product's options.
#: inc/woocommerce.php:399
#, php-format
msgid "From %s"
msgstr "از %s"

#: inc/woocommerce.php:450
msgid "Choose options"
msgstr "انتخاب گزینه‌ها"

#: inc/woocommerce.php:450
msgid "Add to cart"
msgstr "افزودن به سبد خرید"

#: inc/woocommerce.php:475
msgid "Your details"
msgstr "مشخصات شما"

#. translators: %s: number of items in the cart.
#: inc/woocommerce.php:550
#, php-format
msgid "Cart, %s item"
msgid_plural "Cart, %s items"
msgstr[0] "سبد خرید، %s کالا"
msgstr[1] "سبد خرید، %s کالا"

#: inc/woocommerce.php:568
msgid "Cart"
msgstr "سبد خرید"

#: inc/woocommerce.php:613
msgid "Log in | Create account"
msgstr "ورود | ساخت حساب"

#: inc/woocommerce.php:645
msgid "Your account"
msgstr "حساب کاربری"

#: inc/woocommerce.php:647
#: inc/woocommerce.php:665
msgid "Create account"
msgstr "ساخت حساب"

#: inc/woocommerce.php:663
msgid "No account yet?"
msgstr "حساب کاربری ندارید؟"

#: inc/woocommerce.php:679
msgid "Already have an account?"
msgstr "حساب کاربری دارید؟"

#: index.php:21
msgid "Latest posts"
msgstr "تازه‌ترین نوشته‌ها"

#: page.php:33
#: single.php:31
msgid "Page"
msgstr "صفحه"

#. translators: %s: search query.
#: search.php:20
#, php-format
msgid "Search results for “%s”"
msgstr "نتایج جستجو برای «%s»"

#: searchform.php:21
msgid "Product search"
msgstr "جستجوی محصولات"

#: searchform.php:21
msgid "Site search"
msgstr "جستجو در سایت"

#: searchform.php:25
msgid "Search products"
msgstr "جستجوی محصولات"

#: searchform.php:25
#: searchform.php:32
msgid "Search"
msgstr "جستجو"

#: searchform.php:26
msgid "Search products…"
msgstr "جستجو در محصولات…"

#: searchform.php:26
msgid "Search…"
msgstr "جستجو…"

#: sidebar.php:14
msgid "Sidebar"
msgstr "ستون کناری"

#: single.php:38
msgid "Tags:"
msgstr "برچسب‌ها:"

#: single.php:44
msgid "Previous post"
msgstr "نوشتهٔ قبلی"

#: single.php:45
msgid "Next post"
msgstr "نوشتهٔ بعدی"

#: template-parts/content/card.php:33
msgid "Product"
msgstr "محصول"

#: template-parts/content/none.php:11
msgid "Nothing found"
msgstr "چیزی پیدا نشد"

#: template-parts/content/none.php:13
msgid "Nothing matched your search. Try fewer or different words, or browse a category."
msgstr "نتیجه‌ای با جستجوی شما مطابقت نداشت. واژه‌های کمتر یا متفاوتی را امتحان کنید، یا یکی از دسته‌ها را ببینید."

#: template-parts/content/none.php:16
msgid "There is nothing here yet."
msgstr "هنوز چیزی اینجا نیست."

#: template-parts/home/categories.php:18
msgid "Shop by category"
msgstr "خرید بر اساس دسته"

#: template-parts/home/hero.php:20
msgid "carousel"
msgstr "نمایش اسلایدی"

#: template-parts/home/hero.php:20
msgid "Featured"
msgstr "پیشنهادهای ویژهٔ فروشگاه"

#: template-parts/home/hero.php:25
msgid "slide"
msgstr "اسلاید"

#. translators: 1: slide number, 2: number of slides.
#: template-parts/home/hero.php:25
#, php-format
msgid "%1$s of %2$s"
msgstr "%1$s از %2$s"

#: template-parts/home/hero.php:63
msgid "Previous slide"
msgstr "اسلاید قبلی"

#. translators: %s: slide number.
#: template-parts/home/hero.php:68
#, php-format
msgid "Go to slide %s"
msgstr "رفتن به اسلاید %s"

#: template-parts/home/hero.php:73
msgid "Pause slideshow"
msgstr "توقف نمایش خودکار"

#: template-parts/home/hero.php:76
msgid "Next slide"
msgstr "اسلاید بعدی"

#: template-parts/home/products.php:41
#: template-parts/home/products.php:89
msgid "View all"
msgstr "مشاهدهٔ همه"

#: template-parts/home/products.php:55
msgid "Special offers"
msgstr "پیشنهادهای ویژه"

#: template-parts/home/products.php:59
msgid "Newest products"
msgstr "جدیدترین محصولات"

#: template-parts/home/products.php:88
msgid "Best sellers"
msgstr "پرفروش‌ترین‌ها"
```

### sofreh/sample-data/sample-products.csv

```csv
Type,SKU,Name,Published,Is featured?,Visibility in catalog,Short description,Description,Tax status,In stock?,Stock,Regular price,Sale price,Categories,Tags,Parent,Attribute 1 name,Attribute 1 value(s),Attribute 1 visible,Attribute 1 global
simple,SAMPLE-POT-24,قابلمه چدنی لعابی ۲۴ سانتی (نمونه),1,0,visible,قابلمهٔ چدنی با لعاب داخلی، مناسب پخت آرام و خورش.,<p>قابلمهٔ چدنی با لعاب داخلی، مناسب پخت آرام و خورش.</p><p><strong>این یک محصول نمونه برای نمایش پوسته است و کالای واقعی نیست. پیش از راه‌اندازی فروشگاه آن را حذف کنید.</strong></p>,taxable,1,12,4850000,,آشپزخانه > ظروف پخت‌وپز,محصول نمونه,,,,,
simple,SAMPLE-PAN-28,تابه گرانیتی ۲۸ سانتی (نمونه),1,0,visible,تابهٔ نچسب گرانیتی با دستهٔ چوبی، سازگار با اجاق القایی.,<p>تابهٔ نچسب گرانیتی با دستهٔ چوبی، سازگار با اجاق القایی.</p><p><strong>این یک محصول نمونه برای نمایش پوسته است و کالای واقعی نیست. پیش از راه‌اندازی فروشگاه آن را حذف کنید.</strong></p>,taxable,1,20,1650000,1390000,آشپزخانه > ظروف پخت‌وپز,محصول نمونه,,,,,
simple,SAMPLE-KETTLE,کتری استیل سوت‌دار (نمونه),1,0,visible,کتری استیل ۲.۵ لیتری با سوت و دستهٔ عایق.,<p>کتری استیل ۲.۵ لیتری با سوت و دستهٔ عایق.</p><p><strong>این یک محصول نمونه برای نمایش پوسته است و کالای واقعی نیست. پیش از راه‌اندازی فروشگاه آن را حذف کنید.</strong></p>,taxable,1,15,980000,,آشپزخانه > ظروف پخت‌وپز,محصول نمونه,,,,,
simple,SAMPLE-KNIFE-SET,سرویس چاقوی آشپزخانه ۵ پارچه (نمونه),1,0,visible,پنج چاقو با پایهٔ چوبی، تیغهٔ فولاد ضدزنگ.,<p>پنج چاقو با پایهٔ چوبی، تیغهٔ فولاد ضدزنگ.</p><p><strong>این یک محصول نمونه برای نمایش پوسته است و کالای واقعی نیست. پیش از راه‌اندازی فروشگاه آن را حذف کنید.</strong></p>,taxable,1,8,2350000,1990000,آشپزخانه > ابزار آشپزی,محصول نمونه,,,,,
simple,SAMPLE-BOARD,تخته برش چوب گردو (نمونه),1,0,visible,تخته برش یکپارچه از چوب گردو با شیار آب‌گیر.,<p>تخته برش یکپارچه از چوب گردو با شیار آب‌گیر.</p><p><strong>این یک محصول نمونه برای نمایش پوسته است و کالای واقعی نیست. پیش از راه‌اندازی فروشگاه آن را حذف کنید.</strong></p>,taxable,1,30,720000,,آشپزخانه > ابزار آشپزی,محصول نمونه,,,,,
simple,SAMPLE-BLENDER,مخلوط‌کن ۱۲۰۰ وات (نمونه),1,0,visible,مخلوط‌کن با پارچ شیشه‌ای ۱.۵ لیتری و سه سرعت.,<p>مخلوط‌کن با پارچ شیشه‌ای ۱.۵ لیتری و سه سرعت.</p><p><strong>این یک محصول نمونه برای نمایش پوسته است و کالای واقعی نیست. پیش از راه‌اندازی فروشگاه آن را حذف کنید.</strong></p>,taxable,0,0,5400000,,آشپزخانه > لوازم برقی آشپزخانه,محصول نمونه,,,,,
simple,SAMPLE-SAMOVAR,سماور برقی ۴ لیتری (نمونه),1,0,visible,سماور برقی استیل با قوری چینی و کنترل دما.,<p>سماور برقی استیل با قوری چینی و کنترل دما.</p><p><strong>این یک محصول نمونه برای نمایش پوسته است و کالای واقعی نیست. پیش از راه‌اندازی فروشگاه آن را حذف کنید.</strong></p>,taxable,1,5,6900000,6200000,آشپزخانه > لوازم برقی آشپزخانه,محصول نمونه,,,,,
simple,SAMPLE-DINNER-SET,سرویس غذاخوری چینی ۲۶ پارچه (نمونه),1,0,visible,سرویس شش‌نفره با طرح ساده و لبهٔ طلایی.,<p>سرویس شش‌نفره با طرح ساده و لبهٔ طلایی.</p><p><strong>این یک محصول نمونه برای نمایش پوسته است و کالای واقعی نیست. پیش از راه‌اندازی فروشگاه آن را حذف کنید.</strong></p>,taxable,1,4,8800000,,سرو و پذیرایی > ظروف سرو,محصول نمونه,,,,,
simple,SAMPLE-BOWL-SET,ست کاسه سفالی دست‌ساز (نمونه),1,0,visible,چهار کاسهٔ سفالی لعاب‌دار، ساخت دست.,<p>چهار کاسهٔ سفالی لعاب‌دار، ساخت دست.</p><p><strong>این یک محصول نمونه برای نمایش پوسته است و کالای واقعی نیست. پیش از راه‌اندازی فروشگاه آن را حذف کنید.</strong></p>,taxable,1,10,1250000,,سرو و پذیرایی > ظروف سرو,محصول نمونه,,,,,
simple,SAMPLE-TEA-GLASS,استکان و نعلبکی کمرباریک ۶ عددی (نمونه),1,0,visible,استکان شیشه‌ای کمرباریک با نعلبکی.,<p>استکان شیشه‌ای کمرباریک با نعلبکی.</p><p><strong>این یک محصول نمونه برای نمایش پوسته است و کالای واقعی نیست. پیش از راه‌اندازی فروشگاه آن را حذف کنید.</strong></p>,taxable,1,40,540000,460000,سرو و پذیرایی > لیوان و فنجان,محصول نمونه,,,,,
simple,SAMPLE-MUG,ماگ سرامیکی فیروزه‌ای (نمونه),1,0,visible,ماگ ۳۵۰ میلی‌لیتری با لعاب فیروزه‌ای.,<p>ماگ ۳۵۰ میلی‌لیتری با لعاب فیروزه‌ای.</p><p><strong>این یک محصول نمونه برای نمایش پوسته است و کالای واقعی نیست. پیش از راه‌اندازی فروشگاه آن را حذف کنید.</strong></p>,taxable,1,60,310000,,سرو و پذیرایی > لیوان و فنجان,محصول نمونه,,,,,
simple,SAMPLE-JARS,ست بانکه شیشه‌ای درب چوبی (نمونه),1,0,visible,سه بانکهٔ شیشه‌ای برای حبوبات و ادویه.,<p>سه بانکهٔ شیشه‌ای برای حبوبات و ادویه.</p><p><strong>این یک محصول نمونه برای نمایش پوسته است و کالای واقعی نیست. پیش از راه‌اندازی فروشگاه آن را حذف کنید.</strong></p>,taxable,1,25,890000,,نگهداری و نظم‌دهی,محصول نمونه,,,,,
simple,SAMPLE-SPICE-RACK,جاادویه‌ای گردان ۱۲ عددی (نمونه),1,0,visible,جاادویه‌ای چرخان با دوازده شیشهٔ برچسب‌دار.,<p>جاادویه‌ای چرخان با دوازده شیشهٔ برچسب‌دار.</p><p><strong>این یک محصول نمونه برای نمایش پوسته است و کالای واقعی نیست. پیش از راه‌اندازی فروشگاه آن را حذف کنید.</strong></p>,taxable,1,14,1150000,990000,نگهداری و نظم‌دهی,محصول نمونه,,,,,
simple,SAMPLE-CUSHION,کوسن مخمل طرح ترمه (نمونه),1,0,visible,کوسن ۴۵ در ۴۵ سانتی‌متر با روکش مخمل و طرح ترمه.,<p>کوسن ۴۵ در ۴۵ سانتی‌متر با روکش مخمل و طرح ترمه.</p><p><strong>این یک محصول نمونه برای نمایش پوسته است و کالای واقعی نیست. پیش از راه‌اندازی فروشگاه آن را حذف کنید.</strong></p>,taxable,1,18,650000,,دکوراسیون خانه > منسوجات خانگی,محصول نمونه,,,,,
simple,SAMPLE-LAMP,آباژور رومیزی پایه سرامیکی (نمونه),1,0,visible,آباژور با پایهٔ سرامیکی و کلاهک پارچه‌ای.,<p>آباژور با پایهٔ سرامیکی و کلاهک پارچه‌ای.</p><p><strong>این یک محصول نمونه برای نمایش پوسته است و کالای واقعی نیست. پیش از راه‌اندازی فروشگاه آن را حذف کنید.</strong></p>,taxable,1,6,2750000,,دکوراسیون خانه > روشنایی,محصول نمونه,,,,,
simple,SAMPLE-SOAP,جاصابونی سنگی (نمونه),1,0,visible,جاصابونی از سنگ مرمر با شیار آب‌گیر.,<p>جاصابونی از سنگ مرمر با شیار آب‌گیر.</p><p><strong>این یک محصول نمونه برای نمایش پوسته است و کالای واقعی نیست. پیش از راه‌اندازی فروشگاه آن را حذف کنید.</strong></p>,taxable,1,35,280000,,حمام و شست‌وشو,محصول نمونه,,,,,
variable,SAMPLE-TOWEL,ست حوله پنبه‌ای (نمونه),1,0,visible,ست سه‌تکهٔ حولهٔ پنبه‌ای در دو رنگ.,<p>ست سه‌تکهٔ حولهٔ پنبه‌ای در دو رنگ.</p><p><strong>این یک محصول نمونه برای نمایش پوسته است و کالای واقعی نیست. پیش از راه‌اندازی فروشگاه آن را حذف کنید.</strong></p>,taxable,1,,,,حمام و شست‌وشو,محصول نمونه,,رنگ,"کرم, سبز",1,0
variation,SAMPLE-TOWEL-CREAM,ست حوله پنبه‌ای (نمونه) - کرم,1,0,visible,,,taxable,1,10,1450000,,,,SAMPLE-TOWEL,رنگ,کرم,,0
variation,SAMPLE-TOWEL-GREEN,ست حوله پنبه‌ای (نمونه) - سبز,1,0,visible,,,taxable,1,10,1450000,1290000,,,SAMPLE-TOWEL,رنگ,سبز,,0
```

### sofreh/template-parts/content/card.php

```php
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
		<?php if ( has_post_thumbnail() || $sofreh_product ) : ?>
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
				} else {
					echo wc_placeholder_img( 'woocommerce_thumbnail', array( 'alt' => '' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- WooCommerce builds this image tag.
				}
				?>
			</span>
		<?php endif; ?>
		<span class="post-card__body">
			<?php if ( $sofreh_product ) : ?>
				<span class="post-card__type"><?php esc_html_e( 'Product', 'sofreh' ); ?></span>
			<?php elseif ( 'post' === get_post_type() ) : ?>
				<span class="post-card__type"><?php echo esc_html( get_the_date() ); ?></span>
			<?php endif; ?>
			<span class="post-card__title" dir="auto"><?php the_title(); ?></span>
			<?php if ( $sofreh_product ) : ?>
				<span class="price"><?php echo sofreh_kses_price( $sofreh_product->get_price_html() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped by sofreh_kses_price(). ?></span>
			<?php else : ?>
				<span class="post-card__excerpt" dir="auto"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></span>
			<?php endif; ?>
		</span>
	</a>
</article>
```

### sofreh/template-parts/content/category-links.php

```php
<?php
/**
 * A short list of top-level product categories (used on 404 and empty search).
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

$sofreh_terms = sofreh_get_product_categories( 0, 10 );
if ( empty( $sofreh_terms ) ) {
	return;
}
?>
<nav class="category-chips" aria-label="<?php esc_attr_e( 'Product categories', 'sofreh' ); ?>">
	<ul>
		<?php foreach ( $sofreh_terms as $sofreh_term ) : ?>
			<?php
			$sofreh_link = get_term_link( $sofreh_term );
			if ( is_wp_error( $sofreh_link ) ) {
				continue;
			}
			?>
			<li><a class="chip" href="<?php echo esc_url( $sofreh_link ); ?>"><?php echo esc_html( $sofreh_term->name ); ?></a></li>
		<?php endforeach; ?>
	</ul>
</nav>
```

### sofreh/template-parts/content/none.php

```php
<?php
/**
 * Nothing found.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="no-results">
	<h2><?php esc_html_e( 'Nothing found', 'sofreh' ); ?></h2>
	<?php if ( is_search() ) : ?>
		<p><?php esc_html_e( 'Nothing matched your search. Try fewer or different words, or browse a category.', 'sofreh' ); ?></p>
		<?php get_template_part( 'template-parts/content/category-links' ); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'There is nothing here yet.', 'sofreh' ); ?></p>
	<?php endif; ?>
</section>
```

### sofreh/template-parts/home/categories.php

```php
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
```

### sofreh/template-parts/home/hero.php

```php
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
```

### sofreh/template-parts/home/products.php

```php
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
										<span class="price"><?php echo sofreh_kses_price( $sofreh_product->get_price_html() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped by sofreh_kses_price(). ?></span>
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
```

### sofreh/template-parts/home/trust.php

```php
<?php
/**
 * Home: store promises strip. Text comes from the Customizer; empty items are
 * hidden so the store never shows a promise it did not write.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

$sofreh_items = array();
foreach ( array(
	1 => 'truck',
	2 => 'shield',
	3 => 'return',
	4 => 'support',
) as $sofreh_n => $sofreh_icon ) {
	$sofreh_text = trim( (string) sofreh_option( 'trust_' . $sofreh_n ) );
	if ( '' !== $sofreh_text ) {
		$sofreh_items[] = array( $sofreh_icon, $sofreh_text );
	}
}

if ( empty( $sofreh_items ) ) {
	return;
}
?>
<section class="home-section trust-strip" aria-label="<?php esc_attr_e( 'Store promises', 'sofreh' ); ?>">
	<div class="container">
	<ul class="trust-strip__list">
		<?php foreach ( $sofreh_items as $sofreh_item ) : ?>
			<li><?php sofreh_icon( $sofreh_item[0], 28 ); ?><span><?php echo esc_html( $sofreh_item[1] ); ?></span></li>
		<?php endforeach; ?>
	</ul>
	</div>
</section>
```

### sofreh-phone-accounts/readme.txt

```text
=== Sofreh Phone Accounts ===
Contributors: yns-nur
Requires at least: 6.7
Tested up to: 7.1
Requires PHP: 7.4
Requires Plugins: woocommerce
Stable tag: 1.2.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Buy with a mobile number; the customer account is created automatically and its
login details are shown on the order confirmation page.

== Description ==

* Checkout never sends a signed-out customer to a registration page: anyone can
  buy straight away.
* The mobile number is required and becomes the username. Persian/Arabic digits,
  spaces and +98 / 0098 prefixes are accepted and stored as 09XXXXXXXXX.
* Only when the order is paid (the gateway reports payment complete, or the
  order reaches Processing/Completed) is a customer account created with a
  generated password; the order is attached to it, the checkout addresses are
  saved to it and the customer is signed in (as WooCommerce does for its own
  checkout sign-up). Unpaid, failed and cancelled orders never create accounts.
* The order confirmation page shows the order tracking code with the account
  confirmation beside it: the username and the password, with copy buttons, and
  links to complete the account. While a payment is still awaited (for example
  a bank transfer on hold) it says the account is created once the payment is
  confirmed.
* If the payment is confirmed while the buyer is away (a server callback, or
  the store marking a bank transfer as paid), the account is created then, and
  its password is set and shown the next time the buyer opens the confirmation
  page in the browser they ordered from.
* The password is kept only in that customer's session for 30 minutes. It is
  never stored with the order, never written to a log and never sent by email
  or SMS; WordPress stores only its hash.
* If an account with the number already exists, the order is NOT attached to it
  (placing an order never grants access to someone else's account); the page
  suggests signing in, and the order can still be tracked with its code.
* "Create account" (ساخت حساب) sits beside "Log in" on the My Account page and
  is offered at checkout, returning to the checkout afterwards. The form asks
  for the mobile number (it becomes the username), an email address
  (WooCommerce requires one for sign-up) and a password the customer chooses.
* Customers sign in later with the mobile number (any digit form) and the
  password, and are reminded on their dashboard to complete their account. The
  login field is labelled "Mobile number or email".
* A [sofreh_order_tracking] form (a "Track your order" page is created on
  activation) shows status, date, total and items for a tracking code + mobile
  number pair. Addresses and other personal details are never shown there.

Works with the classic checkout shortcode and the Checkout block. On the Checkout
block WooCommerce always asks for an email address (it cannot be made optional
there); on the classic checkout the email becomes optional.

== Installation ==

1. Upload the plugin folder to wp-content/plugins/ (or the zip via Plugins → Add
   New → Upload) and activate it. WooCommerce must be active.
2. Activation turns on guest checkout, turns off WooCommerce's own "create an
   account" checkout option (accounts are created automatically instead), turns
   on sign-up on the My Account page (username generated = the mobile number,
   password chosen by the customer) and creates the "Track your order" page.
3. Add the tracking page to a menu if you like.

== Changelog ==

= 1.2.0 =
* Accounts for guest orders are created only once the order is paid, and shown
  beside the tracking code on the confirmation page.
* "Create account" offered at checkout, with a return to the checkout.
* The sign-up form's heading and button read "Create account".

= 1.1.0 =
* Manual sign-up on My Account with the mobile number as the username.
* Login field labelled "Mobile number or email".

= 1.0.0 =
* First release.
```

### sofreh-phone-accounts/sofreh-phone-accounts.php

```php
<?php
/**
 * Plugin Name:       Sofreh Phone Accounts
 * Plugin URI:        https://github.com/yns-nur/nur/tree/main/wp-theme/sofreh-phone-accounts
 * Description:       Customers buy with just their mobile number, or create an account first. When a signed-out customer's order is paid, a customer account is created automatically, and the order confirmation page shows the order tracking code with the account confirmation and login details beside it (mobile number as username, plus a generated password). Adds an order-tracking form that works with order number and mobile number. Companion to the Sofreh theme, but works with any theme.
 * Version:           1.2.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Requires Plugins:  woocommerce
 * WC requires at least: 9.0
 * WC tested up to:   11.2
 * Author:            Younes Nur
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       sofreh-phone-accounts
 * Domain Path:       /languages
 *
 * @package SofrehPhoneAccounts
 */

defined( 'ABSPATH' ) || exit;

define( 'SOFREH_PA_VERSION', '1.2.0' );
define( 'SOFREH_PA_FILE', __FILE__ );
define( 'SOFREH_PA_DIR', plugin_dir_path( __FILE__ ) );
define( 'SOFREH_PA_URL', plugin_dir_url( __FILE__ ) );

require SOFREH_PA_DIR . 'includes/class-sofreh-phone-accounts.php';

// Declare compatibility with WooCommerce order storage (HPOS) and the Cart/Checkout blocks.
add_action(
	'before_woocommerce_init',
	function () {
		if ( class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', SOFREH_PA_FILE, true );
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'cart_checkout_blocks', SOFREH_PA_FILE, true );
		}
	}
);

add_action(
	'plugins_loaded',
	function () {
		if ( class_exists( 'WooCommerce' ) ) {
			Sofreh_Phone_Accounts::instance();
		}
	}
);

register_activation_hook( __FILE__, array( 'Sofreh_Phone_Accounts', 'activate' ) );
```

### sofreh-phone-accounts/assets/sofreh-phone-accounts.css

```css
/*
 * Fallback styles so the confirmation card and tracking form are usable with
 * any theme. The Sofreh theme restyles these to match its design.
 */
.sofreh-pa-card {
	margin: 0 0 2em;
	padding: 1.25em;
	border: 1px solid rgba(0, 0, 0, 0.12);
	border-radius: 12px;
}

.sofreh-pa-card__row + .sofreh-pa-card__row {
	margin-top: 1.25em;
	padding-top: 1.25em;
	border-top: 1px solid rgba(0, 0, 0, 0.12);
}

.sofreh-pa-card__title,
.sofreh-pa-card__subtitle {
	margin: 0 0 0.25em;
	font-size: 1.15em;
}

.sofreh-pa-value {
	display: inline-flex;
	align-items: center;
	gap: 0.5em;
}

.sofreh-pa-value code {
	direction: ltr;
	unicode-bidi: isolate;
	padding: 0.2em 0.5em;
	border-radius: 6px;
	background: rgba(0, 0, 0, 0.05);
	font-size: 1.1em;
	user-select: all;
}

.sofreh-pa-copy {
	cursor: pointer;
}

.sofreh-pa-copy__done,
.sofreh-pa-copy.is-copied .sofreh-pa-copy__idle {
	display: none;
}

.sofreh-pa-copy.is-copied .sofreh-pa-copy__done {
	display: inline;
}

.sofreh-pa-credentials {
	margin: 1em 0;
}

.sofreh-pa-credentials dd {
	margin: 0.25em 0 0.75em;
}

.sofreh-pa-card__warning {
	font-size: 0.9em;
}
```

### sofreh-phone-accounts/assets/sofreh-phone-accounts.js

```js
/**
 * Copy buttons on the order confirmation and tracking pages.
 */
( function () {
	'use strict';

	var l10n = window.sofrehPA || { copied: 'Copied' };
	var live = document.createElement( 'div' );
	live.className = 'screen-reader-text';
	live.setAttribute( 'aria-live', 'polite' );
	document.body.appendChild( live );

	function copyText( text ) {
		if ( navigator.clipboard && window.isSecureContext ) {
			return navigator.clipboard.writeText( text );
		}
		// Fallback for http:// and older browsers.
		return new Promise( function ( resolve, reject ) {
			var area = document.createElement( 'textarea' );
			area.value = text;
			area.setAttribute( 'readonly', '' );
			area.style.position = 'fixed';
			area.style.opacity = '0';
			document.body.appendChild( area );
			area.select();
			var ok = document.execCommand( 'copy' );
			document.body.removeChild( area );
			if ( ok ) {
				resolve();
			} else {
				reject();
			}
		} );
	}

	document.addEventListener( 'click', function ( event ) {
		var button = event.target.closest( '.sofreh-pa-copy' );
		if ( ! button ) {
			return;
		}
		copyText( button.getAttribute( 'data-copy' ) ).then( function () {
			button.classList.add( 'is-copied' );
			live.textContent = l10n.copied;
			window.setTimeout( function () {
				button.classList.remove( 'is-copied' );
				live.textContent = '';
			}, 1800 );
		} ).catch( function () {
			// Copy blocked: select the value so it can be copied by hand.
			var code = button.parentNode.querySelector( 'code' );
			if ( code && window.getSelection ) {
				var range = document.createRange();
				range.selectNodeContents( code );
				window.getSelection().removeAllRanges();
				window.getSelection().addRange( range );
			}
		} );
	} );
}() );
```

### sofreh-phone-accounts/includes/class-sofreh-phone-accounts.php

```php
<?php
/**
 * Phone-number checkout with automatic customer accounts.
 *
 * Flow:
 * 1. Checkout always allows buying without signing in first (no redirect to a
 *    registration page) and requires a mobile number.
 * 2. When a signed-out customer's order is paid (the gateway confirms the
 *    payment, or WooCommerce moves the order to a paid status such as
 *    "processing" for cash on delivery), an account is created with the
 *    mobile number as username and a generated password. The order is
 *    attached to it and, in the buyer's own browser, the customer is signed
 *    in, the same way WooCommerce's own checkout sign-up does. Unpaid,
 *    failed or cancelled orders never create accounts.
 * 3. The order confirmation page shows the order tracking code with the
 *    account confirmation and login details beside it. The password is kept
 *    only in the customer's own session, for a limited time, and is never
 *    stored in the order or sent by email. If the payment was confirmed by a
 *    server-to-server callback while the buyer was away, the account is
 *    created then and its password is set and shown when the buyer opens the
 *    confirmation page in the browser that placed the order.
 * 4. Customers can sign in later with the mobile number (Persian digits and
 *    +98 forms accepted) and complete their account details.
 * 5. "Create account" (manual sign-up) sits beside "Log in" on the My Account
 *    page and is offered at checkout; it asks for the mobile number too,
 *    which becomes the username, so every account signs in the same way.
 *
 * @package SofrehPhoneAccounts
 */

defined( 'ABSPATH' ) || exit;

/**
 * Main plugin class.
 */
final class Sofreh_Phone_Accounts {

	/** Session key holding just-created credentials. */
	const SESSION_KEY = 'sofreh_pa_new_account';

	/** How long the confirmation page may show the password (seconds). */
	const SHOW_PASSWORD_FOR = 1800;

	/** User meta: account was created at checkout and is not completed yet. */
	const META_INCOMPLETE = 'sofreh_pa_incomplete';

	/** Option holding the order tracking page ID. */
	const OPTION_TRACKING_PAGE = 'sofreh_pa_tracking_page_id';

	/** Session key: the order this browser placed without signing in. */
	const SESSION_ORDER = 'sofreh_pa_guest_order';

	/** Order meta: placed at checkout by a signed-out customer. */
	const META_GUEST = '_sofreh_pa_guest_checkout';

	/** Order meta: the account step for this order is finished. */
	const META_DONE = '_sofreh_pa_account_done';

	/** Order meta: an account was created while the buyer was away; set and show its password on their next visit. */
	const META_REVEAL = '_sofreh_pa_reveal_pending';

	/**
	 * Singleton.
	 *
	 * @var Sofreh_Phone_Accounts|null
	 */
	private static $instance = null;

	/**
	 * Get the instance.
	 *
	 * @return Sofreh_Phone_Accounts
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Register hooks.
	 */
	private function __construct() {
		add_action( 'init', array( $this, 'load_textdomain' ) );

		// 1. Checkout rules.
		add_filter( 'woocommerce_checkout_registration_required', '__return_false', 20 );
		add_filter( 'woocommerce_checkout_registration_enabled', '__return_false', 20 );
		add_filter( 'pre_option_woocommerce_checkout_phone_field', array( $this, 'phone_field_required' ) );
		add_filter( 'woocommerce_billing_fields', array( $this, 'classic_billing_fields' ), 20 );
		add_filter( 'woocommerce_default_address_fields', array( $this, 'default_phone_label' ), 20 );
		add_action( 'woocommerce_after_checkout_validation', array( $this, 'classic_validate_mobile' ), 10, 2 );
		add_action( 'woocommerce_checkout_create_order', array( $this, 'classic_normalize_order_phone' ), 10 );
		add_action( 'woocommerce_store_api_checkout_update_order_from_request', array( $this, 'blocks_validate_mobile' ), 10 );

		// 2. Account creation once the order is paid.
		add_action( 'woocommerce_checkout_order_processed', array( $this, 'classic_order_processed' ), 20, 3 );
		add_action( 'woocommerce_store_api_checkout_order_processed', array( $this, 'mark_guest_order' ), 20 );
		add_action( 'woocommerce_payment_complete', array( $this, 'on_payment_complete' ) );
		add_action( 'woocommerce_order_status_changed', array( $this, 'on_status_changed' ), 10, 4 );

		// 3. Order confirmation page.
		add_action( 'template_redirect', array( $this, 'on_confirmation_page' ), 5 );
		add_action( 'woocommerce_before_thankyou', array( $this, 'render_confirmation' ), 5 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );

		// 4. Signing in and completing the account.
		add_action( 'wp_authenticate', array( $this, 'normalize_login' ), 1, 2 );
		add_action( 'woocommerce_login_form_start', array( $this, 'login_hint' ) );
		if ( ! is_admin() ) {
			add_filter( 'gettext_woocommerce', array( $this, 'login_label' ), 10, 2 );
		}
		add_action( 'woocommerce_account_dashboard', array( $this, 'dashboard_notice' ), 5 );
		add_action( 'woocommerce_save_account_details', array( $this, 'mark_complete' ) );

		// 5. "Create account" with the mobile number as username.
		add_action( 'woocommerce_register_form_start', array( $this, 'register_mobile_field' ) );
		add_action( 'woocommerce_login_form_end', array( $this, 'return_field' ) );
		add_action( 'woocommerce_register_form_end', array( $this, 'return_field' ) );
		add_action( 'woocommerce_before_checkout_form', array( $this, 'checkout_account_notice' ), 15 );
		add_filter( 'render_block_woocommerce/checkout', array( $this, 'block_checkout_account_notice' ) );
		add_filter( 'woocommerce_process_registration_errors', array( $this, 'register_validate' ) );
		add_filter( 'woocommerce_new_customer_data', array( $this, 'register_username' ) );
		add_action( 'woocommerce_created_customer', array( $this, 'register_save_phone' ) );

		// Order tracking by order number + mobile.
		add_shortcode( 'sofreh_order_tracking', array( $this, 'tracking_shortcode' ) );
	}

	/**
	 * Load translations.
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'sofreh-phone-accounts', false, dirname( plugin_basename( SOFREH_PA_FILE ) ) . '/languages' );
	}

	/**
	 * On activation: allow guest checkout, turn off WooCommerce's own checkout
	 * sign-up (accounts are created automatically instead) and create the
	 * order tracking page.
	 */
	public static function activate() {
		update_option( 'woocommerce_enable_guest_checkout', 'yes' );
		update_option( 'woocommerce_enable_signup_and_login_from_checkout', 'no' );
		// Manual sign-up stays available on My Account; the mobile number is
		// the username, so WooCommerce's own username field is not shown.
		update_option( 'woocommerce_enable_myaccount_registration', 'yes' );
		update_option( 'woocommerce_registration_generate_username', 'yes' );
		// Customers choose their own password when they sign up, so they can
		// sign in straight away without waiting for an email.
		update_option( 'woocommerce_registration_generate_password', 'no' );

		$page_id = (int) get_option( self::OPTION_TRACKING_PAGE );
		if ( ! $page_id || ! get_post( $page_id ) ) {
			load_plugin_textdomain( 'sofreh-phone-accounts', false, dirname( plugin_basename( SOFREH_PA_FILE ) ) . '/languages' );
			$page_id = wp_insert_post(
				array(
					'post_type'    => 'page',
					'post_status'  => 'publish',
					'post_title'   => __( 'Track your order', 'sofreh-phone-accounts' ),
					'post_name'    => 'order-tracking',
					'post_content' => '<!-- wp:shortcode -->[sofreh_order_tracking]<!-- /wp:shortcode -->',
				)
			);
			if ( $page_id && ! is_wp_error( $page_id ) ) {
				update_option( self::OPTION_TRACKING_PAGE, (int) $page_id );
			}
		}
	}

	/*
	 * ---------------------------------------------------------------------
	 * Mobile numbers
	 * ---------------------------------------------------------------------
	 */

	/**
	 * Normalize an Iranian mobile number to 09XXXXXXXXX.
	 *
	 * Accepts Persian/Arabic digits, spaces, dashes, brackets and the +98 /
	 * 0098 / 98 prefixes. Returns '' when the input is not a mobile number.
	 *
	 * @param string $raw Input.
	 * @return string
	 */
	public static function normalize_mobile( $raw ) {
		$raw = (string) $raw;
		$map = array();
		for ( $i = 0; $i <= 9; $i++ ) {
			$map[ html_entity_decode( '&#' . ( 0x06F0 + $i ) . ';', ENT_QUOTES, 'UTF-8' ) ] = (string) $i;
			$map[ html_entity_decode( '&#' . ( 0x0660 + $i ) . ';', ENT_QUOTES, 'UTF-8' ) ] = (string) $i;
		}
		$digits = preg_replace( '/[\s\-\(\)\.]/u', '', strtr( $raw, $map ) );

		if ( 0 === strpos( $digits, '+98' ) ) {
			$digits = '0' . substr( $digits, 3 );
		} elseif ( 0 === strpos( $digits, '0098' ) ) {
			$digits = '0' . substr( $digits, 4 );
		} elseif ( 12 === strlen( $digits ) && 0 === strpos( $digits, '98' ) ) {
			$digits = '0' . substr( $digits, 2 );
		} elseif ( 10 === strlen( $digits ) && 0 === strpos( $digits, '9' ) ) {
			$digits = '0' . $digits;
		}

		/**
		 * Filters the normalized mobile number. Return '' to reject it.
		 * Stores outside Iran can replace the format check here.
		 *
		 * @param string $mobile Normalized number, or '' when invalid.
		 * @param string $raw    What the customer typed.
		 */
		return (string) apply_filters( 'sofreh_pa_normalize_mobile', preg_match( '/^09\d{9}$/', $digits ) ? $digits : '', $raw );
	}

	/**
	 * Error message for an invalid mobile number.
	 *
	 * @return string
	 */
	private function invalid_mobile_message() {
		return __( 'Please enter a valid mobile number, for example 09121234567. It becomes your username for signing in.', 'sofreh-phone-accounts' );
	}

	/*
	 * ---------------------------------------------------------------------
	 * 1. Checkout rules
	 * ---------------------------------------------------------------------
	 */

	/**
	 * The phone field is always required: it is the customer's username.
	 *
	 * @return string
	 */
	public function phone_field_required() {
		return 'required';
	}

	/**
	 * Classic checkout: mobile first and required, email optional.
	 *
	 * The Checkout block always asks for an email address (WooCommerce does
	 * not offer a way to make it optional there); on the classic checkout it
	 * becomes optional.
	 *
	 * @param array $fields Billing fields.
	 * @return array
	 */
	public function classic_billing_fields( $fields ) {
		if ( isset( $fields['billing_phone'] ) ) {
			$fields['billing_phone']['required']    = true;
			$fields['billing_phone']['label']       = __( 'Mobile number', 'sofreh-phone-accounts' );
			$fields['billing_phone']['placeholder'] = '09121234567';
			if ( ! is_user_logged_in() ) {
				$fields['billing_phone']['description'] = __( 'Once your payment is confirmed, your account is created with this number and your password is shown on the confirmation page.', 'sofreh-phone-accounts' );
			}
		}
		if ( isset( $fields['billing_email'] ) ) {
			$fields['billing_email']['required'] = false;
		}
		return $fields;
	}

	/**
	 * Label the phone field "Mobile number" in the default address fields too:
	 * WooCommerce's address script relabels fields from these defaults when
	 * the country changes.
	 *
	 * @param array $fields Default address fields.
	 * @return array
	 */
	public function default_phone_label( $fields ) {
		if ( isset( $fields['phone'] ) ) {
			$fields['phone']['label']       = __( 'Mobile number', 'sofreh-phone-accounts' );
			$fields['phone']['placeholder'] = '09121234567';
		}
		return $fields;
	}

	/**
	 * Classic checkout: the billing phone must be a mobile number.
	 *
	 * @param array    $data   Posted data.
	 * @param WP_Error $errors Errors.
	 */
	public function classic_validate_mobile( $data, $errors ) {
		if ( is_user_logged_in() ) {
			return;
		}
		$raw = isset( $data['billing_phone'] ) ? $data['billing_phone'] : '';
		if ( '' === self::normalize_mobile( $raw ) ) {
			$errors->add( 'billing_phone_validation', $this->invalid_mobile_message(), array( 'id' => 'billing_phone' ) );
		}
	}

	/**
	 * Classic checkout: store the phone in its normalized form.
	 *
	 * @param WC_Order $order Order.
	 */
	public function classic_normalize_order_phone( $order ) {
		$mobile = self::normalize_mobile( $order->get_billing_phone() );
		if ( '' !== $mobile ) {
			$order->set_billing_phone( $mobile );
		}
	}

	/**
	 * Checkout block (Store API): validate and normalize the mobile number.
	 * The exception is shown to the customer as a checkout error.
	 *
	 * @param WC_Order $order Order being built from the request.
	 * @throws \Automattic\WooCommerce\StoreApi\Exceptions\RouteException When the number is invalid.
	 */
	public function blocks_validate_mobile( $order ) {
		$mobile = self::normalize_mobile( $order->get_billing_phone() );
		if ( '' === $mobile ) {
			if ( is_user_logged_in() ) {
				return;
			}
			throw new \Automattic\WooCommerce\StoreApi\Exceptions\RouteException( 'sofreh_pa_invalid_mobile', esc_html( $this->invalid_mobile_message() ), 400 );
		}
		$order->set_billing_phone( $mobile );
	}

	/*
	 * ---------------------------------------------------------------------
	 * 2. Account creation
	 * ---------------------------------------------------------------------
	 */

	/**
	 * Classic checkout adapter.
	 *
	 * @param int      $order_id Order ID.
	 * @param array    $posted   Posted data.
	 * @param WC_Order $order    Order.
	 */
	public function classic_order_processed( $order_id, $posted, $order ) {
		$this->mark_guest_order( $order instanceof WC_Order ? $order : wc_get_order( $order_id ) );
	}

	/**
	 * Remember that this browser placed the order without signing in. Runs
	 * before the payment is taken, so no account is created yet.
	 *
	 * @param WC_Order $order Order.
	 */
	public function mark_guest_order( $order ) {
		if ( ! $order instanceof WC_Order || is_user_logged_in() || $order->get_customer_id() ) {
			return;
		}
		$order->update_meta_data( self::META_GUEST, 1 );
		$order->save_meta_data();
		if ( WC()->session ) {
			WC()->session->set( self::SESSION_ORDER, $order->get_id() );
		}
	}

	/**
	 * The gateway reported a successful payment.
	 *
	 * @param int $order_id Order ID.
	 */
	public function on_payment_complete( $order_id ) {
		$this->create_account_for_paid_order( wc_get_order( $order_id ) );
	}

	/**
	 * The order moved to a paid status (for example "processing" for cash on
	 * delivery, or when the store marks a bank transfer as received).
	 *
	 * @param int      $order_id Order ID.
	 * @param string   $from     Old status.
	 * @param string   $to       New status.
	 * @param WC_Order $order    Order.
	 */
	public function on_status_changed( $order_id, $from, $to, $order ) {
		if ( in_array( $to, wc_get_is_paid_statuses(), true ) ) {
			$this->create_account_for_paid_order( $order instanceof WC_Order ? $order : wc_get_order( $order_id ) );
		}
	}

	/**
	 * Is this request the buyer's own browser session for the order?
	 *
	 * @param WC_Order $order Order.
	 * @return bool
	 */
	private function is_buyer_session( $order ) {
		return ! is_user_logged_in()
			&& WC()->session
			&& (int) WC()->session->get( self::SESSION_ORDER ) === (int) $order->get_id();
	}

	/**
	 * Create an account for a paid order placed without signing in, and
	 * attach the order to it. In the buyer's own browser the customer is
	 * signed in and the login details are kept for the confirmation page;
	 * otherwise (a server callback) the password is set and shown when the
	 * buyer next opens the confirmation page.
	 *
	 * @param WC_Order|false $order Order.
	 */
	public function create_account_for_paid_order( $order ) {
		if ( ! $order instanceof WC_Order || ! $order->is_paid() || $order->get_customer_id() ) {
			return;
		}
		if ( ! $order->get_meta( self::META_GUEST ) || $order->get_meta( self::META_DONE ) ) {
			return;
		}

		$in_session = $this->is_buyer_session( $order );
		$mobile     = self::normalize_mobile( $order->get_billing_phone() );

		$order->update_meta_data( self::META_DONE, 1 );
		$order->save_meta_data();

		if ( '' === $mobile ) {
			return;
		}

		// An account with this number already exists: never attach the order
		// to it; the confirmation page suggests signing in.
		if ( username_exists( $mobile ) ) {
			if ( $in_session ) {
				$this->remember(
					array(
						'order_id' => $order->get_id(),
						'existing' => true,
					)
				);
			}
			return;
		}

		$password = self::generate_password();
		$email    = $order->get_billing_email();
		if ( ! is_email( $email ) || email_exists( $email ) ) {
			$email = ''; // WordPress allows accounts without email; the customer can add one later.
		}

		$first = $order->get_billing_first_name();
		$last  = $order->get_billing_last_name();

		$user_id = wp_insert_user(
			array(
				'user_login'   => $mobile,
				'user_pass'    => $password,
				'user_email'   => $email,
				'first_name'   => $first,
				'last_name'    => $last,
				'display_name' => trim( $first . ' ' . $last ) ? trim( $first . ' ' . $last ) : $mobile,
				'role'         => 'customer',
			)
		);

		if ( is_wp_error( $user_id ) ) {
			wc_get_logger()->warning( 'Could not create an account for order ' . $order->get_id() . ': ' . $user_id->get_error_message(), array( 'source' => 'sofreh-phone-accounts' ) );
			return;
		}

		update_user_meta( $user_id, self::META_INCOMPLETE, 1 );

		// Save the checkout addresses to the new account.
		$customer = new WC_Customer( $user_id );
		foreach ( array( 'billing', 'shipping' ) as $type ) {
			foreach ( array( 'first_name', 'last_name', 'company', 'address_1', 'address_2', 'city', 'state', 'postcode', 'country', 'phone' ) as $field ) {
				$getter = "get_{$type}_{$field}";
				$setter = "set_{$type}_{$field}";
				if ( is_callable( array( $order, $getter ) ) && is_callable( array( $customer, $setter ) ) ) {
					$customer->{$setter}( $order->{$getter}() );
				}
			}
		}
		if ( $email ) {
			$customer->set_billing_email( $email );
		}
		$customer->save();

		$order->set_customer_id( $user_id );
		if ( ! $in_session ) {
			$order->update_meta_data( self::META_REVEAL, 1 );
		}
		$order->add_order_note( __( 'Payment confirmed: customer account created automatically from the mobile number.', 'sofreh-phone-accounts' ) );
		$order->save();

		/** This action is documented in woocommerce/includes/wc-user-functions.php */
		do_action(
			'woocommerce_created_customer',
			$user_id,
			array(
				'user_login' => $mobile,
				'user_email' => $email,
				'role'       => 'customer',
				'source'     => 'sofreh-phone-checkout',
			),
			true
		);

		if ( $in_session ) {
			$this->sign_in_and_remember( $order, $user_id, $mobile, $password );
		}
	}

	/**
	 * Confirmation page, before anything is printed: create the account if
	 * the order is paid but the paid hooks ran before this browser was
	 * recognised, and reveal an account created while the buyer was away.
	 * Only for the browser session that placed the order, with its order key.
	 */
	public function on_confirmation_page() {
		if ( ! function_exists( 'is_order_received_page' ) || ! is_order_received_page() ) {
			return;
		}
		global $wp;
		$order = wc_get_order( absint( isset( $wp->query_vars['order-received'] ) ? $wp->query_vars['order-received'] : 0 ) );
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- The order key is the capability, as in WooCommerce.
		$key = isset( $_GET['key'] ) ? sanitize_text_field( wp_unslash( $_GET['key'] ) ) : '';
		if ( ! $order || ! is_string( $key ) || ! hash_equals( $order->get_order_key(), $key ) || ! $this->is_buyer_session( $order ) ) {
			return;
		}

		$this->create_account_for_paid_order( $order );

		if ( ! $order->get_meta( self::META_REVEAL ) || ! $this->is_buyer_session( $order ) ) {
			return;
		}
		$user = get_userdata( $order->get_customer_id() );
		if ( ! $user || ! in_array( 'customer', (array) $user->roles, true ) ) {
			return;
		}
		// Nobody has seen this password yet: set a fresh one now and show it.
		$password = self::generate_password();
		wp_set_password( $password, $user->ID );
		$order->delete_meta_data( self::META_REVEAL );
		$order->save_meta_data();
		$this->sign_in_and_remember( $order, $user->ID, $user->user_login, $password );
	}

	/**
	 * Sign the new customer in and keep the login details for the
	 * confirmation page.
	 *
	 * @param WC_Order $order    Order.
	 * @param int      $user_id  User ID.
	 * @param string   $username Username.
	 * @param string   $password Password.
	 */
	private function sign_in_and_remember( $order, $user_id, $username, $password ) {
		// Sign the customer in, as WooCommerce does for accounts created at
		// checkout. Without this, WooCommerce (8.4+) would hide the order
		// confirmation page behind a login form.
		wc_set_customer_auth_cookie( $user_id );

		// Remember the credentials only after signing in: signing in moves the
		// session from the guest ID to the user ID.
		$this->remember(
			array(
				'order_id' => $order->get_id(),
				'username' => $username,
				'password' => $password,
				'expires'  => time() + self::SHOW_PASSWORD_FOR,
			)
		);
	}

	/**
	 * Store data in the customer's session.
	 *
	 * @param array $data Data.
	 */
	private function remember( $data ) {
		if ( WC()->session ) {
			WC()->session->set( self::SESSION_KEY, $data );
		}
	}

	/**
	 * A readable random password (no 0/O, 1/l/I look-alikes).
	 *
	 * @param int $length Length.
	 * @return string
	 */
	public static function generate_password( $length = 10 ) {
		$chars = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789';
		$max   = strlen( $chars ) - 1;
		do {
			$password = '';
			for ( $i = 0; $i < $length; $i++ ) {
				$password .= $chars[ random_int( 0, $max ) ];
			}
		} while ( ! preg_match( '/\d/', $password ) || ! preg_match( '/[a-z]/', $password ) || ! preg_match( '/[A-Z]/', $password ) );
		return $password;
	}

	/*
	 * ---------------------------------------------------------------------
	 * 3. Order confirmation page
	 * ---------------------------------------------------------------------
	 */

	/**
	 * Tracking code, with the account confirmation and login details beside it.
	 *
	 * @param int $order_id Order ID.
	 */
	public function render_confirmation( $order_id ) {
		$order = wc_get_order( $order_id );
		if ( ! $order ) {
			return;
		}

		$stash       = WC()->session ? WC()->session->get( self::SESSION_KEY ) : null;
		$stash       = ( is_array( $stash ) && (int) $stash['order_id'] === (int) $order->get_id() ) ? $stash : null;
		$credentials = null;

		if ( $stash && ! empty( $stash['password'] ) ) {
			$user = wp_get_current_user();
			if ( $stash['expires'] > time() && $user->exists() && $user->user_login === $stash['username'] && (int) $order->get_customer_id() === $user->ID ) {
				$credentials = $stash;
			} else {
				WC()->session->set( self::SESSION_KEY, null ); // Expired or not this customer: forget it.
			}
		}

		$guest_order = (bool) $order->get_meta( self::META_GUEST );
		$state       = '';
		if ( $credentials ) {
			$state = 'created';
		} elseif ( $stash && ! empty( $stash['existing'] ) ) {
			$state = 'existing';
		} elseif ( $guest_order && $order->get_customer_id() && get_current_user_id() === (int) $order->get_customer_id() ) {
			$state = 'created-earlier';
		} elseif ( $guest_order && ! $order->get_customer_id() && ! $order->is_paid() && ! $order->has_status( array( 'failed', 'cancelled', 'refunded' ) ) ) {
			$state = 'awaiting';
		}

		$tracking_url = $this->tracking_url();
		$account_url  = wc_get_page_permalink( 'myaccount' );
		?>
		<section class="sofreh-pa-card<?php echo $state ? ' sofreh-pa-card--split' : ''; ?>" aria-labelledby="sofreh-pa-title">
			<div class="sofreh-pa-card__row sofreh-pa-card__row--tracking">
				<div>
					<h2 id="sofreh-pa-title" class="sofreh-pa-card__title"><?php esc_html_e( 'Your order tracking code', 'sofreh-phone-accounts' ); ?></h2>
					<p class="sofreh-pa-card__help">
						<?php
						if ( $tracking_url ) {
							printf(
								/* translators: %s: link to the order tracking page. */
								wp_kses( __( 'Use it with your mobile number on the <a href="%s">order tracking page</a>.', 'sofreh-phone-accounts' ), array( 'a' => array( 'href' => true ) ) ),
								esc_url( $tracking_url )
							);
						} else {
							esc_html_e( 'Keep it to follow up on your order.', 'sofreh-phone-accounts' );
						}
						?>
					</p>
				</div>
				<?php $this->copy_value( $order->get_order_number(), __( 'Copy tracking code', 'sofreh-phone-accounts' ), 'sofreh-pa-value--large' ); ?>
			</div>

			<?php if ( 'created' === $state ) : ?>
				<div class="sofreh-pa-card__row sofreh-pa-card__row--account" role="status">
					<h3 class="sofreh-pa-card__subtitle sofreh-pa-card__subtitle--done"><?php esc_html_e( 'Your account has been created', 'sofreh-phone-accounts' ); ?></h3>
					<p class="sofreh-pa-card__help"><?php esc_html_e( 'Your payment was confirmed and you are signed in. Use these details to sign in next time, then complete your account information whenever you like.', 'sofreh-phone-accounts' ); ?></p>
					<dl class="sofreh-pa-credentials">
						<div>
							<dt><?php esc_html_e( 'Username (your mobile number)', 'sofreh-phone-accounts' ); ?></dt>
							<dd><?php $this->copy_value( $credentials['username'], __( 'Copy username', 'sofreh-phone-accounts' ) ); ?></dd>
						</div>
						<div>
							<dt><?php esc_html_e( 'Password', 'sofreh-phone-accounts' ); ?></dt>
							<dd><?php $this->copy_value( $credentials['password'], __( 'Copy password', 'sofreh-phone-accounts' ) ); ?></dd>
						</div>
					</dl>
					<p class="sofreh-pa-card__warning">
						<?php
						printf(
							/* translators: %s: number of minutes. */
							esc_html__( 'Write the password down or save it now: for your security it is shown only on this page, for %s minutes, and is never sent by email or text message.', 'sofreh-phone-accounts' ),
							esc_html( number_format_i18n( self::SHOW_PASSWORD_FOR / 60 ) )
						);
						?>
					</p>
					<p class="sofreh-pa-card__actions">
						<a class="button" href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>"><?php esc_html_e( 'Complete your account', 'sofreh-phone-accounts' ); ?></a>
						<a class="button button--ghost" href="<?php echo esc_url( $account_url ); ?>"><?php esc_html_e( 'Go to my account', 'sofreh-phone-accounts' ); ?></a>
					</p>
				</div>
			<?php elseif ( 'created-earlier' === $state ) : ?>
				<div class="sofreh-pa-card__row sofreh-pa-card__row--account">
					<h3 class="sofreh-pa-card__subtitle sofreh-pa-card__subtitle--done"><?php esc_html_e( 'Your account has been created', 'sofreh-phone-accounts' ); ?></h3>
					<p class="sofreh-pa-card__help">
						<?php
						printf(
							/* translators: %s: the customer's mobile number (username). */
							esc_html__( 'This order is saved in your account. Sign in with %s and your password.', 'sofreh-phone-accounts' ),
							'<bdi dir="ltr">' . esc_html( wp_get_current_user()->user_login ) . '</bdi>' // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in place.
						);
						?>
					</p>
					<p class="sofreh-pa-card__actions">
						<a class="button" href="<?php echo esc_url( $account_url ); ?>"><?php esc_html_e( 'Go to my account', 'sofreh-phone-accounts' ); ?></a>
					</p>
				</div>
			<?php elseif ( 'existing' === $state ) : ?>
				<div class="sofreh-pa-card__row sofreh-pa-card__row--account">
					<h3 class="sofreh-pa-card__subtitle"><?php esc_html_e( 'You already have an account', 'sofreh-phone-accounts' ); ?></h3>
					<p class="sofreh-pa-card__help">
						<?php
						printf(
							/* translators: %s: link to the account page. */
							wp_kses( __( 'If you already have an account with this mobile number, <a href="%s">sign in</a> to see your orders there.', 'sofreh-phone-accounts' ), array( 'a' => array( 'href' => true ) ) ),
							esc_url( $account_url )
						);
						?>
					</p>
				</div>
			<?php elseif ( 'awaiting' === $state ) : ?>
				<div class="sofreh-pa-card__row sofreh-pa-card__row--account">
					<h3 class="sofreh-pa-card__subtitle sofreh-pa-card__subtitle--waiting"><?php esc_html_e( 'Your account is created after payment', 'sofreh-phone-accounts' ); ?></h3>
					<p class="sofreh-pa-card__help"><?php esc_html_e( 'As soon as your payment is confirmed, an account is created with your mobile number. Open this page again in this browser to see your login details.', 'sofreh-phone-accounts' ); ?></p>
				</div>
			<?php endif; ?>
		</section>
		<?php
	}

	/**
	 * A value with a copy button.
	 *
	 * @param string $value Value.
	 * @param string $label Accessible label for the copy button.
	 * @param string $extra_class Extra class.
	 */
	private function copy_value( $value, $label, $extra_class = '' ) {
		?>
		<span class="sofreh-pa-value <?php echo esc_attr( $extra_class ); ?>">
			<code dir="ltr" translate="no"><?php echo esc_html( $value ); ?></code>
			<button type="button" class="sofreh-pa-copy" data-copy="<?php echo esc_attr( $value ); ?>" aria-label="<?php echo esc_attr( $label ); ?>">
				<span class="sofreh-pa-copy__idle"><?php esc_html_e( 'Copy', 'sofreh-phone-accounts' ); ?></span>
				<span class="sofreh-pa-copy__done" aria-hidden="true"><?php esc_html_e( 'Copied', 'sofreh-phone-accounts' ); ?></span>
			</button>
		</span>
		<?php
	}

	/**
	 * Copy-button script and fallback styles on the pages that need them.
	 */
	public function enqueue_assets() {
		$needs = is_order_received_page() || ( is_singular() && has_shortcode( (string) get_post_field( 'post_content', get_queried_object_id() ), 'sofreh_order_tracking' ) );
		if ( ! $needs ) {
			return;
		}
		wp_enqueue_style( 'sofreh-pa', SOFREH_PA_URL . 'assets/sofreh-phone-accounts.css', array(), SOFREH_PA_VERSION );
		wp_enqueue_script(
			'sofreh-pa',
			SOFREH_PA_URL . 'assets/sofreh-phone-accounts.js',
			array(),
			SOFREH_PA_VERSION,
			array(
				'in_footer' => true,
				'strategy'  => 'defer',
			)
		);
		wp_localize_script( 'sofreh-pa', 'sofrehPA', array( 'copied' => __( 'Copied to clipboard', 'sofreh-phone-accounts' ) ) );
	}

	/*
	 * ---------------------------------------------------------------------
	 * 4. Signing in and completing the account
	 * ---------------------------------------------------------------------
	 */

	/**
	 * Accept the mobile number in any common form at sign-in (Persian digits,
	 * +98, spaces) by mapping it to the stored username.
	 *
	 * @param string $username Username, by reference.
	 */
	public function normalize_login( &$username ) {
		if ( ! is_string( $username ) || '' === $username || false !== strpos( $username, '@' ) ) {
			return;
		}
		$mobile = self::normalize_mobile( $username );
		if ( '' !== $mobile && $mobile !== $username && username_exists( $mobile ) ) {
			$username = $mobile;
		}
	}

	/**
	 * The login form's "Username or email address" label names what customers
	 * actually type here: their mobile number (the username) or their email.
	 *
	 * @param string $translation Translated text.
	 * @param string $text        Original text.
	 * @return string
	 */
	public function login_label( $translation, $text ) {
		if ( 'Username or email address' === $text ) {
			return __( 'Mobile number or email', 'sofreh-phone-accounts' );
		}
		// The sign-up form's heading and button: "Create account".
		if ( 'Register' === $text ) {
			return __( 'Create account', 'sofreh-phone-accounts' );
		}
		return $translation;
	}

	/**
	 * Hint above the login form.
	 */
	public function login_hint() {
		echo '<p class="sofreh-pa-hint">' . esc_html__( 'Bought with your mobile number? Sign in with that number and the password shown after your purchase.', 'sofreh-phone-accounts' ) . '</p>';
	}

	/**
	 * Remind new customers to complete their account.
	 */
	public function dashboard_notice() {
		if ( ! get_user_meta( get_current_user_id(), self::META_INCOMPLETE, true ) ) {
			return;
		}
		printf(
			'<div class="woocommerce-info sofreh-pa-complete">%1$s <a class="button" href="%2$s">%3$s</a></div>',
			esc_html__( 'Your account was created with your mobile number. Add your name and email and choose your own password.', 'sofreh-phone-accounts' ),
			esc_url( wc_get_account_endpoint_url( 'edit-account' ) ),
			esc_html__( 'Complete account', 'sofreh-phone-accounts' )
		);
	}

	/**
	 * Account details saved: the account is complete.
	 *
	 * @param int $user_id User ID.
	 */
	public function mark_complete( $user_id ) {
		delete_user_meta( $user_id, self::META_INCOMPLETE );
	}

	/*
	 * ---------------------------------------------------------------------
	 * 5. Manual sign-up
	 * ---------------------------------------------------------------------
	 */

	/**
	 * The posted mobile number on the registration form, normalized ('' when
	 * absent or invalid).
	 *
	 * @return string
	 */
	private function posted_register_mobile() {
		// phpcs:ignore WordPress.Security.NonceVerification.Missing -- WooCommerce verifies the registration nonce before these hooks run.
		$raw = isset( $_POST['sofreh_pa_mobile'] ) ? sanitize_text_field( wp_unslash( $_POST['sofreh_pa_mobile'] ) ) : '';
		return self::normalize_mobile( $raw );
	}

	/**
	 * Link to "Create account" on the My Account page; after signing up (or
	 * signing in there) the customer comes back to $return.
	 *
	 * @param string $return_url Page to return to.
	 * @return string
	 */
	public static function create_account_url( $return_url = '' ) {
		$url = add_query_arg( 'action', 'register', wc_get_page_permalink( 'myaccount' ) );
		if ( $return_url ) {
			$url = add_query_arg( 'redirect_to', rawurlencode( $return_url ), $url );
		}
		return $url;
	}

	/**
	 * Send the customer back where they came from (for example the checkout)
	 * after signing in or creating an account. Only addresses on this site.
	 */
	public function return_field() {
		if ( is_checkout() ) {
			return; // The checkout's own login form already returns to the checkout.
		}
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only return address, validated below.
		$target = isset( $_GET['redirect_to'] ) ? wp_validate_redirect( esc_url_raw( wp_unslash( $_GET['redirect_to'] ) ), '' ) : '';
		if ( $target ) {
			echo '<input type="hidden" name="redirect" value="' . esc_url( $target ) . '">';
		}
	}

	/**
	 * The account choice, shown at checkout to signed-out customers.
	 *
	 * @return string
	 */
	private function checkout_account_notice_html() {
		if ( is_user_logged_in() || 'yes' !== get_option( 'woocommerce_enable_myaccount_registration' ) ) {
			return '';
		}
		$link = sprintf(
			'<a class="sofreh-pa-create-link" href="%1$s">%2$s</a>',
			esc_url( self::create_account_url( wc_get_checkout_url() ) ),
			esc_html__( 'Create account', 'sofreh-phone-accounts' )
		);
		return '<div class="woocommerce-info sofreh-pa-checkout-account" role="note">' . sprintf(
			/* translators: %s: "Create account" link. */
			esc_html__( 'No account yet? %s first, or simply place your order: once your payment is confirmed, an account is created for you with your mobile number.', 'sofreh-phone-accounts' ),
			$link
		) . '</div>';
	}

	/**
	 * Classic checkout: the account choice above the form.
	 */
	public function checkout_account_notice() {
		echo $this->checkout_account_notice_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped while building.
	}

	/**
	 * Checkout block: the same account choice above the block.
	 *
	 * @param string $content Block HTML.
	 * @return string
	 */
	public function block_checkout_account_notice( $content ) {
		return $this->checkout_account_notice_html() . $content;
	}

	/**
	 * Mobile number field at the top of the registration form.
	 */
	public function register_mobile_field() {
		// phpcs:ignore WordPress.Security.NonceVerification.Missing -- Only re-fills the field after a failed submit.
		$value = isset( $_POST['sofreh_pa_mobile'] ) ? sanitize_text_field( wp_unslash( $_POST['sofreh_pa_mobile'] ) ) : '';
		?>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide sofreh-pa-register-mobile">
			<label for="reg_sofreh_pa_mobile"><?php esc_html_e( 'Mobile number', 'sofreh-phone-accounts' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'sofreh-phone-accounts' ); ?></span></label>
			<input type="tel" class="woocommerce-Input woocommerce-Input--text input-text" name="sofreh_pa_mobile" id="reg_sofreh_pa_mobile" autocomplete="tel" inputmode="tel" placeholder="09121234567" value="<?php echo esc_attr( $value ); ?>" required aria-required="true" aria-describedby="reg_sofreh_pa_mobile_desc">
			<span class="description" id="reg_sofreh_pa_mobile_desc"><?php esc_html_e( 'You will sign in with this number.', 'sofreh-phone-accounts' ); ?></span>
		</p>
		<?php
	}

	/**
	 * Validate the mobile number on registration.
	 *
	 * @param WP_Error $errors Errors.
	 * @return WP_Error
	 */
	public function register_validate( $errors ) {
		$mobile = $this->posted_register_mobile();
		if ( '' === $mobile ) {
			$errors->add( 'sofreh_pa_mobile', $this->invalid_mobile_message() );
		} elseif ( username_exists( $mobile ) ) {
			$errors->add( 'sofreh_pa_mobile_taken', __( 'An account with this mobile number already exists. Please sign in instead.', 'sofreh-phone-accounts' ) );
		}
		return $errors;
	}

	/**
	 * Use the mobile number as the username for accounts created on the
	 * registration form.
	 *
	 * @param array $data New customer data.
	 * @return array
	 */
	public function register_username( $data ) {
		// phpcs:ignore WordPress.Security.NonceVerification.Missing -- WooCommerce verified the registration nonce.
		if ( empty( $_POST['register'] ) ) {
			return $data;
		}
		$mobile = $this->posted_register_mobile();
		if ( '' !== $mobile && ! username_exists( $mobile ) ) {
			$data['user_login'] = $mobile;
		}
		return $data;
	}

	/**
	 * Save the mobile number to the new account's billing phone.
	 *
	 * @param int $user_id User ID.
	 */
	public function register_save_phone( $user_id ) {
		// phpcs:ignore WordPress.Security.NonceVerification.Missing -- WooCommerce verified the registration nonce.
		if ( empty( $_POST['register'] ) ) {
			return;
		}
		$mobile = $this->posted_register_mobile();
		if ( '' !== $mobile ) {
			update_user_meta( $user_id, 'billing_phone', $mobile );
		}
	}

	/*
	 * ---------------------------------------------------------------------
	 * Order tracking
	 * ---------------------------------------------------------------------
	 */

	/**
	 * URL of the tracking page, if it exists.
	 *
	 * @return string
	 */
	private function tracking_url() {
		$page_id = (int) get_option( self::OPTION_TRACKING_PAGE );
		return ( $page_id && 'publish' === get_post_status( $page_id ) ) ? get_permalink( $page_id ) : '';
	}

	/**
	 * [sofreh_order_tracking]: look up an order by tracking code and mobile.
	 *
	 * Only status, date, total and item names are shown; addresses and other
	 * personal details never are.
	 *
	 * @return string
	 */
	public function tracking_shortcode() {
		$result = null;
		$error  = '';
		$code   = '';
		$phone  = '';

		if ( isset( $_POST['sofreh_pa_track_nonce'] ) ) {
			if ( ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['sofreh_pa_track_nonce'] ) ), 'sofreh_pa_track' ) ) {
				$error = __( 'The form has expired. Please try again.', 'sofreh-phone-accounts' );
			} else {
				$code  = isset( $_POST['sofreh_pa_code'] ) ? sanitize_text_field( wp_unslash( $_POST['sofreh_pa_code'] ) ) : '';
				$phone = isset( $_POST['sofreh_pa_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['sofreh_pa_phone'] ) ) : '';

				$mobile   = self::normalize_mobile( $phone );
				$order_id = absint( preg_replace( '/\D/', '', self::normalize_mobile_digits_only( $code ) ) );
				/** This filter is documented in woocommerce/includes/shortcodes/class-wc-shortcode-order-tracking.php */
				$order_id = absint( apply_filters( 'woocommerce_shortcode_order_tracking_order_id', $order_id ) );
				$order    = $order_id ? wc_get_order( $order_id ) : false;

				if ( $order instanceof WC_Order && '' !== $mobile && hash_equals( self::normalize_mobile( $order->get_billing_phone() ), $mobile ) ) {
					$result = $order;
				} else {
					$error = __( 'No order matches this tracking code and mobile number.', 'sofreh-phone-accounts' );
				}
			}
		}

		ob_start();
		?>
		<div class="sofreh-pa-tracking">
			<form method="post" class="sofreh-pa-tracking__form">
				<p class="sofreh-pa-tracking__intro"><?php esc_html_e( 'Enter the tracking code shown after your purchase and the mobile number you ordered with.', 'sofreh-phone-accounts' ); ?></p>
				<p class="form-row">
					<label for="sofreh-pa-code"><?php esc_html_e( 'Tracking code', 'sofreh-phone-accounts' ); ?></label>
					<input type="text" inputmode="numeric" id="sofreh-pa-code" name="sofreh_pa_code" value="<?php echo esc_attr( $code ); ?>" required autocomplete="off">
				</p>
				<p class="form-row">
					<label for="sofreh-pa-phone"><?php esc_html_e( 'Mobile number', 'sofreh-phone-accounts' ); ?></label>
					<input type="tel" id="sofreh-pa-phone" name="sofreh_pa_phone" value="<?php echo esc_attr( $phone ); ?>" placeholder="09121234567" required autocomplete="tel">
				</p>
				<?php wp_nonce_field( 'sofreh_pa_track', 'sofreh_pa_track_nonce' ); ?>
				<p><button type="submit" class="button"><?php esc_html_e( 'Track order', 'sofreh-phone-accounts' ); ?></button></p>
			</form>

			<?php if ( $error ) : ?>
				<div class="woocommerce-error" role="alert"><?php echo esc_html( $error ); ?></div>
			<?php endif; ?>

			<?php if ( $result ) : ?>
				<section class="sofreh-pa-result" aria-live="polite">
					<h2>
						<?php
						/* translators: %s: order number. */
						printf( esc_html__( 'Order %s', 'sofreh-phone-accounts' ), esc_html( $result->get_order_number() ) );
						?>
					</h2>
					<dl>
						<div><dt><?php esc_html_e( 'Status', 'sofreh-phone-accounts' ); ?></dt><dd><mark class="sofreh-pa-status sofreh-pa-status--<?php echo esc_attr( $result->get_status() ); ?>"><?php echo esc_html( wc_get_order_status_name( $result->get_status() ) ); ?></mark></dd></div>
						<div><dt><?php esc_html_e( 'Date', 'sofreh-phone-accounts' ); ?></dt><dd><?php echo esc_html( $result->get_date_created() ? wc_format_datetime( $result->get_date_created() ) : '' ); ?></dd></div>
						<div><dt><?php esc_html_e( 'Total', 'sofreh-phone-accounts' ); ?></dt><dd><?php echo wp_kses_post( $result->get_formatted_order_total() ); ?></dd></div>
					</dl>
					<ul class="sofreh-pa-items">
						<?php foreach ( $result->get_items() as $item ) : ?>
							<li><?php echo esc_html( $item->get_name() ); ?> <span>× <?php echo esc_html( number_format_i18n( $item->get_quantity() ) ); ?></span></li>
						<?php endforeach; ?>
					</ul>
					<?php if ( is_user_logged_in() && get_current_user_id() === (int) $result->get_customer_id() ) : ?>
						<p><a class="button button--ghost" href="<?php echo esc_url( $result->get_view_order_url() ); ?>"><?php esc_html_e( 'View full order', 'sofreh-phone-accounts' ); ?></a></p>
					<?php endif; ?>
				</section>
			<?php endif; ?>
		</div>
		<?php
		return (string) ob_get_clean();
	}

	/**
	 * Persian/Arabic digits to ASCII (for the tracking code field).
	 *
	 * @param string $value Value.
	 * @return string
	 */
	private static function normalize_mobile_digits_only( $value ) {
		$map = array();
		for ( $i = 0; $i <= 9; $i++ ) {
			$map[ html_entity_decode( '&#' . ( 0x06F0 + $i ) . ';', ENT_QUOTES, 'UTF-8' ) ] = (string) $i;
			$map[ html_entity_decode( '&#' . ( 0x0660 + $i ) . ';', ENT_QUOTES, 'UTF-8' ) ] = (string) $i;
		}
		return strtr( (string) $value, $map );
	}
}
```

### sofreh-phone-accounts/languages/sofreh-phone-accounts-fa_IR.po

```po
# Persian translation for Sofreh Phone Accounts.
# This file is distributed under the GNU General Public License v2 or later.
msgid ""
msgstr ""
"Project-Id-Version: Sofreh Phone Accounts 1.2.0\n"
"Report-Msgid-Bugs-To: https://wordpress.org/support/plugin/sofreh-phone-accounts\n"
"Last-Translator: FULL NAME <EMAIL@ADDRESS>\n"
"Language-Team: Persian\n"
"Language: fa_IR\n"
"MIME-Version: 1.0\n"
"Content-Type: text/plain; charset=UTF-8\n"
"Content-Transfer-Encoding: 8bit\n"
"Plural-Forms: nplurals=2; plural=(n > 1);\n"
"POT-Creation-Date: 2026-10-12T18:18:52+00:00\n"
"PO-Revision-Date: 2026-10-12 12:00+0330\n"
"X-Generator: WP-CLI 2.12.0\n"
"X-Domain: sofreh-phone-accounts\n"

#. Plugin Name of the plugin
#: sofreh-phone-accounts.php:3
msgid "Sofreh Phone Accounts"
msgstr "حساب کاربری با شماره موبایل (سفره)"

#. Plugin URI of the plugin
#: sofreh-phone-accounts.php:4
msgid "https://github.com/yns-nur/nur/tree/main/wp-theme/sofreh-phone-accounts"
msgstr "https://github.com/yns-nur/nur/tree/main/wp-theme/sofreh-phone-accounts"

#. Description of the plugin
#: sofreh-phone-accounts.php:5
msgid "Customers buy with just their mobile number, or create an account first. When a signed-out customer's order is paid, a customer account is created automatically, and the order confirmation page shows the order tracking code with the account confirmation and login details beside it (mobile number as username, plus a generated password). Adds an order-tracking form that works with order number and mobile number. Companion to the Sofreh theme, but works with any theme."
msgstr "مشتری فقط با شماره موبایل خرید می‌کند یا پیش از خرید حساب می‌سازد. وقتی سفارشِ مشتریِ واردنشده پرداخت شد، حساب کاربری به‌صورت خودکار ساخته می‌شود و صفحهٔ تأیید سفارش، کد پیگیری را همراه با تأیید ساخت حساب و اطلاعات ورود (شماره موبایل به‌عنوان نام کاربری و یک رمز عبور ساخته‌شده) در کنار هم نشان می‌دهد. فرم پیگیری سفارش با کد پیگیری و شماره موبایل نیز اضافه می‌شود. همراه پوستهٔ سفره، اما با هر پوسته‌ای کار می‌کند."

#. Author of the plugin
#: sofreh-phone-accounts.php:12
msgid "Younes Nur"
msgstr "یونس نور"

#: includes/class-sofreh-phone-accounts.php:161
msgid "Track your order"
msgstr "پیگیری سفارش"

#: includes/class-sofreh-phone-accounts.php:222
msgid "Please enter a valid mobile number, for example 09121234567. It becomes your username for signing in."
msgstr "لطفاً شماره موبایل معتبر وارد کنید، مثلاً 09121234567. این شماره نام کاربری شما برای ورود خواهد بود."

#: includes/class-sofreh-phone-accounts.php:253
#: includes/class-sofreh-phone-accounts.php:275
#: includes/class-sofreh-phone-accounts.php:938
#: includes/class-sofreh-phone-accounts.php:1057
msgid "Mobile number"
msgstr "شماره موبایل"

#: includes/class-sofreh-phone-accounts.php:256
msgid "Once your payment is confirmed, your account is created with this number and your password is shown on the confirmation page."
msgstr "پس از تأیید پرداخت، حساب کاربری شما با همین شماره ساخته می‌شود و رمز عبورتان در صفحهٔ تأیید سفارش نمایش داده می‌شود."

#: includes/class-sofreh-phone-accounts.php:486
msgid "Payment confirmed: customer account created automatically from the mobile number."
msgstr "پرداخت تأیید شد: حساب مشتری به‌صورت خودکار با شماره موبایل ساخته شد."

#: includes/class-sofreh-phone-accounts.php:646
msgid "Your order tracking code"
msgstr "کد پیگیری سفارش شما"

#. translators: %s: link to the order tracking page.
#: includes/class-sofreh-phone-accounts.php:652
#, php-format
msgid "Use it with your mobile number on the <a href=\"%s\">order tracking page</a>."
msgstr "با این کد و شماره موبایلتان در <a href=\"%s\">صفحهٔ پیگیری سفارش</a> وضعیت سفارش را ببینید."

#: includes/class-sofreh-phone-accounts.php:656
msgid "Keep it to follow up on your order."
msgstr "این کد را برای پیگیری سفارش نگه دارید."

#: includes/class-sofreh-phone-accounts.php:661
msgid "Copy tracking code"
msgstr "کپی کد پیگیری"

#: includes/class-sofreh-phone-accounts.php:666
#: includes/class-sofreh-phone-accounts.php:694
msgid "Your account has been created"
msgstr "حساب کاربری شما ساخته شد"

#: includes/class-sofreh-phone-accounts.php:667
msgid "Your payment was confirmed and you are signed in. Use these details to sign in next time, then complete your account information whenever you like."
msgstr "پرداخت شما تأیید شد و اکنون وارد حساب خود شده‌اید. دفعهٔ بعد با این اطلاعات وارد شوید و هر زمان خواستید اطلاعات حسابتان را کامل کنید."

#: includes/class-sofreh-phone-accounts.php:670
msgid "Username (your mobile number)"
msgstr "نام کاربری (شماره موبایل شما)"

#: includes/class-sofreh-phone-accounts.php:671
msgid "Copy username"
msgstr "کپی نام کاربری"

#: includes/class-sofreh-phone-accounts.php:674
msgid "Password"
msgstr "رمز عبور"

#: includes/class-sofreh-phone-accounts.php:675
msgid "Copy password"
msgstr "کپی رمز عبور"

#. translators: %s: number of minutes.
#: includes/class-sofreh-phone-accounts.php:682
#, php-format
msgid "Write the password down or save it now: for your security it is shown only on this page, for %s minutes, and is never sent by email or text message."
msgstr "همین حالا رمز عبور را یادداشت یا ذخیره کنید: برای امنیت شما فقط در همین صفحه و تا %s دقیقه نمایش داده می‌شود و هرگز با ایمیل یا پیامک فرستاده نمی‌شود."

#: includes/class-sofreh-phone-accounts.php:688
msgid "Complete your account"
msgstr "تکمیل اطلاعات حساب"

#: includes/class-sofreh-phone-accounts.php:689
#: includes/class-sofreh-phone-accounts.php:705
msgid "Go to my account"
msgstr "رفتن به حساب من"

#. translators: %s: the customer's mobile number (username).
#: includes/class-sofreh-phone-accounts.php:699
#, php-format
msgid "This order is saved in your account. Sign in with %s and your password."
msgstr "این سفارش در حساب کاربری شما ثبت شده است. با %s و رمز عبورتان وارد شوید."

#: includes/class-sofreh-phone-accounts.php:710
msgid "You already have an account"
msgstr "شما از قبل حساب کاربری دارید"

#. translators: %s: link to the account page.
#: includes/class-sofreh-phone-accounts.php:715
#, php-format
msgid "If you already have an account with this mobile number, <a href=\"%s\">sign in</a> to see your orders there."
msgstr "اگر از قبل با این شماره موبایل حساب کاربری دارید، برای دیدن سفارش‌هایتان <a href=\"%s\">وارد شوید</a>."

#: includes/class-sofreh-phone-accounts.php:723
msgid "Your account is created after payment"
msgstr "حساب کاربری پس از پرداخت ساخته می‌شود"

#: includes/class-sofreh-phone-accounts.php:724
msgid "As soon as your payment is confirmed, an account is created with your mobile number. Open this page again in this browser to see your login details."
msgstr "به‌محض تأیید پرداخت، حساب کاربری شما با شماره موبایلتان ساخته می‌شود. برای دیدن اطلاعات ورود، این صفحه را دوباره در همین مرورگر باز کنید."

#: includes/class-sofreh-phone-accounts.php:743
msgid "Copy"
msgstr "کپی"

#: includes/class-sofreh-phone-accounts.php:744
msgid "Copied"
msgstr "کپی شد"

#: includes/class-sofreh-phone-accounts.php:769
msgid "Copied to clipboard"
msgstr "در کلیپ‌بورد کپی شد"

#: includes/class-sofreh-phone-accounts.php:804
msgid "Mobile number or email"
msgstr "شماره موبایل یا ایمیل"

#: includes/class-sofreh-phone-accounts.php:808
#: includes/class-sofreh-phone-accounts.php:904
msgid "Create account"
msgstr "ساخت حساب"

#: includes/class-sofreh-phone-accounts.php:817
msgid "Bought with your mobile number? Sign in with that number and the password shown after your purchase."
msgstr "با شماره موبایل خرید کرده‌اید؟ با همان شماره و رمز عبوری که پس از خرید نمایش داده شد وارد شوید."

#: includes/class-sofreh-phone-accounts.php:829
msgid "Your account was created with your mobile number. Add your name and email and choose your own password."
msgstr "حساب شما با شماره موبایلتان ساخته شده است. نام و ایمیل خود را اضافه کنید و رمز عبور دلخواهتان را انتخاب کنید."

#: includes/class-sofreh-phone-accounts.php:831
msgid "Complete account"
msgstr "تکمیل حساب"

#. translators: %s: "Create account" link.
#: includes/class-sofreh-phone-accounts.php:908
#, php-format
msgid "No account yet? %s first, or simply place your order: once your payment is confirmed, an account is created for you with your mobile number."
msgstr "حساب کاربری ندارید؟ اول %s، یا همین حالا سفارش دهید: پس از تأیید پرداخت، حساب شما با شماره موبایلتان خودکار ساخته می‌شود."

#: includes/class-sofreh-phone-accounts.php:938
msgid "Required"
msgstr "الزامی"

#: includes/class-sofreh-phone-accounts.php:940
msgid "You will sign in with this number."
msgstr "با همین شماره وارد حساب کاربری می‌شوید."

#: includes/class-sofreh-phone-accounts.php:956
msgid "An account with this mobile number already exists. Please sign in instead."
msgstr "با این شماره موبایل قبلاً حساب کاربری ساخته شده است. لطفاً وارد شوید."

#: includes/class-sofreh-phone-accounts.php:1028
msgid "The form has expired. Please try again."
msgstr "اعتبار فرم تمام شده است. لطفاً دوباره تلاش کنید."

#: includes/class-sofreh-phone-accounts.php:1042
msgid "No order matches this tracking code and mobile number."
msgstr "سفارشی با این کد پیگیری و شماره موبایل پیدا نشد."

#: includes/class-sofreh-phone-accounts.php:1051
msgid "Enter the tracking code shown after your purchase and the mobile number you ordered with."
msgstr "کد پیگیری‌ای را که پس از خرید دریافت کردید و شماره موبایلی را که با آن سفارش دادید وارد کنید."

#: includes/class-sofreh-phone-accounts.php:1053
msgid "Tracking code"
msgstr "کد پیگیری"

#: includes/class-sofreh-phone-accounts.php:1061
msgid "Track order"
msgstr "پیگیری سفارش"

#. translators: %s: order number.
#: includes/class-sofreh-phone-accounts.php:1073
#, php-format
msgid "Order %s"
msgstr "سفارش %s"

#: includes/class-sofreh-phone-accounts.php:1077
msgid "Status"
msgstr "وضعیت"

#: includes/class-sofreh-phone-accounts.php:1078
msgid "Date"
msgstr "تاریخ"

#: includes/class-sofreh-phone-accounts.php:1079
msgid "Total"
msgstr "مبلغ کل"

#: includes/class-sofreh-phone-accounts.php:1087
msgid "View full order"
msgstr "مشاهدهٔ کامل سفارش"
```

### build.sh

```sh
#!/usr/bin/env sh
# Builds installable zips into wp-theme/dist/:
#   sofreh.zip                 -> Appearance → Themes → Add New → Upload
#   sofreh-phone-accounts.zip  -> Plugins → Add New → Upload
set -eu
cd "$(dirname "$0")"
rm -rf dist && mkdir -p dist
zip -qr dist/sofreh.zip sofreh -x '*.DS_Store'
zip -qr dist/sofreh-phone-accounts.zip sofreh-phone-accounts -x '*.DS_Store'
ls -l dist
```
