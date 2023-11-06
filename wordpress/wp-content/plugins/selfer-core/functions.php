<?php 
/**
 * Some theme and plugin functions goes here
 * =========================================
 */

/**
 *  Selfer Image Dimension Issue
 *
 * @package Selfer
 * @since 1.0
 */
if ( ! function_exists( 'selfer_image_resize_dimensions' ) ) :
    function selfer_image_resize_dimensions() {
        remove_filter( 'image_resize_dimensions', array( $this, 'aq_upscale' ) );
    }
endif;

/**
 *  Remove Unnecessary p and br tag from shortcode
 *
 * @package Selfer
 * @since 1.0
 */
if( !function_exists('selfer_fix_shortcodes') ) :
    function selfer_fix_shortcodes($content){
        $array = array (
            '<p>[' => '[',
            ']</p>' => ']',
            ']<br />' => ']'
        );
        $content = strtr($content, $array);
        return $content;   
    }
    add_filter('the_content', 'selfer_fix_shortcodes');
endif;

/**
 *  Selfer Social Post Share
 *
 * @package Selfer
 * @since 1.0
 */
if ( ! function_exists( 'selfer_social_share_link' ) ) :
function selfer_social_share_link( $before_text = "" ) { ?>
  
    <div class="entry-share">
        <?php if($before_text != ""): ?> 
        <span class="share-head"><?php echo esc_html($before_text); ?></span>    
        <?php endif; ?> 
        <ul class="social-item remove-broswer-defult">
            <!-- facebook share -->
            <li><a class="social-btn-lg btn-gf bg-blue-violet color-white" rel="nofollow" title="<?php esc_html_e(  'Share on Facebook', 'selfer-core' ); ?>" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick="selfer_PopupWindow(this.href, 'facebook-share', 580, 400); return false;">
               <i class="fab fa-facebook"></i>
            </a></li>
            <li><a class="social-btn-lg btn-gf bg-blue-violet color-white" rel="nofollow" title="<?php esc_html_e(  'Share on Twitter', 'selfer-core' ); ?>" href="https://twitter.com/home?status=<?php the_permalink(); ?>"  onclick="selfer_PopupWindow(this.href, 'facebook-share', 580, 400); return false;">
                <i class="fab fa-twitter"></i>
            </a></li>

            <li><a class="social-btn-lg btn-gf bg-blue-violet color-white" rel="nofollow" title="<?php esc_html_e(  'Share on GooglePlus', 'selfer-core' ); ?>" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="selfer_PopupWindow(this.href, 'facebook-share', 580, 400); return false;">
                <i class="fab fa-google-plus"></i>
            </a></li>

            <li><a class="social-btn-lg btn-gf bg-blue-violet color-white" rel="nofollow" title="<?php esc_html_e(  'Share on Linkedin', 'selfer-core' ); ?>" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" onclick="selfer_PopupWindow(this.href, 'facebook-share', 580, 400); return false;">
                <i class="fab fa-linkedin"></i>
            </a></li>
            <li><a class="social-btn-lg btn-gf bg-blue-violet color-white" rel="nofollow" title="<?php esc_html_e(  'Share on Pinterest', 'selfer-core' ); ?>" href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
                <i class="fab fa-pinterest-p"></i>
            </a></li> 
        </ul>
    </div><!-- /.entry-share --> 
    <?php
}
endif;

/**
 *  Return Mailchimp Functions
 *
 * @package Selfer
 * @since 1.0
 */
if ( ! function_exists( 'selfer_mail_chimp_functions' ) ) :
    function selfer_mail_chimp_functions() {
        if( get_post_meta( get_the_ID(), 'selfer_footer_mail_chimp', true) == 'yes' ) {
            $enableMailChimp = true;
        } elseif( get_post_meta( get_the_ID(), 'selfer_footer_mail_chimp', true) == 'no' ) {
            $enableMailChimp = false;
        } else {
            $enableMailChimp = selfer_get_options('mail_chimp_visivility');
        }

        if( $enableMailChimp == true ) {
            echo do_shortcode( '[mc4wp_form]' );
        }
    } 
endif;

