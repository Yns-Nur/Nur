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
