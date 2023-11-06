<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Selfer Portfolio Widget.
 *
 * Selfer widget that inserts an embeddable content into the page, from any given URL.
 *
 * @since 1.0
 */

class Selfer_Portfolio_Widget extends Widget_Base {

	public function get_name() {
		return 'slefer-portfolio';
	}

	public function get_title() {
		return esc_html__( 'Portfolio', 'selfer-core' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'selfer-category' ];
	}

	/**
	 * Register Portfolio widget controls.
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
				'default' => 12,
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

		$this->add_control(
			'portfolio_open_with',
			[
				'label' => esc_html__( 'Portfolio Open With', 'selfer-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'popup',
				'options' => [
					'popup'  => esc_html__( 'Popup', 'selfer-core' ),
					'single' => esc_html__( 'Single Portfolio', 'selfer-core' ),
					'custom' => esc_html__( 'Custom Links', 'selfer-core' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_shortings',
			[
				'label' => esc_html__( 'Query', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'post_types',
			[
				'label' => esc_html__( 'Choose Post Type', 'selfer-core' ),
				'type' => Controls_Manager::SELECT2,
				'default' => 'portfolio',
				'options' => selfer_get_all_post_type_options(),
				'multiple' => true,
			]
		);

		$this->add_control(
		    'tax_query',
		    [
		        'label' => esc_html__('Taxonomies', 'selfer-core'),
		        'type' => Controls_Manager::SELECT2,
		        'options' => selfer_get_all_taxonomy_options(),
		        'multiple' => true,
		        'label_block' => true
		    ]
		);

		$this->add_control(
		    'post_in',
		    [
		        'label' => esc_html__('Post In', 'selfer-core'),
		        'description' => esc_html__('Provide a comma separated list of Post IDs to display in the grid.', 'selfer-core'),
		        'type' => Controls_Manager::TEXT,
		        'label_block' => true
		    ]
		);

		$this->add_control(
		    'shortings',
		    [
		        'label' => esc_html__('Shortings', 'selfer-core'),
		        'type' => Controls_Manager::HEADING,
		    ]
		);		

		$this->add_control(
			'orderby',
			[
				'label' => esc_html__( 'Order By', 'selfer-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'none' => esc_html__('No order', 'selfer-core'),
					'ID' => esc_html__('Post ID', 'selfer-core'),
					'author' => esc_html__('Author', 'selfer-core'),
					'title' => esc_html__('Title', 'selfer-core'),
					'date' => esc_html__('Published date', 'selfer-core'),
					'modified' => esc_html__('Modified date', 'selfer-core'),
					'parent' => esc_html__('By parent', 'selfer-core'),
					'rand' => esc_html__('Random order', 'selfer-core'),
					'comment_count' => esc_html__('Comment count', 'selfer-core'),
					'menu_order' => esc_html__('Menu order', 'selfer-core'),
					'post__in' => esc_html__('By include order', 'selfer-core'),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => esc_html__( 'Order', 'selfer-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'ASC' => esc_html__( 'ASC', 'selfer-core' ),
					'DESC' => esc_html__( 'DESC', 'selfer-core' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content Styling', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'portfolio_title_color',
			[
				'label' => esc_html__( 'Icon Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ts-gallery__item-description h6, .ts-gallery__item-description h4' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Portfolio widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() { 
		$settings = $this->get_settings_for_display();
		if( $settings['number_grids'] == 'one' ) {
			$grid_no = 'col-md-12 col-lg-12';
		} elseif( $settings['number_grids'] == 'two' ) {
			$grid_no = 'col-md-6 col-lg-6';
		} elseif( $settings['number_grids'] == 'three' ) {
			$grid_no = 'col-md-6 col-lg-4';
		} else {
			$grid_no = 'col-md-6 col-lg-3';
		} ?>
		<div class="row ts-gallery">
			<?php 
				$terms = get_terms( array(
				    'taxonomy' => 'portfolio-category',
				    'hide_empty' => false,
				) );

				$query_args = selfer_build_query_args( $settings ); 
				$portfolio_query = new \WP_Query($query_args); 

			while ($portfolio_query->have_posts()) : $portfolio_query->the_post(); ?> 
			<?php if ( has_post_thumbnail() ) { 
				$get_portfolio_url_stauts = $settings['portfolio_open_with'];
				if( $get_portfolio_url_stauts == 'custom' ) {
					$portfolio_open_type = get_post_meta(get_the_ID(), 'selfer_custom_link', true);
				} elseif( $get_portfolio_url_stauts == 'single' ) {
					$portfolio_open_type = get_post_permalink(get_the_ID());
				} else {
					if( get_post_meta(get_the_ID(), 'selfer_video_embed_popup_link', true) !== '' ) {
						$portfolio_open_type = get_post_meta(get_the_ID(), 'selfer_video_embed_popup_link', true);
						$popup_class = 'video-popup';
					} else {
						$portfolio_open_type = get_the_post_thumbnail_url(get_the_ID(), 'full');
						$popup_class = '';
					}
				}
			?> 
			<div class="<?php echo esc_attr($grid_no); ?> gallery-items-main card ts-gallery__item">
				<a href="<?php echo esc_url( $portfolio_open_type ); ?>" class="<?php echo esc_attr( $popup_class ); ?>" data-animate="ts-fadeInUp">
					<figure class="portfolio-thumb">
						<?php 
							$image_size = get_post_meta(get_the_ID(), 'selfer_featured_image_masonry_size', true);
							if( $settings['number_grids'] == 'one' ) {
								selfer_post_featured_image(1120, 750, true, false); 
							} elseif( $settings['number_grids'] == 'two' ) {
								if( $image_size == 'x_x' ) {
									selfer_post_featured_image(550, 385, true, false); 
								} elseif ( $image_size == 'x_dx' ) {
									selfer_post_featured_image(550, 588, true, false); 
								} elseif ( $image_size == 'dx_x' ) {
									selfer_post_featured_image(550, 749, true, false); 
								} elseif ( $image_size == 'dx_dx' ) {
									selfer_post_featured_image(550, 441, true, false); 
								} else {
									selfer_post_featured_image(540, 411, true, false); 
								}
							} elseif( $settings['number_grids'] == 'three' ) {
								if( $image_size == 'x_x' ) {
									selfer_post_featured_image(360, 252, true, false); 
								} elseif ( $image_size == 'x_dx' ) {
									selfer_post_featured_image(360, 385, true, false); 
								} elseif ( $image_size == 'dx_x' ) {
									selfer_post_featured_image(360, 490, true, false); 
								} elseif ( $image_size == 'dx_dx' ) {
									selfer_post_featured_image(360, 289, true, false); 
								} else {
									selfer_post_featured_image(360, 289, true, false); 
								}
							} else {            		
								if( $image_size == 'x_x' ) {
									selfer_post_featured_image(263, 184, true, false); 
								} elseif ( $image_size == 'x_dx' ) {
									selfer_post_featured_image(263, 281, true, false); 
								} elseif ( $image_size == 'dx_x' ) {
									selfer_post_featured_image(263, 358, true, false); 
								} elseif ( $image_size == 'dx_dx' ) {
									selfer_post_featured_image(263, 211, true, false); 
								} else {
									selfer_post_featured_image(263, 211, true, false); 
								}
							}
						?>
						<div class="ts-gallery__item-description">
							<?php 
								$portfilio_cats = get_the_terms( get_the_ID(), 'portfolio-category' ); 
								$cats_name = "";
								foreach($portfilio_cats as $cat_name) {    
									$cats_name .= $cat_name->name.' '; 
								}
							?>
							<h6 class="ts-opacity__50"><?php echo esc_html($cats_name); ?></h6>
							<h4><?php echo esc_html( get_the_title() ); ?></h4>
						</div>
					</figure>
				</a>
			</div>
	    	<?php } ?>
	        <?php endwhile; ?> <?php wp_reset_postdata(); ?>
		</div>
		<?php
		/**
		 * Happy isotope hack.
		 *
		 * This piece of code may seem unnecessary to you
		 * but it saved me from hell!!!
		 */
		if ( Plugin::$instance->editor->is_edit_mode() ) :
		    printf( '<script>jQuery(window).on("load", function() { jQuery(".ts-gallery").isotope();})</script>' );
		endif; ?>
	<?php }

}

Plugin::instance()->widgets_manager->register_widget_type( new Selfer_Portfolio_Widget() );