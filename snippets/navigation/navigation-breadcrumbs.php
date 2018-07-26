<?php

/**
 * Template snippet for breadcrumb navigation
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 *
 * @package WordPress
 * @subpackage Viderum
 */
/*
 * Based on an example provided on The Web Taylor
 * https://www.thewebtaylor.com/articles/wordpress-creating-breadcrumbs-without-a-plugin
 * Settings
 */
$breadcrums_id = 'breadcrumb';
$breadcrums_class = $breadcrums_id;
$home_title = __( 'Home', 'viderum' );

// If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
$custom_taxonomy = '';

// Get the query & post information
global $post, $wp_query;

if ( !function_exists( 'breadcrumb_item' ) ) :

    function breadcrumb_item($url, $title = '', $wrapper = 'a') {
        printf( '<li class="breadcrumb-item"><%3$s %1$s>%2$s</%3$s></li>', ( esc_url( $url ) ? 'href="' . esc_url( $url ) . '"' : '' ), wp_kses_post( $title ), esc_attr( $wrapper ) );

    }

endif;

if ( !function_exists( 'is_paginated_url' ) ) {

    function is_paginated_url() {

        if ( get_query_var( 'paged' ) > 1 ) :
            $url = get_term_link( get_queried_object()->term_id, get_queried_object()->taxonomy );
        else :
            $url = false;
        endif;

        return $url;

    }

}

