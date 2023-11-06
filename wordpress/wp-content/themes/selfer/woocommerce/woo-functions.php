<?php 
/**
 * WooCommerce Functions
 *
 * @package Selfer
 * @since 1.0
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	/* Declare WooCommerce support */
	add_action( 'after_setup_theme', 'selfer_woocommerce_support' );
	function selfer_woocommerce_support() {
	    add_theme_support( 'woocommerce' );
	}
   
	/* Gallery Support */
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
