<?php
/**
 * Case Study post type
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 *
 * @package WordPress
 * @subpackage Viderum
 */

/**
 * Register Case Study post type
 *
 * @return void
 */
function register_case_studies() {
	$labels = array(
		'name'              => _x( 'Case Studies', 'taxonomy general name', 'viderum' ),
		'singular_name'     => _x( 'Case Study', 'taxonomy singular name', 'viderum' ),
		'search_items'      => __( 'Search Case Studies', 'viderum' ),
		'all_items'         => __( 'All Case Studies', 'viderum' ),
		'parent_item'       => __( 'Parent Case Study', 'viderum' ),
		'parent_item_colon' => __( 'Parent Case Study:', 'viderum' ),
		'edit_item'         => __( 'Edit Case Study', 'viderum' ),
		'update_item'       => __( 'Update Case Study', 'viderum' ),
		'add_new_item'      => __( 'Add New Case Study', 'viderum' ),
		'new_item_name'     => __( 'New Case Study Name', 'viderum' ),
		'menu_name'         => __( 'Case Studies', 'viderum' ),
	);

	$args = array(
		'labels'        => $labels,
		'show_ui'       => true,
		'public'        => true,
		'show_tagcloud' => true,
		'query_var'     => true,
		'menu_position' => 20,
		'has_archive'   => true,
		'menu_icon'     => 'dashicons-book',
		'rewrite'       => array(
			'slug' => 'case-study',
		),
		'supports'      => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'revisions' ),
	);

	register_post_type( 'case-study', $args );

}

add_action( 'init', 'register_case_studies' );

/**
 * Register Case Study Category taxonomy
 *
 * @return void
 */
function register_case_study_categories() {
	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name', 'viderum' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'viderum' ),
		'search_items'      => __( 'Search Categories', 'viderum' ),
		'all_items'         => __( 'All Categories', 'viderum' ),
		'parent_item'       => __( 'Parent Category', 'viderum' ),
		'parent_item_colon' => __( 'Parent Category:', 'viderum' ),
		'edit_item'         => __( 'Edit Category', 'viderum' ),
		'update_item'       => __( 'Update Category', 'viderum' ),
		'add_new_item'      => __( 'Add New Category', 'viderum' ),
		'new_item_name'     => __( 'New Category Name', 'viderum' ),
		'menu_name'         => __( 'Categories', 'viderum' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug'         => 'case-study-category',
			'hierarchical' => true,
		),
	);

	register_taxonomy( 'case_study_category', 'case-study', $args );

}

add_action( 'init', 'register_case_study_categories' );

/**
 * Register Case Study Tag taxonomy
 *
 * @return void
 */
function register_case_study_tags() {
	$labels = array(
		'name'          => _x( 'Tags', 'taxonomy general name', 'viderum' ),
		'singular_name' => _x( 'Tag', 'taxonomy singular name', 'viderum' ),
		'search_items'  => __( 'Search Tags', 'viderum' ),
		'all_items'     => __( 'All Tags', 'viderum' ),
		'edit_item'     => __( 'Edit Tag', 'viderum' ),
		'update_item'   => __( 'Update Tag', 'viderum' ),
		'add_new_item'  => __( 'Add New Tag', 'viderum' ),
		'new_item_name' => __( 'New Tag Name', 'viderum' ),
		'menu_name'     => __( 'Tags', 'viderum' ),
	);

	$args = array(
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'query_var'         => true,
		'rewrite'           => array(
			'slug' => 'case-study-tag',
		),
	);

	register_taxonomy( 'case_study_tag', 'case-study', $args );

}

add_action( 'init', 'register_case_study_tags' );
