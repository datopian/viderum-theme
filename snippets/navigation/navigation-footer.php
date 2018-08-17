<?php
/**
 * Render Footer navigation menu
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 *
 * @package WordPress
 * @subpackage Viderum
 */

wp_nav_menu(
	array(
		'theme_location' => 'footer',
		'menu_id'        => 'footer-menu',
	)
);
