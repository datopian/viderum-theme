<?php

// Initialize the Viderum theme
function viderum_setup() {

    /*
     * Make theme available for translation.
     */
    load_theme_textdomain( 'viderum' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     */
    add_theme_support( 'post-thumbnails' );

    // Set the default content width.
    $GLOBALS[ 'content_width' ] = 600;

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus( array(
        'main' => __( 'Main Navigation', 'viderum' ),
        'footer' => __( 'Footer Navigation', 'viderum' ),
        'social' => __( 'Social Links Menu', 'viderum' ),
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        // 'comment-form',
        // 'comment-list',
        'gallery',
        'caption',
    ) );

    // Add theme support for Custom Logo.
    add_theme_support( 'custom-logo', array(
        'width' => 250,
        'height' => 250,
        'flex-width' => true,
        'flex-height' => true
    ) );

    // Add theme support for Custom headers.
    add_theme_support( 'custom-header' );

    // Add theme support for Custom background.
    add_theme_support( 'custom-background' );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

}

add_action( 'after_setup_theme', 'viderum_setup' );

// Enqueue scripts and styles for Viderum theme
function viderum_scripts() {

    // Theme stylesheet.
    wp_enqueue_style( 'viderum-style', get_stylesheet_uri(), array(), NULL );

}

add_action( 'wp_enqueue_scripts', 'viderum_scripts' );
