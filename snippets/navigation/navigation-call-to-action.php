<?php
/**
 * Render Call to Action navigation menu
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 *
 * @package WordPress
 * @subpackage Viderum
 */

wp_nav_menu(
	array(
		'theme_location'  => 'call_to_action',
		'container_id'    => 'callToActionNavContent',
		'container_class' => 'd-flex',
		'menu_class'      => 'menu call-to-action-menu nav',
	)
);
