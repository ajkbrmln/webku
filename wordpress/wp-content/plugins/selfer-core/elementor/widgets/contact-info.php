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
class Selfer_Contact_info_Widget extends Widget_Base {

	public function get_name() {
		return 'selfer-contact-info';
	}

	public function get_title() {
		return esc_html__( 'Contact Info', 'selfer-core' );
	}

	public function get_icon() {
		return 'eicon-post-list';
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
			'contact_info_grid',
			[
				'label' => esc_html__( 'Contact Grid', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'number_grids',
			[
				'label' => esc_html__( 'Number Of Grids', 'selfer-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'four',
				'options' => [
					'one'  => esc_html__( 'One Grid', 'selfer-core' ),
					'two' => esc_html__( 'Two Grid', 'selfer-core' ),
					'three' => esc_html__( 'Three Grid', 'selfer-core' ),
					'four' => esc_html__( 'Four Grid', 'selfer-core' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'contact_info_section',
			[
				'label' => esc_html__( 'Contact Info', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater = new Repeater();
		if( selfer_is_elementor_version( '<', '2.6.0' ) ) {
			$repeater->add_control(
			    'icon',
			    [
			    	'label' => esc_html__( 'Icon', 'selfer-core' ),
			    	'type' => Controls_Manager::ICON,
			    ]
			);
		} else {
			$repeater->add_control(
			    'selected_icon',
			    [
			    	'label' => esc_html__( 'Icon', 'selfer-core' ),
			    	'type' => Controls_Manager::ICONS,
			    ]
			);		
		}

		$repeater->add_control(
		    'custom_icon',
		    [
		    	'label' => esc_html__( 'Or Custom Icon', 'selfer-core' ),
		    	'type' => Controls_Manager::TEXTAREA,
		    ]
		);		

		$repeater->add_control(
		    'image_icons',
		    [
		    	'label' => esc_html__( 'Or Select Image', 'selfer-core' ),
		    	'type' => Controls_Manager::MEDIA,
		    	'default' => [
		    		'url' => Utils::get_placeholder_image_src(),
		    	],
		    ]
		);

		$repeater->add_control(
		    'title',
		    [
		    	'label' => esc_html__( 'Or Custom Icon', 'selfer-core' ),
		    	'type' => Controls_Manager::TEXT,
		    	'default' => 'Mail',
		    ]
		);		

		$repeater->add_control(
		    'description',
		    [
		    	'label' => esc_html__( 'Description', 'selfer-core' ),
		    	'type' => Controls_Manager::TEXTAREA,
		    	'default' => 'example@example.com',
		    ]
		);

		$this->add_control(
			'contact_info_elem',
			[
				'label' => esc_html__( 'Info Item', 'selfer-core' ),
				'type' => Controls_Manager::REPEATER,  
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
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
			'info_margin',
			[
				'label' => esc_html__( 'Margin', 'selfer-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'rem', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .selfer-contact-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		

		$this->add_responsive_control(
			'info_padding',
			[
				'label' => esc_html__( 'Padding', 'selfer-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'rem', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .selfer-contact-info ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'info_icon_box_bg',
			[
				'label' => esc_html__( 'Icon Box Background', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .selfer-contact-info i' => 'background: {{VALUE}};',
				],
			]
		);	
		
		$this->add_control(
			'info_icon_box_color',
			[
				'label' => esc_html__( 'Icon Box Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .selfer-contact-info i' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_control(
			'info_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'selfer-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 25,
				],
				'selectors' => [
					'{{WRAPPER}} .selfer-contact-info i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'info_title_color',
			[
				'label' => esc_html__( 'Title Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .selfer-contact-info  h5' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_control(
			'info_description_color',
			[
				'label' => esc_html__( 'Description Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#999999',
				'selectors' => [
					'{{WRAPPER}} .selfer-contact-info .contact_descriptions' => 'color: {{VALUE}};',
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
		if( $settings['number_grids'] == 'one' ) {
			$grid_no = 'col-sm-12 col-md-12';
		} elseif( $settings['number_grids'] == 'two' ) {
			$grid_no = 'col-sm-6 col-md-6';
		} elseif( $settings['number_grids'] == 'three' ) {
			$grid_no = 'col-sm-6 col-md-4';
		} else {
			$grid_no = 'col-sm-6 col-md-3';
		} ?>
		<div class="row ts-xs-text-center">
			<?php foreach ($settings['contact_info_elem'] as $key => $value) { ?>	
			<div class="<?php echo esc_attr( $grid_no ); ?> mb-4 selfer-contact-info" data-animate="ts-fadeInUp">
				<?php
					if( !empty( $value['image_icons']['url'] )  ) { ?>
						<img src="<?php echo esc_url( $value['image_icons']['url'] ); ?>" class="mb-4" alt="<?php echo esc_attr( $value['title'] ); ?>">
					<?php } elseif ( $value['custom_icon'] !=="" ) { ?>
						<i class="<?php echo esc_attr( $value['custom_icon'] ); ?>"></i>
					<?php } else { ?>
						<div class="mb-4">					
							<?php if ( !empty( $value['icon'] ) || !empty( $value['selected_icon'] )  ) {
	                		    selfer_render_icon( $value, 'icon', 'selected_icon' );
	                		} ?>
						</div><!--  /.mb-4 -->
					<?php }
				?>
			    <h5><?php echo esc_html( $value['title'] ); ?></h5>
			    <div class="contact_descriptions"><?php echo wp_kses_post( $value['description'] ); ?></div>
			</div>
			<?php } ?> 
		</div>
		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Selfer_Contact_info_Widget() );