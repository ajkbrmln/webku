<?php 
/**
 *  Selfer page meta box
 *
 * @package Selfer
 * @since 1.0
 */

class Selfer_Metabox {
 
	private static $instance = null;

	/**
	 * @since 1.0
	 */
	public static function get_instance() {
	    if ( ! self::$instance )
	       self::$instance = new self;
	    return self::$instance;
	}

	/**
	 * @since 1.0
	 */
	public function init(){
		add_action( 'plugins_loaded', array( $this, 'load_butterbean' ) );
        add_action( 'butterbean_register', array( $this, 'add_metabox' ), 10, 2 );
	}

	/**
	 * @since 1.0
	 */
	public function load_butterbean() {
        require_once plugin_dir_path( __FILE__ ) . 'butterbean/butterbean.php';
	}

	/**
	 * @since 1.0
	 */
	public function add_metabox( $butterbean, $post_type ) {
        // Post types to add the metabox to
        $post_type = array(
            'post',
            'page',
            'product',
            'elementor_library',
            'ae_global_templates',
        );
        
        $prefix = 'selfer_mb_';
        
        $butterbean->register_manager(
            $prefix . 'settings',
            array(
                'label'     => esc_html__( 'Custom Settings', 'selfer-core' ),
                'post_type' => $post_type,
                'context'   => 'normal',
                'priority'  => 'high'
            )
        ); 
        $manager = $butterbean->get_manager( $prefix . 'settings' );

        // layout
        $manager->register_section(
            $prefix . 'layout',
            array(
                'label' => esc_html__( 'Layout', 'selfer-core' ),
                'icon'  => 'dashicons-admin-generic'
            )
        );

        $manager->register_control(
            $prefix . 'header_part', // Same as setting name.
            array(
                'section' => $prefix . 'layout',
                'type'          => 'radio',
                'label'         => esc_html__( 'Header Part', 'selfer-core' ), 
                'choices'       => array(
                    'show'      => esc_html__( 'Show', 'selfer-core' ),
                    'hide'   => esc_html__( 'Hide', 'selfer-core' ), 
                ),
            )
        ); 
        $manager->register_setting(
            $prefix . 'header_part', // Same as control name.
            array(
                'sanitize_callback' => 'wp_filter_nohtml_kses',
                'default'           => 'show',
            )
        ); 

        $manager->register_control(
            $prefix . 'footer_part', // Same as setting name.
            array(
                'section' => $prefix . 'layout',
                'type'          => 'radio',
                'label'         => esc_html__( 'Footer Part', 'selfer-core' ), 
                'choices'       => array(
                    'show'      => esc_html__( 'Show', 'selfer-core' ),
                    'hide'   => esc_html__( 'Hide', 'selfer-core' ), 
                ),
            )
        ); 
        $manager->register_setting(
            $prefix . 'footer_part', // Same as control name.
            array(
                'sanitize_callback' => 'wp_filter_nohtml_kses',
                'default'           => 'show',
            )
        );

        $butterbean->register_manager(
            $prefix . 'service_settings',
            array(
                'label'     => esc_html__( 'Service Meta', 'selfer-core' ),
                'post_type' => 'service',
                'context'   => 'normal',
                'priority'  => 'high'
            )
        ); 
        $manager = $butterbean->get_manager( $prefix . 'service_settings' );

        // service_setting
        $manager->register_section(
            $prefix . 'service_setting',
            array(
                'label' => esc_html__( 'Service Content', 'selfer-core' ),
                'icon'  => 'dashicons-admin-generic'
            )
        );

        $manager->register_control(
            $prefix . 'service_icon', // Same as setting name.
            array(
                'section' => $prefix . 'service_setting',
                'type'          => 'text',
                'label'         => esc_html__( 'Service Icon', 'selfer-core' ),  
                'description'   => esc_html__( 'You can also add bootstrap class like: fa fa-facebook', 'selfer-core' ),  
            )
        ); 
        $manager->register_setting(
            $prefix . 'service_icon', // Same as control name.
            array(
                'sanitize_callback' => 'wp_filter_nohtml_kses',
                'default'           => 'gra-laptop',
            )
        ); 

        $manager->register_control(
            $prefix . 'short_title', // Same as setting name.
            array(
                'section' => $prefix . 'service_setting',
                'type'          => 'text',
                'label'         => esc_html__( 'Short Title', 'selfer-core' ),   
            )
        ); 
        $manager->register_setting(
            $prefix . 'short_title', // Same as control name.
            array(
                'sanitize_callback' => 'wp_filter_nohtml_kses',
                'default'           => esc_html__( 'Web Designing', 'selfer-core' ),
            )
        );

        $manager->register_control(
            $prefix . 'short_desc', // Same as setting name.
            array(
                'section' => $prefix . 'service_setting',
                'type'          => 'textarea',
                'label'         => esc_html__( 'Short Description', 'selfer-core' ),   
            )
        ); 
        $manager->register_setting(
            $prefix . 'short_desc', // Same as control name.
            array(
                'sanitize_callback' => 'wp_filter_nohtml_kses',
                'default'           => esc_html__( 'Her extensive perceived may any sincerity extremity', 'selfer-core' ),
            )
        ); 
 
		  
	}
}
 
Selfer_Metabox::get_instance()->init();