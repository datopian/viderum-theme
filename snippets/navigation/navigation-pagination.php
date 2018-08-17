<?php
/**
 * Template snippet for pagination navigation
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 *
 * @package WordPress
 * @subpackage Viderum
 */

echo wp_kses_post(
	paginate_links(
		array(
			'mid_size' => 6,
			'type'     => 'list',
		)
	)
);
