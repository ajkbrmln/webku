<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor progressbar widget.
 *
 * Elementor widget that displays an escalating progressbar bar.
 *
 * @since 1.0.0
 */
class Selfer_Progressbar extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve progressbar widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'slefer-progressbar';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve progressbar widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Progress Bar', 'selfer-core' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve progressbar widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-skill-bar';
	}

	public function get_categories() {
		return [ 'selfer-category' ];
	}

	/**
	 * Register progressbar widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_progressbar',
			[
				'label' => esc_html__( 'Progress Bar', 'selfer-core' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'selfer-core' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter your title', 'selfer-core' ),
				'default' => esc_html__( 'My Skill', 'selfer-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'percent',
			[
				'label' => esc_html__( 'Percentage', 'selfer-core' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 50,
					'unit' => '%',
				],
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'progress_style',
			[
				'label' => esc_html__( 'Progress Bar', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bar_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#f26c4f',
				'selectors' => [
					'{{WRAPPER}} .progress .progress-bar' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'progress_var_title',
			[
				'label' => esc_html__( 'Title Style', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'progress_var_title_color',
			[
				'label' => esc_html__( 'Text Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ts-progress-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .ts-progress-title',
			]
		);

		$this->add_control(
			'progress_var_value_color',
			[
				'label' => esc_html__( 'Percentage Block Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .ts-progress-value' => 'color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_section();
	}

	/**
	 * Render progressbar widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display(); 
		?>
		<div class="progress" data-progress-width="<?php echo esc_attr( $settings['percent']['size'] ); ?>%">
			<?php if ( ! empty( $settings['title'] ) ) { ?>
            <h5 class="ts-progress-title"><?php echo esc_html($settings['title']); ?></h5>
            <?php } ?>
            <figure class="ts-progress-value"></figure>
            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="<?php echo esc_attr( $settings['percent']['size'] ); ?>"></div>
        </div>
	<?php
	}

	/**
	 * Render progressbar widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {
		?>

			<div class="progress" data-progress-width="{{ settings.percent.size }}%">
				<# if( settings.title ) { #>
	            <h5 class="ts-progress-title">{{{ settings.title }}}</h5>
	            <# } #>
	            <figure class="ts-progress-value"></figure>
	            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="{{ settings.percent.size }}%"></div>
	        </div>

		<?php
	}

} // end class

Plugin::instance()->widgets_manager->register_widget_type( new Selfer_Progressbar() );
