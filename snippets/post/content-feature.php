<?php
/**
 * Feature content block
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 *
 * @package WordPress
 * @subpackage Viderum
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'col-lg-6' ); ?>>
	<div class="row align-items-center">
		<div class="col-lg-4">
			<?php if ( has_post_thumbnail() ) : ?>
				<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><img class="img-thumbnail card-img-top" src="<?php echo esc_attr( the_post_thumbnail_url() ); ?>" alt="<?php the_title(); ?>"></a>
			<?php endif; ?>
		</div>
		<div class="col-lg-8">
			<?php the_title( '<h2 class="card-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			<p class="card-text">
				<?php echo wp_kses_post( get_the_excerpt() ); ?>
			</p><!-- .card-text -->
			<?php viderum_read_more_button( 'btn-outline-primary' ); ?>
		</div><!-- .card-body -->
	</div>
</article><!-- #post-## -->
