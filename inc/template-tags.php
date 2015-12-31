<?php

if ( ! function_exists( 'pure_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @since Pure 1.0
 */
function pure_post_thumbnail() {
    if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
        return;
    }

    if ( is_singular() ) :
    ?>

    <div class="post-thumbnail">
        <?php the_post_thumbnail(); ?>
    </div><!-- .post-thumbnail -->

    <?php else : ?>

    <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
        <?php
            the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
        ?>
    </a>

    <?php endif; // End is_singular()
}
endif;

if ( ! function_exists( 'pure_comment_nav' ) ) :
/**
 * Display navigation to next/previous comments when applicable.
 *
 * @since Pure 1.0
 */
function pure_comment_nav() {
    // Are there comments to navigate through?
    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
    ?>
    <nav class="navigation comment-navigation" role="navigation">
        <h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'pure' ); ?></h2>
        <div class="nav-links">
            <?php
                if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'pure' ) ) ) :
                    printf( '<div class="nav-previous"><i class="fa fa-long-arrow-left"></i> %s</div>', $prev_link );
                endif;

                if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'pure' ) ) ) :
                    printf( '<div class="nav-next">%s <i class="fa fa-long-arrow-right"></i></div>', $next_link );
                endif;
            ?>
        </div><!-- .nav-links -->
    </nav><!-- .comment-navigation -->
    <?php
    endif;
}
endif;

if ( ! function_exists( 'pure_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the categories, tags.
 *
 * @since Pure 1.0
 */
function pure_entry_meta() {
    if ( is_sticky() && is_home() && ! is_paged() ) {
        printf( '<span class="sticky-post">%s</span>', __( 'Featured', 'pure' ) );
    }

    if ( 'post' == get_post_type() ) {
        printf( '<span class="byline"><span class="author vcard"><i class="fa fa-user"></i><span class="screen-reader-text">%1$s </span><a class="url fn n" href="%2$s">%3$s</a></span></span>',
            _x( 'Author', 'Used before post author name.', 'pure' ),
            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
            get_the_author()
        );
    }

    if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';

        /*$time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c' ) ),
            is_single() ? pure_get_time_ago( get_post_time( 'c', true ) ),
            esc_attr( get_the_modified_date( 'c' ) ),
            get_the_modified_date()
        );*/

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c' ) ),
            get_the_date(),
            esc_attr( get_the_modified_date( 'c' ) ),
            get_the_modified_date()
        );

        printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><i class="fa fa-clock-o"></i><a href="%2$s" rel="bookmark">%3$s</a></span>',
            _x( 'Posted on', 'Used before publish date.', 'pure' ),
            esc_url( get_permalink() ),
            $time_string
        );
    }

    if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo '<span class="comments-link"><i class="fa fa-comment-o"></i>';
        comments_popup_link( __( 'Leave a comment', 'pure' ), __( '1 Comment', 'pure' ), __( '% Comments', 'pure' ) );
        echo '</span>';
    }

    return;
}
endif;

if ( ! function_exists( 'pure_entry_tags' ) ) :
/**
 * Prints HTML with meta information for the tags.
 *
 * @since Pure 1.0
 */
function pure_entry_tags() {
    if ( 'post' == get_post_type() && is_single() ) {
        $tags_list = get_the_tag_list( '', _x( ' ', 'Used between list items, there is a space after the comma.', 'pure' ) );
        if ( $tags_list ) {
            printf( '<span class="tags-links"><i class="fa fa-tags"></i> <span class="screen-reader-text">%1$s </span>%2$s</span>',
                _x( 'Tags', 'Used before tag names.', 'pure' ),
                $tags_list
            );
        }
    }
}
endif;

if ( ! function_exists( 'pure_entry_category' ) ) :
/**
 * Prints HTML with meta information for the categories
 *
 * @since Pure 1.0
 */
function pure_entry_category() {
    if ( 'post' == get_post_type() ) {
        $categories_list = get_the_category_list();
        if ( $categories_list ) {
            printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
                _x( 'Categories', 'Used before category names.', 'pure' ),
                $categories_list
            );
        }
    }
}
endif;

/**
 * Determine whether blog/site has more than one category.
 *
 * @since Pure 1.0
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function pure_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'pure_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,

            // We only need to know if there is more than one category.
            'number'     => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'pure_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so pure_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so pure_categorized_blog should return false.
        return false;
    }
}

function pure_get_time_ago($ptime) {
    $ptime = strtotime($ptime);
    $etime = time() - $ptime;
    if ($etime < 1) {
        return '刚刚';
    }

    $interval = array(
        12 * 30 * 24 * 60 * 60 => '年前 (' . date('Y-m-d', $ptime) . ')',
        30 * 24 * 60 * 60 => '个月前 (' . date('Y-m-d', $ptime) . ')',
        7 * 24 * 60 * 60 => '周前 (' . date('Y-m-d', $ptime) . ')',
        24 * 60 * 60 => '天前',
        60 * 60 => '小时前',
        60 => '分钟前',
        1 => '秒前',
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    };
}

if ( ! function_exists( 'pure_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'Continue reading' link.
 *
 * @since Twenty Fifteen 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function pure_excerpt_more( $more ) {
    $link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
        esc_url( get_permalink( get_the_ID() ) ),
        /* translators: %s: Name of current post */
        sprintf( __( 'Continue reading %s', 'pure' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
        );
    return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'pure_excerpt_more' );
endif;

function pure_profile_show_on() {
    return get_theme_mod('pure_profile_show_on', 'off') == 'on' ? true : false;
}

function pure_get_profile( $name, $default = null ) {
    return get_theme_mod( "pure_profile_{$name}", $default );
}

function pure_copyright($start = null) {
    $current = date('Y');
    $start = $start ? $start : $current;

    return $start == $current ? $start : sprintf("%s - %s", $start, $current);
}

function pure_icp_number($handler = null) {
    $icp = get_theme_mod('pure_copyright_icp');

    if ($icp && $handler instanceof \Closure) {
        return $handler($icp); 
    }

    return $icp;
}