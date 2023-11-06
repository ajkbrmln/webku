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
class Selfer_Call_to_actions extends Widget_Base {

	public function get_name() {
		return 'slefer-call-to-actions';
	}

	public function get_title() {
		return esc_html__( 'Call To Actions', 'selfer-core' );
	}

	public function get_icon() {
		return 'eicon-call-to-action';
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
			'call_to_sections',
			[
				'label' => esc_html__( 'Call To Actions', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'call_to_actions_title',
			[
				'label' => esc_html__( 'Call To Title', 'selfer-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Add Title', 'selfer-core' ),
			]
		);

		$this->add_control(
			'call_to_background',
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
			'call_to_btn',
			[
				'label' => esc_html__( 'Button', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'call_to_actions_btn_title',
			[
				'label' => esc_html__( 'Button Title', 'selfer-core' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Add Title', 'selfer-core' ),
				'default' => 'Hire Me Now!',
			]
		);	

		$this->add_control(
			'call_to_button_url',
			[
				'label' => esc_html__( 'Button URL', 'selfer-core' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'selfer-core' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'info_styling',
			[
				'label' => esc_html__( 'Style', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'video_popup_margin',
			[
				'label' => esc_html__( 'Margin', 'selfer-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .selfer-call-to-block > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		

		$this->add_responsive_control(
			'video_popup_padding',
			[
				'label' => esc_html__( 'Padding', 'selfer-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', 'rem' ],
				'selectors' => [
					'{{WRAPPER}} .selfer-call-to-block > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'call_to_title_color',
			[
				'label' => esc_html__( 'Title Colors', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .call-to-title' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_control(
			'call_to_btn_bg',
			[
				'label' => esc_html__( 'Button Background', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f26c4f',
				'selectors' => [
					'{{WRAPPER}} .selfer-call-to-block .btn' => 'background-color: {{VALUE}}; border-color: {{VALUE}}',
					'{{WRAPPER}} .ts-has-talk-arrow:after' => 'border-color: {{VALUE}} transparent transparent transparent !important;',
				],
			]
		);	

		$this->add_control(
			'call_to_btn_bg_hover',
			[
				'label' => esc_html__( 'Button Hover Background', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f26c4f',
				'selectors' => [
					'{{WRAPPER}} .selfer-call-to-block .btn:hover' => 'background-color: {{VALUE}} !important; border-color: {{VALUE}} !important;',
					'{{WRAPPER}} .ts-has-talk-arrow:hover:after' => 'border-color: {{VALUE}} transparent transparent transparent !important;',
				],
			]
		);	

		$this->add_control(
			'call_to_btn_color_hover',
			[
				'label' => esc_html__( 'Button Hover Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .selfer-call-to-block .btn:hover' => 'color: {{VALUE}}; color: {{VALUE}} !important;',
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
			<div class="selfer-call-to-block">
				<div class="text-center px-5 pt-5 position-relative">
					<?php if(  $settings['call_to_actions_title'] ) { ?>
				    <h3 class="my-3 call-to-title"><?php echo esc_html( $settings['call_to_actions_title'] ); ?></h3>
					<?php } ?>
				    <?php if( $settings['call_to_actions_btn_title'] !== '' ) : ?>
				    <?php 
				    	$target = $settings['call_to_button_url']['is_external'] ? ' target="_blank"' : '';
				    	$nofollow = $settings['call_to_button_url']['nofollow'] ? ' rel="nofollow"' : '';
				    ?>	
				    <a href="<?php echo esc_url( $settings['call_to_button_url']['url'] ); ?>" class="btn btn-primary mr-2 ts-push-down__50 ts-has-talk-arrow" <?php echo ( $target .' '. $nofollow ) ?>><?php echo esc_html( $settings['call_to_actions_btn_title'] ); ?></a>
					<?php endif; ?>
				    <div class="ts-background ts-opacity__20" data-bg-image="<?php echo esc_url( $settings['call_to_background']['url'] ); ?>"></div>
				</div>
			</div>
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
	// protected function _content_template() {

	// }
}

Plugin::instance()->widgets_manager->register_widget_type( new Selfer_Call_to_actions() );