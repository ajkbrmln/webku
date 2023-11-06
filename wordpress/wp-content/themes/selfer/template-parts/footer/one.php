<?php
/**
 * This template for displaying footer part
 *
 * @package Selfer
 * @since 1.0
 */
    /**
     * Footer Part show/hide condition
     *
     * @since 1.0
     */
    if( get_post_meta( get_the_ID(), 'selfer_footer_show_footer', true) == 'no' ) {
        return;
    } ?>

    <!-- Modal -->
    <div class="modal fade text-dark" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content border-0 rounded-0">
                <div id="post-modal-container">
                </div><!-- /#post-modal-container  -->
            </div>
            <!--end modal-content-->
        </div>
        <!--end modal-dialog-->
    </div>

    <!-- Custom Footer
    ================================================== --> 
    <?php if( selfer_get_options('footer_type') == 'custom_footer' && selfer_get_options('footer_templates') !== 'default' || get_post_meta( get_the_ID(), 'selfer_footer_type', true) == 'custom_template' && get_post_meta( get_the_ID(), 'selfer_footer_template', true) !== 'default'  ) : ?>
    <footer class="selfer-custom-footer">
        <?php
            if( !empty(get_post_meta( get_the_ID(), 'selfer_footer_template', true)) && get_post_meta( get_the_ID(), 'selfer_footer_template', true) !== 'default' ) {
                $get_custom_footers = get_post_meta( get_the_ID(), 'selfer_footer_template', true);
            } else {
                $get_custom_footers = selfer_get_options('footer_templates');
            }
            
            $args = array( 'post_type' => 'selfer_templates', 'p' => $get_custom_footers );

            $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                    the_content();
                endwhile;
            wp_reset_postdata();
        ?>
    </footer><!--  /.selfer-custom-header -->

    <?php else : ?>

    <footer id="ts-footer" class="selfer-footer-wrapper">
        <div class="selfer-footer">
            <div class="container py-3 position-relative">
                <small class="copyright-text"><?php echo wp_kses( selfer_get_options( array('footer_copyright_info', __('Copyright &copy; 2018 Selfer All rights Reserved. Developed By - <a href="#">SoftHopper</a>','selfer') ) ), Selfer_Static::html_allow() ); ?></small>
                <?php 
                $scrollOptions = selfer_get_options( 'scroll_top_btn' );
                if( $scrollOptions == true ) { ?>
                <a href="#page-top" class="ts-circle__xs rounded-0 bg-dark position-absolute ts-right__0 ts-top__0 ts-push-up__50 ts-footer-scroll">
                    <i class="fa fa-arrow-up text-white"></i>
                </a>
                <?php } ?>
            </div>
        </div>
    </footer>
    <?php endif; ?>
</div><!--end page-->