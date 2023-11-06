<ul class="selfer_metabox_tabs">
    <?php if( function_exists( 'register_block_type' ) ) { ?>
    <li class="active"><a href="#gutenberg"><?php echo esc_html__( "Gutenberg Options", 'selfer-core' ) ?></a></li>
	<li><a href="#header"><?php echo esc_html__( "Header", 'selfer-core' ) ?></a></li>
    <?php } else { ?>
    <li class="active"><a href="#header"><?php echo esc_html__( "Header", 'selfer-core' ) ?></a></li>
    <?php } ?>
    <li><a href="#contents"><?php echo esc_html__( "Content Area", 'selfer-core' ) ?></a></li>
	<li><a href="#footer"><?php echo esc_html__( "Footer", 'selfer-core' ) ?></a></li>
</ul>
<div class="selfer_metabox">
    <?php if( function_exists( 'register_block_type' ) ) { ?>
    <div class="selfer_metabox_tab" id="selfer_tab_gutenberg">
        <?php 
        $this->select ( 'show_page_title', esc_html__( 'Show Page Title', 'selfer-core' ), array (
            'default' => esc_html__( 'Select to display title', 'selfer-core' ),
            'yes' => esc_html__( 'Yes', 'selfer-core' ),
            'no' => esc_html__( 'No', 'selfer-core' )
        ), esc_html__( 'Choose to show or hide the page title.', 'selfer-core' ) );
        $this->select ( 'show_featured_image_in_content', esc_html__( 'Show featured image in the content', 'selfer-core' ), array (
            'default' => esc_html__( 'Select to display Featured Image', 'selfer-core' ),
            'yes' => esc_html__( 'Yes', 'selfer-core' ),
            'no' => esc_html__( 'No', 'selfer-core' )
        ), esc_html__( 'Choose no to hide featured image in the content area.', 'selfer-core' ) );
        ?>
    </div>
    <?php } ?>
    <div class="selfer_metabox_tab" id="selfer_tab_header">        
        <?php
        $this->select ( 'header_show_header', esc_html__( 'Show header', 'selfer-core' ), array (
            'default'   => esc_html__( 'Theme Setting', 'selfer-core' ),
            'yes'       => esc_html__( 'Yes', 'selfer-core' ),
            'no'        => esc_html__( 'No', 'selfer-core' ),
        ), esc_html__( 'Choose to show or hide the header.', 'selfer-core' ) );

        $menus = wp_get_nav_menus();
        $menuName = array();
        foreach ( $menus as $menu  ) : 
            $menuName[0] = esc_html__( 'Default', 'selfer-core' );
            $menuName[$menu->term_id] = $menu->name;
        endforeach;

        $this->select ( 'header_type', esc_html__( 'Select Header Type', 'selfer-core' ), array (
            'default'   => esc_html__( 'Theme Setting', 'selfer-core' ),
            'custom_header'   => esc_html__( 'Custom Header', 'selfer-core' ),
            'elementor_header' => esc_html__( 'Custom Template', 'selfer-core' ),
        ), esc_html__( 'Choose your header types.', 'selfer-core' ) );

        $this->subsection_start( esc_html__( 'Header Template', 'selfer-core' ), array(
            'option' => 'header_type',
            'value' => 'elementor_header',
            'background' => get_post_meta( get_the_ID(), 'selfer_header_type', true),
        ) );

        // Header Template
        $header_args = array( 
            'post_type' => 'selfer_templates', 
            'posts_per_page' => -1,
            'meta_key' => 'selfer_template_types',
            'meta_value'  => 'header',
            'meta_compare' => '>=',
            'orderby'      => 'meta_value',
            'order'        => 'ASC',
            'meta_query'   => array(
                'relation' => 'OR',
                array(
                    'key'     => 'selfer_template_types',
                    'value'   => 'header',
                    'compare' => '==',
                    'type'    => 'page',
                ),
            ),
        );
        
        $get_header = get_posts($header_args);
        $header_template = array();
        if( $get_header ) {
            foreach ($get_header as $value) {
                $header_template['default'] = esc_html__('Default', 'selfer-core');
                $header_template[$value->ID] = $value->post_title;
            }
        } else {
            $header_template['default'] = esc_html__('Default', 'selfer-core');
        }

        $this->select ( 'header_template', esc_html__( 'Select Header Type', 'selfer-core' ), $header_template, esc_html__( 'Choose your header template.', 'selfer-core' ) );

        // End Header Template

        $this->subsection_end(); 

        $this->subsection_start( esc_html__( 'Header Template', 'selfer-core' ), array(
            'option' => 'header_type',
            'value' => 'custom_header',
            'background' => get_post_meta( get_the_ID(), 'selfer_header_type', true),
        ) );

        $this->select ( 'header_menu_sticky', esc_html__( 'Enable sticky/fixed header', 'selfer-core' ), array (
            'default'   => esc_html__( 'Default', 'selfer-core' ),
            'yes'       => esc_html__( 'Yes', 'selfer-core' ),
            'no'        => esc_html__( 'No', 'selfer-core' )
        ), esc_html__( 'Choose to enable or disable sticky menu.', 'selfer-core' ) );

        $this->select ( 'header_page_menu', esc_html__( 'Select Menu For Page', 'selfer-core' ), $menuName , esc_html__( 'Show Diffrent Menu at diffrent pages.', 'selfer-core' ) );

        $this->upload ( 'header_logo_main', esc_html__( 'Header Main Logo', 'selfer-core' ),esc_html__( 'Choose Page Header Main Logo.', 'selfer-core' ) );
        
        $this->subsection_end(); 
        /* Start Header Background Status */
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

        $this->select ( 'footer_type', esc_html__( 'Footer Type', 'selfer-core' ), array (
            'default' => esc_html__( 'Theme Setting', 'selfer-core' ),
            'custom_template' => esc_html__( 'Custom Template', 'selfer-core' ),
        ), esc_html__( 'Choose to show or hide the footer.','selfer-core' ) );

        $this->subsection_start( esc_html__( 'Footer Template', 'selfer-core' ), array(
            'option' => 'footer_type',
            'value' => 'custom_template',
            'background' => get_post_meta( get_the_ID(), 'selfer_footer_type', true),
        ) );

        // Footer Templates Query
        $footer_args = array( 
            'post_type' => 'selfer_templates', 
            'posts_per_page' => -1,
            'meta_key' => 'selfer_template_types',
            'meta_value'  => 'footer',
            'meta_compare' => '>=',
            'orderby'      => 'meta_value',
            'order'        => 'ASC',
            'meta_query'   => array(
                'relation' => 'OR',
                array(
                    'key'     => 'selfer_template_types',
                    'value'   => 'footer',
                    'compare' => '==',
                    'type'    => 'page',
                ),
            ),
        );

        $get_footer = get_posts($footer_args);
        $footer_template = array();
        if( $get_footer ) {
            foreach ($get_footer as $value) {
                $footer_template['default'] = esc_html__('Default', 'selfer-core');
                $footer_template[$value->ID] = $value->post_title;
            }
        } else {
            $footer_template['default'] = esc_html__('Default', 'selfer-core');
        }

        $this->select ( 'footer_template', esc_html__( 'Select Footer Template', 'selfer-core' ), $footer_template , esc_html__( 'Show Diffrent Menu at diffrent pages.', 'selfer-core' ) );
        // End Footer Templates Query

        $this->subsection_end(); 
        ?>
    </div>

</div>
<div class="clear"></div>