<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Pure
 * @since Pure 1.0
 */

get_header(); ?>

    <div id="primary" class="content-area col-sm-8">
        <main id="main" class="site-main" role="main">

            <?php get_template_part('navbar') ?>

            <section class="error-404 not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'pure' ); ?></h1>
                </header><!-- .page-header -->

                <div class="page-content">
                    <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'pure' ); ?></p>

                    <?php get_search_form(); ?>
                </div><!-- .page-content -->
            </section><!-- .error-404 -->

        </main><!-- .site-main -->
    </div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>