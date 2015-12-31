<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Pure
 * @since Pure 1.0
 */

if ( is_active_sidebar( 'sidebar-1' )  ) : ?>
    <div id="secondary" class="secondary col-sm-4 col-sm-offset-1">
        <?php
        if ( pure_profile_show_on() ) :
            get_template_part( 'author' );
        endif;
        ?>

        <div class="sidebox">
            <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
                <div id="widget-area" class="widget-area" role="complementary">
                    <?php dynamic_sidebar( 'sidebar-1' ); ?>
                </div><!-- .widget-area -->
            <?php endif; ?>
        </div>
    </div><!-- .secondary -->

<?php endif; ?>