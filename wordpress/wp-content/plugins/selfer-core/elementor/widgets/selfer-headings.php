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
class Selfer_Headings_Widget extends Widget_Base {

	public function get_name() {
		return 'selfer-headings';
	}

	public function get_title() {
		return esc_html__( 'Selfer Headings', 'selfer-core' );
	}

	public function get_icon() {
		return 'eicon-heading';
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
			'social_info_section',
			[
				'label' => esc_html__( 'Headings', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'main_heading',
			[
				'label'       => esc_html__( 'Heading', 'selfer-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => esc_html__( 'Enter your main heading here', 'selfer-core' ),
				'default'     => esc_html__( 'I am Selfer Heading', 'selfer-core' ),
			]
		);

		$this->add_control(
			'selfer_heading_layouts',
			[
				'label' => esc_html__( 'Heading Layout', 'selfer-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'animated',
				'options' => [
					'normal'  => esc_html__( 'Normal', 'selfer-core' ),
					'animated' => esc_html__( 'Animated', 'selfer-core' ),
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'   => esc_html__( 'Alignment', 'selfer-core' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'selfer-core' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'selfer-core' ),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'selfer-core' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default' => 'center',
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_main_heading',
			[
				'label'     => esc_html__( 'Main Heading', 'selfer-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'main_heading!' => '',
				],
			]
		);


		$this->add_control(
			'main_heading_color',
			[
				'label'     => esc_html__( 'Color', 'selfer-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .selfer-bubble-border-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'main_heading_typography',
				'selector' => '{{WRAPPER}} .selfer-bubble-border-title',
			]
		);

		$this->add_control(
			'devider_colors',
			[
				'label'     => esc_html__( 'Border Color', 'selfer-core' ),
				'type'      => Controls_Manager::COLOR,
				'default'	=> '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ts-title .title-divider:before' => 'background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .ts-title .title-divider:after' => 'background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .ts-title .title-divider span:nth-child(1)' => 'border-right-color: {{VALUE}} !important;',
					'{{WRAPPER}} .ts-title .title-divider span:nth-child(2)' => 'border-right-color: {{VALUE}} !important;',
					'{{WRAPPER}} .ts-title .ts-bubble-border i' => 'background-color: {{VALUE}} !important;',
					'{{WRAPPER}} .ts-title .ts-bubble-border i:nth-child(5):after' => 'border-color: {{VALUE}} transparent transparent transparent !important;',
				],
				'condition' => [
					'main_heading!' => '',
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
		$alignHeadings = $settings['align'];

		if( $alignHeadings == 'left' ) {
			$alignClass = 'text-left';
		} elseif ( $alignHeadings == 'center'  ) {
			$alignClass = 'text-center';
		} elseif ( $alignHeadings == 'right' ) {
			$alignClass = 'text-right';
		} else {
			$alignClass = 'text-center';
		} ?>
		<?php if( $settings['selfer_heading_layouts'] == 'normal' ) { ?>
			<div class="ts-title <?php echo esc_attr( $alignClass ); ?>">
				<h2 class="selfer-bubble-border-title"><?php echo esc_html( $settings['main_heading'] ); ?></h2>
				<div class="title-divider">
					<span></span>
					<span></span>
				</div>
			</div>
		<?php } else { ?>
		<div class="selfer-title-heading ts-title <?php echo esc_attr( $alignClass ); ?>">
		    <h2 class="ts-bubble-border selfer-bubble-border-title"><?php echo esc_html( $settings['main_heading'] ); ?></h2>
		</div>
		<?php } ?>
		<?php
	}

	/**
	 * Render Social Info widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() { ?>
		<# 
			var $alignHeadings = settings.align;

			if( $alignHeadings == 'left' ) {
				$alignClass = 'text-left';
			} else if ( $alignHeadings == 'center'  ) {
				$alignClass = 'text-center';
			} else if ( $alignHeadings == 'right' ) {
				$alignClass = 'text-right';
			} else {
				$alignClass = 'text-center';
			} 
		#>
		<# if( settings.selfer_heading_layouts == 'normal' ) { #>
			<div class="ts-title {{ $alignClass }}">
				<h2 class="selfer-bubble-border-title">{{{ settings.main_heading }}}</h2>
				<div class="title-divider">
					<span></span>
					<span></span>
				</div>
			</div>
		<# } else { #>
			<div class="ts-title {{ $alignClass }}">
				<h2 class="ts-bubble-border selfer-bubble-border-title">{{{ settings.main_heading }}}</h2>
			</div>
		<# } #>
	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Selfer_Headings_Widget() );