<?php
/**
 * The template for displaying all single posts.
 *
 * @package Selfer
 * @since 1.0
 */
get_header(); ?>

<!-- Blog Block
================================================== -->
<?php
if( get_bloginfo( 'version' ) >= '5.0' ) {
    if( class_exists( 'Classic_Editor' ) )  {?>
        <section class="blog-page-block content-area-main pd-t-220 pd-b-135">
            <div class="container blog-container">
                <div class="row">
                    <?php
                        if( get_post_meta( get_the_ID(), 'selfer_sidebar_position', true) && get_post_meta( get_the_ID(), 'selfer_sidebar_position', true) !=='default' ) {
                            $sidebar_position = get_post_meta( get_the_ID(), 'selfer_sidebar_position', true);
                            if ( $sidebar_position == 'full' ) {
                                $post_columns_class = 'col-lg-11 full-content';
                                $sidebar_columns_class = '';
                            } elseif ( $sidebar_position == 'left' ) {
                               $post_columns_class = 'col-lg-8 order-last';
                               $sidebar_columns_class = 'col-lg-4 order-first';
                            } else {
                                $post_columns_class = 'col-lg-8';
                                $sidebar_columns_class = 'col-lg-4';
                            }
                        } else {
                            $sidebar_position = selfer_get_options('blog_sidebar_dispay');
                            if ( $sidebar_position == 'full' ) {
                                $post_columns_class = 'col-lg-11 full-content';
                                $sidebar_columns_class = '';
                            } elseif ( $sidebar_position == 'left' ) {
                               $post_columns_class = 'col-lg-8 order-last';
                               $sidebar_columns_class = 'col-lg-4 order-first';
                            } else {
                                $post_columns_class = 'col-lg-8';
                                $sidebar_columns_class = 'col-lg-4';
                            }
                        }
                    ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                    <div class="<?php echo esc_attr( $post_columns_class ); ?>">
                        <div class="blog-page-content blog-single-page">
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                                <?php if ( has_post_thumbnail() ) { ?>
                                    <figure class="entry-thumb">
                                        <?php 
                                        if ( $sidebar_position == 'full' ) {
                                            selfer_post_featured_image(924, 450, true, false);
                                        } elseif ( $sidebar_position == 'left' ) {
                                           selfer_post_featured_image(700, 450, true, false);
                                        } else {
                                            selfer_post_featured_image(700, 450, true, false);
                                        } ?> 
                                    </figure><!-- /.entry-thumb -->
                                <?php } ?>
    
                                <div class="entry-meta">
                                    <ul class="meta-list remove-broswer-defult">
                                        <li class="entry-date"><i class="fa fa-calendar"></i> <?php the_time( get_option( 'date_format' ) ); ?></li>
                                        <?php if( function_exists('selfer_estimated_reading_time') ) { ?>
                                        <li class="time-need"><i class="fa fa-clock"></i> <?php echo wp_kses_post( selfer_estimated_reading_time( get_the_content() ) ); ?> <?php esc_html_e('Minute to read', 'selfer'); ?></li>
                                        <?php } ?>
                                        <li class="entry-category"><i class="fa fa-sitemap"></i> <?php the_category(', ' ); ?></li>
                                    </ul><!-- /.meta-list -->
                                </div><!-- /.entry-meta -->
                                <div class="entry-content"> 
                                    <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?> 
                                    <?php 
                                        the_content(); 
                                        selfer_wp_link_pages(); 
                                    ?>
                                    
                                    <?php if( has_tag() ): ?>
                                    <div class="entry-tag">
                                        <?php the_tags(' ', ' ', ' '); ?>
                                    </div><!-- /.entry-tag -->
                                    <?php endif; ?>
                                </div><!-- /.entry-content -->
                            </article><!-- /.post -->
    
                            <div class="single-post-footer text-center">
                                <?php if ( function_exists( 'selfer_social_share_link' ) ) {
                                    // Social Share Code
                                } ?> 
                            </div><!-- /.single-post-footer -->
                            <?php
                                // If comments are open or we have at least one comment, load up the comment template
                                if ( comments_open() || get_comments_number() ) :
                                  comments_template();
                                endif;
                            ?>
                        </div><!-- /.blog-page-content -->
                    </div><!-- /.col-lg-8 -->
                    <?php endwhile; ?>
                    <?php if( $sidebar_position !=='full' ) { ?>
                    <div class="<?php echo esc_attr( $sidebar_columns_class ); ?>">
                        <?php get_sidebar(); ?>
                    </div><!-- /.col-lg-4 -->
                    <?php } ?>
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.blog-block -->
    <?php } else { ?>
        <section class="blog-page-block content-area-main pd-t-150 pd-b-135">
            <div class="container-fluid gutenburg-blog">
                <div class="row">
                    <div class="col-md-12">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                                <header class="entry-header">
                                    <?php
                                    if ( is_singular() ) :
                                        the_title( '<h1 class="entry-title">', '</h1>' );
                                    else :
                                        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                                    endif; ?>
                                </header><!-- .entry-header -->
                                
                                <div class="entry-meta">
                                    <ul class="meta-list remove-broswer-defult">
                                        <li class="entry-date"><i class="fa fa-calendar"></i> <?php the_time( get_option( 'date_format' ) ); ?></li>
                                        <?php if( function_exists('selfer_estimated_reading_time') ) { ?>
                                        <li class="time-need"><i class="fa fa-clock"></i> <?php echo wp_kses_post( selfer_estimated_reading_time( get_the_content() ) ); ?> <?php esc_html_e('Minute to read', 'selfer'); ?></li>
                                        <?php } ?>
                                        <li class="entry-category"><i class="fa fa-sitemap"></i> <?php the_category(', ' ); ?></li>
                                    </ul><!-- /.meta-list -->
                                </div><!-- /.entry-meta -->

                                <?php if ( has_post_thumbnail() ) { ?>
                                    <figure class="entry-thumb">           
                                        <?php selfer_post_featured_image(1920, 750, true, false); ?>  
                                    </figure><!-- /.entry-thumb -->
                                <?php } ?>
                                <div class="entry-content"> 
                                    <?php 
                                        the_content();
                                        selfer_wp_link_pages(); 
                                    ?>
                                    <div class="single-post-footer text-center">
                                        <?php if( has_tag() ): ?>
                                        <div class="entry-tag">
                                            <?php the_tags(' ', ' ', ' '); ?>
                                        </div><!-- /.entry-tag -->
                                        <?php endif; ?>
            
                                        <?php if ( function_exists( 'selfer_social_share_link' ) ) {
                                            // Social Share Code 
                                        } ?> 
                                    </div><!-- /.single-post-footer -->
                                </div><!-- /.entry-content -->
                            </article><!-- /.post -->
                            <?php 
                                // If comments are open or we have at least one comment, load up the comment template.
                                if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                endif;
                            ?>
                        <?php endwhile; ?>
                    </div><!--  /.col-md-12 -->
                </div><!--  /.row -->
            </div>
        </section>
    <?php }
} else {
    if( function_exists('the_gutenberg_project') && has_blocks( get_the_ID() ) ) { ?>
        <section class="blog-page-block content-area-main pd-t-150 pd-b-135">
            <div class="container-fluid gutenburg-blog">
                <div class="row">
                    <div class="col-md-12">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                                <header class="entry-header">
                                    <?php
                                    if ( is_singular() ) :
                                        the_title( '<h1 class="entry-title">', '</h1>' );
                                    else :
                                        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                                    endif; ?>
                                </header><!-- .entry-header -->
                                <div class="entry-meta">
                                    <ul class="meta-list remove-broswer-defult">
                                        <li class="entry-date"><i class="fa fa-calendar"></i> <?php the_time( get_option( 'date_format' ) ); ?></li>
                                        <?php if( function_exists('selfer_estimated_reading_time') ) { ?>
                                        <li class="time-need"><i class="fa fa-clock"></i> <?php echo wp_kses_post( selfer_estimated_reading_time( get_the_content() ) ); ?> <?php esc_html_e('Minute to read', 'selfer'); ?></li>
                                        <?php } ?>
                                        <li class="entry-category"><i class="fa fa-sitemap"></i> <?php the_category(', ' ); ?></li>
                                    </ul><!-- /.meta-list -->
                                </div><!-- /.entry-meta -->
                                <?php if ( has_post_thumbnail() ) { ?>
                                    <figure class="entry-thumb">           
                                        <?php selfer_post_featured_image(1920, 750, true, false); ?>  
                                    </figure><!-- /.entry-thumb -->
                                <?php } ?>
                                <div class="entry-content"> 
                                    <?php 
                                        the_content();
                                        selfer_wp_link_pages(); 
                                    ?>
                                    <div class="single-post-footer text-center">
                                        <?php if( has_tag() ): ?>
                                        <div class="entry-tag">
                                            <?php the_tags(' ', ' ', ' '); ?>
                                        </div><!-- /.entry-tag -->
                                        <?php endif; ?>
        
                                        <?php if ( function_exists( 'selfer_social_share_link' ) ) {
                                            // Social Share Code 
                                        } ?> 
                                    </div><!-- /.single-post-footer -->
                                </div><!-- /.entry-content -->
                            </article><!-- /.post -->
                            <?php 
                                // If comments are open or we have at least one comment, load up the comment template.
                                if ( comments_open() || get_comments_number() ) :
                                    comments_template();
                                endif;
                            ?>
                        <?php endwhile; ?>
                    </div><!--  /.col-md-12 -->
                </div><!--  /.row -->
            </div>
        </section>
    <?php } else { ?>
        <section class="blog-page-block content-area-main pd-t-220 pd-b-135">
            <div class="container blog-container">
                <div class="row">
                    <?php
                        if( get_post_meta( get_the_ID(), 'selfer_sidebar_position', true) && get_post_meta( get_the_ID(), 'selfer_sidebar_position', true) !=='default' ) {
                            $sidebar_position = get_post_meta( get_the_ID(), 'selfer_sidebar_position', true);
                            if ( $sidebar_position == 'full' ) {
                                $post_columns_class = 'col-lg-11 full-content';
                                $sidebar_columns_class = '';
                            } elseif ( $sidebar_position == 'left' ) {
                            $post_columns_class = 'col-lg-8 order-last';
                            $sidebar_columns_class = 'col-lg-4 order-first';
                            } else {
                                $post_columns_class = 'col-lg-8';
                                $sidebar_columns_class = 'col-lg-4';
                            }
                        } else {
                            $sidebar_position = selfer_get_options('blog_sidebar_dispay');
                            if ( $sidebar_position == 'full' ) {
                                $post_columns_class = 'col-lg-11 full-content';
                                $sidebar_columns_class = '';
                            } elseif ( $sidebar_position == 'left' ) {
                            $post_columns_class = 'col-lg-8 order-last';
                            $sidebar_columns_class = 'col-lg-4 order-first';
                            } else {
                                $post_columns_class = 'col-lg-8';
                                $sidebar_columns_class = 'col-lg-4';
                            }
                        }
                    ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                    <div class="<?php echo esc_attr( $post_columns_class ); ?>">
                        <div class="blog-page-content blog-single-page">
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                                <?php if ( has_post_thumbnail() ) { ?>
                                    <figure class="entry-thumb">
                                        <?php 
                                        if ( $sidebar_position == 'full' ) {
                                            selfer_post_featured_image(924, 450, true, false);
                                        } elseif ( $sidebar_position == 'left' ) {
                                        selfer_post_featured_image(700, 450, true, false);
                                        } else {
                                            selfer_post_featured_image(700, 450, true, false);
                                        } ?> 
                                    </figure><!-- /.entry-thumb -->
                                <?php } ?>

                                <div class="entry-meta">
                                    <ul class="meta-list remove-broswer-defult">
                                        <li class="entry-date"><i class="fa fa-calendar"></i> <?php the_time( get_option( 'date_format' ) ); ?></li>
                                        <?php if( function_exists('selfer_estimated_reading_time') ) { ?>
                                        <li class="time-need"><i class="fa fa-clock"></i> <?php echo wp_kses_post( selfer_estimated_reading_time( get_the_content() ) ); ?> <?php esc_html_e('Minute to read', 'selfer'); ?></li>
                                        <?php } ?>
                                        <li class="entry-category"><i class="fa fa-sitemap"></i> <?php the_category(', ' ); ?></li>
                                    </ul><!-- /.meta-list -->
                                </div><!-- /.entry-meta -->
                                <div class="entry-content"> 
                                    <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?> 
                                    <?php 
                                        the_content(); 
                                        selfer_wp_link_pages(); 
                                    ?>
                                    
                                    <?php if( has_tag() ): ?>
                                    <div class="entry-tag">
                                        <?php the_tags(' ', ' ', ' '); ?>
                                    </div><!-- /.entry-tag -->
                                    <?php endif; ?>
                                </div><!-- /.entry-content -->
                            </article><!-- /.post -->

                            <div class="single-post-footer text-center">
                                <?php if ( function_exists( 'selfer_social_share_link' ) ) {
                                    // Social Share Code
                                } ?> 
                            </div><!-- /.single-post-footer -->
                            <?php
                                // If comments are open or we have at least one comment, load up the comment template
                                if ( comments_open() || get_comments_number() ) :
                                comments_template();
                                endif;
                            ?>
                        </div><!-- /.blog-page-content -->
                    </div><!-- /.col-lg-8 -->
                    <?php endwhile; ?>
                    <?php if( $sidebar_position !=='full' ) { ?>
                    <div class="<?php echo esc_attr( $sidebar_columns_class ); ?>">
                        <?php get_sidebar(); ?>
                    </div><!-- /.col-lg-4 -->
                    <?php } ?>
                </div><!-- /.row -->
            </div><!-- /.container -->
        </section><!-- /.blog-block -->
    <?php }
} ?>

<?php get_footer(); ?>