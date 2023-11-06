<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Selfer Essential Grids Widget.
 *
 * Selfer widget that inserts an embeddable content into the page, from any given URL.
 *
 * @since 1.0
 */
class Selfer_Essentail_Grids_Widget extends Widget_Base {

	public function get_name() {
		return 'slefer-essential-grids';
	}

	public function get_title() {
		return esc_html__( 'Essential Grids', 'selfer-core' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'selfer-category' ];
	}

	public function get_script_depends() {
		return [ 'tp-tools', 'essential-grid-essential-grid-script' ];
	}

	/**
	 * Register Edu_Exp widget controls.
	 *
	 * @since 1.0
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'contact_content_section',
			[
				'label' => esc_html__( 'Content', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'grids_items',
			[
				'label' => esc_html__( 'Select Grids', 'selfer-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 0,
				'options' => $this->get_rev_slider_list(),
			]
		); 

		$this->end_controls_section();

		$this->start_controls_section(
			'rev_slider_styling',
			[
				'label' => esc_html__( 'Style', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'rev_slider_margin',
			[
				'label' => esc_html__( 'Margin', 'selfer-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .selfer-rev-slider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		

		$this->add_responsive_control(
			'rev_slider_padding',
			[
				'label' => esc_html__( 'Padding', 'selfer-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .selfer-rev-slider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Whether the reload preview is required or not.
	 *
	 * Used to determine whether the reload preview is required.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return bool Whether the reload preview is required.
	 */
	public function is_reload_preview_required() {
		return true;
	}

	/**
	 * Render Contact Form List.
	 *
	 * @since 1.0
	 */
	protected function get_rev_slider_list() {
		global $wpdb;
        $gridsItem = array();
        $gridsItem[0] = esc_html__( 'Select a grid', 'selfer-core' );

		$get_grids = $wpdb->get_results ( $wpdb->prepare( 'SELECT * FROM ' . $wpdb->prefix . 'eg_grids where 1=%d', 1 ) );

        if ($get_grids) {
            foreach ( $get_grids as $slider ) {
                $gridsItem[$slider->handle] = $slider->name;
            }
		}
			
        return $gridsItem;
	}

	/**
	 * Render Edu_Exp widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() { 
		$settings = $this->get_settings_for_display(); 
		
		?>  
		<div class="selfer-essentail-grids">
			<?php  echo do_shortcode( '[ess_grid alias="'. $settings['grids_items'] .'" id="2"]' ); ?>
		</div><!--  /.selfer-rev-slider -->
		<?php 
	}

	/**
	 * Render shortcode widget as plain content.
	 *
	 * Override the default behavior by printing the shortcode instead of rendering it.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function render_plain_content() {
		// In plain mode, render without shortcode
		echo $this->get_settings( 'grids_items' );
	}
}

if(class_exists('Essential_Grid')){
	Plugin::instance()->widgets_manager->register_widget_type( new Selfer_Essentail_Grids_Widget() );
}