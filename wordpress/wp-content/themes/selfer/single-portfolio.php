<?php
/**
 * The template for displaying Portfolio Details
 *
 * This is the template that displays all Portfolio.
 *
 * @package Selfer
 */
get_header();

$elemetor = get_post_meta( get_the_ID(), '_elementor_edit_mode');
if( $elemetor ) : 
    if ( have_posts() ) : 
        while ( have_posts() ) : the_post(); ?> 
        <div class="selfer-page-builder-content content-area-main clearfix pd-t-195 pd-b-135">
            <div class="container">                
                <?php if( get_post_meta( get_the_ID(), 'selfer_show_page_title', true) !== 'no' ) {
                    the_title( '<h2 class="entry-title mrb-30">', '</h2>' );
                } ?>
                <?php if( get_post_meta( get_the_ID(), 'selfer_show_featured_image_in_content', true) !== 'no' && has_post_thumbnail()) { ?>
                    <figure class="entry-thumb">           
                        <?php selfer_post_featured_image(1920, 750, true, false); ?>  
                    </figure><!-- /.entry-thumb -->
                <?php } ?>
            </div>
            <div class="pagebuilder-content">
                <?php the_content(); ?>
            </div>
            <div class="container mrt-60">
                <div class="portfolio-pagination">
                    <div class="row align-items-center">
                        <div class="col text-left">
                        <?php 
                        $prev_post = get_previous_post();
                        if($prev_post) {
                            $prev_title = strip_tags(str_replace('"', '', $prev_post->post_title)); ?>
                            <a href="<?php echo esc_url( get_permalink($prev_post->ID) ); ?>" class="older-posts" title="<?php echo esc_attr( $prev_title ); ?>"><i class="fa fa-arrow-left"></i><span class="navigation-text"><?php esc_html_e('Older Posts', 'selfer'); ?></span></a>
                        <?php } ?>
                        </div>
                        <div class="col text-center">
                            
                        </div>
                        <div class="col text-right">
                        <?php 
                        $next_post = get_next_post();
                        if($next_post) {
                            $next_title = strip_tags(str_replace('"', '', $next_post->post_title)); ?>
                            <a href="<?php echo esc_url( get_permalink($next_post->ID) ); ?>" class="newer-posts" title="<?php echo esc_attr($next_title); ?>"><span class="navigation-text"><?php esc_html_e('Newer Posts', 'selfer'); ?></span> <i class="fa fa-arrow-right"></i></a>
                        <?php } ?>
                        </div>
                    </div>
                </div><!-- /.container -->
            </div>
        </div>
        <?php 
        endwhile; 
    endif;
