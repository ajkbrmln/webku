<?php 
if ( ! defined( 'ABSPATH' ) ) die( esc_html__( 'Direct access forbidden.', 'selfer' ) );

// enqueue styles
wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/assets/bootstrap/css/bootstrap.min.css' ) );
wp_enqueue_style( 'fontawesome', get_theme_file_uri( '/assets/font-awesome/css/fontawesome-all.min.css' ) );
wp_enqueue_style( 'magnific-popup', get_theme_file_uri( '/assets/css/magnific-popup.css' ) );
wp_enqueue_style( 'odometer-theme', get_theme_file_uri( '/assets/css/odometer-theme-default.css' ) ); 
wp_enqueue_style( 'owl-carousel', get_theme_file_uri( '/assets/css/owl.carousel.min.css' ) ); 
wp_enqueue_style( 'selfer-blogs', get_theme_file_uri( '/assets/css/blogs.css' ) ); 
wp_enqueue_style( 'selfer-style', get_theme_file_uri( '/assets/css/style.css' ) ); 
wp_enqueue_style( 'selfer-main-style', get_stylesheet_uri() ); 

// enqueue scripts
wp_enqueue_script( 'hero-banner', get_theme_file_uri( '/assets/js/custom.hero.js' ), array('jquery'), false, false);
wp_enqueue_script( 'popper', get_theme_file_uri( '/assets/js/popper.min.js' ), array('jquery'), false, true);
wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/assets/bootstrap/js/bootstrap.min.js' ), array('jquery'), false, true);
wp_enqueue_script( 'imagesloaded', get_theme_file_uri( '/assets/js/imagesloaded.pkgd.min.js' ), array('jquery'), false, true);
wp_enqueue_script( 'isotope', get_theme_file_uri( '/assets/js/isotope.pkgd.min.js' ), array('jquery'), false, true);
wp_enqueue_script( 'isInViewport', get_theme_file_uri( '/assets/js/isInViewport.jquery.js' ), array('jquery'), false, true);
wp_enqueue_script( 'magnific-popup', get_theme_file_uri( '/assets/js/jquery.magnific-popup.min.js' ), array('jquery'), false, true);
wp_enqueue_script( 'scrolla', get_theme_file_uri( '/assets/js/scrolla.jquery.min.js' ), array('jquery'), false, true);
wp_enqueue_script( 'odometer', get_theme_file_uri( '/assets/js/odometer.min.js' ), array('jquery'), false, true);
wp_enqueue_script( 'fitvids', get_theme_file_uri( '/assets/js/jquery.fitvids.js' ), array('jquery'), false, true);

wp_enqueue_script( 'owl-carousel', get_theme_file_uri( '/assets/js/owl.carousel.min.js' ), array('jquery'), false, true);
wp_enqueue_script( 'selfer-main', get_theme_file_uri( '/assets/js/custom.js' ), array('jquery'), false, true);

wp_enqueue_script('selfer-custom-js', get_theme_file_uri( '/assets/custom/custom.js' ), array('jquery'), false, true);

wp_localize_script('selfer-custom-js', 'selfer', array (
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
    )
);

if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
}
