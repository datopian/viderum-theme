<?php
/**
 * Card type content
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 *
 * @package WordPress
 * @subpackage Viderum
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'col-lg-4' ); ?>>
	<div class="card">
		<?php if ( has_post_thumbnail() ) : ?>
			<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><img class="card-img-top" src="<?php echo esc_attr( the_post_thumbnail_url() ); ?>" alt="<?php the_title(); ?>"></a>
		<?php endif; ?>
		<div class="card-body">
			<?php the_title( '<h2 class="card-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
			<p class="card-text">
				<?php echo wp_kses_post( get_the_excerpt() ); ?>
			</p><!-- .card-text -->
			<?php viderum_read_more_button( 'btn-outline-primary' ); ?>
		</div><!-- .card-body -->
	</div><!-- .card -->
</article><!-- #post-## -->
