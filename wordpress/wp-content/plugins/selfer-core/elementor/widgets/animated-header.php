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
class Selfer_Animated_Header_Widget extends Widget_Base {

	public function get_name() {
		return 'selfer-animated_header';
	}

	public function get_title() {
		return esc_html__( 'Animated Header', 'selfer-core' );
	}

	public function get_icon() {
		return 'eicon-animated-headline';
	}

	public function get_categories() {
		return [ 'selfer-category' ];
	}

	public function get_script_depends() {
		return [ 'morphext', 'typed' ];
	}

	/**
	 * Register Edu_Exp widget controls.
	 *
	 * @since 1.0
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_content_heading',
			[
				'label' => esc_html__( 'Heading', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'heading_layout',
			[
				'label'   => esc_html__( 'Layout', 'selfer-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'animated' => esc_html__( 'Animated', 'selfer-core' ),
					'typed'    => esc_html__( 'Typed', 'selfer-core' ),
				],
				'default' => 'animated',
			]
		);

		$this->add_control(
			'pre_heading',
			[
				'label'       => esc_html__( 'Prefix Heading', 'selfer-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your prefix title', 'selfer-core' ),
				'default'     => esc_html__( 'Hello I am', 'selfer-core' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'animated_heading',
			[
				'label'       => esc_html__( 'Heading', 'selfer-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your title', 'selfer-core' ),
				'description' => esc_html__( 'Write animated heading here with comma separated. Such as Animated, Morphing, Awesome', 'selfer-core' ),
				'default'     => esc_html__( "Animated,Morphing,Awesome", 'selfer-core' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'post_heading',
			[
				'label'       => esc_html__( 'Post Heading', 'selfer-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your suffix title', 'selfer-core' ),
				'default'     => esc_html__( 'Heading', 'selfer-core' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'link',
			[
				'label'       => esc_html__( 'Link', 'selfer-core' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'http://your-link.com',
			]
		);

		$this->add_control(
			'header_size',
			[
				'label'   => esc_html__( 'HTML Tag', 'selfer-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h1'   => esc_html__( 'H1', 'selfer-core' ),
					'h2'   => esc_html__( 'H2', 'selfer-core' ),
					'h3'   => esc_html__( 'H3', 'selfer-core' ),
					'h4'   => esc_html__( 'H4', 'selfer-core' ),
					'h5'   => esc_html__( 'H5', 'selfer-core' ),
					'h6'   => esc_html__( 'H6', 'selfer-core' ),
					'div'  => esc_html__( 'div', 'selfer-core' ),
					'span' => esc_html__( 'span', 'selfer-core' ),
					'p'    => esc_html__( 'p', 'selfer-core' ),
				],
				'default' => 'h2',
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
				'default'      => 'center',
				'prefix_class' => 'elementor-align%s-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_animation',
			[
				'label'     => esc_html__( 'Animation', 'selfer-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'heading_animation!' => '',
				],
			]
		);

		$this->add_control(
			'heading_animation',
			[
				'label'       => esc_html__( 'Animation', 'selfer-core' ),
				'type'        => Controls_Manager::ANIMATION,
				'default'     => 'fadeIn',
				'label_block' => true,
				'condition' => [
					'heading_animation!' => '',
					'heading_layout'     => 'animated',
				],
			]
		);

		$this->add_control(
			'heading_animation_duration',
			[
				'label'   => esc_html__( 'Animation Duration', 'selfer-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''     => esc_html__( 'Normal', 'selfer-core' ),
					'slow' => esc_html__( 'Slow', 'selfer-core' ),
					'fast' => esc_html__( 'Fast', 'selfer-core' ),
				],
				'condition' => [
					'heading_animation!' => '',
					'heading_layout'     => 'animated',
				],
			]
		);

		$this->add_control(
			'heading_animation_delay',
			[
				'label'     => esc_html__( 'Animation Delay', 'selfer-core' ) . ' (ms)',
				'type'      => Controls_Manager::NUMBER,
				'default'   => 2500,
				'min'       => 100,
				'max'       => 7000,
				'step'      => 100,
				'condition' => [
					'heading_animation!' => '',
					'heading_layout'     => 'animated',
				],
			]
		);

		$this->add_control(
			'type_speed',
			[
				'label'     => esc_html__( 'Type Speed', 'selfer-core' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 60,
				'min'       => 10,
				'max'       => 100,
				'step'      => 5,
				'condition' => [
					'heading_animation!' => '',
					'heading_layout'     => 'typed',
				],
			]
		);

		$this->add_control(
			'start_delay',
			[
				'label'     => esc_html__( 'Start Delay', 'selfer-core' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1,
				'min'       => 1,
				'max'       => 100,
				'step'      => 1,
				'condition' => [
					'heading_animation!' => '',
					'heading_layout'     => 'typed',
				],
			]
		);

		$this->add_control(
			'back_speed',
			[
				'label'     => esc_html__( 'Back Speed', 'selfer-core' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 30,
				'min'       => 0,
				'max'       => 100,
				'step'      => 2,
				'condition' => [
					'heading_animation!' => '',
					'heading_layout'     => 'typed',
				],
			]
		);

		$this->add_control(
			'back_delay',
			[
				'label'     => esc_html__( 'Back Delay', 'selfer-core' ) . ' (ms)',
				'type'      => Controls_Manager::NUMBER,
				'default'   => 500,
				'min'       => 0,
				'max'       => 3000,
				'step'      => 50,
				'condition' => [
					'heading_animation!' => '',
					'heading_layout'     => 'typed',
				],
			]
		);

		$this->add_control(
			'loop',
			[
				'label'     => esc_html__( 'Loop', 'selfer-core' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'heading_animation!' => '',
					'heading_layout'     => 'typed',
				],
			]
		);

		$this->add_control(
			'loop_count',
			[
				'label'     => esc_html__( 'Loop Count', 'selfer-core' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 0,
				'min'       => 0,
				'condition' => [
					'loop'           => 'yes',
					'heading_layout' => 'typed',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_animated_heading',
			[
				'label' => esc_html__( 'Heading', 'selfer-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'animated_heading_color',
			[
				'label'     => esc_html__( 'Color', 'selfer-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .selfer-heading .selfer-heading-tag' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'animated_heading_typography',
				'selector' => '{{WRAPPER}} .selfer-heading .selfer-heading-tag',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'animated_heading_shadow',
				'selector' => '{{WRAPPER}} .selfer-heading .selfer-heading-tag',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_pre_heading',
			[
				'label'     => esc_html__( 'Pre Heading', 'selfer-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'pre_heading!' => '',
				]
			]
		);

		$this->add_control(
			'pre_heading_color',
			[
				'label'     => esc_html__( 'Pre Heading Color', 'selfer-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .selfer-heading .selfer-pre-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'pre_heading_typography',
				'selector' => '{{WRAPPER}} .selfer-heading .selfer-pre-heading',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'pre_heading_shadow',
				'selector' => '{{WRAPPER}} .selfer-heading .selfer-pre-heading',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_post_heading',
			[
				'label'     => esc_html__( 'Post Heading', 'selfer-core' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'post_heading!' => '',
				]
			]
		);

		$this->add_control(
			'post_heading_color',
			[
				'label'     => esc_html__( 'Post Heading Color', 'selfer-core' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .selfer-heading .selfer-post-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'post_heading_typography',
				'selector' => '{{WRAPPER}} .selfer-heading .selfer-post-heading',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'post_heading_shadow',
				'selector' => '{{WRAPPER}} .selfer-heading .selfer-post-heading',
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
		$settings      = $this->get_settings();
		$id            = $this->get_id();
		$final_heading = '';
		$heading_html  = array();

		if ( empty( $settings['pre_heading'] ) and empty( $settings['animated_heading'] ) and empty( $settings['post_heading'] ) ) {
			return;
		}

		$this->add_render_attribute( 'heading', 'class', 'selfer-heading-tag' );


		if ($settings['pre_heading']) :
			$final_heading .= '<div class="selfer-pre-heading">'. esc_attr($settings['pre_heading']).'</div> ';
		endif;

		if ($settings['animated_heading'] and 'animated' == $settings['heading_layout']) {
			$heading_animation_duration = ($settings['heading_animation_duration']) ? ' selfer-animated-'.$settings['heading_animation_duration'] : '';
	   		$final_heading .= '<div class="selfer-animated-heading'.$heading_animation_duration.'">'.rtrim(esc_attr($settings['animated_heading']), ',') . '</div> ';
		} elseif ($settings['animated_heading'] and 'typed' == $settings['heading_layout']) {
			$final_heading .= '<div class="selfer-animated-heading"></div> ';
		}

		if ($settings['post_heading']) :
			$final_heading .= '<div class="selfer-post-heading">'.esc_attr($settings['post_heading']).'</div>';
		endif;


		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'url', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'url', 'target', '_blank' );
			}

			if ( ! empty( $settings['link']['nofollow'] ) ) {
				$this->add_render_attribute( 'url', 'rel', 'nofollow' );
			}

			$final_heading = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $final_heading );
		}

		$heading_html[] = '<div id ="selferah-'.$id.'" class="selfer-heading">';
		
		
		$heading_html[] = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'heading' ), $final_heading );
		
		$heading_html[] = '</div>';

		echo implode("", $heading_html);

		$type_heading = explode(",", esc_html($settings['animated_heading']) );
		?>	
		
		<?php if ($settings['animated_heading']) : ?>
		<script>
			jQuery(document).ready(function($) {
	    		"use strict";
	    		<?php if ( 'animated' == $settings['heading_layout'] ) : ?>
					$("#selferah-<?php echo esc_attr($id); ?> .selfer-animated-heading").Morphext({
					    animation: "<?php echo esc_attr($settings['heading_animation']); ?>", // Overrides default "bounceIn"
					    speed: <?php echo esc_attr($settings['heading_animation_delay']); ?>, // Overrides default 2000
					});
				<?php elseif ( 'typed' == $settings['heading_layout'] ) : ?>
					var typed = new Typed('#selferah-<?php echo esc_attr($id); ?> .selfer-animated-heading', {
					  strings: <?php echo json_encode($type_heading); ?>,
					  typeSpeed: <?php echo esc_attr( $settings['type_speed'] ); ?>,
					  startDelay: <?php echo esc_attr( $settings['start_delay'] ); ?>,
					  backSpeed: <?php echo esc_attr( $settings['back_speed'] ); ?>,
					  backDelay: <?php echo esc_attr( $settings['back_delay'] ); ?>,
					  loop: <?php echo ( 'yes' == $settings['loop'] ) ? 'true' : 'false'; ?>,
					  loopCount: <?php echo ($settings['loop_count']) ? esc_attr( $settings['loop_count'] ) : 0; ?>,
					});
				<?php endif; ?>
			});
		</script>
		<?php endif; ?>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Selfer_Animated_Header_Widget() );