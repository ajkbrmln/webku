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
class Selfer_Social_Profile_Widget extends Widget_Base {

	public function get_name() {
		return 'slefer-social-profile';
	}

	public function get_title() {
		return esc_html__( 'Social Url', 'selfer-core' );
	}

	public function get_icon() {
		return 'eicon-share';
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
			'social_info_aligments',
			[
				'label' => esc_html__( 'Alignments', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);	

		$this->add_control(
			'social_item_alignment',
			[
				'label' => esc_html__( 'Alignment', 'selfer-core' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Start', 'selfer-core' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'selfer-core' ),
						'icon' => 'fa fa-align-center',
					],
					'end' => [
						'title' => esc_html__( 'End', 'selfer-core' ),
						'icon' => 'fa fa-align-right',
					],			
					'around' => [
						'title' => esc_html__( 'Around', 'selfer-core' ),
						'icon' => 'fa fa-th-large',
					],		
					'between' => [
						'title' => esc_html__( 'Between', 'selfer-core' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'between',
				'toggle' => true,
			]
		);

		$this->end_controls_section();	

		$this->start_controls_section(
			'social_info_section',
			[
				'label' => esc_html__( 'Social Url', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
		    'title',
		    [
		    	'label' => esc_html__( 'Title', 'selfer-core' ),
		    	'type' => Controls_Manager::TEXT,
		    	'default' => '',
		    ]
		);

		if( selfer_is_elementor_version( '<', '2.6.0' ) ) {
			$repeater->add_control(
			    'icon',
			    [
			    	'label' => esc_html__( 'Icon', 'selfer-core' ),
			    	'type' => Controls_Manager::ICON,
			    	'default' => 'fa fa-facebook',
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
		    'custom_icon',
		    [
		    	'label' => esc_html__( 'or Custom Icon', 'selfer-core' ),
		    	'type' => Controls_Manager::TEXTAREA,
		    	'default' => '',
		    ]
		);		

		$repeater->add_control(
		    'social_url',
		    [
		    	'label' => esc_html__( 'URL', 'selfer-core' ),
		    	'type' => Controls_Manager::URL,
		    	'placeholder' => esc_html__( 'https://your-link.com', 'selfer-core' ),
		    	'show_external' => true,
		    	'default' => [
		    		'url' => '',
		    		'is_external' => true,
		    		'nofollow' => true,
		    	]
		    ]
		);

		$this->add_control(
			'social_info_elem',
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

		$this->add_control(
			'social_item_bg',
			[
				'label' => esc_html__( 'Icon Background', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
			]
		);		

		$this->add_control(
			'social_item_icons_color',
			[
				'label' => esc_html__( 'Icon Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .selfer-social-items i' => 'color: {{VALUE}};',
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
		if( $settings['social_item_alignment'] == 'start' ) {
			$alignment = 'justify-content-start';
		} elseif ( $settings['social_item_alignment'] == 'center' ) {
			$alignment = 'justify-content-center';
		} elseif ( $settings['social_item_alignment'] == 'end' ) {
			$alignment = 'justify-content-end';
		} elseif ( $settings['social_item_alignment'] == 'around' ) {
			$alignment = 'justify-content-around';
		} else {
			$alignment = 'justify-content-between';
		} 
		$fallback_defaults = [
			'fa fa-facebook',
			'fa fa-twitter',
			'fa fa-instagram',
		];
		$migration_allowed = Icons_Manager::is_migration_allowed(); ?>

		<div class="d-md-flex <?php echo esc_attr( $alignment ); ?> selfer-social-items">
			<?php foreach ($settings['social_info_elem'] as $key => $value) { ?>
				<?php 
					$target = $value['social_url']['is_external'] ? ' target="_blank"' : '';
					$nofollow = $value['social_url']['nofollow'] ? ' rel="nofollow"' : '';
			
					if ( ! isset( $value['icon'] ) && ! $migration_allowed ) {
						$value['icon'] = isset( $fallback_defaults[ $key ] ) ? $fallback_defaults[ $key ] : 'fa fa-facebook';
					}
			        $migrated = isset( $value['__fa4_migrated']['selected_icon'] );
			        $is_new = ! isset( $value['icon'] ) && $migration_allowed;
			        			
			        if ( ! empty( $value['icon'] ) || ( ! empty( $value['selected_icon']['value'] ) && $is_new ) ) :
				?>

	           	<a href="<?php echo esc_url( $value['social_url']['url'] ); ?>" class="mb-3 mr-3 d-flex text-white ts-align__vertical" <?php echo ( $target .' '. $nofollow ); ?>>
		           	<span class="ts-circle__xs border ts-border-transparent mr-4" style="background: <?php echo esc_attr( $settings['social_item_bg'] ) ?>;">
		           		<?php
		           		if ( $is_new || $migrated ) {
		           			Icons_Manager::render_icon( $value['selected_icon'], [ 'aria-hidden' => 'true' ] );
		           		} else { ?>
		           			<i class="<?php echo esc_attr( $value['icon'] ); ?>" aria-hidden="true"></i>
		           		<?php } ?>
		           	</span>
	           	    <span class="social-title"><?php echo esc_attr( $value['title'] ); ?></span>
	           	</a>
			    <?php else: ?>
			    <a href="<?php echo esc_url( $value['social_url']['url'] ); ?>" class="mb-3 mr-3 d-flex text-white ts-align__vertical" <?php echo ( $target .' '. $nofollow ); ?>>
		           	<span class="ts-circle__xs border ts-border-transparent mr-4" style="background: <?php echo esc_attr( $settings['social_item_bg'] ) ?>;">
						<i class="<?php echo esc_attr( ( $value['custom_icon'] !=='' ) ? $value['custom_icon']  : ''  ); ?>"></i>
					</span>
	           	    <span class="social-title"><?php echo esc_attr( $value['title'] ); ?></span>
	           	</a>
			    <?php endif; ?>	
	           	<!--end link-->
	        <?php } ?> 
       </div>
		<?php 
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Selfer_Social_Profile_Widget() );