/**
 *  Remove Query String
 *
 * @package Selfer
 * @since 1.0
 */
function selfer_remove_query_string_one( $src ){   
    $rqs = explode( '?ver', $src );
    return $rqs[0];
}
if ( !is_admin() ) { 
    add_filter( 'script_loader_src', 'selfer_remove_query_string_one', 15, 1 );
    add_filter( 'style_loader_src', 'selfer_remove_query_string_one', 15, 1 );
}

function selfer_remove_query_string_two( $src ){
    $rqs = explode( '&ver', $src );
    return $rqs[0];
}
if ( !is_admin() ) { 
    add_filter( 'script_loader_src', 'selfer_remove_query_string_two', 15, 1 );
    add_filter( 'style_loader_src', 'selfer_remove_query_string_two', 15, 1 );
}

/**
 *  Service Ajax Content
 *
 * @package Selfer
 * @since 1.0
 */
function selfer_service_ajax_content () {
    $post_id = (isset($_REQUEST['post_id'])) ? $_REQUEST['post_id'] : '';

    $the_query  = new WP_Query( array(
        'p' => $post_id,
        'post_type' => 'service',
        'post_status' => 'publish'
    ) );

    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="modal-header bg-light px-5 pt-0 pb-5">
                <div class="ts-title mb-0">
                    <figure class="ts-circle__md bg-dark rounded-0">
                        <?php if( get_post_meta( get_the_ID(), 'selfer_service_images_icon', true) !== '' ) { ?>
			                <img src="<?php echo esc_url( get_post_meta( get_the_ID(), 'selfer_service_images_icon', true) ); ?>" alt="<?php the_title(); ?>">
						<?php } elseif( get_post_meta( get_the_ID(), 'selfer_service_icons', true) !== '' ) { ?>
							<i class="<?php echo esc_attr( get_post_meta( get_the_ID(), 'selfer_service_icons', true) ); ?>"></i>
						<?php } ?>
                    </figure>
                    <h4 class="mb-0"><?php the_title(); ?></h4>
                </div>

                <button type="button" class="close position-absolute ts-top__0 ts-right__0 m-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="">&times;</span>
                </button>
            </div>
            <div class="modal-body p-5">
                <div class="slide">
                    <div class="row">
                        <?php if ( has_post_thumbnail() ) {  ?>
                        <div class="col-md-4">
                            <?php selfer_post_featured_image(205, 375, true, false); ?>
                        </div>
                        <div class="col-md-8">
                        <?php } else { ?>
                        <div class="col-md-12">
                        <?php } ?>
                            <p><?php echo get_the_content(); ?></p>
                            <?php if( get_post_meta(get_the_ID(), 'selfer_service_relevent_url', true) !== '' ) { ?>
                            <a href="<?php echo esc_url( get_post_meta(get_the_ID(), 'selfer_service_relevent_url', true) ); ?>" target="_blank" class="mb-4 text-dark d-block">
                                <i class="fa fa-globe mr-2"></i>
                                <?php echo esc_html( get_post_meta(get_the_ID(), 'selfer_service_relevent_url', true) ); ?>
                            </a>
                            <?php } ?>
                            <hr>
                            <?php if(get_post_meta(get_the_ID(), 'selfer_service_includes', true) !== '') {  ?>
                            <?php if(get_post_meta(get_the_ID(), 'selfer_service_includes_title', true) !== '') { ?>
                            <h6><?php echo esc_html(get_post_meta(get_the_ID(), 'selfer_service_includes_title', true)); ?></h6>
                            <?php } else { ?>
                            <h6><?php echo esc_html__('Services Included', 'selfer-core'); ?></h6>
                            <?php } ?>
                            <ul class="list-unstyled">
                                <?php 
                                    $get_service_include = get_post_meta(get_the_ID(), 'selfer_service_includes', true);
                                    $service_inc = explode (", ", $get_service_include);
                                    foreach ($service_inc as $key => $value) { ?>
                                       <li><?php echo esc_html( $value ); ?></li>
                                   <?php }
                                ?>
                            </ul>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div> 
        <?php endwhile; ?> 
        <?php 
    } else {
        echo '<div id="postdata">'. esc_html__('Didn\'t find anything', 'selfer-core') .'</div>';
    }
    wp_die();
    wp_reset_postdata();   
}

