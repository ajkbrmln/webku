<?php 
if ( ! defined( 'ABSPATH' ) ) die( esc_html__( 'Direct access forbidden.', 'selfer' ) );

/*
 * Make theme available for translation.
 * Translations can be filed in the /languages/ directory.
 * If you're building a theme based on Selfer, use a find and replace
 * to change 'selfer' to the name of your theme in all the template files
 */
load_theme_textdomain( 'selfer', get_template_directory() . '/languages' );

/**
 * Add default posts and comments RSS feed links to head.
 * @package Selfer
 * @since 1.0
 */
add_theme_support( 'automatic-feed-links' );

/**
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 * @package Selfer
 * @since 1.0
 */
add_theme_support( 'title-tag' );

/**
 * Enable support for Post Thumbnails on posts and pages.
 * @package Selfer
 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
 * @since 1.0
 */
add_theme_support( 'post-thumbnails' );

/**
 * Enable support for register menu
 * @package Selfer
 * @since 1.0
 */
register_nav_menus( 
    array(
        'main-menu' => esc_html__( 'Main Menu', 'selfer' ),
    ) 
);

/**
 * Switch default core markup for search form, comment form, and comments to output valid HTML5.
 * @package Selfer
 * @since 1.0
 */
add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
    ) 
);

/**
 * Enable support for custom background.
 * @package Selfer
 * @since 1.0
 */
add_theme_support( 'custom-background', apply_filters( 'selfer_custom_background_args', array (
    'default-color' => 'fff',
    'default-image' => '',
) ) );

/**
 * Enable support for custom Header Image.
 * @package Selfer
 * @since 1.0
 */
$args = array(
    'flex-width'    => true,
    'width'         => 1920,
    'flex-height'    => true,
    'height'        => 932,
);
add_theme_support( 'custom-header', $args );

/**
 * Enable support for custom Logo Image.
 * @package Selfer
 * @since 1.0
 */
$selfer_cutom_logo = array(
    'height'      => 100,
    'width'       => 100,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
);
add_theme_support( 'custom-logo', $selfer_cutom_logo );

/** 
 * Enable selective refresh for widgets.
 *
 * @since 1.0
 */
add_theme_support( 'customize-selective-refresh-widgets' );

/**
 * Enable support for custom Editor Style.
 *
 * @since 1.0
 */
add_editor_style( 'assets/css/custom-editor-style.css' );

/** 
 * Enable WP Responsive embedded content
 *
 * @since 1.0
 */
add_theme_support( 'responsive-embeds' );

/** 
 * Enable WP Gutenberg Align Wide
 *
 * @since 1.0
 */
add_theme_support( 'align-wide' );


/** 
 * Enable WP Gutenberg Block Style
 *
 * @since 1.0
 */
add_theme_support( 'wp-block-styles' );

/**
 * Add Editor Style
 *
 * @since 1.0
 */
// Add support for editor styles.
add_theme_support( 'editor-styles' );

/**
 * Enable support for custom Editor Style.
 *
 * @since 1.0
 */
add_editor_style( 'editor-style.css' );

/**
 * Enable fonts Google font family
 *
 * @since 1.0
 */
// Enqueue fonts in the editor.
add_editor_style( selfer_enqueue_google_font_url( selfer_get_options( array('body_font', 'Open Sans' ) ) ) );
add_editor_style( selfer_enqueue_google_font_url( selfer_get_options( array('headings_font', 'Rubik' ) ) ) );

/** 
 * Enable Custom Color Scheme For Block Style
 *
 * @since 1.0
 */
add_theme_support( 'editor-color-palette', array(
    array(
        'name'  => 'strong blue',
        'slug'  => 'strong-blue',
        'color' => '#0073aa',
    ),
    array(
        'name'  => 'lighter blue',
        'slug'  => 'lighter-blue',
        'color' => '#229fd8',
    ),
    array(
        'name'  => 'very light gray',
        'slug'  => 'very-light-gray',
        'color' => '#eee',
    ),
    array(
        'name'  => 'very dark gray',
        'slug'  => 'very-dark-gray',
        'color' => '#444',
    )
) );