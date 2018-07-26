<?php

/*
 * Meta information template function
 */

function viderum_posted_on() {

    // Get the author name; wrap it in a link.
    $byline = sprintf(
            /* translators: %s: post author */
            __( 'by %s', 'viderum' ), '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
    );

    // Finally, let's write all of this to the page.
    echo '<span class="posted-on">' . viderum_time_link() . '</span><span class="byline"> ' . $byline . '</span>';

}

function viderum_time_link() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf( $time_string, get_the_date( DATE_W3C ), get_the_date(), get_the_modified_date( DATE_W3C ), get_the_modified_date()
    );

    // Wrap the time string in a link, and preface it with 'Posted on'.
    return sprintf(
            /* translators: %s: post date */
            __( '<span class="screen-reader-text">Posted on</span> %s', 'viderum' ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
    );

}

/*
 * Print Edit link
 */

function viderum_edit_link() {
    printf( '<a href="%1$s" class="btn btn-outline-secondary">%2$s</a>', get_edit_post_link(), __( 'Edit', 'viderum' ) );

}

/*
 * Print Read more link
 */

function viderum_read_more_button() {
    printf( '<a href="%1$s" class="btn btn-secondary">%2$s</a>', get_permalink(), __( 'Read more', 'viderum' ) );

}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function viderum_entry_footer() {

    /* translators: used between list items, there is a space after the comma */
    $separate_meta = __( ', ', 'viderum' );

    // Get Categories for posts.
    $categories_list = get_the_category_list( $separate_meta );

    // Get Tags for posts.
    $tags_list = get_the_tag_list( '', $separate_meta );

    // We don't want to output .entry-footer if it will be empty, so make sure its not.
    if ( ( $categories_list || $tags_list ) || get_edit_post_link() ) {

        echo '<footer class="entry-footer">';

        if ( 'post' === get_post_type() ) {
            
        }

        viderum_edit_link();

        echo '</footer> <!-- .entry-footer -->';
    }

}
