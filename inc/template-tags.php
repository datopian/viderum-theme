<?php
/**
 * Viderum theme template functions
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 *
 * @package WordPress
 * @subpackage Viderum
 */

/**
 * Meta information template function
 *
 * @return void
 */
function viderum_posted_on() {

	// Get the author name; wrap it in a link.
	$byline = sprintf(
		/* translators: %s: post author */
			__( 'by %s', 'viderum' ), '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
	);

	// Finally, let's write all of this to the page.
	echo '<span class="posted-on">' . wp_kses_post( viderum_time_link() ) . '</span><span class="byline"> ' . wp_kses_post( $byline ) . '</span>';

}

/**
 * Get post publish time
 *
 * @return string
 */
function viderum_time_link() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf(
		$time_string, get_the_date( DATE_W3C ), get_the_date(), get_the_modified_date( DATE_W3C ), get_the_modified_date()
	);

	// Wrap the time string in a link, and preface it with 'Posted on'.
	return sprintf(
		/* translators: %s: post date */
			__( '<span class="screen-reader-text">Posted on</span> %s', 'viderum' ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

}

/**
 * Print Edit link
 *
 * @return void
 */
function viderum_edit_link() {
	printf( '<a href="%1$s" class="btn btn-outline-secondary">%2$s</a>', esc_url( get_edit_post_link() ), esc_html__( 'Edit', 'viderum' ) );

}

/**
 * Print Read more link
 *
 * @param string $btn_type Bootstrap 4 CSS class name, such as: btn-secondary.
 * @param string $text Text for the anchor title.
 * @return void
 */
function viderum_read_more_button( $btn_type = 'btn-secondary', $text = '' ) {
	if ( ! $text ) :
		$text = ( function_exists( 'pll__' ) ? pll__( 'Read more' ) : __( 'Read more', 'viderum' ) );
	endif;
	printf( '<a href="%1$s" class="btn %3$s" rel="bookmark">%2$s</a>', esc_url( get_permalink() ), esc_html( $text ), esc_html( $btn_type ) );

}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 *
 * @return void
 */
function viderum_entry_footer() {

	/* translators: used between list items, there is a space after the comma */
	$separate_meta = __( ', ', 'viderum' );

	// Get Categories for posts.
	$categories_list = get_the_category_list( $separate_meta );

	// Get Tags for posts.
	$tags_list = get_the_tag_list( '', $separate_meta );

	// We don't want to output .entry-footer if it will be empty, so make sure its not.
	if ( ( $categories_list || $tags_list ) || get_edit_post_link() ) {

		echo '<footer class="entry-footer">';

		viderum_edit_link();

		echo '</footer> <!-- .entry-footer -->';
	}

}

/**
 * Print or return author avatar
 *
 * @param boolean $author ID of the post author.
 * @param integer $size Size of the author thumbnail.
 * @param boolean $display Render or return the markup.
 */
function viderum_author_avatar( $author = false, $size = 112, $display = true ) {

	$print = '';

	$custom_avatar_url  = wp_get_attachment_image_url( get_the_author_meta( 'user_meta_image', $author ) );
	$default_avatar_url = get_avatar_url( '', array( 'size' => $size ) );
	$custom_avatar      = sprintf( '<img alt="Author avatar" src="%1$s" class="avatar avatar-96 photo avatar-default" height="%2$s" width="%2$s">', $custom_avatar_url, $size );

	if ( $custom_avatar_url ) :
		$avatar = $custom_avatar;
	elseif ( $custom_avatar_url === $default_avatar_url ) :
		$avatar = $custom_avatar;
	else :
		$avatar = get_avatar( $author, $size );
	endif;

	$print .= sprintf( '<a title="%1$s" class="avatar-url url fn n" href="%2$s">%3$s</a>', get_the_author_meta( 'display_name', $author ), esc_url( get_author_posts_url( $author ) ), $avatar );

	if ( true === $display ) :
		echo wp_kses_post( $print );
	else :
		return wp_kses_post( $print );
	endif;

}

/**
 * Undocumented function
 *
 * @param string $post_type Post type id.
 * @return void
 */
function viderum_content_type_navigation( $post_type = 'case-study' ) {

	$active = 'active';
	$posts  = get_posts(
		array(
			'post_type' => $post_type,
			'nopaging'  => 1,
			'order'     => 'ASC',
			'orderby'   => 'title',
		)
	);

	if ( $posts ) :

		?>
		<div class="widget widget-post-type-nav">
			<h2 class="widgettitle"><?php echo esc_html( get_post_type_object( $post_type )->labels->name ); ?></h2>
			<div class="list-group">
				<?php

				foreach ( $posts as $post ) :
					printf( '<a href="%1$s" class="list-group-item list-group-item-action %3$s">%2$s</a>', get_permalink( $post->ID ), get_the_title( $post->ID ), ( get_the_ID() === $post->ID ? esc_html( $active ) : '' ) );
				endforeach;

				?>
			</div>
		</div>
		<?php

	endif;

}

/**
 * Render images in widgets
 *
 * @param [type]  $attachment_id Unique ID of the image attachment.
 * @param boolean $display Render or return the image markup.
 * @param string  $print The HTML markup for printing or returning.
 */
function viderum_custom_image_placeholder( $attachment_id, $display = true, $print = '' ) {

	if ( $attachment_id ) :

		$btn_label_add    = __( 'Replace Image', 'viderum' );
		$btn_label_remove = __( 'Remove Image', 'viderum' );
		$custom_image_url = esc_url( wp_get_attachment_image_url( $attachment_id ) );
	else :
		$btn_label_add    = __( 'Upload Image', 'viderum' );
		$custom_image_url = get_avatar_url( '' );
	endif;

	if ( $display ) :
		$print .= sprintf( '<div><a data-media-widget-title="%1$s" href="#" class="custom-image"><img class="current-custom-image" src="%2$s" width="96"></a></div>', $btn_label_add, $custom_image_url );
		$print .= sprintf( '<button data-media-widget-title="%1$s" type="button" class="button custom-image">%1$s</button>&nbsp;', $btn_label_add );
		echo wp_kses_post( $print );
	else :
		return esc_url( $custom_image_url );
	endif;

}
