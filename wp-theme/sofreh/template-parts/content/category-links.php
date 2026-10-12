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
