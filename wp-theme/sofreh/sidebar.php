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
