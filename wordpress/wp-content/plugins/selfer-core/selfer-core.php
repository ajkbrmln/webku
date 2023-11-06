<?php
/*
Plugin Name: Selfer Core
Plugin URI: https://demo.softhopper.net/selfer
Description: This plugin is some component/shortcode/blocks and essential function for Selfer Creative Portfolio WordPress theme, To use Selfer theme properly you must install this plugin.
Author: SoftHopper
Version: 2.0.5
Author URI: https://softhopper.net/
Text Domain: selfer-core
*/

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit; 

// Plugin Path
define( 'SELFER_PLUGIN_PATH', ABSPATH . 'wp-content/plugins/selfer-core' );

// Plugin URL
define( 'SELFER_PLUGIN_URL', plugins_url( '', __FILE__ ) );

/**
 * Include language
 */
add_action( 'after_setup_theme', 'selfer_load_plugin_textdomain' );
function selfer_load_plugin_textdomain() {
	load_plugin_textdomain( 'selfer-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
/**
 * Include Functions
 */
require_once plugin_dir_path( __FILE__ ) . 'functions.php'; 
/**
 * Include Elementor Functions
 */
require_once plugin_dir_path( __FILE__ ) . 'elementor/functions.php';
/**
 * Include Custom Posts
 */ 
require_once plugin_dir_path( __FILE__ ) . 'custom-post.php';
/**
 * Include Metabox
 */
if ( is_admin() ) {
    require_once plugin_dir_path( __FILE__ ) . 'inc/metaboxes/metaboxes.php';
    //require_once plugin_dir_path( __FILE__ ) . 'inc/demo-import/one-click-demo-import.php';
}