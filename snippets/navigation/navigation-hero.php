<?php
/**
 * Render Hero navigation menu
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 *
 * @package WordPress
 * @subpackage Viderum
 */

$location = 'hero';

if ( has_nav_menu( $location ) ) :

	wp_nav_menu(
		array(
			'theme_location' => $location,
			'menu_id'        => $location . '-menu',
			'menu_class'     => 'menu hero-menu nav',
		)
	);

endif;
