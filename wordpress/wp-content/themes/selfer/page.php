<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package Selfer
 */
get_header();

$elemetor = get_post_meta( get_the_ID(), '_elementor_edit_mode');
if( $elemetor ) : 
    if ( have_posts() ) : 
        while ( have_posts() ) : the_post(); ?> 
        <div class="selfer-page-builder-content clearfix">
            <?php the_content(); ?>
        </div>
        <?php 
        endwhile; 
    endif;
else: 
    if( get_bloginfo( 'version' ) >= '5.0' ) {
        if( class_exists( 'Classic_Editor' ) ) { ?>
            <!-- Blog Block
            ================================================== -->
            <section class="blog-page-block content-area-main pd-t-195 pd-b-135">
                <div class="container blog-container">
                    <div class="row">
                        <?php while ( have_posts() ) : the_post(); ?>
                        <div class="col-md-12 full-content">
                            <div class="blog-page-content blog-single-page site-single-post">
                                <article id="post-<?php the_ID(); ?>" <?php post_class(' post '); ?> >
                                    <?php if ( has_post_thumbnail() ) { ?>
                                        <figure class="entry-thumb">          
                                            <a href="<?php the_permalink(); ?>">
                                                <?php selfer_post_featured_image(685, 439); ?>       
                                            </a> 
                                        </figure><!-- /.entry-thumb -->
                                    <?php } ?>

                                    <div class="entry-content"> 
                                        <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?> 
                                        <?php 
                                            the_content(); 
                                            selfer_wp_link_pages(); 
                                        ?>
                                    </div><!-- /.entry-content -->
                                </article><!-- /.post -->

                            </div><!-- /.blog-page-content -->
                            
                            <div class="page-comments-area">             
                                <?php
                                // If comments are open or we have at least one comment, load up the comment template
                                if ( comments_open() || get_comments_number() ) :
                                comments_template();
                                endif;
                                ?>
                            </div><!--  /.page-comments-area -->
                        </div><!-- /.col-md-9 full-content -->
                        <?php endwhile; ?>
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </section><!-- /.blog-block -->
        <?php } else {
            if ( have_posts() ) : 
                while ( have_posts() ) : the_post(); ?> 
                <div class="selfer-page-gutenberg-content content-area-main clearfix  pd-t-150 pd-b-135">
                    <?php if( get_post_meta( get_the_ID(), 'selfer_show_page_title', true) !== 'no' ) {
                        the_title( '<h2 class="entry-title">', '</h2>' );
                    } ?>
                    <?php if( get_post_meta( get_the_ID(), 'selfer_show__service_featured_image_in_content', true) == 'yes' && has_post_thumbnail()) { ?>
                        <figure class="entry-thumb">           
                            <?php selfer_post_featured_image(1920, 750, true, false); ?>  
                        </figure><!-- /.entry-thumb -->
                    <?php } ?>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div><!--  /.entry-content -->
                </div>
                <div class="page-comments-area">             
                    <?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                    ?>
                </div><!--  /.page-comments-area -->
                <?php 
                endwhile; 
            endif;
        }
    } else {
        if ( function_exists('the_gutenberg_project') && has_blocks( get_the_ID() ) ) :
            if ( have_posts() ) : 
                while ( have_posts() ) : the_post(); ?> 
                <div class="selfer-page-gutenberg-content content-area-main clearfix  pd-t-150 pd-b-135">
                    <?php if( get_post_meta( get_the_ID(), 'selfer_show_page_title', true) !== 'no' ) {
                        the_title( '<h2 class="entry-title">', '</h2>' );
                    } ?>
                    <?php if( get_post_meta( get_the_ID(), 'selfer_show__service_featured_image_in_content', true) == 'yes' && has_post_thumbnail()) { ?>
                        <figure class="entry-thumb">           
                            <?php selfer_post_featured_image(1920, 750, true, false); ?>  
                        </figure><!-- /.entry-thumb -->
                    <?php } ?>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div><!--  /.entry-content -->
                </div>
                <div class="page-comments-area">             
                    <?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || get_comments_number() ) :
                      comments_template();
                    endif;
                    ?>
                </div><!--  /.page-comments-area -->
                <?php 
                endwhile; 
            endif;
        else: ?>
            <!-- Blog Block
            ================================================== -->
            <section class="blog-page-block content-area-main pd-t-195 pd-b-135">
                <div class="container blog-container">
                    <div class="row">
                        <?php while ( have_posts() ) : the_post(); ?>
                        <div class="col-md-12 full-content">
                            <div class="blog-page-content blog-single-page site-single-post">
                                <article id="post-<?php the_ID(); ?>" <?php post_class(' post '); ?> >
                                    <?php if ( has_post_thumbnail() ) { ?>
                                        <figure class="entry-thumb">          
                                            <a href="<?php the_permalink(); ?>">
                                                <?php selfer_post_featured_image(685, 439); ?>       
                                            </a> 
                                        </figure><!-- /.entry-thumb -->
                                    <?php } ?>
        
                                    <div class="entry-content"> 
                                        <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?> 
                                        <?php 
                                            the_content(); 
                                            selfer_wp_link_pages(); 
                                        ?>
                                    </div><!-- /.entry-content -->
                                </article><!-- /.post -->
        
                            </div><!-- /.blog-page-content -->
                            
                            <div class="page-comments-area">             
                                <?php
                                // If comments are open or we have at least one comment, load up the comment template
                                if ( comments_open() || get_comments_number() ) :
                                  comments_template();
                                endif;
                                ?>
                            </div><!--  /.page-comments-area -->
                        </div><!-- /.col-md-9 full-content -->
                        <?php endwhile; ?>
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </section><!-- /.blog-block -->

        <?php endif;
    }
endif; ?>        
<?php get_footer(); ?>