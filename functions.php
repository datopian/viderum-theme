<?php
/**
 * Viderum theme customizations
 * The Viderum theme reuses parts of TwentySeventeen - the official WordPress theme.
 * TwentySeventeen is licensed under GPLv2 or later.
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 * @package WordPress
 * @subpackage Viderum
 */

/**
 * Initialize taxonomies
 */
get_template_part( '/inc/departments' );
get_template_part( '/inc/case-studies' );
get_template_part( '/inc/features' );

/**
 * Include template functions
 */
get_template_part( '/inc/template-tags' );

/*
 * Initialize widgets
 */
get_template_part( '/snippets/widgets/class', 'service' );
get_template_part( '/snippets/widgets/class', 'action-block' );

/**
 * Initialize the Viderum theme
 *
 * @return void
 */
function viderum_setup() {
	/*
	 * Define constants
	 */
	define( 'DEFAULT_HEADER_IMAGE', get_stylesheet_directory_uri() . '/assets/img/viderum-hero.jpg' );

	/*
	 *  Remove WordPress version meta tag
	 */
	add_filter( 'the_generator', '__return_false' );

	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'viderum' );

	// Register Polylang strings.
	get_template_part( '/inc/strings' );

	// Load theme settings class.
	get_template_part( '/inc/class-viderum-theme-settings' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Add excerpt support to pages
	 */
	add_post_type_support( 'page', 'excerpt' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );

	// Set the default content width.
	$GLOBALS['content_width'] = 600;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'main'           => __( 'Main Navigation', 'viderum' ),
			'call_to_action' => __( 'Call to Action Navigation', 'viderum' ),
			'footer'         => __( 'Footer Navigation', 'viderum' ),
			'social'         => __( 'Social Links Menu', 'viderum' ),
			'hero'           => __( 'Hero Menu', 'viderum' ),
		)
	);

	register_default_headers(
		array(
			'viderum' => array(
				'url'           => DEFAULT_HEADER_IMAGE,
				'thumbnail_url' => DEFAULT_HEADER_IMAGE,
				'description'   => __( 'The default hero image of Viderum', 'viderum' ),
			),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5', array(
			// 'comment-form',
			// 'comment-list',
			'gallery',
			'caption',
		)
	);

	// Add theme support for Custom Logo.
	add_theme_support(
		'custom-logo', array(
			'width'       => 250,
			'height'      => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Add theme support for Custom headers.
	add_theme_support( 'custom-header' );

	// Add theme support for Custom background.
	add_theme_support( 'custom-background' );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

}

add_action( 'after_setup_theme', 'viderum_setup' );

/**
 * Enqueue scripts and styles for Viderum theme
 *
 * @return void
 */
function viderum_scripts() {

	// Replace jQuery version from WP Core.
	$jquery_path = '/assets/js/jquery.min.js';
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_bloginfo( 'template_url' ) . $jquery_path, array(), null, true );

	// Theme stylesheet.
	wp_enqueue_style( 'viderum-style', get_stylesheet_uri(), array(), null );

	// jQuery.
	wp_enqueue_script( 'jquery' );

	// Bootstrap JS.
	wp_enqueue_script( 'bootstrap-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), null, true );

	// Popper.
	wp_enqueue_script( 'popper-js', get_stylesheet_directory_uri() . '/assets/js/popper.min.js', array( 'bootstrap-js' ), null, true );

	// Cookie Control.
	wp_enqueue_script( 'cookie-control', 'https://cc.cdn.civiccomputing.com/8/cookieControl-8.0.min.js', array(), null, true );

}

add_action( 'wp_enqueue_scripts', 'viderum_scripts' );

/**
 * Wrapper function for theme settings
 *
 * @return array
 */
function get_theme_settings() {
	return get_option( 'viderum_settings' );
}

/**
 * Set custom meta tag for Google Search Console
 *
 * @return void
 */
function google_search_console_tags() {
	$theme_settings = get_theme_settings();

	if ( $theme_settings['gsc_verification_id'] ) :
		printf( '<meta name="google-site-verification" content="%s" />', esc_attr( $theme_settings['gsc_verification_id'] ) );
	endif;

}

add_action( 'wp_head', 'google_search_console_tags' );

/**
 * Override default WordPress logo on wp-login.php
 *
 * @return void
 */
function viderum_theme_login_logo() {

	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image          = wp_get_attachment_image_src( $custom_logo_id, 'full' );

	?>
	<style type="text/css">
		#login h1 a, .login h1 a {
			background-image: url(<?php echo esc_url( $image[0] ); ?>);
			width: 225px;
			background-size: 225px auto;
			background-repeat: no-repeat;
		}
	</style>
	<?php

}

add_action( 'login_enqueue_scripts', 'viderum_theme_login_logo' );

/**
 * Initialize widget sections and custom widgets
 */
