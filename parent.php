<?php
/**
 * Template Name: Parent Page
 * --------------------------
 * Template for parent pages which have child pages and
 * are required to show snippets of the child pages content
 * within their content.
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 * @package WordPress
 * @subpackage Viderum
 */

/*
 * Template Name: Parent Page
 */

get_header();

if ( have_posts() ) :

	?>
	<div class="container-fluid">
		<div class="col-lg-8 offset-lg-2">
			<?php

			while ( have_posts() ) :

				the_post();

				get_template_part( '/snippets/page/content', 'page' );
				get_template_part( '/snippets/page/content', 'child-page' );

			endwhile;

			?>
		</div>
	</div>
	<?php

endif;

get_footer();
