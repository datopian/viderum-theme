<?php
/**
 * Sidebar snippet for Partners section, rendered on the front page
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 *
 * @package WordPress
 * @subpackage Viderum
 */

$sidebar_id = 'sidebar-partners';
$title      = ( function_exists( 'pll__' ) ? pll__( 'Our Partners' ) : __( 'Our Partners', 'viderum' ) );

if ( is_active_sidebar( $sidebar_id ) ) :

	?>

	<div class="container-fluid">
		<section class="partners">
			<div class="list">
				<?php dynamic_sidebar( $sidebar_id ); ?>
			</div>
		</section>
	</div>

	<?php

endif;
