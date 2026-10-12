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