add_action ( 'wp_ajax_nopriv_selfer_service_ajax_content', 'selfer_service_ajax_content' );
add_action ( 'wp_ajax_selfer_service_ajax_content', 'selfer_service_ajax_content' );


/**
 *  Protfolio Ajax Content
 *
 * @package Selfer
 * @since 1.0
 */
add_action ( 'wp_ajax_nopriv_selfer_portfolio_ajax_content', 'selfer_portfolio_ajax_content' );
add_action ( 'wp_ajax_selfer_portfolio_ajax_content', 'selfer_portfolio_ajax_content' );
function selfer_portfolio_ajax_content () {
    $post_id = (isset($_REQUEST['post_id'])) ? $_REQUEST['post_id'] : '';

    $the_query  = new WP_Query( array(
        'p' => $post_id,
        'post_type' => 'portfolio',
        'post_status' => 'publish'
    ) );

    if ( $the_query->have_posts() ) {
        while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="modal-header bg-light px-5 pt-0 pb-5">
                <div class="ts-title mb-0">
                    <h4 class="mb-0"><?php the_title(); ?></h4>
                </div>

                <button type="button" class="close position-absolute ts-top__0 ts-right__0 m-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="">&times;</span>
                </button>
            </div>
            <div class="modal-body p-5">
                <div class="slide">
                    <div class="row">
                        <?php if ( has_post_thumbnail() ) {  ?>
                        <div class="col-md-4">
                            <?php selfer_post_featured_image(1920, 1000, true, false); ?>
                        </div>
                        <div class="col-md-8">
                        <?php } else { ?>
                        <div class="col-md-12">
                        <?php } ?>
                            <p><?php echo get_the_content(); ?></p>
                        </div>
                    </div>
                </div>
            </div> 
        <?php endwhile; ?> 
        <?php 
    } else {
        echo '<div id="postdata">'. esc_html__('Didn\'t find anything', 'selfer-core') .'</div>';
    }
    wp_die();
    wp_reset_postdata();   
}


/**
 *  Get All Post Type
 *
 * @package selfer
 * @since 1.0
 */
function selfer_get_all_post_type_options() {

    $post_types = get_post_types(array('public' => true), 'objects');

    $options = ['' => ''];

    foreach ($post_types as $post_type) {
        $options[$post_type->name] = $post_type->label;
    }

    return apply_filters('selfer_post_type_options', $options);
}

/**
 *  Action to handle searching taxonomy terms.
 *
 * @package selfer
 * @since 1.0
 */
