<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Pure
 * @since Pure 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
        // Post thumbnail.
        pure_post_thumbnail();
    ?>

    <header class="entry-header">
        <?php
            if ( is_single() ) :
                the_title( '<h1 class="entry-title">', '</h1>' );
            else :
                the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
            endif;
        ?>
        <?php if ( is_single() ) : ?>
        <div class="entry-meta">
            <?php pure_entry_meta(); ?>
            <?php edit_post_link( __( 'Edit', 'pure' ), '<span class="edit-link"><i class="fa fa-pencil-square-o"></i>', '</span>' ); ?>
        </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
            if ( is_home() || is_archive() || is_search() ) :
                the_excerpt();
            else :
                /* translators: %s: Name of current post */
                the_content( sprintf(
                    __( 'Continue reading %s', 'pure' ),
                    the_title( '<span class="screen-reader-text">', '</span>', false )
                ) );
            endif;

            wp_link_pages( array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'pure' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
                'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'pure' ) . ' </span>%',
                'separator'   => '<span class="screen-reader-text">, </span>',
            ) );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php if ( is_single() ) : ?>
        <?php pure_entry_tags(); ?>
        <?php else : ?>
        <?php pure_entry_meta(); ?>
        <?php edit_post_link( __( 'Edit', 'pure' ), '<span class="edit-link"><i class="fa fa-pencil-square-o"></i>', '</span>' ); ?>
        <?php endif; ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->