<?php

/*
 * Don't render anything if the template does not match
 */
if ( !is_page_template( 'parent.php' ) ) :
    return;
endif;

$child_pages = new WP_Query(
        array(
    'post_parent' => get_the_ID(),
    'post_type' => 'page',
    'order' => 'ASC',
    'orderby' => 'menu_order',
        )
);


if ( $child_pages->have_posts() ) :
    while ( $child_pages->have_posts() ) :
        $child_pages->the_post();

        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'hentry-child' ); ?>>
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="post-thumbnail">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail(); ?>
                    </a>
                </div><!-- .post-thumbnail -->
            <?php endif; ?>
            <div class="entry-wrap">
                <header class="entry-header">
                    <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
                </header><!-- .entry-header -->
                <div class="entry-content">
                    <?php the_excerpt(); ?>
                </div><!-- .entry-content -->
            </div><!-- .entry-wrap -->
        </article><!-- #post-## -->

        <?php

    endwhile;
endif;

// Reset query data to go back to the default WordPress loop
wp_reset_postdata();