function selfer_get_all_taxonomy_options() {

    global $wpdb;

    $results = array();

    foreach ($wpdb->get_results("
        SELECT terms.slug AS 'slug', terms.name AS 'label', termtaxonomy.taxonomy AS 'type'
        FROM $wpdb->terms AS terms
        JOIN $wpdb->term_taxonomy AS termtaxonomy ON terms.term_id = termtaxonomy.term_id
        LIMIT 500
    ") as $result) {
        $results[$result->type . ':' . $result->slug] = $result->type . ':' . $result->label;
    }

    return apply_filters('selfer_taxonomy_options', $results);
}

/**
 *  Query Arguments
 *
 * @package selfer
 * @since 1.0
 */
function selfer_build_query_args($settings) {

    $query_args = [
        'orderby' => $settings['orderby'],
        'order' => $settings['order'],
        'ignore_sticky_posts' => 1,
        'post_status' => 'publish',
    ];

    if (!empty($settings['post_types'])) {
        $query_args['post_type'] = $settings['post_types'];
    }

    if (!empty($settings['post_in'])) {
        $query_args['post__in'] = explode(',', $settings['post_in']);
        $query_args['post__in'] = array_map('intval', $query_args['post__in']);
    } else {
        if (!empty($settings['post_types'])) {
            $query_args['post_type'] = $settings['post_types'];
        }

        if (!empty($settings['tax_query'])) {
            $tax_queries = $settings['tax_query'];

            $query_args['tax_query'] = array();
            $query_args['tax_query']['relation'] = 'OR';
            foreach ($tax_queries as $tq) {
                list($tax, $term) = explode(':', $tq);

                if (empty($tax) || empty($term))
                    continue;
                $query_args['tax_query'][] = array(
                    'taxonomy' => $tax,
                    'field' => 'slug',
                    'terms' => $term
                );
            }
        }
    }

    $query_args['posts_per_page'] = $settings['number'];

    $query_args['paged'] = max(1, get_query_var('paged'), get_query_var('page'));

    return apply_filters('selfer_posts_query_args', $query_args, $settings);
}
/**
 *  Paginatio
 *
 * @package selfer
 * @since 1.0
 */
function selfer_pagination( $query = null ) {
    $big        = 999999999;
    $translated = esc_html__( 'Page', 'selfer-core' );

    if( get_query_var('paged') ) {
        $paged = get_query_var('paged');
    } elseif( get_query_var('page') ) {
        $paged = get_query_var('page');
    } else { 
        $paged = 1; 
    }

    if( $query->max_num_pages > 1 ) {
        echo '<div id="pagination-block-selfer" class="pagination-block">';
            echo paginate_links( array(
                'base'                  => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'                => '?paged=%#%',
                'current'               => max( 1, $paged ),
                'prev_text'             => '<i class="fa fa-angle-left"></i>',
                'next_text'             => '<i class="fa fa-angle-right"></i>',
                'total'                 => $query->max_num_pages,
                'type'                  => 'list',
                'before_page_number'    => '<span class="screen-reader-text">' . $translated . '</span>'
            ) );
        echo '</div>';
    }
}

function selfer_category_post_cont($id, $settings ) {

    if( get_query_var('paged') ) {
        $paged = get_query_var('paged');
    } elseif( get_query_var('page') ) {
        $paged = get_query_var('page');
    } else { 
        $paged = 1; 
    }

    $args = array(
        'post_type'     => 'portfolio', //post type, I used 'product'
        'posts_per_page' => $settings['number'],  //show all,
        'ignore_sticky_posts' => true,
        'paged' => $paged,
        'tax_query' => array(
            array(
              'taxonomy' => 'portfolio-category',  //taxonomy name  here, I used 'product_cat'
              'field' => 'slug',
              'relation' => 'OR',
              'terms' => array( $id )
            )
        )
    );

    if( !empty( $settings['post_in'] ) ) {    
        $args['post__in'] = explode(',', $settings['post_in']);
        $args['post__in'] = array_map('intval', $args['post__in']);
    }

    $query = new WP_Query( $args);

    return (int) $query->post_count;
}

/**
 * Check elementor version
 *
 * @param string $version
 * @param string $operator
 * @return bool
 */
function selfer_is_elementor_version( $operator = '<', $version = '2.6.0' ) {
    return defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, $version, $operator );
}

/**
 * Render icon html with backward compatibility
 *
 * @param array $settings
 * @param string $old_icon_id
 * @param string $new_icon_id
 * @param array $attributes
 */
function selfer_render_icon( $settings = [], $old_icon_id = 'icon', $new_icon_id = 'selected_icon', $attributes = [] ) {
    // Check if its already migrated
    $migrated = isset( $settings['__fa4_migrated'][ $new_icon_id ] );
    // Check if its a new widget without previously selected icon using the old Icon control
    $is_new = empty( $settings[ $old_icon_id ] );

    $attributes['aria-hidden'] = 'true';

    if ( selfer_is_elementor_version( '>=', '2.6.0' ) && ( $is_new || $migrated ) ) {
        \Elementor\Icons_Manager::render_icon( $settings[ $new_icon_id ], $attributes );
    } else {
        if ( empty( $attributes['class'] ) ) {
            $attributes['class'] = $settings[ $old_icon_id ];
        } else {
            if ( is_array( $attributes['class'] ) ) {
                $attributes['class'][] = $settings[ $old_icon_id ];
            } else {
                $attributes['class'] .= ' ' . $settings[ $old_icon_id ];
            }
        }
        printf( '<i %s></i>', \Elementor\Utils::render_html_attributes( $attributes ) );
    }
}