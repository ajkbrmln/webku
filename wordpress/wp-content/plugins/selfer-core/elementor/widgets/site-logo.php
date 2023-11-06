<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Selfer Site Logo
 *
 * selfer widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0
 */

class Selfer_Site_Logo_Widget extends Widget_Base {

	public function get_name() {
		return 'selfer-site-logo';
	}

	public function get_title() {
		return esc_html__( 'Site Logo', 'selfer-core' );
	}

	public function get_icon() {
		return 'eicon-site-logo';
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
			'content_section',
			[
				'label' => esc_html__( 'Content', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'content_main_area',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => 'If you want to change the logo content then go at <strong>Appearance > Customize > Site Identity. Then Logo Area areas.</strong>',
				'separator' => 'after',
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

		$this->add_control(
			'custom_site_logo',
			[
				'label'       => esc_html__( 'or Custom Logo', 'selfer-core' ),
				'type' => Controls_Manager::MEDIA,
				'description' => 'Custom logo works if you don\'t set any logo from customizer or page meta options',
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_responsive_control(
			'custom_logo_width',
			[
				'label' => esc_html__( 'Logo Width', 'selfer-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .selfer-site-branding' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);		

		$this->add_responsive_control(
			'custom_logo_height',
			[
				'label' => esc_html__( 'Logo Height', 'selfer-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .selfer-site-branding' => 'height: {{SIZE}}{{UNIT}};',
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
		<!-- Site Branding -->  
		<?php if(  get_post_meta( get_the_ID(), 'selfer_header_logo_main', true) !== false && get_post_meta( get_the_ID(), 'selfer_header_logo_main', true) !== '' ) { ?>
		<div class="selfer-site-branding">
		    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link">
		        <img class="custom-logo" src="<?php echo esc_url( get_post_meta( get_the_ID(), 'selfer_header_logo_main', true) ); ?>" alt="<?php echo esc_attr__('Site Logo', 'selfer'); ?>" />
		    </a>
		</div><!--  /.selfer-site-branding -->
		<?php } elseif ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) { ?>
		    <div class="selfer-site-branding">
		        <?php the_custom_logo(); ?>
		    </div><!--  /.selfer-site-branding -->
		<?php } else { ?>
			<div class="selfer-site-branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-logo-link">
					<img class="custom-logo" src="<?php echo esc_url( $settings['custom_site_logo']['url'] ); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" />
				</a>
			</div><!--  /.selfer-site-branding -->
		<?php } ?>
	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Selfer_Site_Logo_Widget() );