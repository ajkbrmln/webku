<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Selfer Service Widget.
 *
 * Selfer widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0
 */

class Selfer_Service_Widget extends Widget_Base {

	public function get_name() {
		return 'slefer-service';
	}

	public function get_title() {
		return esc_html__( 'Service', 'selfer-core' );
	}

	public function get_icon() {
		return 'eicon-posts-grid';
	}

	public function get_categories() {
		return [ 'selfer-category' ];
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
			'number',
			[
				'label' => esc_html__( 'Total Post', 'selfer-core' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);	

		$this->add_control(
		    'readmore_content',
		    [
		        'label'                 => __( 'Read More Button', 'materia-core' ),
		        'type'                  => Controls_Manager::SWITCHER,
		        'default'               => 'yes',
		        'label_on'              => __( 'Show', 'materia-core' ),
		        'label_off'             => __( 'Hide', 'materia-core' ),
		        'return_value'          => 'yes',
		    ]
		);	
		
		$this->add_control(
			'read_more_text',
			[
				'label' => esc_html__( 'Read More Text', 'selfer-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Read More',
				'condition'             => [
				    'readmore_content'          => 'yes',
				],
			]
		);		

		$this->add_control(
		    'readmore_ajax_popup',
		    [
		        'label'                 => __( 'Read More Ajax Popup', 'selfer-core' ),
		        'type'                  => Controls_Manager::SWITCHER,
		        'default'               => 'yes',
		        'label_on'              => __( 'Show', 'materia-core' ),
		        'label_off'             => __( 'Hide', 'materia-core' ),
		        'return_value'          => 'yes',
		        'condition'             => [
		            'readmore_content'          => 'yes',
		        ],
		    ]
		);			

		$this->add_control(
			'number_of_columns',
			[
				'label' => esc_html__( 'Grid Columns', 'selfer-core' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'one_columns' => [
						'title' => esc_html__( 'One Columns', 'selfer-core' ),
						'icon' => 'fa fa-square',
					],
					'two_columns' => [
						'title' => esc_html__( 'Two Columns', 'selfer-core' ),
						'icon' => 'fa fa-th-large',
					],
					'three_columns' => [
						'title' => esc_html__( 'Three Columns', 'selfer-core' ),
						'icon' => 'fa fa-th',
					],
				],
				'default' => 'three_columns',
				'toggle' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_shortings',
			[
				'label' => esc_html__( 'Shortings', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => esc_html__( 'Order By', 'selfer-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'post_date',
				'options' => [
					'post_date' => esc_html__( 'Date', 'selfer-core' ),
					'post_title' => esc_html__( 'Title', 'selfer-core' ),
					'menu_order' => __( 'Menu Order', 'selfer-core' ),
					'rand' => esc_html__( 'Random', 'selfer-core' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => esc_html__( 'Order', 'selfer-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc' => esc_html__( 'ASC', 'selfer-core' ),
					'desc' => esc_html__( 'DESC', 'selfer-core' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'service_item_style',
			[
				'label' => esc_html__( 'Style', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'service_title_color',
			[
				'label' => esc_html__( 'Title Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ts-item-body h4' => 'color: {{VALUE}};',
				],
			]
		);	

		$this->add_control(
			'service_description_color',
			[
				'label' => esc_html__( 'Description Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#999999',
				'selectors' => [
					'{{WRAPPER}} .ts-item-body p' => 'color: {{VALUE}};',
				],
			]
		);			

		$this->add_control(
			'service_box_color',
			[
				'label' => esc_html__( 'Service Item Background', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#12141c',
				'selectors' => [
					'{{WRAPPER}} .ts-item-content' => 'background: {{VALUE}};',
				],
			]
		);				

		$this->add_control(
			'service_morelink_border_color',
			[
				'label' => esc_html__( 'Read More Border Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f26c4f',
				'selectors' => [
					'{{WRAPPER}} .ts-link-arrow-effect:before' => 'background-color: {{VALUE}};',
				],
			]
		);	

		$this->add_control(
			'service_morelink_color',
			[
				'label' => esc_html__( 'Read More Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ts-link-arrow-effect' => 'color: {{VALUE}};',
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

		<div class="row item-3">
			<?php 
			$service_query = new \WP_Query(
			    array(
			        'post_type' => 'service', 
			        'post_status' => 'publish',
					'posts_per_page' => $settings['number'],
					'orderby' => $settings['orderby'],
					'order'   => $settings['order'],  
			    )
			);

			if( $settings['number_of_columns'] == 'one_columns' ) {
				$columns_status = 'col-md-12';
			} elseif ( $settings['number_of_columns'] == 'two_columns' ) {
				$columns_status = 'col-sm-6 col-md-6 col-xl-6';
			} else {
				$columns_status = 'col-sm-6 col-md-4 col-xl-4';
			}

			while ($service_query->have_posts()) : $service_query->the_post(); ?>
				<div class="<?php echo esc_attr( $columns_status ); ?>">
			         <div class="ts-item" data-animate="ts-fadeInUp">
			             <div class="ts-item-content">
			                <div class="ts-item-header">
			                    <figure class="icon">
									<?php if( get_post_meta( get_the_ID(), 'selfer_service_images_icon', true) !== '' ) { ?>
			                        <img src="<?php echo esc_url( get_post_meta( get_the_ID(), 'selfer_service_images_icon', true) ); ?>" alt="<?php the_title(); ?>">
									<?php } elseif( get_post_meta( get_the_ID(), 'selfer_service_icons', true) !== '' ) { ?>
										<i class="<?php echo esc_attr( get_post_meta( get_the_ID(), 'selfer_service_icons', true) ); ?>"></i>
									<?php } ?>
			                    </figure>
			                </div>
			                <div class="ts-item-body">
			                	<?php if( $settings['readmore_ajax_popup'] == 'yes' ) { ?>
			                    <h4>
									<a href="#" class="ts-title-arrow-ajax" data-toggle="modal" data-target="#modal" data-rel="<?php echo esc_attr(get_the_ID()); ?>">
										<?php the_title(); ?>
									</a>
								</h4>
								<?php } else { ?>
			                    <h4>
									<a href="<?php echo esc_url( the_permalink() ); ?>" class="ts-title-arrow-single">
										<?php the_title(); ?>
									</a>
								</h4>
								<?php } ?>
			                    <p class="mb-0"><?php echo esc_html( get_post_meta(get_the_ID(), 'selfer_service_short_description', true) ); ?></p>
			                </div>
			                <?php if( $settings['readmore_content'] == 'yes' ) { ?>
			                <div class="ts-item-footer">
			                	<?php if( $settings['readmore_ajax_popup'] == 'yes' ) { ?>
			                    <a href="#" data-toggle="modal" data-target="#modal" class="ts-link-arrow-effect" data-rel="<?php echo esc_attr(get_the_ID()); ?>">
			                        <span><?php echo esc_html( $settings['read_more_text'] ); ?></span>
			                    </a>
			                    <?php } else { ?>
		                    	<a href="<?php echo esc_url( the_permalink() ); ?>" class="ts-link-arrow-effect">
		                    	    <span><?php echo esc_html( $settings['read_more_text'] ); ?></span>
		                    	</a>
			                    <?php } ?>
			                </div>
			            	<?php } ?>
			            </div>
			        </div>
			    </div>
			<?php endwhile; ?> <?php wp_reset_postdata(); ?> 
		</div><!-- /.row -->
	<?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new Selfer_Service_Widget() );