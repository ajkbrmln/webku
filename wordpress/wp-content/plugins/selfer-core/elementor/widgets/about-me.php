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
class Selfer_About_Me_Widget extends Widget_Base {

	public function get_name() {
		return 'selfer-about_me';
	}

	public function get_title() {
		return esc_html__( 'About Me Info', 'selfer-core' );
	}

	public function get_icon() {
		return 'eicon-person';
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
			'about_section',
			[
				'label' => esc_html__( 'Greetings', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'greetings_text',
			[
				'label' => esc_html__( 'Greetings Text', 'selfer-core' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => 'Hi There',
			]
		);

		$this->add_control(
			'greetings_descriptions',
			[
				'label' => esc_html__( 'Description', 'selfer-core' ),
				'label_block' => true,
				'type' => Controls_Manager::WYSIWYG,
			]
		);		

		$this->end_controls_section();

		$this->start_controls_section(
			'additional_info_block',
			[
				'label' => esc_html__( 'Additional Info', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);	

		$repeater = new Repeater();

		$repeater->add_control(
			'info',
			[
				'label_block' => true,
				'label' => esc_html__( 'Info Name', 'selfer-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Name',
			]
		);			
		
		$repeater->add_control(
			'info_description',
			[
				'label' => esc_html__( 'Description', 'selfer-core' ),
				'type' => Controls_Manager::TEXTAREA,
			]
		);	

		$this->add_control(
			'additional_info_item',
			[
				'label' => esc_html__( 'Additional Info', 'selfer-core' ),
				'type' => Controls_Manager::REPEATER,
				'prevent_empty' => false,  
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ info }}}',
			]
		);	

		$this->end_controls_section();	

		$this->start_controls_section(
			'button_controls',
			[
				'label' => esc_html__( 'Buttons', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'contact_button_text',
			[
				'label' => esc_html__( 'Contact Button Text', 'selfer-core' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Contact Me','selfer-core'),
			]
		);

		$this->add_control(
			'contact_button_url',
			[
				'label' => esc_html__( 'Contact Button URL', 'selfer-core' ),
				'label_block' => true,
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
			'cv_button_text',
			[
				'label' => esc_html__( 'CV Button Text', 'selfer-core' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Download CV','selfer-core'),
			]
		);

		$this->add_control(
			'cv_button_url',
			[
				'label' => esc_html__( 'CV Button URL', 'selfer-core' ),
				'label_block' => true,
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
			'greetings_styling',
			[
				'label' => esc_html__( 'Greetings Styling', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'greetings_title_color',
			[
				'label' => esc_html__( 'Greetings Title', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .selfer-bubble-border-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'greetings_descriptions_color',
			[
				'label' => esc_html__( 'Greetings Description', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#999999',
				'selectors' => [
					'{{WRAPPER}} .about-me-description' => 'color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'extra_info_style',
			[
				'label' => esc_html__( 'Additional Info', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'additional_info_title',
			[
				'label' => esc_html__( 'Additional Info Name', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#f26c4f',
				'selectors' => [
					'{{WRAPPER}} .selfer-about-me-content dt' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->add_control(
			'additional_info_descriptions',
			[
				'label' => esc_html__( 'Additional Info Description', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#999999',
				'selectors' => [
					'{{WRAPPER}} .selfer-about-me-content dd' => 'color: {{VALUE}};',
				],
			]
		);		

		$this->end_controls_section();

		$this->start_controls_section(
			'button_styling',
			[
				'label' => esc_html__( 'Button', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'contact_button_hover_bg',
			[
				'label' => esc_html__( 'Contact Hover BG', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#f26c4f',
				'selectors' => [
					'{{WRAPPER}} .ts-visible.btn.btn-primary' => 'background: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);	

		$this->add_control(
			'contact_button_bg',
			[
				'label' => esc_html__( 'Contact Hover BG', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#d44729',
			]
		);

		$this->add_control(
			'cv_button_bg',
			[
				'label' => esc_html__( 'CV Button Hover', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .bg-white' => 'background: {{VALUE}};',
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
	    <div class="selfer-about-me-content">
	    	<div class="row ts-align__vertical">
	    		<div class="col-lg-12">
	    			<?php if( $settings['greetings_text'] ) { ?>		
	                <h4 class="ts-bubble-border selfer-bubble-border-title"><?php echo esc_html( $settings['greetings_text'] ); ?></h4>
	            	<?php } ?>
	            	<?php if( $settings['greetings_descriptions'] ) { ?>
	                <div class="about-me-description"><?php echo wp_kses_post( $settings['greetings_descriptions'] ); ?></div>
	                <?php } ?>
	                <?php if( $settings['additional_info_item'] ) { ?>
	                <dl class="ts-column-count-2 additional-info-block">
	                	<?php foreach ($settings['additional_info_item'] as $key => $value) { ?>           		
		                    <dt><?php echo wp_kses_post($value['info']); ?>:</dt>
		                    <dd><?php echo wp_kses_post( $value['info_description'] ); ?></dd>
	                	<?php } ?>
	                </dl>
	            	<?php } ?>
	            	
	                <?php if( $settings['contact_button_text'] !== '' ) : ?>
	                <?php 
	                	$contactTarget = $settings['contact_button_url']['is_external'] ? ' target="_blank"' : '';
	                	$contactNofollow = $settings['contact_button_url']['nofollow'] ? ' rel="nofollow"' : '';
	                ?>	
	                <a href="<?php echo esc_url( $settings['contact_button_url']['url'] ); ?>" class="ts-btn-effect mr-2" <?php echo ( $contactTarget .' '. $contactNofollow ) ?>>
	                    <span class="ts-visible btn btn-primary ts-btn-arrow"><?php echo esc_html( $settings['contact_button_text'] ); ?></span>
	                    <span class="ts-hidden btn btn-primary ts-btn-arrow" data-bg-color="<?php echo esc_attr( $settings['contact_button_bg'] ); ?>"><?php echo esc_html( $settings['contact_button_text'] ); ?></span>
	                </a>
	            	<?php endif; ?>

					<?php if( $settings['cv_button_text'] !== '' ) : ?>
					<?php 
						$cvTarget = $settings['cv_button_url']['is_external'] ? ' target="_blank"' : '';
						$cvNofollow = $settings['cv_button_url']['nofollow'] ? ' rel="nofollow"' : '';
					?>	
	                <a href="<?php echo esc_url( $settings['cv_button_url']['url'] ); ?>" class="ts-btn-effect mr-2" <?php echo ( $cvTarget .' '. $cvNofollow ) ?>>
	                    <span class="ts-visible btn btn-outline-light">
	                        <i class="fa fa-download small mr-2"></i>
	                        <?php echo esc_html( $settings['cv_button_text'] ); ?>
	                    </span>
	                    <span class="ts-hidden btn btn-light bg-white">
	                        <i class="fa fa-download small mr-2"></i>
	                        <?php echo esc_html( $settings['cv_button_text'] ); ?>
	                    </span>
	                </a>
	            	<?php endif; ?>
	    		</div><!--  /.col-lg-12 -->
	    	</div><!--  /.row -->
	        <!--end row-->
	    </div>
		<?php 
	}

	/**
	 * Render Social Status widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	//protected function _content_template() { }
}

Plugin::instance()->widgets_manager->register_widget_type( new Selfer_About_Me_Widget() );