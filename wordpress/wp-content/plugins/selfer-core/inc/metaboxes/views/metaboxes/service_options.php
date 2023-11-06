<ul class="selfer_metabox_tabs">
	<li class="active"><a href="#service"><?php echo esc_html__( "Service", 'selfer-core' ) ?></a></li>
	<li><a href="#header"><?php echo esc_html__( "Header", 'selfer-core' ) ?></a></li>
	<li><a href="#contents"><?php echo esc_html__( "Content Area", 'selfer-core' ) ?></a></li>
	<li><a href="#footer"><?php echo esc_html__( "Footer", 'selfer-core' ) ?></a></li>
</ul>
<div class='selfer_metabox'>
	<div class="selfer_metabox_tab" id="selfer_tab_service">
		<?php
		$this->text ( 'service_icons',  
			esc_html__( 'Service Icons', 'selfer-core' ),
			esc_html__( 'Add Service Icon code. EX. fa fa-facebook.', 'selfer-core' ) );	
		$this->upload ( 'service_images_icon', esc_html__( 'Service Image Icons', 'selfer-core' ),esc_html__( 'or Choose Service Image icons.', 'selfer-core' ) );	
		$this->textarea ( 'service_short_description',  
			esc_html__( 'Service Short Descriptions', 'selfer-core' ),
			esc_html__( 'Add Service Short Descriptions.', 'selfer-core' ) );
		$this->text ( 'service_relevent_url',  
			esc_html__( 'Service Relevant URL', 'selfer-core' ),
			esc_html__( 'Add your service relevant URL', 'selfer-core' ) );	
		$this->text ( 'service_includes_title',  
			esc_html__( 'Service Includes Title', 'selfer-core' ),
			esc_html__( 'Add your Service Includes Title', 'selfer-core' ) );	
		$this->textarea ( 'service_includes',  
			esc_html__( 'Service Includes', 'selfer-core' ),
			esc_html__( 'Add Service Separate With Comma ( , ) .', 'selfer-core' ) );
        ?>
        <?php
        $this->select ( 'show__service_featured_image_in_content', esc_html__( 'Show featured image in the content', 'selfer-core' ), array (
            'yes' => esc_html__( 'Yes', 'selfer-core' ),
            'no' => esc_html__( 'No', 'selfer-core' )
        ), esc_html__( 'Choose no to hide featured image in the content area.', 'selfer-core' ) );
        ?>
	</div>
	<div class="selfer_metabox_tab" id="selfer_tab_header">
		<?php
		$this->select ( 'header_show_header', esc_html__( 'Show header', 'selfer-core' ), array (
				'default' 	=> esc_html__( 'Theme Setting', 'selfer-core' ),
				'yes' 		=> esc_html__( 'Yes', 'selfer-core' ),
				'no' 		=> esc_html__( 'No', 'selfer-core' )
		), esc_html__( 'Choose to show or hide the header.', 'selfer-core' ) );
		$this->select ( 'header_menu_sticky', esc_html__( 'Enable sticky menu', 'selfer-core' ), array (
				'default' 	=> esc_html__( 'Theme Setting', 'selfer-core' ),
				'yes' 		=> esc_html__( 'Yes', 'selfer-core' ),
				'no' 		=> esc_html__( 'No', 'selfer-core' )
		), esc_html__( 'Choose to enable or disable sticky menu.', 'selfer-core' ) );
        ?>
	</div>
	<div class="selfer_metabox_tab" id="selfer_tab_contents">
        <?php 
        $this->text ( 'content_padding_top',  
            esc_html__( 'Padding Top', 'selfer-core' ),  
            esc_html__( 'Leave it empty for default.', 'selfer-core' ) );

        $this->text ( 'content_padding_bottom',  
            esc_html__( 'Padding Bottom', 'selfer-core' ),  
            esc_html__( 'Leave it empty for default.', 'selfer-core' ) );
        ?>
    </div>
	<div class="selfer_metabox_tab" id="selfer_tab_footer">
		<?php
		$this->select ( 'footer_show_footer', esc_html__( 'Show footer', 'selfer-core' ), array (
				'default' => esc_html__( 'Theme Setting', 'selfer-core' ),
				'yes' => esc_html__( 'Yes', 'selfer-core' ),
				'no' => esc_html__( 'No', 'selfer-core' ),
		), esc_html__( 'Choose to show or hide the footer.','selfer-core' ) );
		?>
	</div>
</div>
<div class="clear"></div>