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
