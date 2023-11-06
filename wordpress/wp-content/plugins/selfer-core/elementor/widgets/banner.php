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
class Selfer_Banner_Widget extends Widget_Base {

	public function get_name() {
		return 'selfer-banner';
	}

	public function get_title() {
		return esc_html__( 'Hero Block', 'selfer-core' );
	}

	public function get_icon() {
		return 'eicon-banner';
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
			'social_section',
			[
				'label' => esc_html__( 'Social Links', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

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
			    	'fa4compatibility' => 'icon',
			    ]
			);		
		}

		$repeater->add_control(
			'custom',
			[
				'label_block' => true,
				'label' => esc_html__( 'Custom Icon', 'selfer-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'description' => 'Use any custom icons code you wants',
			]
		);		

		$repeater->add_control(
			'social_url',
			[
				'label' => esc_html__( 'Link', 'selfer-core' ),
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

		$this->add_control(
			'social_item',
			[
				'label' => esc_html__( 'Social URL', 'selfer-core' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,  
				'fields' => $repeater->get_controls(),
				'title_field' => 'Social Item',
			]
		);	
	
		$this->end_controls_section();

		$this->start_controls_section(
			'author_title',
			[
				'label' => esc_html__( 'Title', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);	

		
		$this->add_control(
			'title_content', [
				'label'       => esc_html__( 'Title', 'selfer-core' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => esc_html__( 'Enter your title', 'selfer-core' ),
				'default'     => esc_html__( 'I am Jonathan Doe', 'selfer-core' ),
			]
		);

		$repeater_title = new Repeater();

		$repeater_title->add_control(
			'desegnation_name',
			[
				'label_block' => true,
				'label' => esc_html__( 'Designation Name', 'selfer-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Photographer',
			]
		);	

		$this->add_control(
			'designation_content',
			[
				'label' => esc_html__( 'Social URL', 'selfer-core' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,   
				'fields' => $repeater_title->get_controls(),
				'title_field' => '{{{ desegnation_name }}}',
			]
		);			

		$this->end_controls_section();	

		$this->start_controls_section(
			'add_section',
			[
				'label' => esc_html__( 'Scroll Bottom', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
		    'add_section_scroll_enable',
		    [
		        'label'                 => __( 'Scroll Bottom', 'materia-core' ),
		        'type'                  => Controls_Manager::SWITCHER,
		        'default'               => 'yes',
		        'label_on'              => __( 'Show', 'materia-core' ),
		        'label_off'             => __( 'Hide', 'materia-core' ),
		        'return_value'          => 'yes',
		    ]
		);
		
		$this->add_control(
			'add_section_id',
			[
				'label'       => esc_html__( 'Scroll Bottom ID', 'selfer-core' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => esc_html__( 'Enter Section ID', 'selfer-core' ),
				'condition'             => [
					'add_section_scroll_enable'   => 'yes',
				],
			]
		);

		$this->add_control(
		    'add_section_icons',
		    [
		    	'label' => esc_html__( 'Icons', 'selfer-core' ),
		    	'type' => Controls_Manager::ICONS,
		    	'description' => 'Use button icon at here',
		    	'condition'=> [
		    		'add_section_scroll_enable'   => 'yes',
		    	],
		    ]
		);	

		$this->end_controls_section();

		$this->start_controls_section(
			'banner_image_section',
			[
				'label' => esc_html__( 'Hero Background', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);	

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'hero_background_blocks',
				'label' => esc_html__( 'Select Hero Background', 'selfer-core' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ts-animate-hero-items .ts-background .ts-background-image',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'banner_aligments_contents',
			[
				'label' => esc_html__( 'Content Aligments', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);	

		$this->add_responsive_control(
			'content_align',
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
			'hero_layout_style',
			[
				'label' => esc_html__( 'Banner Styling', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'hero_layout_margin',
			[
				'label' => esc_html__( 'Margin', 'selfer-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ts-animate-hero-items' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);		

		$this->add_responsive_control(
			'hero_layout_padding',
			[
				'label' => esc_html__( 'Padding', 'selfer-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ts-animate-hero-items' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'hero_layout_background',
			[
				'label' => esc_html__( 'Hero Block Background', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ts-background-image' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'social_styling',
			[
				'label' => esc_html__( 'Social Block', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'social_icon_color_block',
			[
				'label' => esc_html__( 'Icon Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#343a40',
				'selectors' => [
					'{{WRAPPER}} .ts-social-icons a' => 'color: {{VALUE}} !important;',
				],
			]
		);			

		$this->add_control(
			'social_icon_background',
			[
				'label' => esc_html__( 'Icon Background', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => 'rgba(255,255,255,.8)',
				'selectors' => [
					'{{WRAPPER}} .ts-social-icons a' => 'background-color: {{VALUE}} !important;',
				],
			]
		);		

		$this->add_control(
			'social_icon_hover_color_block',
			[
				'label' => esc_html__( 'Icon Hover Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ts-social-icons a:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);			

		$this->add_control(
			'social_icon_hover_background',
			[
				'label' => esc_html__( 'Icon Hover Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ts-social-icons a:hover' => 'background-color: {{VALUE}} !important;',
				],
			]
		);		

		$this->end_controls_section();

		$this->start_controls_section(
			'titles_styling',
			[
				'label' => esc_html__( 'Title', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'titles_text_color',
			[
				'label' => esc_html__( 'Title Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ts-animate-hero-items h2' => 'color: {{VALUE}};',
				],
			]
		);			

		$this->add_control(
			'titles_border_color',
			[
				'label' => esc_html__( 'Slider Title Border', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ts-bubble-border i' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .ts-bubble-border i:nth-child(5):after' => 'border-color: {{VALUE}} transparent transparent transparent;',
				],
			]
		);	

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_titles_text_typography',
				'label' => esc_html__( 'Author Name:', 'selfer-core' ),
				'selector' => '{{WRAPPER}} .author-name-info',
				'fields_options' => [
					'font_weight' => [
						'default' => '500',
					],
					'font_family' => [
						'default' => 'Rubik',
					],
					'font_size' => [ 'default' => [ 'unit' => 'px', 'size' => 70 ] ],
				],
			]
		);		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'titles_text_typography',
				'label' => esc_html__( 'Title Typo:', 'selfer-core' ),
				'selector' => '{{WRAPPER}} .ts-animate-hero-items h2.ts-bubble-border',
				'fields_options' => [
					'font_weight' => [
						'default' => '500',
					],
					'font_family' => [
						'default' => 'Rubik',
					],
					'font_size' => [ 'default' => [ 'unit' => 'px', 'size' => 60 ] ],
				],
			]
		);			


		$this->end_controls_section();

		$this->start_controls_section(
			'scroll_nav_style',
			[
				'label' => esc_html__( 'Scroll To Nav', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'scroll_nav_bg',
			[
				'label' => esc_html__( 'Nav Background', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#f26c4f',
				'selectors' => [
					'{{WRAPPER}} .ts-animate-hero-items .ts-bg-primary' => 'background: {{VALUE}};',
				],
			]
		);			

		$this->add_control(
			'scroll_hover_nav_bg',
			[
				'label' => esc_html__( 'Nav Hover Background', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ts-animate-hero-items .ts-btn-effect .ts-hidden' => 'background: {{VALUE}};',
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
		$alignHeadings = $settings['content_align'];

		if ( $alignHeadings == 'center'  ) {
			$alignClass = 'content-center';
		} elseif ( $alignHeadings == 'right' ) {
			$alignClass = 'content-right';
		} else {
			$alignClass = 'content-left';
		}
		$fallback_defaults = [
			'fa fa-facebook',
			'fa fa-twitter',
			'fa fa-dribbble',
		];
		$migration_allowed = Icons_Manager::is_migration_allowed();	?>
		<div class="ts-animate-hero-items inique-ts-hero-image">
		    <div class="container position-relative h-100 ts-align__vertical <?php echo esc_attr($alignClass); ?>">
		        <div class="row w-100">
		            <div class="col-md-8">
		                <!--SOCIAL ICONS-->
		                <?php if( $settings['social_item'] ) { ?>
		                <figure class="ts-social-icons mb-4">
		                	<?php foreach ($settings['social_item'] as $social => $item) { ?>
		                		<?php 
		                			$target = $item['social_url']['is_external'] ? ' target="_blank"' : '';
		                			$nofollow = $item['social_url']['nofollow'] ? ' rel="nofollow"' : '';
			
			                        if ( ! isset( $item['icon'] ) && ! $migration_allowed ) {
										 $item['icon'] = isset( $fallback_defaults[ $social ] ) ? $fallback_defaults[ $social ] : 'fa fa-facebook';
									}
			
			                         $migrated = isset( $item['__fa4_migrated']['selected_icon'] );
			                         $is_new = ! isset( $item['icon'] ) && $migration_allowed;
			                         if ( ! empty( $item['icon'] ) || ( ! empty( $item['selected_icon']['value'] ) && $is_new ) ) :	?>
									 <a href="<?php echo esc_url( $item['social_url']['url'] ); ?>" class="mr-3 text-dark ts-circle__xxs" <?php echo ( $target .' '. $nofollow ) ?> data-bg-color="rgba(255,255,255,.8)">
									<?php
									if ( $is_new || $migrated ) {
										Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] );
									} else { ?>
										<i class="<?php echo esc_attr( $item['icon'] ); ?>" aria-hidden="true"></i>
									<?php } ?>	 
									</a>
							        <?php else: ?>
							        <i class="<?php echo esc_attr( ( $item['custom'] !== "" ) ? $item['custom'] : '' ) ?>"></i>
							        <?php endif; ?>	
		                	<?php } ?>
		                </figure>
		            	<?php } ?>

		                <!--TITLE -->
		                <?php if( $settings['title_content'] ) { ?>
		                <h2 class="author-name-info"><?php echo wp_kses_post($settings['title_content']); ?></h2>
		            	<?php } ?>

		            	<?php if( $settings['designation_content'] ) { ?>
		                <h2 class="ts-bubble-border">
		                    <span class="ts-title-rotate">
		                    	<?php $counter = 0; ?>
		                    	<?php foreach ($settings['designation_content'] as $key => $value) { ?>
		                    		<?php $activeClass = ( $counter == 0 ) ? 'active' : '' ; ?>
		                    			<span class="<?php echo esc_attr( $activeClass ); ?>"><?php echo wp_kses_post($value['desegnation_name']); ?></span>
		                    		<?php $counter++; ?>
		                    	<?php } ?>
		                    </span>
		                </h2>
		            	<?php } ?>
		            </div>
		            <!--end col-md-8-->
		        </div>
		        <?php if( $settings['add_section_scroll_enable'] == 'yes' ) { ?>
		        <!--end row-->
		        <a href="<?php echo esc_url( $settings['add_section_id'] ) ?>" class="ts-btn-effect position-absolute ts-bottom__0 ts-left__0 ts-scroll ml-3 mb-3 xsm-0">
		            <span class="ts-visible ts-circle__sm rounded-0 ts-bg-primary text-white">
		                <?php if ( ! empty( $settings['add_section_icons'] )  ) {
		                	selfer_render_icon( $settings, 'add_section_icons' );
		                } ?>
		            </span>
		            <span class="ts-hidden ts-circle__sm rounded-0 text-white">
		                <?php if ( ! empty( $settings['add_section_icons'] )  ) {
		                	selfer_render_icon( $settings, 'add_section_icons' );
		                } ?>
		            </span>
		        </a>
		    	<?php } ?>
		    </div>
		    <div class="ts-background">
		        <div class="ts-background-image"></div>
		    </div>
		</div>
		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Selfer_Banner_Widget() );