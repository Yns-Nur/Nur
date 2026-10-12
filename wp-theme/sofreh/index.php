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
