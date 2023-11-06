<?php
/**
 *  Selfer Besic Theme Settings
 *
 * @since Selfer 1.0
 *
 * @return array selfer_customize_register
 *
*/
function selfer_customize_register( $wp_customize ) {
    //Basic Post Message Settings
    $wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'custom_logo' )->transport     = 'postMessage';

    // Changing for site Identity
    $wp_customize->selective_refresh->add_partial( 'blogname', array(
        'selector' => '.site-title a',
        'render_callback' => 'selfer_customize_partial_blogname',
    ));
    $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
        'selector' => '.site-description',
        'render_callback' => 'selfer_customize_partial_blogdescription',
    ));

    if( class_exists('Selfer_Customizer_Dimensions_Control') ) {
        /**
         * Blog Padding
         */
        $wp_customize->add_setting( 'selfer_options[logo_top_padding]', array(
            'transport'             => 'postMessage',
            'capability'            => 'edit_theme_options',
            'sanitize_callback'     => 'selfer_sanitize_number',
            'default'               => 20,
        ) );
        $wp_customize->add_setting( 'selfer_options[logo_bottom_padding]', array(
            'transport'             => 'postMessage',
            'capability'            => 'edit_theme_options',
            'sanitize_callback'     => 'selfer_sanitize_number',
            'default'               => 20,
        ) );

        $wp_customize->add_setting( 'selfer_options[logo_tablet_top_padding]', array(
            'transport'             => 'postMessage',
            'capability'            => 'edit_theme_options',
            'sanitize_callback'     => 'selfer_sanitize_number_blank',
            'default'               => 20,
        ) );
        $wp_customize->add_setting( 'selfer_options[logo_tablet_bottom_padding]', array(
            'transport'             => 'postMessage',
            'capability'            => 'edit_theme_options',
            'sanitize_callback'     => 'selfer_sanitize_number_blank',
            'default'               => 20,
        ) );

        $wp_customize->add_setting( 'selfer_options[logo_mobile_top_padding]', array(
            'transport'             => 'postMessage',
            'capability'            => 'edit_theme_options',
            'sanitize_callback'     => 'selfer_sanitize_number_blank',
            'default'               => 20,
        ) );
        $wp_customize->add_setting( 'selfer_options[logo_mobile_bottom_padding]', array(
            'transport'             => 'postMessage',
            'capability'            => 'edit_theme_options',
            'sanitize_callback'     => 'selfer_sanitize_number_blank',
            'default'               => 20,
        ) );

        $wp_customize->add_control( new Selfer_Customizer_Dimensions_Control( $wp_customize, 'selfer_options[logo_padding]', array(
            'label'                 => esc_html__( 'Logo Padding (px)', 'selfer' ),
            'section'               => 'title_tagline',             
            'settings'   => array(
                'desktop_top'       => 'selfer_options[logo_top_padding]',
                'desktop_bottom'    => 'selfer_options[logo_bottom_padding]',
                'tablet_top'        => 'selfer_options[logo_tablet_top_padding]',
                'tablet_bottom'     => 'selfer_options[logo_tablet_bottom_padding]',
                'mobile_top'        => 'selfer_options[logo_mobile_top_padding]',
                'mobile_bottom'     => 'selfer_options[logo_mobile_bottom_padding]',
            ),
            'priority'              => 20,
            'input_attrs'           => array(
                'min'   => 0,
                'max'   => 100,
                'step'  => 1,
            ),
        ) ) );
    }

    $wp_customize->add_setting( 'selfer_options[theme_color]' , array(
       'default'   => '#f26c4f',
       'capability' => 'edit_theme_options',
       'sanitize_callback' => 'sanitize_hex_color',
       'type'      =>  'theme_mod',
       'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'selfer_options[theme_color]', array(
           'label'    => esc_html__( 'Theme Color', 'selfer' ),
           'section'  => 'colors',
        ) 
    ));    

    $wp_customize->add_setting( 'selfer_options[header_bg_colors]' , array(
       'default'   => '#ffffff',
       'capability' => 'edit_theme_options',
       'sanitize_callback' => 'sanitize_hex_color',
       'type'      =>  'theme_mod',
    ));

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'selfer_options[header_bg_colors]', array(
           'label'    => esc_html__( 'Header Background', 'selfer' ),
           'section'  => 'colors',
        ) 
    ));        

    $wp_customize->add_setting( 'selfer_options[menu_color]' , array(
       'default'   => '#424242',
       'capability' => 'edit_theme_options',
       'sanitize_callback' => 'sanitize_hex_color',
       'type'      =>  'theme_mod',
       'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'selfer_options[menu_color]', array(
           'label'    => esc_html__( 'Menu Color', 'selfer' ),
           'section'  => 'colors',
        ) 
    ));      

    $wp_customize->add_setting( 'selfer_options[dropdown_menu_bg]' , array(
       'default'   => '#1d2023',
       'capability' => 'edit_theme_options',
       'sanitize_callback' => 'sanitize_hex_color',
       'type'      =>  'theme_mod',
       'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'selfer_options[dropdown_menu_bg]', array(
           'label'    => esc_html__( 'Dropdown Menu Background', 'selfer' ),
           'section'  => 'colors',
        ) 
    ));    

    $wp_customize->add_setting( 'selfer_options[dropdown_menu_color]' , array(
       'default'   => '#f7f7f7',
       'capability' => 'edit_theme_options',
       'sanitize_callback' => 'sanitize_hex_color',
       'type'      =>  'theme_mod',
       'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'selfer_options[dropdown_menu_color]', array(
           'label'    => esc_html__( 'Dropdown Menu Color', 'selfer' ),
           'section'  => 'colors',
        ) 
    ));

    $wp_customize->add_setting( 'selfer_options[footer_background]' , array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability' => 'edit_theme_options',
        'type'      =>  'theme_mod',
        'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'selfer_options[footer_background]', array(
           'label'    => esc_html__( 'Footer Background Color: ', 'selfer' ),
           'section'  => 'colors',
        ) 
    ));

    $wp_customize->add_setting( 'selfer_options[footer_color]' , array(
        'default'     => '#343a40',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability' => 'edit_theme_options',
        'type'      =>  'theme_mod',
        'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'selfer_options[footer_color]', array(
           'label'    => esc_html__( 'Footer Text Color: ', 'selfer' ),
           'section'  => 'colors',
        ) 
    ));    

    $wp_customize->add_setting( 'selfer_options[footer_link_color]' , array(
        'default'     => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability' => 'edit_theme_options',
        'type'      =>  'theme_mod',
        'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'selfer_options[footer_link_color]', array(
           'label'    => esc_html__( 'Footer Link Color: ', 'selfer' ),
           'section'  => 'colors',
        ) 
    ));

 
    /**
     * Selfer WordPress Theme General Settings
     */  
    $wp_customize->add_section( 'selfer_general_settings' , array(
        'title'      => esc_html__( 'General Settings', 'selfer' ),
        'priority'   => 28,
    ) ); 

    if ( class_exists( 'Selfer_Toggle_Control' ) ) {
        $wp_customize->add_setting( 'selfer_options[preloader]', array(
            'default'     => false,
            'transport'   => 'postMessage', 
            'sanitize_callback' => 'selfer_sanitize_checkbox',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control( new Selfer_Toggle_Control( $wp_customize, 
            'selfer_options[preloader]', 
            array(
                'label'  => esc_html__( 'Preloader:', 'selfer' ),
                'type'   => 'ios',
                'section'  => 'selfer_general_settings',
                'priority' => 10, 
                
            ) 
        ));            

        $wp_customize->add_setting( 'selfer_options[scroll_top_btn]', array(
            'default'     => true,
            'transport'   => 'postMessage', 
            'sanitize_callback' => 'selfer_sanitize_checkbox',
            'capability' => 'edit_theme_options',
        ));

        $wp_customize->add_control( new Selfer_Toggle_Control( $wp_customize, 
            'selfer_options[scroll_top_btn]', 
            array(
                'label'  => esc_html__( 'Scroll Top:', 'selfer' ),
                'type'   => 'ios',
                'section'  => 'selfer_general_settings',
                'priority' => 10, 
                
            ) 
        ));             
    }
    
    $wp_customize->add_setting( 'selfer_options[header_type]' , array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'selfer_sanitize_select',
        'default' => 'predefine_header',
    ));

    $wp_customize->add_control( 'selfer_options[header_type]', array(
        'label' => esc_html__( 'Header Type ', 'selfer' ),
        'description' => esc_html__( 'We had predefine header and header builder as well. if you don\'t like our header then you can build your header from switching Custom Header.', 'selfer' ),
        'section' => 'selfer_general_settings',
        'type' => 'select',
        'priority' => 10,
        'choices' => array(
            'predefine_header'  => esc_html__( 'Predefine Header', 'selfer' ),
            'custom_header'   => esc_html__( 'Custom Header', 'selfer' ),
        ),
    ));

    if( class_exists('Selfer_Elementor_Widget') ) {
        // Header Template
        $header_args = array( 
            'post_type' => 'selfer_templates', 
            'posts_per_page' => -1,
            'meta_key' => 'selfer_template_types',
            'meta_value'  => 'header',
            'meta_compare' => '>=',
            'orderby'      => 'meta_value',
            'order'        => 'ASC',
            'meta_query'   => array(
                'relation' => 'OR',
                array(
                    'key'     => 'selfer_template_types',
                    'value'   => 'header',
                    'compare' => '==',
                    'type'    => 'page',
                ),
            ),
        );
        
        $get_header = get_posts($header_args);
        $header_template = array();
        if( $get_header ) {
            foreach ($get_header as $value) {
                $header_template['default'] = esc_html__('Default', 'selfer');
                $header_template[$value->ID] = $value->post_title;
            }
        } else {
            $header_template['default'] = esc_html__('Default', 'selfer');
        }

        $wp_customize->add_setting( 'selfer_options[header_templates]' , array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'selfer_sanitize_select',
            'default' => 'default',
        ));

        $wp_customize->add_control( 'selfer_options[header_templates]', array(
            'label' => esc_html__( 'Custom Template', 'selfer' ),
            'section' => 'selfer_general_settings',
            'type' => 'select',
            'priority' => 10,
            'choices' => $header_template,
            'active_callback' => 'selfer_header_type_callback',
        ));
    }

    /**
     * Selfer WordPress Theme Blog Settings
     */ 
    $wp_customize->add_section( 'selfer_blog_settings' , array(
        'title'      => esc_html__( 'Blog Settings', 'selfer' ),
        'priority'   => 90,   
    ));

    if( class_exists('Selfer_Customizer_Dimensions_Control') ) {
        /**
         * Blog Padding
         */
        $wp_customize->add_setting( 'selfer_options[top_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'selfer_sanitize_number',
            'default'               => 195,
        ) );
        $wp_customize->add_setting( 'selfer_options[bottom_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'selfer_sanitize_number',
            'default'               => 135,
        ) );

        $wp_customize->add_setting( 'selfer_options[tablet_top_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'selfer_sanitize_number_blank',
            'default'               => 195,
        ) );
        $wp_customize->add_setting( 'selfer_options[tablet_bottom_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'selfer_sanitize_number_blank',
            'default'               => 135,
        ) );

        $wp_customize->add_setting( 'selfer_options[mobile_top_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'selfer_sanitize_number_blank',
            'default'               => 175,
        ) );
        $wp_customize->add_setting( 'selfer_options[mobile_bottom_padding]', array(
            'transport'             => 'postMessage',
            'sanitize_callback'     => 'selfer_sanitize_number_blank',
            'default'               => 135,
        ) );

        $wp_customize->add_control( new Selfer_Customizer_Dimensions_Control( $wp_customize, 'selfer_options[blog_padding]', array(
            'label'                 => esc_html__( 'Blog Padding (px)', 'selfer' ),
            'section'               => 'selfer_blog_settings',             
            'settings'   => array(
                'desktop_top'       => 'selfer_options[top_padding]',
                'desktop_bottom'    => 'selfer_options[bottom_padding]',
                'tablet_top'        => 'selfer_options[tablet_top_padding]',
                'tablet_bottom'     => 'selfer_options[tablet_bottom_padding]',
                'mobile_top'        => 'selfer_options[mobile_top_padding]',
                'mobile_bottom'     => 'selfer_options[mobile_bottom_padding]',
            ),
            'priority'              => 10,
            'input_attrs'           => array(
                'min'   => 0,
                'max'   => 400,
                'step'  => 1,
            ),
        ) ) );
    }

    if ( class_exists( 'Selfer_Customize_Control_Radio_Image' ) ) { 
        $sidebar_choices = array(
            'full'    => array(
                'url'   =>  get_theme_file_uri( '/inc/customizer/customizer-radio-image/img/full-width.png' ),
                'label' => esc_html__( 'Full Width', 'selfer' ),
            ),
            'left'  => array(
                'url'   => get_theme_file_uri( '/inc/customizer/customizer-radio-image/img/sidebar-left.png' ),
                'label' => esc_html__( 'Left Sidebar', 'selfer' ),
            ),
            'right' => array(
                'url'   => get_theme_file_uri( '/inc/customizer/customizer-radio-image/img/sidebar-right.png' ),
                'label' => esc_html__( 'Right Sidebar', 'selfer' ),
            ),
        );

        $wp_customize->add_setting( 'selfer_options[blog_sidebar_dispay]' , array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_key',
            'type'      =>  'theme_mod',
            'default' => 'right',
        ));

        $wp_customize->add_control(
            new Selfer_Customize_Control_Radio_Image(
                $wp_customize, 'selfer_options[blog_sidebar_dispay]', array(
                    'label'    => esc_html__( 'Blog Sidebar Layout', 'selfer' ),
                    'section'  => 'selfer_blog_settings',
                    'priority' => 10,
                    'choices'  => $sidebar_choices,
                )
            )
        );
    }

    $wp_customize->add_setting( 'selfer_options[excerpt_length]' , array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
        'type'      =>  'theme_mod',
        'default' => 25,
        'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 'selfer_options[excerpt_length]', array(
        'label' => esc_html__( 'Excerpt Length: ', 'selfer' ),
        'description' => esc_html__( 'How many words want to show per page?', 'selfer' ),
        'section' => 'selfer_blog_settings',
        'type'        => 'number',
        'priority' => 20,
        'input_attrs' => array(
            'min'  => 1,
            'max'   => 100,
            'step' => 1,
        ),
    ));


    /**
     * End Selfer WordPress Theme Footer Control Panel
     */
    $wp_customize->add_section( 'selfer_footer' , array(
        'title'      => esc_html__( 'Footer Settings', 'selfer' ),
        'priority'   => 100,   
    ));

    $wp_customize->add_setting(
        'selfer_options[footer_copyright_info]', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'selfer_sanitize_advance_html',
            'type'      =>  'theme_mod',
            'transport' => 'postMessage',
            'default'   => 'Copyright &copy; 2018 Selfer All rights Reserved. Developed By - <a href="#">SoftHopper</a>',
        )
    );

    $wp_customize->add_control(
        'selfer_options[footer_copyright_info]', array(
            'label' => esc_html__( 'Footer Copyright Text:', 'selfer' ),
            'type' => 'text',
            'priority' => 10,
            'section' => 'selfer_footer',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'selfer_options[footer_copyright_info]', array(
        'selector' => '.copyright-text', 
    ) );

    $wp_customize->add_setting( 'selfer_options[footer_type]' , array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'selfer_sanitize_select',
        'default' => 'predefine_footer',
    ));

    $wp_customize->add_control( 'selfer_options[footer_type]', array(
        'label' => esc_html__( 'Footer Type ', 'selfer' ),
        'description' => esc_html__( 'We had predefine footer and footer builder as well. if you don\'t like our footer then you can build your footer from switching Custom Header.', 'selfer' ),
        'section' => 'selfer_footer',
        'type' => 'select',
        'priority' => 20,
        'choices' => array(
            'predefine_footer'  => esc_html__( 'Predefine Footer', 'selfer' ),
            'custom_footer'   => esc_html__( 'Custom Footer', 'selfer' ),
        ),
    ));

    if( class_exists('selfer_Elementor_Widget') ) {
        // Footer Templates Query
        $footer_args = array( 
            'post_type' => 'selfer_templates', 
            'posts_per_page' => -1,
            'meta_key' => 'selfer_template_types',
            'meta_value'  => 'footer',
            'meta_compare' => '>=',
            'orderby'      => 'meta_value',
            'order'        => 'ASC',
            'meta_query'   => array(
                'relation' => 'OR',
                array(
                    'key'     => 'selfer_template_types',
                    'value'   => 'footer',
                    'compare' => '==',
                    'type'    => 'page',
                ),
            ),
        );

        $get_footer = get_posts($footer_args);
        $footer_template = array();
        if( $get_footer ) {
            foreach ($get_footer as $value) {
                $footer_template['default'] = esc_html__('Default', 'selfer');
                $footer_template[$value->ID] = $value->post_title;
            }
        } else {
            $footer_template['default'] = esc_html__('Default', 'selfer');
        }

        $wp_customize->add_setting( 'selfer_options[footer_templates]' , array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'selfer_sanitize_select',
            'default' => 'default',
        ));

        $args = array( 'post_type' => 'selfer_templates');

        $wp_customize->add_control( 'selfer_options[footer_templates]', array(
            'label' => esc_html__( 'Custom Template', 'selfer' ),
            'section' => 'selfer_footer',
            'type' => 'select',
            'priority' => 20,
            'choices' => $footer_template,
            'active_callback' => 'selfer_footer_type_callback',
        ));
    }

    /**
     * End Selfer WordPress Theme Footer Control Panel
     */    
}
add_action( 'customize_register', 'selfer_customize_register' );