<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Selfer Contact Form 7 Widget.
 *
 * Selfer widget that inserts an embeddable content into the page, from any given URL.
 *
 * @since 1.0
 */
class Selfer_Counter_item_Widget extends Widget_Base {

	public function get_name() {
		return 'selfer-counter';
	}

	public function get_title() {
		return esc_html__( 'Counter Item', 'selfer-core' );
	}

	public function get_icon() {
		return 'eicon-counter-circle';
	}

	public function get_categories() {
		return [ 'selfer-category' ];
	}

	/**
	 * Register Edu_Exp widget controls.
	 *
	 * @since 1.0
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'counter_sections',
			[
				'label' => esc_html__( 'Counter', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'counter_box', [
				'label' => esc_html__( 'Counter Value', 'selfer-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => '43',
			]
		);			
		
		$repeater->add_control(
			'title', [
				'label' => esc_html__( 'Title', 'selfer-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Hourly Rate',
			]
		);	
		
		$this->add_control(
			'counter_elem',
			[
				'label' => __( 'Counter Item', 'plugin-domain' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'counter_box' => '50',
						'title' => esc_html__( 'Hourly Rate', 'selfer-core' ),
					]
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'counter_bg',
			[
				'label' => esc_html__( 'Counter Background', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);		

		$this->add_control(
			'counter_background',
			[
				'label' => esc_html__( 'Background Image', 'selfer-core' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);	

		$this->end_controls_section();

		$this->start_controls_section(
			'counter_styling',
			[
				'label' => esc_html__( 'Style', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'carousel_margin',
			[
				'label' => esc_html__( 'Margin', 'selfer-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'rem', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .counter-ts-block' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		

		$this->add_responsive_control(
			'carousel_padding',
			[
				'label' => esc_html__( 'Padding', 'selfer-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'rem', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .counter-ts-block' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'layout_one_background',
			[
				'label' => esc_html__( 'Background', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'transparent',
				'selectors' => [
					'{{WRAPPER}} .counter-ts-block' => 'background-color: {{VALUE}};',
				],
			]
		);		

		$this->add_control(
			'counter_title_colors',
			[
				'label' => esc_html__( 'Layout One Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .counter-ts-block h5' => 'color: {{VALUE}};',
				],
			]
		);			

		$this->add_control(
			'counter_colors',
			[
				'label' => esc_html__( 'Counter Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f26c4f',
				'selectors' => [
					'{{WRAPPER}} .ts-promo-number figure' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'counter_devider_colors',
			[
				'label' => esc_html__( 'Counter Devider Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(255, 255, 255, .5)',
				'selectors' => [
					'{{WRAPPER}} .ts-promo-number.ts-has-divider:after' => 'background-color: {{VALUE}};',
				],
			]
		);		

		$this->end_controls_section();
	}


	/**
	 * Render Edu_Exp widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() { 
		$settings = $this->get_settings_for_display();
		?>  
		<div class="counter-ts-block" data-bg-image="<?php echo esc_url( $settings['counter_background']['url'] ); ?>">
			<div class="container ts-promo-numbers">			
				<div class="row counter-loop">
					<?php foreach ($settings['counter_elem'] as $key => $value) { ?>
					<div class="col-sm-6 col-md-3">
					    <div class="ts-promo-number text-center ts-has-divider">
					        <figure class="odometer" data-odometer-final="<?php echo esc_attr( $value['counter_box'] ); ?>">0</figure>
					        <h5><?php echo esc_html( $value['title'] ); ?></h5>
					    </div>
					    <!--end ts-promo-number-->
					</div>
					<?php } ?>
				</div>
			</div><!--  /.ts-promo-numbers -->
		</div>
		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Selfer_Counter_item_Widget() );