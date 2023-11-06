<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package Selfer
 * @since 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
    <?php if ( has_post_thumbnail() ) {  ?>
        <figure class="entry-thumb">          
            <a href="<?php the_permalink(); ?>">
                <?php 
                $sidebar_position = selfer_get_options('blog_sidebar_dispay');
                if ( $sidebar_position == 'full' ) {
                    selfer_post_featured_image(924, 450, true, false);
                } elseif ( $sidebar_position == 'left' ) {
                   selfer_post_featured_image(700, 450, true, false);
                } else {
                    selfer_post_featured_image(700, 450, true, false);
                } ?>            
            </a> 
        </figure><!-- /.entry-thumb -->
    <?php } ?>

    <div class="entry-content"> 
        <?php 
            /* translators: %s: Permalinks of Posts */
            the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); 
        ?>
        <?php 
            the_excerpt();
        ?>
    </div><!-- /.entry-content -->
</article><!-- /.post -->