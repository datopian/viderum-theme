<?php
/**
 * Case studies archive page template
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 * @package WordPress
 * @subpackage Viderum
 */

get_header();

if ( have_posts() ) :

	?>
	<div class="container-fluid">
		<div class="col-lg-8 offset-lg-2">
			<div class="row">
				<?php

				while ( have_posts() ) :

					the_post();

					get_template_part( '/snippets/post/content', 'card' );

				endwhile;

				?>
			</div>
			<?php get_template_part( '/snippets/navigation/navigation', 'pagination' ); ?>
		</div>
	</div>
	<?php

else :
	get_template_part( 'snippets/post/content', 'none' );
endif;

get_footer();
