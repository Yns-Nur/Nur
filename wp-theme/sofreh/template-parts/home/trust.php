<?php
/**
 * Home: store promises strip. Text comes from the Customizer; empty items are
 * hidden so the store never shows a promise it did not write.
 *
 * @package Sofreh
 */

defined( 'ABSPATH' ) || exit;

$sofreh_items = array();
foreach ( array(
	1 => 'truck',
	2 => 'shield',
	3 => 'return',
	4 => 'support',
) as $sofreh_n => $sofreh_icon ) {
	$sofreh_text = trim( (string) sofreh_option( 'trust_' . $sofreh_n ) );
	if ( '' !== $sofreh_text ) {
		$sofreh_items[] = array( $sofreh_icon, $sofreh_text );
	}
}

if ( empty( $sofreh_items ) ) {
	return;
}
?>
<section class="trust-strip" aria-label="<?php esc_attr_e( 'Store promises', 'sofreh' ); ?>">
	<ul class="container trust-strip__list">
		<?php foreach ( $sofreh_items as $sofreh_item ) : ?>
			<li><?php sofreh_icon( $sofreh_item[0], 28 ); ?><span><?php echo esc_html( $sofreh_item[1] ); ?></span></li>
		<?php endforeach; ?>
	</ul>
</section>
