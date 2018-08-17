<?php
/**
 * Features archive page template
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 * @package WordPress
 * @subpackage Viderum
 */

get_header();

if ( have_posts() ) :

	?>
	<div class="container-fluid">
		<div class="row">

			<?php

			while ( have_posts() ) :

				the_post();

				get_template_part( '/snippets/post/content', 'feature' );

			endwhile;

			?>
		</div>
		<div class="row">
			<div class="col-lg-10 offset-lg-2">
				<?php get_template_part( '/snippets/navigation/navigation', 'pagination' ); ?>
			</div>
		</div>
	</div>
	<?php

else :
	get_template_part( 'snippets/post/content', 'none' );
endif;

get_footer();
