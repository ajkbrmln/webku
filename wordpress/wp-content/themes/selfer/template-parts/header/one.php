<?php
/**
 * This template for displaying header part
 *
 * @package Selfer
 * @since 1.0
 */
/* ================================================== */

/**
 * Preloader
 * @package Selfer
 * @since 1.0
 */
selfer_preloader(); 

/**
 * Header Part show/hide condition
 * @package Selfer
 * @since 1.0
 */
if( get_post_meta( get_the_ID(), 'selfer_header_show_header', true) == 'no' ) {
    return;
}

/**
 * Header Sticky/Fixed Background Status
 * @package Selfer
 * @since 1.0
 */
if( get_post_meta( get_the_ID(), 'selfer_header_menu_sticky', true) == 'no' ) {
    $sticky_menu = '';
} else {
    $sticky_menu = 'fixed-top';
}

/**
 * Header Background Status
 * @package Selfer
 * @since 1.0
 */
if ( get_post_meta( get_the_ID(), 'selfer_header_status', true) == 'transparent') {
    $header_bg_class = 'transparent-bg';
} else {
    $header_bg_class = 'bg-lavender header-bg'; 
} ?>

<div class="ts-page-wrapper" id="page-top">
    <?php if( selfer_get_options('header_type') == 'custom_header' && selfer_get_options('header_templates') !== 'default' || get_post_meta( get_the_ID(), 'selfer_header_type', true) == 'elementor_header' &&  get_post_meta( get_the_ID(), 'selfer_header_template', true) !== 'default'  ) : ?>
        <header class="selfer-custom-header" itemscope="itemscope" itemtype="https://schema.org/WPHeader">
            <?php
                if( !empty(get_post_meta( get_the_ID(), 'selfer_header_template', true)) && get_post_meta( get_the_ID(), 'selfer_header_template', true) !== 'default'  ) {
                    $get_custom_headers = get_post_meta( get_the_ID(), 'selfer_header_template', true);
                } else {
                    $get_custom_headers = selfer_get_options('header_templates');
                }
                $args = array( 'post_type' => 'selfer_templates', 'p' => $get_custom_headers );

                $loop = new WP_Query( $args );
                    while ( $loop->have_posts() ) : $loop->the_post();
                        the_content();
                    endwhile;
                wp_reset_postdata();
            ?>
        </header><!--  /.selfer-custom-header -->
    <?php else :  ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-white <?php echo esc_attr($sticky_menu); ?>">
            <div class="container">
                <?php
                if ( get_post_meta( get_the_ID(), 'selfer_header_logo_main', true) !== false && get_post_meta( get_the_ID(), 'selfer_header_logo_main', true) !== "" ) { ?>
                <div class="site-logo main-logo navbar-brand ts-push-down__50 position-absolute ts-bottom__0 bg-white pb-0 ts-z-index__1 ts-scroll">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link">
                        <img src="<?php echo esc_url( get_post_meta( get_the_ID(), 'selfer_header_logo_main', true) ); ?>" alt="<?php echo esc_attr__('Site Logo', 'selfer'); ?>" />
                    </a>
                </div><!-- /.site-logo -->
                <?php } elseif ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) { ?>
                    <div class="site-logo main-logo navbar-brand ts-push-down__50 position-absolute ts-bottom__0 bg-white pb-0 ts-z-index__1 ts-scroll">
                        <?php the_custom_logo(); ?>
                    </div><!-- /.site-logo -->
                <?php } else { 
                    if ( function_exists( 'display_header_text' ) ) { 
                        if( display_header_text() == true ) { ?>
                        <div class="site-logo main-logo navbar-brand site-brands">
                            <div class="site-branding-text">
                                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

                                <?php $description = get_bloginfo( 'description', 'display' );
                                if ( $description || is_customize_preview() ) : ?>
                                <p class="site-description"><?php echo esc_html($description); ?></p>
                                <?php endif; ?>
                            </div><!-- .site-branding-text -->
                        </div><!-- /.site-logo -->
                        <?php }
                    }
                } ?>

                <!--end navbar-brand-->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!--end navbar-toggler-->
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav d-block d-lg-flex ml-auto text-right">
                        <?php
                            if( get_post_meta( get_the_ID(), 'selfer_header_page_menu', true) !=='0') {
                                wp_nav_menu ( array(
                                    'menu_class' => 'mainmenu',
                                    'container'=> 'ul',
                                    'menu' => get_post_meta( get_the_ID(), 'selfer_header_page_menu', true),
                                    'theme_location' => 'main-menu',  
                                )); 
                            } else {
                                wp_nav_menu ( array(
                                    'menu_class' => 'mainmenu',
                                    'container'=> 'ul',
                                    'theme_location' => 'main-menu',  
                                )); 
                            }
                        ?>
                    </div>
                    <!--end navbar-nav-->
                </div>
                <!--end collapse-->
            </div>
            <!--end container-->
        </nav>
    <?php endif; ?>
