<?php
/**
 * Hooks for template header
 *
 * @package Selfer
 * Custom scripts and styles on header
 *
 * @since  1.0
 */
function selfer_header_scripts_css() {	
	ob_start();
	get_template_part('/inc/frontend/helpers');	
	$custom_css_code = ob_get_clean(); 
	wp_add_inline_style( 'selfer-main-style', $custom_css_code );
}
add_action( 'wp_enqueue_scripts', 'selfer_header_scripts_css', 300 );