// Do not display on the homepage
if ( !is_front_page() ) {

    // Set default variables for date archive pages
    if ( is_date() ) :
        $day_display = get_the_time( 'j' );
        $month_numeric = get_the_time( 'm' );
        $month_display = get_the_time( 'F' );
        $year_display = get_the_time( 'Y' );
    endif;

    ?>

    <?php

    // Build the breadcrums
    echo '<nav class="wrap-breadcrumbs"><div class="container"><ol id="' . esc_attr( $breadcrums_id ) . '" class="' . esc_attr( $breadcrums_class ) . '">';

    // Home page
    breadcrumb_item( get_home_url(), __( 'Home', 'viderum' ) );

    if ( is_home() ) {

        if ( get_query_var( 'paged' ) > 1 ) :
            breadcrumb_item( get_page_link( get_queried_object()->ID ), get_queried_object()->post_title );
        else :
            if ( get_queried_object() ) :
                breadcrumb_item( false, get_queried_object()->post_title, 'span' );
            endif;
        endif;
    } elseif ( is_post_type_archive() ) {
        breadcrumb_item( false, post_type_archive_title( false ), 'span' );
    } elseif ( is_archive() && is_tax() && !is_category() && !is_tag() ) {

        // If post is a custom post type
        $post_type = get_post_type();

        // If it is a custom post type display name and link
        if ( 'post' !== $post_type ) {

            breadcrumb_item( get_post_type_archive_link( $post_type ), get_post_type_object( $post_type )->labels->name );
        }

        breadcrumb_item( false, get_queried_object()->name, 'span' );
    } elseif ( is_single() ) {

        // If post is a custom post type
        $post_type = get_post_type();

        // If it is a custom post type display name and link
        if ( 'post' !== $post_type ) {
            breadcrumb_item( get_post_type_archive_link( $post_type ), get_post_type_object( $post_type )->labels->name, 'span' );
        } else {
            // tuka e problemot
            if ( get_option( 'page_for_posts' ) ) :
                breadcrumb_item( get_post_type_archive_link( $post_type ), get_the_title( get_option( 'page_for_posts' ) ) );
            endif;
        }

        // Get post category info
        $category = get_the_category();

        if ( !empty( $category ) ) {

            $cat_array = array_values( $category );

            // Get last category post is in
            $last_category = end( $cat_array );

            // Get parent any categories and create array
            $get_cat_parents = rtrim( get_category_parents( $last_category->term_id, true, ',' ), ',' );
            $cat_parents = explode( ',', $get_cat_parents );

            // Loop through parent categories and store in variable $cat_display
            $cat_display = '';
            foreach ( $cat_parents as $parents ) {
                $cat_display .= '<li class="item-cat breadcrumb-item">' . $parents . '</li>';
            }
        }
        // If it's a custom post type within a custom taxonomy
        $taxonomy_exists = taxonomy_exists( $custom_taxonomy );
        if ( empty( $last_category ) && !empty( $custom_taxonomy ) && $taxonomy_exists ) {

            $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
            $cat_id = $taxonomy_terms[ 0 ]->term_id;
            $cat_nicename = $taxonomy_terms[ 0 ]->slug;
            $cat_link = get_term_link( $taxonomy_terms[ 0 ]->term_id, $custom_taxonomy );
            $cat_name = $taxonomy_terms[ 0 ]->name;
        }

        // Check if the post is in a category
        if ( !empty( $last_category ) && !is_singular() ) {
            echo wp_kses_post( $cat_display );

            breadcrumb_item( false, get_the_title(), 'span' );

            // Else if post is in a custom taxonomy
        } elseif ( !empty( $cat_id ) ) {

            breadcrumb_item( $cat_link, $cat_name );
            breadcrumb_item( false, get_the_title(), 'span' );
        } else {
            breadcrumb_item( false, get_the_title(), 'span' );
        }
    } elseif ( is_category() ) {

        // Category page
        breadcrumb_item( is_paginated_url(), single_cat_title( '', false ), ( is_paginated_url() ? 'a' : 'span' ) );
    } elseif ( is_page() ) {

        // Standard page
        if ( $post->post_parent ) {

            // If child page, get parents
            $anc = array_reverse( get_post_ancestors( $post->ID ) );

            // Parent page loop
            if ( !isset( $parents ) ) {
                $parents = null;
            }
            foreach ( $anc as $ancestor ) {
                breadcrumb_item( get_permalink( $ancestor ), get_the_title( $ancestor ) );
            }

            // Current page
            breadcrumb_item( false, get_the_title(), 'span' );
        } else {

            // Just display current page if not parents
            breadcrumb_item( false, get_the_title(), 'span' );
        }
    } elseif ( is_tag() ) {

        // Tag page
        // Display the tag name
        breadcrumb_item( is_paginated_url(), get_queried_object()->name, ( is_paginated_url() ? 'a' : 'span' ) );
    } elseif ( is_day() ) {

        // Day archive
        // Year link
        breadcrumb_item( get_year_link( $year_display ), $year_display );

        // Month link
        breadcrumb_item( get_month_link( $year_display, $month_numeric ), $month_display );

        // Day display
        breadcrumb_item( false, $day_display, 'span' );
    } elseif ( is_month() ) {

        // Month Archive
        // Year link
        breadcrumb_item( get_year_link( $year_display ), $year_display );
        // Month display
        breadcrumb_item( false, $month_display, 'span' );
    } elseif ( is_year() ) {

        // Display year archive
        breadcrumb_item( false, $year_display, 'span' );
    } elseif ( is_author() ) {

        // Display author name
        breadcrumb_item( false, __( 'Author' ), 'span' );

        if ( get_the_author_posts_link() ) :
            printf( '<li class="breadcrumb-item">%s</li>', wp_kses_post( get_the_author_posts_link() ) );
        else :
            breadcrumb_item( get_author_posts_url( get_queried_object_id() ), get_the_author_meta( 'display_name', get_queried_object_id() ), 'a' );
        endif;
    } elseif ( is_search() ) {

        // Search results page
        breadcrumb_item( false, __( 'Search results for: ', 'viderum' ) . get_search_query(), 'span' );
    } elseif ( is_404() ) {

        // 404 page
        echo '<li class="breadcrumb-item">' . esc_html__( 'Error 404', 'viderum' ) . '</li>';
    }// End if().

    if ( get_query_var( 'paged' ) ) {

        // Paginated archives
        breadcrumb_item( false, __( 'Page ', 'viderum' ) . get_query_var( 'paged' ), 'span' );
    }

    echo '</ol></div></nav>';
}// End if().
