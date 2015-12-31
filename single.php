<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Pure
 * @since Pure 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area col-sm-8">
		<main id="main" class="site-main" role="main">

		<?php get_template_part('navbar') ?>

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			/*
			 * Include the post format-specific template for the content. If you want to
			 * use this in a child theme, then include a file called called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */
			get_template_part( 'content', get_post_format() );

			// Previous/next post navigation.
			/*the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'pure' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Next post:', 'pure' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'pure' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous post:', 'pure' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );*/

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		// End the loop.
		endwhile;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>