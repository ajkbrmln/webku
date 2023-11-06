<?php 
if ( ! defined( 'ABSPATH' ) ) die( esc_html__( 'Direct access forbidden.', 'selfer' ) );

register_sidebar(  array(
    'name'          => esc_html__( 'Sidebar Blog', 'selfer' ),
    'description'   => esc_html__( 'This sidebar will show in blog page', 'selfer' ),
    'id'            => 'sidebar-blog',
    'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s ">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
) );

register_sidebar(  array(
    'name'          => esc_html__( 'Sidebar Single', 'selfer' ),
    'description'   => esc_html__( 'This sidebar will show in blog single page', 'selfer' ),
    'id'            => 'sidebar-single',
    'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s ">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
) );
 