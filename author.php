<?php
/**
 * The template for displaying Author bios
 *
 * @package WordPress
 * @subpackage Pure
 * @since Pure 1.0
 */
?>

<div class="author-info">
    <h2 class="author-heading"><?php _e( 'Published by', 'pure' ); ?></h2>
    <div class="author-avatar">
        <?php
        /**
         * Filter the author bio avatar size.
         *
         * @since Pure 1.0
         *
         * @param int $size The avatar height and width size in pixels.
         */
        $author_bio_avatar_size = apply_filters( 'pure_author_bio_avatar_size', 56 );

        echo get_avatar( pure_get_profile( 'email' ), $author_bio_avatar_size );
        ?>
    </div><!-- .author-avatar -->

    <div class="author-description">
        <h3 class="author-title"><?php echo pure_get_profile( 'nickname' ); ?></h3>

        <p class="author-bio">
            <?php echo pure_get_profile( 'description' ); ?>
        </p><!-- .author-bio -->

    </div><!-- .author-description -->
</div><!-- .author-info -->
