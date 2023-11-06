<div class="selfer_metabox template-metaboxs">
	<div class="selfer_metabox_tab" id="selfer_tab_template">
		<?php 
        $this->select ( 'template_types', esc_html__( 'Select Template For:', 'selfer-core' ), array (
            'default' => esc_html__( 'Select For Template', 'selfer-core' ),
            'header' => esc_html__( 'Header Template', 'selfer-core' ),
            'footer' => esc_html__( 'Footer Template', 'selfer-core' )
        ), esc_html__( 'Choose for where you want to added this template.', 'selfer-core' ) ); ?>
	</div>
</div>