<?php 
if ( ! defined( 'ABSPATH' ) ) die( esc_html__( 'Direct access forbidden.', 'selfer' ) );

if( ! class_exists( 'Selfer_Static' ) ) :
class Selfer_Static {

    /**
     * Allow HTML tag from escaping HTML 
     * 
     * @return void
     * @since v1.0
     */
    public static function html_allow() {
        return array(
            'a' => array(
                'href' => array(),
                'title' => array()
            ),
            'br' => array(),
            'del' => array(),
            'span' => array(),
            'em' => array(),
            'strong' => array(),
            'h1' => array(
                'class' => array(),
                'id' => array(),
            ),            
            'h2' => array(
                'class' => array(),
                'id' => array(),
            ),            
            'h3' => array(
                'class' => array(),
                'id' => array(),
            ),            
            'h4' => array(
                'class' => array(),
                'id' => array(),
            ),            
            'h5' => array(
                'class' => array(),
                'id' => array(),
            ),            
            'h6' => array(
                'class' => array(),
                'id' => array(),
            ),            
            'div' => array(
                'class' => array(),
                'id' => array(),
            ),
            'p' => array(
                'class' => array(),
                'id' => array(),
            ),
        );
    }

    /**
     * @since v1.0
     */
    public static function total_grid() {
        return array(
            '1' => esc_html__( '1 Grid', 'selfer' ),
            '2' => esc_html__( '2 Grid', 'selfer' ),
            '3' => esc_html__( '3 Grid', 'selfer' ),
            '4' => esc_html__( '4 Grid', 'selfer' ),
            '5' => esc_html__( '5 Grid', 'selfer' ),
            '6' => esc_html__( '6 Grid', 'selfer' ),
            '7' => esc_html__( '7 Grid', 'selfer' ),
            '8' => esc_html__( '8 Grid', 'selfer' ),
            '9' => esc_html__( '9 Grid', 'selfer' ),
            '10' => esc_html__( '10 Grid', 'selfer' ),
            '11' => esc_html__( '11 Grid', 'selfer' ),
            '12' => esc_html__( '12 Grid', 'selfer' ),
        );
    }

    /**
     * @since v1.0
     */
    public static function total_items() {
        return array(
            '2' => esc_html__( 'Two', 'selfer' ),
            '3' => esc_html__( 'Three', 'selfer' ),
            '4' => esc_html__( 'Four', 'selfer' ),
            '5' => esc_html__( 'Five', 'selfer' ),
            '6' => esc_html__( 'Six', 'selfer' ),
            '7' => esc_html__( 'Seven', 'selfer' ),
        );
    }

}

// Removing this line is like not having a functions.php file
new Selfer_Static;

endif;