function viderum_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Page Sidebar', 'viderum' ),
			'description'   => __( 'Reserved for widgets shown on all pages.', 'viderum' ),
			'id'            => 'sidebar-page',
			'before_widget' => '<div class="widget widget-page %2$s">',
			'after_widget'  => '</div>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Post Sidebar', 'viderum' ),
			'description'   => __( 'Reserved for widgets shown on all posts.', 'viderum' ),
			'id'            => 'sidebar-post',
			'before_widget' => '<div class="widget widget-post %2$s">',
			'after_widget'  => '</div>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Case Studies Sidebar', 'viderum' ),
			'description'   => __( 'Reserved for widgets shown before the Case Studies list on the front page.', 'viderum' ),
			'id'            => 'sidebar-case-studies',
			'before_widget' => '<div class="widget widget-case-study %2$s">',
			'after_widget'  => '</div>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Case Study Sidebar', 'viderum' ),
			'description'   => __( 'Reserved for widgets shown on all case studies.', 'viderum' ),
			'id'            => 'sidebar-case-study',
			'before_widget' => '<div class="widget widget-case-study %2$s">',
			'after_widget'  => '</div>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Action Block Sidebar', 'viderum' ),
			'description'   => __( 'Reserved for an Action Block widget shown on all static pages and the home page.', 'viderum' ),
			'id'            => 'sidebar-action-block',
			'before_widget' => '<div class="widget widget-action-block %2$s">',
			'after_widget'  => '</div>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Sidebar', 'viderum' ),
			'description'   => __( 'Reserved for widgets shown in the footer section of the theme.', 'viderum' ),
			'id'            => 'sidebar-footer',
			'before_widget' => '<div class="widget widget-footer %2$s">',
			'after_widget'  => '</div>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Services Sidebar', 'viderum' ),
			'description'   => __( 'Reserved for Service widgets and shown only on the front page.', 'viderum' ),
			'id'            => 'sidebar-services',
			'before_widget' => '<div class="col-md-6 col-xl-4 widget widget-service %2$s">',
			'after_widget'  => '</div>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Partners Sidebar', 'viderum' ),
			'description'   => __( 'Reserved for image widgets and shown only on the front page.', 'viderum' ),
			'id'            => 'sidebar-partners',
			'before_widget' => '<div class="widget widget-partner %2$s">',
			'after_widget'  => '</div>',
		)
	);

	// Initialize Service widget.
	if ( class_exists( 'Service' ) ) :
		register_widget( 'Service' );
	endif;

	if ( class_exists( 'Action_Block' ) ) :
		register_widget( 'Action_Block' );
	endif;

}

add_action( 'widgets_init', 'viderum_widgets_init' );

/**
 * Integrate Contact Form 7 with SalesForce
 *
 * @param [type] $contact_form Contact Form 7 form.
 * @return void
 */
function salesforce_cf7_integration( $contact_form ) {
	$url = 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';

	if ( ! isset( $contact_form->posted_data ) && class_exists( 'WPCF7_Submission' ) ) {
		$submission = WPCF7_Submission::get_instance();
		if ( $submission ) {
			$form_data = $submission->get_posted_data();

			if ( ! empty( $form_data['email'] ) ) {
				$response = wp_remote_post(
					$url, array(
						'method'  => 'POST',
						'timeout' => 15,
						'headers' => array(
							'content-type' => 'application/x-www-form-urlencoded',
						),
						'body'    => array(
							'oid'             => $form_data['oid'],
							'lead_source'     => $form_data['lead_source'],
							'first_name'      => $form_data['first_name'],
							'last_name'       => $form_data['last_name'],
							'email'           => $form_data['email'],
							'company'         => $form_data['company'],
							'URL'             => $form_data['URL'],
							'00N1I00000L0VOe' => ( isset( $form_data['00N1I00000L0VOe'] ) ? $form_data['00N1I00000L0VOe'] : 0 ),
							'00N1I00000L0VOj' => ( isset( $form_data['00N1I00000L0VOj'] ) ? $form_data['00N1I00000L0VOj'] : 0 ),
							'00N1I00000L0VOo' => ( isset( $form_data['00N1I00000L0VOo'] ) ? $form_data['00N1I00000L0VOo'] : 0 ),
							'00N1I00000L0VOt' => ( isset( $form_data['00N1I00000L0VOt'] ) ? $form_data['00N1I00000L0VOt'] : 0 ),
							'00N1I00000L0VOy' => ( isset( $form_data['00N1I00000L0VOy'] ) ? $form_data['00N1I00000L0VOy'] : 0 ),
						),
					)
				);
				if ( is_wp_error( $response ) ) {
					new WP_Error( 'sf_error', __( 'Sorry, SalesForce data was not sent because of the following error:', 'viderum' ) . ' ' . $response->get_error_message() );
				}
			}
		} else {
			// We can't retrieve the form data.
			return $contact_form;
		}
	}
}
add_action( 'wpcf7_before_send_mail', 'salesforce_cf7_integration', 1 );

