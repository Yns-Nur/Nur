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
