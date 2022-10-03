<?php
/**
 * The woocommerce sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bloginwp
 * @since 1.0.0
 */
if ( ! is_active_sidebar('shop-sidebar') ) {
	return;
}
dynamic_sidebar( 'shop-sidebar' );