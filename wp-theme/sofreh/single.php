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
