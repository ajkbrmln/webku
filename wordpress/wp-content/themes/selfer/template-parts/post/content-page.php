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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( has_post_thumbnail() ) { ?>
    <figure class="post-thumb">
        <?php 
            the_post_thumbnail( 'selfer-single-full', array( 'class' => " img-responsive", 'alt' => get_the_title() ));
        ?>
    </figure> <!-- /.post-thumb -->
    <?php } ?>
    <header class="entry-header">            
        <?php the_title( sprintf( '<h2 class="entry-title">', esc_url( get_permalink() ) ), '</h2>' ); ?>
    </header> <!-- /.entry-header -->

    <div class="entry-content">
    <?php 
        the_content(); 
        selfer_wp_link_pages();
    ?>
    </div> <!-- .entry-content --> 
</article> <!-- /.post-->
