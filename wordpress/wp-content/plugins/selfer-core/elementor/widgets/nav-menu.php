<?php
namespace Elementor;
use Elementor\Core\Responsive\Responsive;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
/**
 * Selfer Nav Menu
 *
 * Selfer widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0
 */

class Selfer_Nav_Menus_Widget extends Widget_Base {

	protected $nav_menu_index = 1;

	public function get_name() {
		return 'selfer-nav-menu';
	}

	public function get_title() {
		return esc_html__( 'Nav Menu', 'selfer-core' );
	}

	public function get_icon() {
		return 'eicon-nav-menu';
	}

	public function get_categories() {
		return [ 'selfer-header-footer' ];
	}

	public function on_export( $element ) {
		unset( $element['settings']['menu'] );

		return $element;
	}

	protected function get_nav_menu_index() {
		return $this->nav_menu_index++;
	}

	private function get_available_menus() {
		$menus = wp_get_nav_menus();
		$options = [];
		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}
		return $options;
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
				'label' => esc_html__( 'Menu Content', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$menus = $this->get_available_menus();

		if ( ! empty( $menus ) ) {
			$this->add_control(
				'menu',
				[
					'label' => esc_html__( 'Menu', 'selfer-core' ),
					'type' => Controls_Manager::SELECT,
					'options' => $menus,
					'default' => array_keys( $menus )[0],
					'save_default' => true,
					'separator' => 'after',
					'description' => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'selfer-core' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		} else {
			$this->add_control(
				'menu',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'selfer-core' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator' => 'after',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}

		$this->add_control(
			'layout',
			[
				'label' => esc_html__( 'Layout', 'selfer-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal' => esc_html__( 'Horizontal', 'selfer-core' ),
					'vertical' => esc_html__( 'Vertical', 'selfer-core' ),
					'dropdown' => esc_html__( 'Dropdown', 'selfer-core' ),
					'hamburger' => esc_html__( 'Hamburger Menu', 'selfer-core' ),
				],
				'frontend_available' => true,
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
					'justify' => [
						'title' => esc_html__( 'Stretch', 'selfer-core' ),
						'icon' => 'eicon-h-align-stretch',
					],
				],
				'prefix_class' => 'elementor-nav-menu-align-',
				'condition' => [
					'layout!' => 'dropdown',
					'layout!' => 'hamburger',
				],
			]
		);

		$this->add_control(
			'pointer',
			[
				'label' => esc_html__( 'Pointer', 'selfer-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'underline',
				'options' => [
					'none' => esc_html__( 'None', 'selfer-core' ),
					'underline' => esc_html__( 'Underline', 'selfer-core' ),
					'overline' => esc_html__( 'Overline', 'selfer-core' ),
					'double-line' => esc_html__( 'Double Line', 'selfer-core' ),
					'framed' => esc_html__( 'Framed', 'selfer-core' ),
					'background' => esc_html__( 'Background', 'selfer-core' ),
					'text' => esc_html__( 'Text', 'selfer-core' ),
				],
				'condition' => [
					'layout!' => 'dropdown',
					'layout!' => 'hamburger',
				],
			]
		);

		$this->add_control(
			'animation_line',
			[
				'label' => esc_html__( 'Animation', 'selfer-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fade',
				'options' => [
					'fade' => 'Fade',
					'slide' => 'Slide',
					'grow' => 'Grow',
					'drop-in' => 'Drop In',
					'drop-out' => 'Drop Out',
					'none' => 'None',
				],
				'condition' => [
					'layout!' => 'dropdown',
					'layout!' => 'hamburger',
					'pointer' => [ 'underline', 'overline', 'double-line' ],
				],
			]
		);

		$this->add_control(
			'animation_framed',
			[
				'label' => esc_html__( 'Animation', 'selfer-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fade',
				'options' => [
					'fade' => 'Fade',
					'grow' => 'Grow',
					'shrink' => 'Shrink',
					'draw' => 'Draw',
					'corners' => 'Corners',
					'none' => 'None',
				],
				'condition' => [
					'layout!' => 'dropdown',
					'layout!' => 'hamburger',
					'pointer' => 'framed',
				],
			]
		);

		$this->add_control(
			'animation_background',
			[
				'label' => esc_html__( 'Animation', 'selfer-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fade',
				'options' => [
					'fade' => 'Fade',
					'grow' => 'Grow',
					'shrink' => 'Shrink',
					'sweep-left' => 'Sweep Left',
					'sweep-right' => 'Sweep Right',
					'sweep-up' => 'Sweep Up',
					'sweep-down' => 'Sweep Down',
					'shutter-in-vertical' => 'Shutter In Vertical',
					'shutter-out-vertical' => 'Shutter Out Vertical',
					'shutter-in-horizontal' => 'Shutter In Horizontal',
					'shutter-out-horizontal' => 'Shutter Out Horizontal',
					'none' => 'None',
				],
				'condition' => [
					'layout!' => 'dropdown',
					'layout!' => 'hamburger',
					'pointer' => 'background',
				],
			]
		);

		$this->add_control(
			'animation_text',
			[
				'label' => esc_html__( 'Animation', 'selfer-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'grow',
				'options' => [
					'grow' => 'Grow',
					'shrink' => 'Shrink',
					'sink' => 'Sink',
					'float' => 'Float',
					'skew' => 'Skew',
					'rotate' => 'Rotate',
					'none' => 'None',
				],
				'condition' => [
					'layout!' => 'dropdown',
					'layout!' => 'hamburger',
					'pointer' => 'text',
				],
			]
		);

		$this->add_control(
			'indicator',
			[
				'label' => esc_html__( 'Submenu Indicator', 'selfer-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'classic',
				'options' => [
					'none' => esc_html__( 'None', 'selfer-core' ),
					'classic' => esc_html__( 'Classic', 'selfer-core' ),
					'chevron' => esc_html__( 'Chevron', 'selfer-core' ),
					'angle' => esc_html__( 'Angle', 'selfer-core' ),
					'plus' => esc_html__( 'Plus', 'selfer-core' ),
				],
				'prefix_class' => 'selfer-nav-menu-indicator-',
			]
		);

		$this->add_control(
			'heading_mobile_dropdown',
			[
				'label' => esc_html__( 'Mobile Dropdown', 'selfer-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'layout!' => 'dropdown',
					'layout!' => 'hamburger',
				],
			]
		);

		$breakpoints = Responsive::get_breakpoints();

		$this->add_control(
			'dropdown',
			[
				'label' => esc_html__( 'Breakpoint', 'selfer-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'tablet',
				'options' => [
					/* translators: %d: Breakpoint number. */
					'mobile' => sprintf( __( 'Mobile (< %dpx)', 'selfer-core' ), $breakpoints['md'] ),
					/* translators: %d: Breakpoint number. */
					'tablet' => sprintf( __( 'Tablet (< %dpx)', 'selfer-core' ), $breakpoints['lg'] ),
				],
				'prefix_class' => 'selfer-nav-menu-dropdown-',
				'condition' => [
					'layout!' => 'dropdown',
					'layout!' => 'hamburger',
				],
			]
		);

		$this->add_control(
			'text_align',
			[
				'label' => esc_html__( 'Align', 'selfer-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'aside',
				'options' => [
					'aside' => esc_html__( 'Aside', 'selfer-core' ),
					'center' => esc_html__( 'Center', 'selfer-core' ),
				],
				'prefix_class' => 'selfer-nav-menu-text-align-',
			]
		);

		$this->add_control(
			'toggle',
			[
				'label' => esc_html__( 'Toggle Button', 'selfer-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'burger',
				'options' => [
					'' => esc_html__( 'None', 'selfer-core' ),
					'burger' => esc_html__( 'Hamburger', 'selfer-core' ),
				],
				'prefix_class' => 'selfer-nav-menu-toggle selfer-nav-menu-',
				'render_type' => 'template',
				'frontend_available' => true,
				'condition' => [
					'layout!' => 'hamburger',
				],
			]
		);

		$this->add_control(
			'toggle_align',
			[
				'label' => esc_html__( 'Toggle Align', 'selfer-core' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
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
				'prefix_class' => 'selfer-dropdown-',
				'render_type' => 'template',
				'condition' => [
					'toggle!' => '',
					'layout!' => 'hamburger',
				],
				'label_block' => false,
			]
		);	

		$this->add_control(
			'hamburger_align',
			[
				'label' => esc_html__( 'Hamburger Align', 'selfer-core' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
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
				'prefix_class' => 'selfer-hamburger-',
				'render_type' => 'template',
				'condition' => [
					'layout' => 'hamburger',
				],
				'label_block' => false,
			]
		);		

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_main-menu',
			[
				'label' => esc_html__( 'Main Menu', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'dropdown',
					'layout!' => 'hamburger',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'menu_typography',
				'selector' => '{{WRAPPER}} .selfer-nav-menu-main',
			]
		);

		$this->start_controls_tabs( 'tabs_menu_item_style' );

		$this->start_controls_tab(
			'tab_menu_item_normal',
			[
				'label' => esc_html__( 'Normal', 'selfer-core' ),
			]
		);

		$this->add_control(
			'color_menu_item',
			[
				'label' => esc_html__( 'Text Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .selfer-nav-menu-main .selfer-item' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_menu_item_hover',
			[
				'label' => esc_html__( 'Hover', 'selfer-core' ),
			]
		);


		$this->add_control(
			'color_menu_item_hover',
			[
				'label' => esc_html__( 'Text Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .selfer-nav-menu-main .selfer-item:hover,
					{{WRAPPER}} .selfer-nav-menu-main .selfer-item.selfer-item-active,
					{{WRAPPER}} .selfer-nav-menu-main .selfer-item.highlighted,
					{{WRAPPER}} .selfer-nav-menu-main .selfer-item:focus' => 'color: {{VALUE}}',
				],
				'condition' => [
					'pointer!' => 'background',
				],
			]
		);

		$this->add_control(
			'color_menu_item_hover_pointer_bg',
			[
				'label' => esc_html__( 'Text Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .selfer-nav-menu-main .selfer-item:hover,
					{{WRAPPER}} .selfer-nav-menu-main .selfer-item.selfer-item-active,
					{{WRAPPER}} .selfer-nav-menu-main .selfer-item.highlighted,
					{{WRAPPER}} .selfer-nav-menu-main .selfer-item:focus' => 'color: {{VALUE}}',
				],
				'condition' => [
					'pointer' => 'background',
				],
			]
		);

		$this->add_control(
			'pointer_color_menu_item_hover',
			[
				'label' => esc_html__( 'Pointer Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .selfer-nav-menu-main:not(.e-pointer-framed) .selfer-item:before,
					{{WRAPPER}} .selfer-nav-menu-main:not(.e-pointer-framed) .selfer-item:after' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .e-pointer-framed .selfer-item:before,
					{{WRAPPER}} .e-pointer-framed .selfer-item:after' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'pointer!' => [ 'none', 'text' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_menu_item_active',
			[
				'label' => esc_html__( 'Active', 'selfer-core' ),
			]
		);

		$this->add_control(
			'color_menu_item_active',
			[
				'label' => esc_html__( 'Text Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .selfer-nav-menu-main .selfer-item.selfer-item-active' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'pointer_color_menu_item_active',
			[
				'label' => esc_html__( 'Pointer Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .selfer-nav-menu-main:not(.e-pointer-framed) .selfer-item.selfer-item-active:before,
					{{WRAPPER}} .selfer-nav-menu-main:not(.e-pointer-framed) .selfer-item.selfer-item-active:after' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .e-pointer-framed .selfer-item.selfer-item-active:before,
					{{WRAPPER}} .e-pointer-framed .selfer-item.selfer-item-active:after' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'pointer!' => [ 'none', 'text' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		/* This control is required to handle with complicated conditions */
		$this->add_control(
			'hr',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->add_control(
			'pointer_width',
			[
				'label' => esc_html__( 'Pointer Width', 'selfer-core' ),
				'type' => Controls_Manager::SLIDER,
				'devices' => [ self::RESPONSIVE_DESKTOP, self::RESPONSIVE_TABLET ],
				'range' => [
					'px' => [
						'max' => 30,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .e-pointer-framed .selfer-item:before' => 'border-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .e-pointer-framed.e-animation-draw .selfer-item:before' => 'border-width: 0 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .e-pointer-framed.e-animation-draw .selfer-item:after' => 'border-width: {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0 0',
					'{{WRAPPER}} .e-pointer-framed.e-animation-corners .selfer-item:before' => 'border-width: {{SIZE}}{{UNIT}} 0 0 {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .e-pointer-framed.e-animation-corners .selfer-item:after' => 'border-width: 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0',
					'{{WRAPPER}} .e-pointer-underline .selfer-item:after,
					 {{WRAPPER}} .e-pointer-overline .selfer-item:before,
					 {{WRAPPER}} .e-pointer-double-line .selfer-item:before,
					 {{WRAPPER}} .e-pointer-double-line .selfer-item:after' => 'height: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'pointer' => [ 'underline', 'overline', 'double-line', 'framed' ],
				],
			]
		);

		$this->add_responsive_control(
			'padding_horizontal_menu_item',
			[
				'label' => esc_html__( 'Horizontal Padding', 'selfer-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'devices' => [ 'desktop', 'tablet' ],
				'selectors' => [
					'{{WRAPPER}} .selfer-nav-menu-main .selfer-item' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'padding_vertical_menu_item',
			[
				'label' => esc_html__( 'Vertical Padding', 'selfer-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'devices' => [ 'desktop', 'tablet' ],
				'selectors' => [
					'{{WRAPPER}} .selfer-nav-menu-main .selfer-item' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);


		$this->add_responsive_control(
			'menu_space_between',
			[
				'label' => esc_html__( 'Space Between', 'selfer-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'devices' => [ 'desktop', 'tablet' ],
				'selectors' => [
					'body:not(.rtl) {{WRAPPER}} .selfer-nav-menu-layout-horizontal .selfer-nav-menu > li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .selfer-nav-menu-layout-horizontal .selfer-nav-menu > li:not(:last-child)' => 'margin-left: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .selfer-nav-menu--main:not(.selfer-nav-menu-layout-horizontal) .selfer-nav-menu > li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'border_radius_menu_item',
			[
				'label' => esc_html__( 'Border Radius', 'selfer-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'devices' => [ 'desktop', 'tablet' ],
				'selectors' => [
					'{{WRAPPER}} .selfer-item:before' => 'border-radius: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .e-animation-shutter-in-horizontal .selfer-item:before' => 'border-radius: {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0 0',
					'{{WRAPPER}} .e-animation-shutter-in-horizontal .selfer-item:after' => 'border-radius: 0 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .e-animation-shutter-in-vertical .selfer-item:before' => 'border-radius: 0 {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0',
					'{{WRAPPER}} .e-animation-shutter-in-vertical .selfer-item:after' => 'border-radius: {{SIZE}}{{UNIT}} 0 0 {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'pointer' => 'background',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_dropdown',
			[
				'label' => esc_html__( 'Dropdown', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'hamburger',
				],
			]
		);

		$this->add_control(
			'dropdown_description',
			[
				'raw' => esc_html__( 'On desktop, this will affect the submenu. On mobile, this will affect the entire menu.', 'selfer-core' ),
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-descriptor',
			]
		);

		$this->start_controls_tabs( 'tabs_dropdown_item_style' );

		$this->start_controls_tab(
			'tab_dropdown_item_normal',
			[
				'label' => esc_html__( 'Normal', 'selfer-core' ),
			]
		);

		$this->add_control(
			'color_dropdown_item',
			[
				'label' => esc_html__( 'Text Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .selfer-nav-menu-dropdown a, {{WRAPPER}} .selfer-menu-toggle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'background_color_dropdown_item',
			[
				'label' => esc_html__( 'Background Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .selfer-nav-menu-dropdown' => 'background-color: {{VALUE}}',
				],
				'separator' => 'none',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_dropdown_item_hover',
			[
				'label' => esc_html__( 'Hover', 'selfer-core' ),
			]
		);

		$this->add_control(
			'color_dropdown_item_hover',
			[
				'label' => esc_html__( 'Text Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .selfer-nav-menu-dropdown a:hover,
					{{WRAPPER}} .selfer-nav-menu-dropdown a.selfer-item-active,
					{{WRAPPER}} .selfer-menu-toggle:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'background_color_dropdown_item_hover',
			[
				'label' => esc_html__( 'Background Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .selfer-nav-menu-dropdown a:hover,
					{{WRAPPER}} .selfer-nav-menu-dropdown a.selfer-item-active,
					{{WRAPPER}} .selfer-nav-menu-dropdown a.highlighted' => 'background-color: {{VALUE}}',
				],
				'separator' => 'none',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_dropdown_item_active',
			[
				'label' => esc_html__( 'Active', 'selfer-core' ),
			]
		);

		$this->add_control(
			'color_dropdown_item_active',
			[
				'label' => esc_html__( 'Text Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .selfer-nav-menu-dropdown a.selfer-item-active' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'background_color_dropdown_item_active',
			[
				'label' => esc_html__( 'Background Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .selfer-nav-menu-dropdown a.selfer-item-active' => 'background-color: {{VALUE}}',
				],
				'separator' => 'none',
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'dropdown_typography',
				'exclude' => [ 'line_height' ],
				'selector' => '{{WRAPPER}} .selfer-nav-menu-dropdown',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'dropdown_border',
				'selector' => '{{WRAPPER}} .selfer-nav-menu-dropdown',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'dropdown_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'selfer-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .selfer-nav-menu-dropdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .selfer-nav-menu-dropdown li:first-child a' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};',
					'{{WRAPPER}} .selfer-nav-menu-dropdown li:last-child a' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'dropdown_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .selfer-nav-menu-main .selfer-nav-menu-dropdown, {{WRAPPER}} .selfer-nav-menu-container.selfer-nav-menu-dropdown',
			]
		);

		$this->add_responsive_control(
			'padding_horizontal_dropdown_item',
			[
				'label' => esc_html__( 'Horizontal Padding', 'selfer-core' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .selfer-nav-menu-dropdown a' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',

			]
		);

		$this->add_responsive_control(
			'padding_vertical_dropdown_item',
			[
				'label' => esc_html__( 'Vertical Padding', 'selfer-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .selfer-nav-menu-dropdown a' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'heading_dropdown_divider',
			[
				'label' => esc_html__( 'Divider', 'selfer-core' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'dropdown_divider',
				'selector' => '{{WRAPPER}} .selfer-nav-menu-dropdown li:not(:last-child)',
				'exclude' => [ 'width' ],
			]
		);

		$this->add_control(
			'dropdown_divider_width',
			[
				'label' => esc_html__( 'Border Width', 'selfer-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .selfer-nav-menu-dropdown li:not(:last-child)' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'dropdown_divider_border!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'dropdown_top_distance',
			[
				'label' => esc_html__( 'Distance', 'selfer-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .selfer-nav-menu-main > .selfer-nav-menu > li > .selfer-nav-menu-dropdown, {{WRAPPER}} .selfer-nav-menu__container.selfer-nav-menu-dropdown' => 'margin-top: {{SIZE}}{{UNIT}} !important',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section( 'style_toggle',
			[
				'label' => esc_html__( 'Toggle Button', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'toggle!' => '',
					'layout!' => 'hamburger',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_toggle_style' );

		$this->start_controls_tab(
			'tab_toggle_style_normal',
			[
				'label' => esc_html__( 'Normal', 'selfer-core' ),
			]
		);

		$this->add_control(
			'toggle_color',
			[
				'label' => esc_html__( 'Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} div.selfer-menu-toggle' => 'color: {{VALUE}}', // Harder selector to override text color control
				],
			]
		);

		$this->add_control(
			'toggle_background_color',
			[
				'label' => esc_html__( 'Background Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .selfer-menu-toggle' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_toggle_style_hover',
			[
				'label' => esc_html__( 'Hover', 'selfer-core' ),
			]
		);

		$this->add_control(
			'toggle_color_hover',
			[
				'label' => esc_html__( 'Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} div.selfer-menu-toggle:hover' => 'color: {{VALUE}}', // Harder selector to override text color control
				],
			]
		);

		$this->add_control(
			'toggle_background_color_hover',
			[
				'label' => esc_html__( 'Background Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .selfer-menu-toggle:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'toggle_size',
			[
				'label' => esc_html__( 'Size', 'selfer-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 15,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .selfer-menu-toggle' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'toggle_border_width',
			[
				'label' => esc_html__( 'Border Width', 'selfer-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .selfer-menu-toggle' => 'border-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'toggle_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'selfer-core' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .selfer-menu-toggle' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_hamburger',
			[
				'label' => esc_html__( 'Hamburger', 'selfer-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'hamburger',
				],
			]
		);

		$this->add_control(
			'hamburger_before_anim_background',
			[
				'label' => esc_html__( 'Before Background Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container .ef-background' => 'background-color: {{VALUE}}',
				],
			]
		);		

		$this->add_control(
			'hamburger_main_background',
			[
				'label' => esc_html__( 'Main Background Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .selfer-nav-menu-layout-hamburger' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'hamburger_typography',
				'selector' => '{{WRAPPER}} .selfer-nav-menu-hamburger .selfer-nav-menu',
			]
		);

		$this->add_control(
			'hamburger_main_menu_colors',
			[
				'label' => esc_html__( 'Main Menu Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .selfer-nav-menu-hamburger .selfer-nav-menu li' => 'color: {{VALUE}}',
				],
			]
		);		

		$this->add_control(
			'hamburger_indicator_colors',
			[
				'label' => esc_html__( 'Toggle Button Color', 'selfer-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hamburger-menu .hamburger-content, .hamburger-menu .hamburger-content:before, .hamburger-menu .hamburger-content:after' => 'background: {{VALUE}}',
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
		$available_menus = $this->get_available_menus();

		if ( ! $available_menus ) {
			return;
		}

		$settings = $this->get_active_settings();

		$args = [
			'echo' => false,
			'menu' => $settings['menu'],
			'menu_class' => 'selfer-nav-menu',
			'menu_id' => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
			'fallback_cb' => '__return_empty_string',
			'container' => '',
		];

		if ( 'vertical' === $settings['layout'] ) {
			$args['menu_class'] .= ' selfer-vertical';
		}

		// Add custom filter to handle Nav Menu HTML output.
		add_filter( 'nav_menu_link_attributes', [ $this, 'handle_link_classes' ], 10, 4 );
		add_filter( 'nav_menu_submenu_css_class', [ $this, 'handle_sub_menu_classes' ] );
		add_filter( 'nav_menu_item_id', '__return_empty_string' );

		// General Menu.
		$menu_html = wp_nav_menu( $args );

		// Dropdown Menu.
		$args['menu_id'] = 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id();
		$dropdown_menu_html = wp_nav_menu( $args );

		// Remove all our custom filters.
		remove_filter( 'nav_menu_link_attributes', [ $this, 'handle_link_classes' ] );
		remove_filter( 'nav_menu_submenu_css_class', [ $this, 'handle_sub_menu_classes' ] );
		remove_filter( 'nav_menu_item_id', '__return_empty_string' );

		if ( empty( $menu_html ) ) {
			return;
		}

		$this->add_render_attribute( 'menu-toggle', 'class', [
			'selfer-menu-toggle',
		] );

		if ( Plugin::$instance->editor->is_edit_mode() ) {
			$this->add_render_attribute( 'menu-toggle', [
				'class' => 'selfer-clickable',
			] );
		}

		if ( 'dropdown' !== $settings['layout'] && 'hamburger' !== $settings['layout'] ) :
			$this->add_render_attribute( 'main-menu', 'class', [
				'selfer-nav-menu-main',
				'selfer-nav-menu-container',
				'selfer-nav-menu-layout-' . $settings['layout'],
			] );

			if ( $settings['pointer'] ) :
				$this->add_render_attribute( 'main-menu', 'class', 'e-pointer-' . $settings['pointer'] );

				foreach ( $settings as $key => $value ) :
					if ( 0 === strpos( $key, 'animation' ) && $value ) :
						$this->add_render_attribute( 'main-menu', 'class', 'e-animation-' . $value );
						break;
					endif;
				endforeach;
			endif; ?>
			<nav <?php echo $this->get_render_attribute_string( 'main-menu' ); ?>><?php echo $menu_html; ?></nav>
			<?php
		endif; ?>

		<?php if( 'hamburger' !== $settings['layout'] ) : ?>
		<div <?php echo $this->get_render_attribute_string( 'menu-toggle' ); ?>>
			<i class="eicon" aria-hidden="true"></i>
		</div>
		<nav class="selfer-nav-menu-dropdown selfer-nav-menu-container"><?php echo $dropdown_menu_html; ?></nav>
		<?php endif; ?>

		<?php if( 'hamburger' == $settings['layout'] ) : ?>
			<?php 
				$this->add_render_attribute( 'main-menu', 'class', [
					'selfer-nav-menu-hamburger',
					'selfer-nav-menu-wraper',
					'selfer-nav-menu-layout-' . $settings['layout'],
				] );

			?>
			<div class="hamburger-menu hamburger-elementor">
			    <a href="#" class="menu-indicator">
			        <span class="hamburger-content"></span>
			    </a>
			</div><!--  /.hamburger-menu -->
			<nav <?php echo $this->get_render_attribute_string( 'main-menu' ); ?>>
				<div class="vertical-line line1"></div>
				<div class="vertical-line line2"></div>
				<div class="vertical-line line3"></div>
				<div class="hamburger-top">
				    <div class="nav-content">
				        <div class="hamburger-close">
				            <div></div>
				        </div><!--  /.hamburger-close -->
				    </div><!--  /.branding-content -->
				</div><!--  /.hamburger-top -->
				<div class="menu-inner">
					<?php echo $menu_html; ?>
				</div><!--  /.menu-inner -->
			</nav>
			<div class="ef-background"></div><!--  /.ef-background -->
		<?php endif; ?>	
	<?php }

	public function handle_link_classes( $atts, $item, $args, $depth ) {
		$classes = $depth ? 'selfer-sub-item' : 'selfer-item';

		if ( in_array( 'current-menu-item', $item->classes ) ) {
			$classes .= '  selfer-item-active';
		}

		if ( empty( $atts['class'] ) ) {
			$atts['class'] = $classes;
		} else {
			$atts['class'] .= ' ' . $classes;
		}

		return $atts;
	}

	public function handle_sub_menu_classes( $classes ) {
		$classes[] = 'selfer-nav-menu-dropdown';

		return $classes;
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new Selfer_Nav_Menus_Widget() );