<?php
/**
 * Customizer functionality for the theme.
 *
 * @package Selfer
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if(! class_exists( 'Selfer_Customizer' ) ) {
	/**
	 * The Selfer Customizer Settings
	 */
	class Selfer_Customizer  {
		/**
		 * Setup class.
		 *
		 * @since 1.0
		 */
		public function __construct() {
			//add customizer settings control
			add_filter( 'selfer_filter_features', array( $this, 'selfer_filter_features') );

			//includes all files of controls
			add_action( 'after_setup_theme', array($this, 'selfer_include_features'), 0 );

			//Include JS Controls Types
			add_action( 'customize_register', array($this, 'selfer_register_control_types'), 0 );

			//Include Preview Unit JS
			add_action( 'customize_preview_init', array($this, 'selfer_customize_preview_js') );

			//Include Controls Scripts
			add_action( 'customize_controls_enqueue_scripts', array($this, 'selfer_panels_js') );
		}

		/**
		 * Filter The customizer Panel.
		 * @since 1.0
		 */
		public function selfer_filter_features( $array ) {
			$files_to_load = array(
				'typography/typography-settings',
				'customizer-toggle-control/class-customizer-toggle-control',
				'customizer-radio-image/class/class-customize-control-radio-image',
				'customizer-alpha-color-picker/class-customize-alpha-color-control',
				'customizer-repeater/class/class-customizer-repeater-control',
			);
			
			return array_merge(
				$array, $files_to_load
			);
		}

		/**
		 * Include All files.
		 *
		 * @since Selfer 1.0
		 */
		public function selfer_include_features() {
			$selfer_allowed_phps = array();
			$selfer_allowed_phps = apply_filters( 'selfer_filter_features', $selfer_allowed_phps );
			foreach ( $selfer_allowed_phps as $file ) {
				$selfer_file_to_include = get_template_part('/inc/customizer/'. $file );
			}
		}

		/**
		 * Register JS control types.
		 *
		 * @since  1.0
		 * @access public
		 * @return void
		 */
		public function selfer_register_control_types( $wp_customize ) {
			get_template_part('inc/customizer/customizer-range-value/class/class-customizer-range-value-control');
			get_template_part('inc/customizer/customizer-select-multiple/class/class-select-multiple');
			get_template_part('inc/customizer/customizer-dimensions/class-control-dimensions');

			// Register JS control types.
			$wp_customize->register_control_type( 'Selfer_Select_Multiple' );
			$wp_customize->register_control_type( 'Selfer_Customizer_Dimensions_Control' );
			$wp_customize->register_control_type( 'Selfer_Customizer_Range_Value_Control' );
		}

		/**
		 * Customizer Preview Unit JS.
		 *
		 * @since  1.0
		 * @access public
		 * @return void
		 */
		public function selfer_customize_preview_js() {
		    wp_enqueue_script('selfer-customize-preview', get_theme_file_uri( '/assets/custom/customize-preview.js' ), array("jquery"), '1.0', true);
		}

		/**
		 * Customizer Controls JS.
		 *
		 * @since  1.0
		 * @access public
		 * @return void
		 */
		public function selfer_panels_js() {
		    wp_enqueue_script('selfer-customize-controls', get_theme_file_uri( '/assets/custom/customize-controls.js' ), array("jquery"), '1.0', true);
		    wp_enqueue_style('selfer-customize-controls', get_theme_file_uri( '/assets/custom/customize-control.css' ), null );
		}
	}
}
new Selfer_Customizer;