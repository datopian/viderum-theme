<?php

/**
 * Initialize and support Features post type
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 *
 * @package WordPress
 * @subpackage Viderum
 */
/*
 * Register Feature post type
 */

function register_features() {
    $labels = array(
        'name' => _x( 'Features', 'taxonomy general name', 'viderum' ),
        'singular_name' => _x( 'Feature', 'taxonomy singular name', 'viderum' ),
        'search_items' => __( 'Search Feature', 'viderum' ),
        'all_items' => __( 'All Features', 'viderum' ),
        'parent_item' => __( 'Parent Feature', 'viderum' ),
        'parent_item_colon' => __( 'Parent Feature:', 'viderum' ),
        'edit_item' => __( 'Edit Feature', 'viderum' ),
        'update_item' => __( 'Update Feature', 'viderum' ),
        'add_new_item' => __( 'Add New Feature', 'viderum' ),
        'new_item_name' => __( 'New Feature Name', 'viderum' ),
        'menu_name' => __( 'Features', 'viderum' ),
    );

    $args = array(
        'labels' => $labels,
        'show_ui' => true,
        'public' => true,
        'show_tagcloud' => true,
        'query_var' => true,
        'menu_position' => 20,
        'has_archive' => true,
        'menu_icon' => 'dashicons-list-view',
        'rewrite' => array(
            'slug' => 'feature'
        ),
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'revisions' )
    );

    register_post_type( 'feature', $args );

}

add_action( 'init', 'register_features' );

/*
 * Register Feature Category taxonomy
 */

function register_feature_categories() {
    $labels = array(
        'name' => _x( 'Categories', 'taxonomy general name', 'viderum' ),
        'singular_name' => _x( 'Category', 'taxonomy singular name', 'viderum' ),
        'search_items' => __( 'Search Categories', 'viderum' ),
        'all_items' => __( 'All Categories', 'viderum' ),
        'parent_item' => __( 'Parent Category', 'viderum' ),
        'parent_item_colon' => __( 'Parent Category:', 'viderum' ),
        'edit_item' => __( 'Edit Category', 'viderum' ),
        'update_item' => __( 'Update Category', 'viderum' ),
        'add_new_item' => __( 'Add New Category', 'viderum' ),
        'new_item_name' => __( 'New Category Name', 'viderum' ),
        'menu_name' => __( 'Categories', 'viderum' ),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'feature-category',
            'hierarchical' => true
        )
    );

    register_taxonomy( 'feature_category', 'feature', $args );

}

add_action( 'init', 'register_feature_categories' );

/*
 * Register Feature Tag taxonomy
 */

function register_feature_tags() {
    $labels = array(
        'name' => _x( 'Tags', 'taxonomy general name', 'viderum' ),
        'singular_name' => _x( 'Tag', 'taxonomy singular name', 'viderum' ),
        'search_items' => __( 'Search Tags', 'viderum' ),
        'all_items' => __( 'All Tags', 'viderum' ),
        'edit_item' => __( 'Edit Tag', 'viderum' ),
        'update_item' => __( 'Update Tag', 'viderum' ),
        'add_new_item' => __( 'Add New Tag', 'viderum' ),
        'new_item_name' => __( 'New Tag Name', 'viderum' ),
        'menu_name' => __( 'Tags', 'viderum' ),
    );

    $args = array(
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => 'case-study-tag'
        )
    );

    register_taxonomy( 'feature_tag', 'feature', $args );

}

add_action( 'init', 'register_feature_tags' );