else:
    if( get_bloginfo( 'version' ) >= '5.0' ) {
        if ( class_exists( 'Classic_Editor' ) ) : ?>
            <!-- Blog Block
            ================================================== -->
            <section class="blog-page-block content-area-main pd-t-195 pd-b-135">
                <div class="container blog-container">
                    <div class="row">
                        <?php while ( have_posts() ) : the_post(); ?>
                        <div class="col-md-12 full-content">
                            <div class="blog-page-content blog-single-page site-single-post">
                                <article id="post-<?php the_ID(); ?>" <?php post_class(' post '); ?> >
                                    <?php if( get_post_meta( get_the_ID(), 'selfer_show_featured_image_in_content', true) !== 'no' && has_post_thumbnail() ) { ?>
                                        <figure class="entry-thumb">          
                                            <a href="<?php the_permalink(); ?>">
                                                <?php selfer_post_featured_image(1110, 750, true, false); ?>       
                                            </a> 
                                        </figure><!-- /.entry-thumb -->
                                    <?php } ?>

                                    <div class="entry-content">
                                        <?php if( get_post_meta( get_the_ID(), 'selfer_show_page_title', true) !== 'no' ) { ?>
                                            <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
                                        <?php } ?> 
                                        <?php 
                                            the_content(); 
                                            selfer_wp_link_pages(); 
                                        ?>
                                    </div><!-- /.entry-content -->
                                </article><!-- /.post -->

                            </div><!-- /.blog-page-content -->
                            <div class="portfolio-pagination">
                                <div class="row align-items-center">
                                    <div class="col text-left">
                                    <?php 
                                    $prev_post = get_previous_post();
                                    if($prev_post) {
                                        $prev_title = strip_tags(str_replace('"', '', $prev_post->post_title)); ?>
                                        <a href="<?php echo esc_url( get_permalink($prev_post->ID) ); ?>" class="older-posts" title="<?php echo esc_attr( $prev_title ); ?>"><i class="fa fa-arrow-left"></i><span class="navigation-text"><?php esc_html_e('Older Posts', 'selfer'); ?></span></a>
                                    <?php } ?>
                                    </div>
                                    <div class="col text-center">
                                        
                                    </div>
                                    <div class="col text-right">
                                    <?php 
                                    $next_post = get_next_post();
                                    if($next_post) {
                                        $next_title = strip_tags(str_replace('"', '', $next_post->post_title)); ?>
                                        <a href="<?php echo esc_url( get_permalink($next_post->ID) ); ?>" class="newer-posts" title="<?php echo esc_attr($next_title); ?>"><span class="navigation-text"><?php esc_html_e('Newer Posts', 'selfer'); ?></span> <i class="fa fa-arrow-right"></i></a>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div><!-- /.container -->
                        </div><!-- /.col-md-12 full-content -->
                        <?php endwhile; ?>
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </section><!-- /.blog-block -->
        <?php else: 
            if ( have_posts() ) : 
                while ( have_posts() ) : the_post(); ?> 
                <div class="selfer-page-gutenberg-content content-area-main clearfix pd-t-195 pd-b-135">
                    <div class="entry-content">
                        <?php if( get_post_meta( get_the_ID(), 'selfer_show_page_title', true) !== 'no' ) {
                            the_title( '<h2 class="entry-title">', '</h2>' );
                        } ?>
                        <?php if( get_post_meta( get_the_ID(), 'selfer_show_featured_image_in_content', true) !== 'no' && has_post_thumbnail()) { ?>
                            <figure class="entry-thumb pd-l-15 pd-r-15">           
                                <?php selfer_post_featured_image(1920, 750, true, false); ?>  
                            </figure><!-- /.entry-thumb -->
                        <?php } ?>

                        <?php the_content(); ?>

                        <div class="portfolio-pagination mrt-60">
                            <div class="row align-items-center">
                                <div class="col text-left">
                                <?php 
                                $prev_post = get_previous_post();
                                if($prev_post) {
                                    $prev_title = strip_tags(str_replace('"', '', $prev_post->post_title)); ?>
                                    <a href="<?php echo esc_url( get_permalink($prev_post->ID) ); ?>" class="older-posts" title="<?php echo esc_attr( $prev_title ); ?>"><i class="fa fa-arrow-left"></i><span class="navigation-text"><?php esc_html_e('Older Posts', 'selfer'); ?></span></a>
                                <?php } ?>
                                </div>
                                <div class="col text-center">
                                    
                                </div>
                                <div class="col text-right">
                                <?php 
                                $next_post = get_next_post();
                                if($next_post) {
                                    $next_title = strip_tags(str_replace('"', '', $next_post->post_title)); ?>
                                    <a href="<?php echo esc_url( get_permalink($next_post->ID) ); ?>" class="newer-posts" title="<?php echo esc_attr($next_title); ?>"><span class="navigation-text"><?php esc_html_e('Newer Posts', 'selfer'); ?></span> <i class="fa fa-arrow-right"></i></a>
                                <?php } ?>
                                </div>
                            </div>
                        </div><!-- /.container -->
                    </div><!--  /.entry-content -->
                </div>
                <?php 
                endwhile; 
            endif;
        ?>
        <?php endif; 
    } else {
        if( function_exists('the_gutenberg_project') && has_blocks( get_the_ID() ) ) { ?>
            <?php if ( have_posts() ) : 
                while ( have_posts() ) : the_post(); ?> 
                <div class="selfer-page-gutenberg-content content-area-main clearfix   pd-t-195 pd-b-135">
                    <?php if( get_post_meta( get_the_ID(), 'selfer_show_page_title', true) !== 'no' ) {
                        the_title( '<h2 class="entry-title">', '</h2>' );
                    } ?>
                    <?php if( get_post_meta( get_the_ID(), 'selfer_show_featured_image_in_content', true) !== 'no' && has_post_thumbnail()) { ?>
                        <figure class="entry-thumb pd-l-15 pd-r-15">           
                            <?php selfer_post_featured_image(1920, 750, true, false); ?>  
                        </figure><!-- /.entry-thumb -->
                    <?php } ?>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div><!--  /.entry-content -->

                    <div class="portfolio-pagination mrt-60">
                        <div class="row align-items-center">
                            <div class="col text-left">
                            <?php 
                            $prev_post = get_previous_post();
                            if($prev_post) {
                                $prev_title = strip_tags(str_replace('"', '', $prev_post->post_title)); ?>
                                <a href="<?php echo esc_url( get_permalink($prev_post->ID) ); ?>" class="older-posts" title="<?php echo esc_attr( $prev_title ); ?>"><i class="fa fa-arrow-left"></i><span class="navigation-text"><?php esc_html_e('Older Posts', 'selfer'); ?></span></a>
                            <?php } ?>
                            </div>
                            <div class="col text-center">
                                
                            </div>
                            <div class="col text-right">
                            <?php 
                            $next_post = get_next_post();
                            if($next_post) {
                                $next_title = strip_tags(str_replace('"', '', $next_post->post_title)); ?>
                                <a href="<?php echo esc_url( get_permalink($next_post->ID) ); ?>" class="newer-posts" title="<?php echo esc_attr($next_title); ?>"><span class="navigation-text"><?php esc_html_e('Newer Posts', 'selfer'); ?></span> <i class="fa fa-arrow-right"></i></a>
                            <?php } ?>
                            </div>
                        </div>
                    </div><!-- /.container -->
                </div>
                <?php 
                endwhile; 
            endif; ?>
        <?php } else { ?>
            <!-- Blog Block
            ================================================== -->
            <section class="blog-page-block content-area-main pd-t-195 pd-b-135">
                <div class="container blog-container">
                    <div class="row">
                        <?php while ( have_posts() ) : the_post(); ?>
                        <div class="col-md-12 full-content">
                            <div class="blog-page-content blog-single-page site-single-post">
                                <article id="post-<?php the_ID(); ?>" <?php post_class(' post '); ?> >
                                    <?php if( get_post_meta( get_the_ID(), 'selfer_show_featured_image_in_content', true) !== 'no' && has_post_thumbnail() ) { ?>
                                        <figure class="entry-thumb">          
                                            <a href="<?php the_permalink(); ?>">
                                                <?php selfer_post_featured_image(1110, 750, true, false); ?>       
                                            </a> 
                                        </figure><!-- /.entry-thumb -->
                                    <?php } ?>

                                    <div class="entry-content">
                                        <?php if( get_post_meta( get_the_ID(), 'selfer_show_page_title', true) !== 'no' ) { ?>
                                            <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
                                        <?php } ?> 
                                        <?php 
                                            the_content(); 
                                            selfer_wp_link_pages(); 
                                        ?>
                                    </div><!-- /.entry-content -->
                                </article><!-- /.post -->

                            </div><!-- /.blog-page-content -->
                            <div class="portfolio-pagination">
                                <div class="row align-items-center">
                                    <div class="col text-left">
                                    <?php 
                                    $prev_post = get_previous_post();
                                    if($prev_post) {
                                        $prev_title = strip_tags(str_replace('"', '', $prev_post->post_title)); ?>
                                        <a href="<?php echo esc_url( get_permalink($prev_post->ID) ); ?>" class="older-posts" title="<?php echo esc_attr( $prev_title ); ?>"><i class="fa fa-arrow-left"></i><span class="navigation-text"><?php esc_html_e('Older Posts', 'selfer'); ?></span></a>
                                    <?php } ?>
                                    </div>
                                    <div class="col text-center">
                                        
                                    </div>
                                    <div class="col text-right">
                                    <?php 
                                    $next_post = get_next_post();
                                    if($next_post) {
                                        $next_title = strip_tags(str_replace('"', '', $next_post->post_title)); ?>
                                        <a href="<?php echo esc_url( get_permalink($next_post->ID) ); ?>" class="newer-posts" title="<?php echo esc_attr($next_title); ?>"><span class="navigation-text"><?php esc_html_e('Newer Posts', 'selfer'); ?></span> <i class="fa fa-arrow-right"></i></a>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div><!-- /.container -->
                        </div><!-- /.col-md-12 full-content -->
                        <?php endwhile; ?>
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </section><!-- /.blog-block -->
        <?php }
    } ?>
<?php endif; ?>
<?php get_footer(); ?>