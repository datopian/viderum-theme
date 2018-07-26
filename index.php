<?php

get_header();

if ( have_posts() ):

    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <?php

                while ( have_posts() ):

                    the_post();

                    if ( is_page() ):
                        get_template_part( '/snippets/page/content', 'page' );
                    else:
                        get_template_part( '/snippets/post/content' );
                    endif;


                endwhile;

                ?>
            </div>
            <div class="col-md-4 offset-md-1">
                <?php

                if ( is_page() ):
                    get_template_part( '/snippets/sidebars/sidebar', 'page' );
                else:
                    get_template_part( 'sidebar');
                endif;

                ?>
            </div>
        </div>
    </div>
    <?php

endif;

get_footer();
