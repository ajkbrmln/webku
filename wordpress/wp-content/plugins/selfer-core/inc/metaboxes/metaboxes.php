<?php
define( 'METABOXES_PATH', SELFER_PLUGIN_PATH . 'inc/metaboxes/' );

class Selfer_Metaboxes {
	
	public function __construct() {
		add_action('add_meta_boxes', array($this, 'add_custom_meta_boxes'));
		add_action('save_post', array($this, 'save_meta_data'));
		add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
	}
	
	public function add_custom_meta_boxes () {
		$post_types = get_post_types( array( 'public' => true ) );
		foreach ( $post_types as $post_type ) {
			if ( $post_type == 'post' ) {
				add_meta_box( 'selfer_post_options', esc_html__('Post Options', 'selfer'), array($this, 'post_options'), $post_type );
			}
			else if ( $post_type == 'page' ) {
				add_meta_box( 'selfer_page_options', esc_html__('Page Options', 'selfer'), array($this, 'page_options'), $post_type );
			}
			else if ( $post_type == 'portfolio' ) {
				add_meta_box( 'selfer_portfolio_options', esc_html__('Portfolio Options', 'selfer-core'), array($this, 'portfolio_options'), $post_type );
			} 
			else if ($post_type == 'service') {
				add_meta_box( 'selfer_services_options', esc_html__('Default Options', 'selfer-core'), array($this, 'service_options'), $post_type );
			} elseif( $post_type == 'selfer_templates' ) {
				add_meta_box( 'selfer_template_options', esc_html__('Template Options', 'selfer-core'), array($this, 'template_options'), $post_type );
			} else {
				add_meta_box( 'selfer_default_options', esc_html__('Default Options', 'selfer-core'), array($this, 'default_options'), $post_type );
			}
		}
	}
	
