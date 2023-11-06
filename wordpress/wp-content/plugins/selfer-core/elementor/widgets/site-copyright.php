<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * selfer Site copyright
 *
 * selfer widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0
 */

class Selfer_Site_Copyright_Content_Widget extends Widget_Base {

	public function get_name() {
		return 'selfer-copyright-content';
	}

	public function get_title() {
		return esc_html__( 'Copyright Content', 'selfer-core' );
	}

	public function get_icon() {
		return 'eicon-copy';
	}

	public function get_categories() {
		return [ 'selfer-header-footer' ];
	}

	/**
	 * Register Service widget controls.
	 *
	 * @since 1.0
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'content',
			[
				'label' => esc_html__( 'Content', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);		

		$this->add_control(
			'content_main_area',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => 'If you want to change the copyright content then go at <strong>Appearance > Customize > Footer Settings. Then Footer Copyright Text areas.</strong>',
				'separator' => 'after',
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

		$this->add_control(
			'align_items',
			[
				'label' => esc_html__( 'Align', 'selfer-core' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'selfer-core' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'selfer-core' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'selfer-core' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'text-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Style', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'titles_colors',
			[
				'label' => esc_html__( 'Text Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .selfer-copyright-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'exclude' => [ 'line_height' ],
				'selector' => '{{WRAPPER}} .selfer-copyright-text',
				'separator' => 'before',
			]
		);	

		$this->add_control(
			'description_colors',
			[
				'label' => esc_html__( 'Text Icon Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .selfer-copyright-text i' => 'color: {{VALUE}}',
				],
			]
		);		

		$this->add_control(
			'description_link_colors',
			[
				'label' => esc_html__( 'Text Link Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .selfer-copyright-text a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render Service widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() { 
		$settings = $this->get_settings_for_display(); ?>
		<!-- Site Title/Description -->  
		<p class="selfer-copyright-text"><?php echo wp_kses( selfer_get_options( array('footer_copyright_info', __('Created With <i class="far fa-heart"></i> By <a href="#">SoftHopper</a>','selfer') ) ), \selfer_Static::html_allow() ); ?></p>
	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Selfer_Site_Copyright_Content_Widget() );