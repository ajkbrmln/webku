<?php 
/**
 *  Selfer Page Builder Shortcode
 *
 * @package Selfer
 * @since 1.0
 */
// We check if the Elementor plugin has been installed / activated.

if( !in_array( 'elementor/elementor.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) return;

class Selfer_Elementor_Widget {
 
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
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_registered' ) );

		add_action('elementor/frontend/after_register_scripts', array($this, 'register_frontend_scripts'), 10);

		add_action('elementor/frontend/after_register_styles', array($this, 'register_frontend_styles'), 10);

		add_action('elementor/frontend/after_enqueue_styles', array($this, 'enqueue_frontend_styles'), 10);

		add_action( 'elementor/elements/categories_registered', array( $this, 'elementor_widget_categories' ) );
	}

	/**
	 * @since 1.0
	 */
	public function widgets_registered() {
					
		//Require all PHP files in the /elementor/widgets directory
		foreach( glob( plugin_dir_path( __FILE__ ) . "widgets/*.php" ) as $file ) {
		    require $file; 
		} 
	}

	/**
	 * @since 1.0
	 */
	public function register_frontend_scripts() {
		wp_enqueue_script( 'selfer-frontend-widget-scripts',  plugin_dir_url( __FILE__ ) . 'assets/js/front-end-widget.js', array('jquery'), false, true);
		wp_register_script( 'morphext',  plugin_dir_url( __FILE__ ) . 'assets/js/morphext.min.js', array('jquery'), false, true);
		wp_register_script( 'typed',  plugin_dir_url( __FILE__ ) . 'assets/js/typed.min.js', array('jquery'), false, true);
		wp_register_script( 'eventmove',  plugin_dir_url( __FILE__ ) . 'assets/js/jquery.event.move.min.js', array('jquery'), false, true);
		wp_register_script( 'twentytwenty',  plugin_dir_url( __FILE__ ) . 'assets/js/jquery.twentytwenty.min.js', array('jquery'), false, true);
	}

	/**
	 * @since 1.0
	 */
	public function register_frontend_styles() {
		wp_register_style( 'twentytwenty', plugin_dir_url( __FILE__ ) . 'assets/css/twentytwenty.css', null, 1.0 );
		wp_register_style( 'nav-menu', plugin_dir_url( __FILE__ ) . 'assets/css/nav-menu.css', null, 1.0 );
	}

	/**
	 * @since 1.0
	 */
	public function enqueue_frontend_styles() {
		wp_enqueue_style('nav-menu');
	}

	/**
	 * @since 1.0
	 */
	public function elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'selfer-category',
			[
				'title' => esc_html__( 'Selfer Theme', 'selfer-core' ),
				'icon' => 'fa fa-plug',
			]
		);  

		$elements_manager->add_category(
			'selfer-header-footer',
			[
				'title' => esc_html__( 'Selfer Theme', 'selfer-core' ),
				'icon' => 'fa fa-plug',
			]
		);  
	}
}
 
Selfer_Elementor_Widget::get_instance()->init();