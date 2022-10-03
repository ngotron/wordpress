<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bloginwp
 * @since 1.0.0
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<aside id="secondary" class="widget-area">
	<?php
		if ( class_exists( 'WooCommerce' ) ) {
			if( is_woocommerce() ) {
				get_sidebar( 'shop' );
			} else {
				dynamic_sidebar( 'sidebar-1' );
			}
		} else {
			dynamic_sidebar( 'sidebar-1' );
		}
	?>
</aside><!-- #secondary -->