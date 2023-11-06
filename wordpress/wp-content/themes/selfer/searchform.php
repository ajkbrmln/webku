<?php
/**
 * The template for displaying search form.
 *
 * @package Selfer
 * @since 1.0
 */
?>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="searchform">
    <div class="input-group">
        <input type="search" name="s" placeholder="<?php esc_attr_e( 'Search here &hellip;', 'selfer' ); ?>" class="form-controller" required="required" value="<?php echo esc_html( get_search_query() ); ?>">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <i class="fa fa-search"></i>
            </button>
        </span> 
    </div>
</form>

