<?php
/**
 * Front page template
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 * @package WordPress
 * @subpackage Viderum
 */

get_header();

get_template_part( 'snippets/sidebars/sidebar', 'services' );

get_template_part( 'snippets/sidebars/sidebar', 'partners' );

get_template_part( 'snippets/sidebars/sidebar', 'action-block' );

get_template_part( 'snippets/main/home', 'case-studies' );

get_footer();
