<ul class="selfer_metabox_tabs">
	<li class="active"><a href="#header"><?php echo esc_html__( "Header", 'selfer-core' ) ?></a></li>
	<li><a href="#contents"><?php echo esc_html__( "Content Area", 'selfer-core' ) ?></a></li>
	<li><a href="#footer"><?php echo esc_html__( "Footer", 'selfer-core' ) ?></a></li>
</ul>
<div class='selfer_metabox'>
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
	<div class="selfer_metabox_tab" id="selfer_tab_sidebars">
		<?php
		$this->select ( 'sidebar_position', esc_html__( 'Sidebar Position', 'selfer-core' ),
			array (
				'default' => esc_html__( 'Theme Setting', 'selfer-core' ),
				'right' => esc_html__( 'Right', 'selfer-core' ),
				'left' => esc_html__( 'Left', 'selfer-core' ),
		), esc_html__( 'Select the sidebar position.', 'selfer-core' ) );
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
			'default' => esc_html__( 'Default', 'selfer-core' ),
			'yes' => esc_html__( 'Yes', 'selfer-core' ),
			'no' => esc_html__( 'No', 'selfer-core' ),
		), esc_html__( 'Choose to show or hide the footer.','selfer-core' ) );
		?>
	</div>
</div>
<div class="clear"></div>