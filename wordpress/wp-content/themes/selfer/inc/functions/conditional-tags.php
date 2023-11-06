<?php
/**
 * Custom conditional tags for this theme.
 *
 * @package Selfer
 */

define( 'AURORA_ACTIVE_CF7', in_array( 'contact-form-7/wp-contact-form-7.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) );

/**
 * Demo Importer
 *
 * @package Selfer
 */

function selfer_theme_ocdi_import_files() {
    return array(
        array(
            'import_file_name'           =>     esc_html__('Selfer','selfer'),
            'import_file_url'            =>     esc_url('https://demo.softhopper.net/selfer-demo/demo-content.xml'),
            'import_widget_file_url'     =>     esc_url('https://demo.softhopper.net/selfer-demo/widgets.wie'),
            'import_customizer_file_url' =>     esc_url('https://demo.softhopper.net/selfer-demo/selfer-export.dat'),
            'import_preview_image_url'   =>     esc_url('https://demo.softhopper.net/selfer-demo/screenshot.png'),
            'import_notice'              =>     esc_html__( 'Before importing demo data you must have to install required plugins', 'selfer' ),
            'preview_url'                =>     esc_url('https://demo.softhopper.net/selfer/'),
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'selfer_theme_ocdi_import_files' );


function selfer_theme_ocdi_after_import_setup() {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'main-menu' => $main_menu->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'selfer_theme_ocdi_after_import_setup' );


function selfer_theme_ocdi_plugin_page_setup( $default_settings ) {
    $default_settings['parent_slug'] = 'themes.php';
    $default_settings['page_title']  = esc_html__( 'Selfer Demo Import' , 'selfer' );
    $default_settings['menu_title']  = esc_html__( 'Demo Importer' , 'selfer' );
    $default_settings['capability']  = 'import';
    $default_settings['menu_slug']   = 'selfer-one-click-demo-import';

    return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'selfer_theme_ocdi_plugin_page_setup' );