<?php
/**
 * The default template for displaying Portfolio content
 *
 * Used for both single and index/archive/search.
 *
 * @package Selfer
 * @since 1.0
 */
?>
<div class="ts-gallery">
    <a href="<?php the_permalink(); ?>" class="card ts-gallery__item" data-animate="ts-fadeInUp">
        <div class="ts-gallery__item-description">
            <?php 
                $portfilio_cats = get_the_terms( get_the_ID(), 'portfolio-category' ); 
                $cats_name = "";
                foreach($portfilio_cats as $cat_name) {    
                    $cats_name .= $cat_name->name.' '; 
                }
            ?>
            <h6 class="ts-opacity__50"><?php echo esc_html($cats_name); ?></h6>
            <h4><?php echo esc_html( get_the_title() ); ?></h4>
        </div>
        <?php
            $image_size = get_post_meta(get_the_ID(), 'selfer_featured_image_masonry_size', true); 
            if( $image_size == 'x_x' ) {
                selfer_post_featured_image(550, 385, true, false); 
            } elseif ( $image_size == 'x_dx' ) {
                selfer_post_featured_image(550, 588, true, false); 
            } elseif ( $image_size == 'dx_x' ) {
                selfer_post_featured_image(550, 749, true, false); 
            } elseif ( $image_size == 'dx_dx' ) {
                selfer_post_featured_image(550, 441, true, false); 
            } else {
                selfer_post_featured_image(540, 411, true, false); 
            }
        ?>
    </a>
</div>