<ul class="selfer_metabox_tabs">
	<li class="active"><a href="#post"><?php echo esc_html__( "Portfolio", 'selfer-core' ) ?></a></li>
</ul>
<div class='selfer_metabox'>
	<div class="selfer_metabox_tab active" id="selfer_tab_post">
		<?php
		$this->select ( 'featured_image_masonry_size', esc_html__( 'Masonry Image Size', 'selfer-core' ), array (
            'x_x' => esc_html__( 'X * X', 'selfer-core' ),
            'x_dx' => esc_html__( 'X * 2X', 'selfer-core' ),
			'dx_x' => esc_html__( '2X * X', 'selfer-core' ),
			'dx_dx' => esc_html__( '2X * 2X', 'selfer-core' )
		), esc_html__( 'Select featured image size in masonry layout.', 'selfer-core' ) );
		$this->text ( 'custom_link',  
			esc_html__( 'Custom Links', 'selfer-core' ),  
			esc_html__( 'Leave it empty for default.', 'selfer-core' ) );
		$this->text ( 'video_embed_popup_link',  
			esc_html__( 'Video Embed Link', 'selfer-core' ),  
			esc_html__( 'Leave it empty for default. It\'s display with portfolio item as a popup video', 'selfer-core' ) );
			
		$this->select ( 'show_page_title', esc_html__( 'Show Portfolio Title', 'selfer-core' ), array (
				'default' => esc_html__( 'Select to display Title', 'selfer-core' ),
				'yes' => esc_html__( 'Yes', 'selfer-core' ),
				'no' => esc_html__( 'No', 'selfer-core' )
			), esc_html__( 'Choose no to hide Title in the content area.', 'selfer-core' ) );
		$this->select ( 'show_featured_image_in_content', esc_html__( 'Show featured image in the content', 'selfer-core' ), array (
				'default' => esc_html__( 'Select to display Featured Image', 'selfer-core' ),
				'yes' => esc_html__( 'Yes', 'selfer-core' ),
				'no' => esc_html__( 'No', 'selfer-core' )
			), esc_html__( 'Choose no to hide featured image in the content area.', 'selfer-core' ) );
		?>
	</div>
</div>
<div class="clear"></div>