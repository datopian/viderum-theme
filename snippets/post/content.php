<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( is_home() || is_archive() || is_search() ) : ?>
        <header class="entry-header">
            <?php

            if ( is_single() ) {
                the_title( '<h1 class="entry-title">', '</h1>' );
            } elseif ( is_front_page() && is_home() ) {
                the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
            } else {
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            }

            ?>
        </header><!-- .entry-header -->
    <?php endif; ?>

    <?php if ( '' !== get_the_post_thumbnail() && !is_single() ) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
        </div><!-- .post-thumbnail -->
    <?php endif; ?>

    <?php

    if ( 'post' == get_post_type() ) {
        echo '<div class="entry-meta">';
        if ( is_single() ) {
            viderum_posted_on();
        } else {
            echo viderum_time_link();
        };
        echo '</div><!-- .entry-meta -->';
    };

    ?>

    <div class="entry-content">
        <?php

        if ( is_home() || is_archive() || is_search() ):
            the_excerpt();

            ?>
            <ul class="list-inline">
                <li class="list-inline-item"><?php viderum_read_more_button(); ?></li>
                <?php if ( current_user_can( 'edit_posts' ) ): ?>
                    <li class="list-inline-item"><?php viderum_edit_link(); ?></li>
                    <?php endif; ?>
            </ul>
            <?php

        else:

            /* translators: %s: Name of current post */
            the_content( sprintf(
                            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'viderum' ), get_the_title()
            ) );

            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'viderum' ),
                'after' => '</div>',
                'link_before' => '<span class="page-number">',
                'link_after' => '</span>',
            ) );
        endif;

        ?>
    </div><!-- .entry-content -->

    <?php

    if ( is_single() ) {
        viderum_entry_footer();
    }

    ?>

</article><!-- #post-## -->
