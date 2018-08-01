<?php

/*
 * The Viderum theme reuses parts of TwentySeventeen - the official WordPress theme
 * 
 * TwentySeventeen is licensed under GPLv2 or later.
 */

/*
 * Initialize Departments user taxonomy
 */

get_template_part( '/inc/departments' );
get_template_part( '/inc/case-studies' );
get_template_part( '/inc/template-tags' );

/*
 * Initialize Service widget
 */
get_template_part( '/snippets/widgets/class', 'service' );

// Initialize the Viderum theme
function viderum_setup() {

    /*
     * Make theme available for translation.
     */
    load_theme_textdomain( 'viderum' );

    // Load theme settings class
    get_template_part( '/inc/class-viderum-theme-settings' );

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
        'call_to_action' => __( 'Call to Action Navigation', 'viderum' ),
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

    // Replace jQuery version from WP Core
    $jquery_path = '/assets/js/jquery.min.js';
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_bloginfo( 'template_url' ) . $jquery_path, array(), NULL, true );

    // Theme stylesheet
    wp_enqueue_style( 'viderum-style', get_stylesheet_uri(), array(), NULL );

    // jQuery
    wp_enqueue_script( 'jquery' );

    // Bootstrap JS
    wp_enqueue_script( 'bootstrap-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), NULL, true );

    // Popper
    wp_enqueue_script( 'popper-js', get_stylesheet_directory_uri() . '/assets/js/popper.min.js', array( 'bootstrap-js' ), NULL, true );

}

add_action( 'wp_enqueue_scripts', 'viderum_scripts' );

/*
 * Wrapper function for theme settings
 */

function get_theme_settings() {
    return get_option( 'viderum_settings' );

}

/* Set custom meta tag for Google Search Console */

function google_search_console_tags() {
    $theme_settings = get_theme_settings();

    if ( $theme_settings[ 'gsc_verification_id' ] ) :
        printf( '<meta name="google-site-verification" content="%s" />', esc_attr( $theme_settings[ 'gsc_verification_id' ] ) );
    endif;

}

add_action( 'wp_head', 'google_search_console_tags' );

/* Override default WordPress logo on wp-login.php */

function viderum_theme_login_logo() {

    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $image = wp_get_attachment_image_src( $custom_logo_id, 'full' );

    ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo esc_url( $image[ 0 ] ); ?>);
            width: 225px;
            background-size: 225px auto;
            background-repeat: no-repeat;
        }
    </style>
    <?php

}

add_action( 'login_enqueue_scripts', 'viderum_theme_login_logo' );

/*
 * Initialize widget sections and custom widgets
 */

function viderum_widgets_init() {
    register_sidebar(
            array(
                'name' => __( 'Page Sidebar', 'viderum' ),
                'description' => __( 'Reserved for widgets shown on all pages.', 'viderum' ),
                'id' => 'sidebar-page',
                'before_widget' => '<div class="widget widget-page">',
                'after_widget' => '</div>',
            )
    );

    register_sidebar(
            array(
                'name' => __( 'Post Sidebar', 'viderum' ),
                'description' => __( 'Reserved for widgets shown on all posts.', 'viderum' ),
                'id' => 'sidebar-post',
                'before_widget' => '<div class="widget widget-post">',
                'after_widget' => '</div>',
            )
    );

    register_sidebar(
            array(
                'name' => __( 'Footer Sidebar', 'viderum' ),
                'description' => __( 'Reserved for widgets shown in the footer section of the theme.', 'viderum' ),
                'id' => 'sidebar-footer',
                'before_widget' => '<div class="widget widget-footer">',
                'after_widget' => '</div>',
            )
    );

    register_sidebar(
            array(
                'name' => __( 'Services Sidebar', 'viderum' ),
                'description' => __( 'Reserved for Service widgets and shown only on the front page.', 'viderum' ),
                'id' => 'sidebar-services',
                'before_widget' => '<div class="col-md-6 col-xl-4 widget widget-service">',
                'after_widget' => '</div>',
            )
    );

    register_sidebar(
            array(
                'name' => __( 'Partners Sidebar', 'viderum' ),
                'description' => __( 'Reserved for image widgets and shown only on the front page.', 'viderum' ),
                'id' => 'sidebar-partners',
                'before_widget' => '<div class="widget widget-partner">',
                'after_widget' => '</div>',
            )
    );


    // Initialize Service widget
    if ( class_exists( 'Service' ) ) :
        register_widget( 'Service' );
    endif;

}

add_action( 'widgets_init', 'viderum_widgets_init' );