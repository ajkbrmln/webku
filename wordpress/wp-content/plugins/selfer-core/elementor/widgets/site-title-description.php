<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * selfer Site Title/Description
 *
 * selfer widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0
 */

class Selfer_Site_Title_Description_Widget extends Widget_Base {

	public function get_name() {
		return 'selfer-site-title-description';
	}

	public function get_title() {
		return esc_html__( 'Site Title/Description', 'selfer-core' );
	}

	public function get_icon() {
		return ' eicon-site-title';
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
				'raw' => 'If you want to change the Site Title and Description content then go at <strong>Appearance > Customize > Site Identity. Then change Site Title and Description Content.</strong>',
				'separator' => 'after',
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

		$this->add_control(
			'show_title',
			[
				'label' => esc_html__( 'Show Title', 'plugin-domain' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'your-plugin' ),
				'label_off' => esc_html__( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);		

		$this->add_control(
			'show_description',
			[
				'label' => esc_html__( 'Show Description', 'plugin-domain' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'your-plugin' ),
				'label_off' => esc_html__( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
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
				'label' => esc_html__( 'Title Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .selfer-site-branding .site-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'exclude' => [ 'line_height' ],
				'selector' => '{{WRAPPER}} .selfer-site-branding .site-title',
				'separator' => 'before',
			]
		);	

		$this->add_control(
			'description_colors',
			[
				'label' => esc_html__( 'Description Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .selfer-site-branding .site-description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'exclude' => [ 'line_height' ],
				'selector' => '{{WRAPPER}} .selfer-site-branding .site-description',
				'separator' => 'before',
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
		<?php if ( function_exists( 'display_header_text' ) ) { 
		    if( display_header_text() == true ) { ?>
		    <div class="selfer-site-branding">
		        <div class="site-branding-text">
		        <?php if( $settings['show_title'] == 'yes' ) : ?>
		            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		        <?php endif; ?>
				<?php if( $settings['show_description'] == 'yes' ) : ?>
		            <?php $description = get_bloginfo( 'description', 'display' );
		            if ( $description || is_customize_preview() ) : ?>
		            <p class="site-description"><?php echo esc_html($description); ?></p>
		            <?php endif; ?>
		        <?php endif; ?>
		        </div><!-- .site-branding-text -->
		    </div><!--  /.site-branding -->
		    <?php }
		} ?>
	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Selfer_Site_Title_Description_Widget() );