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
