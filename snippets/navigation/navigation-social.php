<?php
/**
 * Render Social navigation menu
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 *
 * @package WordPress
 * @subpackage Viderum
 */

wp_nav_menu(
	array(
		'theme_location' => 'social',
		'menu_id'        => 'social-menu',
		'menu_class'     => 'menu main-menu nav',
	)
);
