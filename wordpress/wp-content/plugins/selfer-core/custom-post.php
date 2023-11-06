<?php
/**
 *  Selfer Register Custom Post type
 *
 * @package Selfer
 * @since 1.0
 */
if ( ! function_exists( 'selfer_custom_posts' ) ) :
function selfer_custom_posts() {

    /* Portfolio Custom Post*/  
    $portfolio_label = array(
        'name' => esc_html_x('Portfolio', 'Post Type General Name', 'selfer'),
        'singular_name' => esc_html_x('Portfolio', 'Post Type Singular Name', 'selfer'),
        'menu_name' => esc_html__('Portfolio', 'selfer'),
        'parent_item_colon' => esc_html__('Parent Portfolio:', 'selfer'),
        'all_items' => esc_html__('All Portfolio', 'selfer'),
        'view_item' => esc_html__('View Portfolio', 'selfer'),
        'add_new_item' => esc_html__('Add New Portfolio', 'selfer'),
        'add_new' => esc_html__('New Portfolio', 'selfer'),
        'edit_item' => esc_html__('Edit Portfolio', 'selfer'),
        'update_item' => esc_html__('Update Portfolio', 'selfer'),
        'search_items' => esc_html__('Search Portfolio', 'selfer'),
        'not_found' => esc_html__('No portfolio found', 'selfer'),
        'not_found_in_trash' => esc_html__('No portfolio found in Trash', 'selfer'),
    );
    $portfolio_args = array(
        'label' => esc_html__('Portfolio', 'selfer'),
        'description' => esc_html__('Portfolio', 'selfer'),
        'labels' => $portfolio_label,
        'supports' => array('title', 'thumbnail', 'editor'),
        'taxonomies' => array('portfolio-category'),
        'hierarchical' => true,
        'show_in_rest' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-screenoptions',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'page',
        'rewrite' => array('slug' => 'portfolio'),
    );
    register_post_type('portfolio', $portfolio_args);   

    // Add new taxonomy, make it hierarchical (like categories) 
    $portfolio_cat_taxonomy_labels = array(
        'name'              => esc_html__( 'Portfolio Categories','selfer-core' ),
        'singular_name'     => esc_html__( 'Portfolio Categories','selfer-core' ),
        'search_items'      => esc_html__( 'Search Portfolio Category','selfer-core' ),
        'all_items'         => esc_html__( 'All Portfolio Category','selfer-core' ),
        'parent_item'       => esc_html__( 'Parent Portfolio Category','selfer-core' ),
        'parent_item_colon' => esc_html__( 'Parent Portfolio Category:','selfer-core' ),
        'edit_item'         => esc_html__( 'Edit Portfolio Category','selfer-core' ),
        'update_item'       => esc_html__( 'Update Portfolio Category','selfer-core' ),
        'add_new_item'      => esc_html__( 'Add New Portfolio Category','selfer-core' ),
        'new_item_name'     => esc_html__( 'New Portfolio Category Name','selfer-core' ),
        'menu_name'         => esc_html__( 'Portfolio Category','selfer-core' ),
    );    

    // Now register the portfolio taxonomy
    register_taxonomy('portfolio-category', array('portfolio'), array(
        'hierarchical' => true,
        'labels' => $portfolio_cat_taxonomy_labels,
        'query_var' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'has_archive' => true,
        'rewrite' => array( 'slug' => 'portfolio-category' ),
    ));   

    /* Service Custom Post*/  
    $service_label = array(
        'name' => esc_html_x('Service', 'Post Type General Name', 'selfer-core'),
        'singular_name' => esc_html_x('Service', 'Post Type Singular Name', 'selfer-core'),
        'menu_name' => esc_html__('Service', 'selfer-core'),
        'parent_item_colon' => esc_html__('Parent Service:', 'selfer-core'),
        'all_items' => esc_html__('All Services', 'selfer-core'),
        'view_item' => esc_html__('View Service', 'selfer-core'),
        'add_new_item' => esc_html__('Add New Service', 'selfer-core'),
        'add_new' => esc_html__('New Service', 'selfer-core'),
        'edit_item' => esc_html__('Edit Service', 'selfer-core'),
        'update_item' => esc_html__('Update Service', 'selfer-core'),
        'search_items' => esc_html__('Search Service', 'selfer-core'),
        'not_found' => esc_html__('No service found', 'selfer-core'),
        'not_found_in_trash' => esc_html__('No service found in Trash', 'selfer-core'),
    );
    $service_args = array(
        'label' => esc_html__('Service', 'selfer-core'),
        'description' => esc_html__('Service', 'selfer-core'),
        'labels' => $service_label,
        'supports' => array('title', 'editor', 'thumbnail'),
        'taxonomies' => array(),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-admin-tools',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('service', $service_args);  
    flush_rewrite_rules();
}
endif;
add_action('init', 'selfer_custom_posts', 0);

// Register Custom Post Type For Templates
function selfer_templates_cpt() {

    $labels = array(
        'name'                  => esc_html_x( 'Header/Footer', 'Post Type General Name', 'selfer-core' ),
        'singular_name'         => esc_html_x( 'Template', 'Post Type Singular Name', 'selfer-core' ),
        'add_new_item'          => esc_html__( 'Add New Template', 'selfer-core' ),
        'add_new'               => esc_html__( 'Add New Template', 'selfer-core' ),
        'new_item'              => esc_html__( 'Add New Template', 'selfer-core' ),
        'all_items'             => esc_html__( 'All Templates', 'jupiterx-core' ),
        'edit_item'             => esc_html__( 'Edit Template', 'selfer-core' ),
        'view_item'             => esc_html__( 'View Template', 'selfer-core' ),
        'search_items'          => esc_html__( 'Search Template', 'selfer-core' ),
        'not_found'             => esc_html__( 'No Templates Found', 'selfer-core' ),
        'not_found_in_trash'    => esc_html__( 'No Templates Found in Trash', 'selfer-core' ),
    );
    $args = array(
        'label'                 => esc_html__( 'Header/Footer', 'selfer-core' ),
        'description'           => esc_html__( 'Add a Template', 'selfer-core' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'elementor' ),
        'hierarchical'          => false,
        'show_in_nav_menus'     => false,
        'public'                => true,
        'menu_position'         => 22,
        'menu_icon'             => 'dashicons-feedback',
        'can_export'            => true,
        'capability_type'       => 'page',
        'rewrite' => array( 'slug' => 'selfer_templates' ),
    );
    register_post_type( 'selfer_templates', $args );
}

add_action( 'init', 'selfer_templates_cpt', 0);  

// Support Elementor Editor By Default
function selfer_elementor_post_type_support() {
    
    //if exists, assign to $cpt_support var
	$cpt_support = get_option( 'elementor_cpt_support' );
	
	//check if option DOESN'T exist in db
	if( ! $cpt_support ) {
	    $cpt_support = [ 'page', 'post', 'portfolio' ]; //create array of our default supported post types
	    update_option( 'elementor_cpt_support', $cpt_support ); //write it to the database
	} else if( ! in_array( 'portfolio', $cpt_support ) ) {
	    $cpt_support[] = 'portfolio'; //append to array
	    update_option( 'elementor_cpt_support', $cpt_support ); //update database
	}
	
	//otherwise do nothing, portfolio already exists in elementor_cpt_support option
}
add_action( 'init', 'selfer_elementor_post_type_support' );