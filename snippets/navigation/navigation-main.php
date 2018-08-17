<?php
/**
 * Render Main navigation menu
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 *
 * @package WordPress
 * @subpackage Viderum
 */

wp_nav_menu(
	array(
		'theme_location'  => 'main',
		'container_id'    => 'mainNavContent',
		'container_class' => 'collapse navbar-collapse',
		'menu_class'      => 'menu main-menu nav',
	)
);
