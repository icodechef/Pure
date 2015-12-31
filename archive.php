<?php
/**
 * The template for displaying archive pages
 *
 * @package WordPress
 * @subpackage Pure
 * @since Pure 1.0
 */

get_header(); ?>

    <section id="primary" class="content-area col-sm-8">
        <main id="main" class="site-main" role="main">

        <?php get_template_part('navbar') ?>

        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <?php
                    the_archive_title( '<h1 class="page-title"><i class="fa fa-folder"></i> ', '</h1>' );
                    the_archive_description( '<div class="taxonomy-description">', '</div>' );
                ?>
            </header><!-- .page-header -->

            <?php
            // Start the Loop.
            while ( have_posts() ) : the_post();

                /*
                 * Include the Post-Format-specific template for the content.
                 * If you want to override this in a child theme, then include a file
                 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                 */
                get_template_part( 'content', get_post_format() );

            // End the loop.
            endwhile;

            // Previous/next page navigation.
            the_posts_pagination( array(
                'prev_text'          => __( 'Previous page', 'pure' ),
                'next_text'          => __( 'Next page', 'pure' ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'pure' ) . ' </span>',
            ) );

        // If no content, include the "No posts found" template.
        else :
            get_template_part( 'content', 'none' );

        endif;
        ?>

        </main><!-- .site-main -->
    </section><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>