	public function save_meta_data( $post_id ) {
		
		if(defined( 'DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}
		
		foreach($_POST as $key => $value) {
			if(strstr($key, 'selfer_')) {
				update_post_meta($post_id, $key, $value);
			}
		}
	}
	
	public function admin_scripts () {
		wp_enqueue_style( 'wp-color-picker' );

		wp_register_script('metabox_script', SELFER_PLUGIN_URL . '/inc/metaboxes/assets/js/metaboxes.js', array( 'wp-color-picker'), false, true );
		wp_enqueue_script('metabox_script');
		
		wp_register_style('metabox_style', SELFER_PLUGIN_URL . '/inc/metaboxes/assets/css/metaboxes.css');
		wp_enqueue_style('metabox_style');
	}
	
	public function post_options () {
		include plugin_dir_path( __FILE__ ) . '/views/metaboxes/post_options.php';
	}
	
	public function page_options () {
		include plugin_dir_path( __FILE__ ) . '/views/metaboxes/page_options.php';
	}
	
	public function portfolio_options () {
		include plugin_dir_path( __FILE__ ) . '/views/metaboxes/portfolio_options.php';
	}
	
	public function service_options () {
		include plugin_dir_path( __FILE__ ) . 'views/metaboxes/service_options.php';
	}	

	public function default_options () {
		include plugin_dir_path( __FILE__ ) . '/views/metaboxes/default_options.php';
	}

	public function template_options () {
		include plugin_dir_path( __FILE__ ) . '/views/metaboxes/template_options.php';
	}
	
	// --------------------------------

	protected function build_dependency_atts( $dependency ) {
		if( empty( $dependency ) || !is_array( $dependency ) ) {
			return false;
		}
		$dep_string = "";
		if( !empty( $dependency['option'] ) ) {
			$dep_string .= sprintf( " data-dep-option='%s'", $dependency['option'] );
		}
		if( !empty( $dependency['value'] ) ) {
			$dep_string .= sprintf( " data-dep-value='%s'", $dependency['value'] );
		}
		if( !empty( $dependency['current_default'] ) ) {
			$dep_string .= sprintf( " data-dep-default='%s'", $dependency['current_default'] );
		}
		if( !empty( $dependency['value_in'] ) && is_array( $dependency['value_in'] ) ) {
			$dep_string .= sprintf( " data-dep-value-in='%s'", implode( ',', $dependency['value_in'] ) );
		}
		if( !empty( $dependency['value_not_in'] ) && is_array( $dependency['value_not_in'] ) ) {
			$dep_string .= sprintf( " data-dep-value-not-in='%s'", implode( ',', $dependency['value_not_in'] ) );
		}
		return $dep_string;
	}
	
	public function text($id, $label, $desc = '')
	{
		global $post;
	
		$html = '';
		$html .= '<div class="selfer_metabox_field">';
		$html .= '<div class="selfer_desc">';
		$html .= '<label for="selfer_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '<div class="selfer_field">';
		$html .= '<input type="text" id="selfer_' . $id . '" name="selfer_' . $id . '" value="' . get_post_meta($post->ID, 'selfer_' . $id, true) . '" />';
		$html .= '</div>';
		$html .= '</div>';
	
		echo ( $html );
	}
	
	public function select($id, $label, $options, $desc = '')
	{
		global $post;
	
		$html = '';
		$html .= '<div class="selfer_metabox_field">';
		$html .= '<div class="selfer_desc">';
		$html .= '<label for="selfer_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '<div class="selfer_field">';
		$html .= '<select class="selfer-meta-value" id="selfer_' . $id . '" name="selfer_' . $id . '">';
		foreach($options as $key => $option) {
			if(get_post_meta($post->ID, 'selfer_' . $id, true) == $key) {
				$selected = 'selected="selected"';
			} else {
				$selected = '';
			}
	
			$html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
		}
		$html .= '</select>';
		$html .= '</div>';
		$html .= '</div>';
	
		echo ( $html );
	}
	
	public function multiple($id, $label, $options, $desc = '')
	{
		global $post;
	
		$html = '';
		$html .= '<div class="selfer_metabox_field">';
		$html .= '<div class="selfer_desc">';
		$html .= '<label for="selfer_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '<div class="selfer_field">';
		$html .= '<select multiple="multiple" id="selfer_' . $id . '" name="selfer_' . $id . '[]">';
		foreach($options as $key => $option) {
			if(is_array(get_post_meta($post->ID, 'selfer_' . $id, true)) && in_array($key, get_post_meta($post->ID, 'selfer_' . $id, true))) {
				$selected = 'selected="selected"';
			} else {
				$selected = '';
			}
	
			$html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
		}
		$html .= '</select>';
		$html .= '</div>';
		$html .= '</div>';
	
		echo ( $html );
	}
	
	public function textarea($id, $label, $desc = '', $default = '' )
	{
		global $post;
	
		$db_value = get_post_meta($post->ID, 'selfer_' . $id, true);
	
		if( metadata_exists( 'post', $post->ID, 'selfer_'. $id ) ) {
			$value = $db_value;
		} else {
			$value = $default;
		}
	
		$html = '';
		$html = '';
		$html .= '<div class="selfer_metabox_field">';
		$html .= '<div class="selfer_desc">';
		$html .= '<label for="selfer_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '<div class="selfer_field">';
		$html .= '<textarea cols="120" rows="10" id="selfer_' . $id . '" name="selfer_' . $id . '">' . $value . '</textarea>';
		$html .= '</div>';
		$html .= '</div>';
	
		echo ( $html );
	}
	
	public function upload($id, $label, $desc = '')
	{
		global $post;
	
		$html = '';
		$html = '';
		$html .= '<div class="selfer_metabox_field">';
		$html .= '<div class="selfer_desc">';
		$html .= '<label for="selfer_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '<div class="selfer_field">';
		$html .= '<div class="selfer_upload">';
		$html .= '<div><input name="selfer_' . $id . '" class="upload_field" id="selfer_' . $id . '" type="text" value="' . get_post_meta($post->ID, 'selfer_' . $id, true) . '" /></div>';
		$html .= '<div class="selfer_upload_button_container"><input class="selfer_upload_button" type="button" value="Browse" /></div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';

		echo ( $html );
	}
	
	public function multiple_images($id, $label, $desc = '')
	{
		global $post;
	
		$html = '';
		$html = '';
		$html .= '<div class="selfer_metabox_field">';
		$html .= '<div class="selfer_desc">';
		$html .= '<label for="selfer_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '<div class="selfer_field">';
		
		$html .= '<div class="selfer_multiple_images" data-formid="' . $id . '">';
		$html .= '<div class="selfer_multiple_image_button_container"><input class="selfer_multiple_upload_button" type="button" value="' . esc_html__( 'Add Images', 'selfer' ) . '" /></div>';
		$html .= '<div class="selfer_uploaded_images clearfix">';
		$html .= '<input type="hidden" id="selfer_' . $id . '_first" name="selfer_' . $id . '[]" value="__">';
		$selected_image = selfer_get_val_from_array( get_post_meta( $post->ID, 'selfer_' . $id, false ) );
		$i = 0;
		if( is_array( $selected_image ) ) {
			foreach( $selected_image as $image_id ) {
				$i++;
				if( $i == 1 )
					continue;
				$image = selfer_get_val_from_array( wp_get_attachment_image_src( $image_id ) );
				$html .= '<div class="image">';
		        $html .= '<img src="' . $image . '">';
		        $html .= '<input type="hidden" id="selfer_' . $id . '" name="selfer_' . $id . '[]" value="' . $image_id . '">';
		        $html .= '<i class="remove fa fa-close"></i>';
		        $html .= '</div>';
			}
		}
		$html .= '</div>';
		$html .= '</div>';
		
		$html .= '</div>';
		$html .= '</div>';
	
		echo ( $html );
	}

	public function color($id, $label, $desc = '')	{
		global $post;
	
		$html = '';
		$html .= '<div class="selfer_metabox_field">';
		$html .= '<div class="selfer_desc">';
		$html .= '<label for="selfer_' . $id . '">';
		$html .= $label;
		$html .= '</label>';
		if($desc) {
			$html .= '<p>' . $desc . '</p>';
		}
		$html .= '</div>';
		$html .= '<div class="selfer_field">';
		$html .= '<input type="text" id="selfer_' . $id . '" name="selfer_' . $id . '" value="' . get_post_meta($post->ID, 'selfer_' . $id, true) . '" class="selfer-metabox-color-picker"/>';
		$html .= '</div>';
		$html .= '</div>';
	
		echo ( $html );
	}

	public function subsection_start( $title, $dependency = false ) {
		$html = "<div class='selfer-metabox-subsection opened'" . $this->build_dependency_atts( $dependency ) . ">";
		$html .= "<div class='subsection-title'>";
		$html .= "<h4 class='title'>" . $title . "</h4>";
		$html .= "</div>";
		$html .= "<div class='subsection-content'>";
		
		echo ( $html );
	}
	
	public function subsection_end() {
		echo "</div></div>\n";
	}
}

$metaboxes = new Selfer_Metaboxes();