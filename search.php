<?php
/**
 * The template for displaying search results pages.
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
                <h1 class="page-title"><i class="fa fa-search"></i> <?php printf( __( 'Search Results for: %s', 'pure' ), get_search_query() ); ?></h1>
            </header><!-- .page-header -->

            <?php
            // Start the loop.
            while ( have_posts() ) : the_post(); ?>

                <?php
                /*
                 * Run the loop for the search to output the results.
                 * If you want to overload this in a child theme then include a file
                 * called content-search.php and that will be used instead.
                 */
                get_template_part( 'content', 'search' );

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