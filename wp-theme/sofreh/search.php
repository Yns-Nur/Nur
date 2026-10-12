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
