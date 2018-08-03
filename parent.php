<?php

/*
 * Template Name: Parent Page
 */

get_header();

if ( have_posts() ):

    ?>
    <div class="container-fluid">
        <div class="col-lg-8 offset-lg-2">
            <?php

            while ( have_posts() ):

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
