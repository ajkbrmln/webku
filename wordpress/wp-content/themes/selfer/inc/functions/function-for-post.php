<?php
/**
 *  Selfer Get Featured Image
 *
 * @package Selfer
 * @since 1.0
 */
if ( ! function_exists( 'selfer_post_featured_image' ) ) :
function selfer_post_featured_image($width = 900, $height = 600, $crop = false, $mobile = true) {
    $image_id = get_post_thumbnail_id( get_the_ID() );
    $type =  get_post_mime_type( $image_id );

    if( $type == 'image/gif' ) {
        $featured_image = wp_get_attachment_url( get_post_thumbnail_id() ,'full' );
    } else {
        $featured_image = selfer_aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ,'full' ), $width, $height, $crop );
    }

    if( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ) {
        $image_alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
    } else {
        $image_alt = get_the_title();
    }
    $img_meta = wp_prepare_attachment_for_js( get_post_thumbnail_id() );

    if($img_meta['title'] !== "") {
        $imgtitle = 'title=" '. $img_meta['title'] .' "';
    } else {
        $imgtitle = '';
    }
    if( $featured_image == false ) {
        the_post_thumbnail( 'full', array( 'alt' => esc_attr( $image_alt ), 'title' => esc_attr( $img_meta['title'] ) ));
    } else { ?>
        <img src="<?php echo esc_url($featured_image); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" <?php echo wp_kses_post($imgtitle); ?> />
    <?php }
}
endif;

/**
 *  Selfer Get Image Crop Size By Image ID
 *
 * @package Selfer
 * @since 1.0
 */
if ( ! function_exists( 'selfer_get_image_crop_size' ) ) :
function selfer_get_image_crop_size($img_id = false, $width = null, $height = null, $crop = false, $mobile = true) {
    $url = wp_get_attachment_url( $img_id ,'full' );
    if ( wp_is_mobile() && $mobile = true ) {
        $crop_image = selfer_aq_resize( $url, 409, 275, false ); 
        if( $crop_image == false ) {
            return $url;
        } else { 
            return $crop_image;
        }
    } else {
        $crop_image = selfer_aq_resize( $url, $width, $height, $crop ); 
        if( $crop_image == false ) {
            return $url;
        } else { 
            return $crop_image;
        }
    }
}
endif;

/**
 *  Selfer Get Image By Post ID
 *
 * @package Selfer
 * @since 1.0
 */
if ( ! function_exists( 'selfer_get_image_crop_size_by_id' ) ) :
function selfer_get_image_crop_size_by_id($post_id = false, $width = null, $height = null, $crop = false) {
    $url = get_the_post_thumbnail_url($post_id, 'full');
    if ( wp_is_mobile() ) { 
        $crop_image = selfer_aq_resize( $url, 409, 275, false ); 
        if( $crop_image == false ) {
            return $url;
        } else { 
            return $crop_image;
        }
    } else {
        $crop_image = selfer_aq_resize( $url, $width, $height, $crop ); 
        if( $crop_image == false ) {
            return $url;
        } else { 
            return $crop_image;
        }
    }
}
endif;

/**
 *  Selfer Get Image By URL
 *
 * @package EasyArt
 * @since 1.0
 */
if ( ! function_exists( 'selfer_get_image_crop_size_by_url' ) ) :
    function selfer_get_image_crop_size_by_url($url = false, $width = null, $height = null, $crop = false) {
        $crop_image = selfer_aq_resize( $url, $width, $height, $crop ); 
        if( $crop_image == false ) {
            return $url;
        } else { 
            return $crop_image;
        }
    }
endif;

/**
 *  Selfer Return Page Title
 *
 * @package Selfer
 * @since 1.0
 */
if(! function_exists('selfer_return_page_title') ) :
    function selfer_return_page_title() {
        $page_ID = get_queried_object_id();
        return get_the_title($page_ID);
    }
endif;

/**
 *  Selfer Generate Custom Link
 *
 * @package Selfer
 * @since 1.0
 */
if ( ! function_exists( 'selfer_theme_kc_custom_link' ) ) :
function selfer_theme_kc_custom_link( $link, $default = array( 'url' => '', 'title' => '', 'target' => '' ) ) {
    $result = $default;
    $params_link = explode('|', $link);

    if( !empty($params_link) ){
        $result['url'] = rawurldecode(isset($params_link[0])?$params_link[0]:'#');
        $result['title'] = isset($params_link[1])?$params_link[1]:'';
        $result['target'] = isset($params_link[2])?$params_link[2]:'';
    }

    return $result;
}
endif;
