<?php
/**
 * The template for displaying search forms.
 *
 * @package WordPress
 * @subpackage Pure
 * @since Pure 1.0
 */
?>

<form role="search" id="search" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" autocomplete="off">
        <span class="input-group-btn">
            <button class="btn btn-custom" type="submit" title="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>"><i class="fa fa-search"></i></button>
        </span>
    </div>
</form>