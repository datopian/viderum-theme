<?php

get_header();

if ( have_posts() ):

    ?>
    <div class="container-fluid">
        <div class="col-lg-8 offset-lg-2">
            <div class="row">
                <div class="col-lg-7">
                    <?php

                    while ( have_posts() ):

                        the_post();

                        if ( is_page() ):
                            get_template_part( 'snippets/page/content', 'page' );
                        else:
                            get_template_part( 'snippets/post/content' );
                        endif;

                    endwhile;

                    get_template_part( 'snippets/navigation/navigation', 'pagination' );

                    ?>
                </div>
                <div class="col-lg-4 offset-lg-1 sidebar">
                    <?php

                    if ( is_page() ):
                        get_template_part( 'snippets/sidebars/sidebar', 'page' );
                    elseif ( is_singular( get_post_type() ) || is_post_type_archive( get_post_type() ) ):
                        get_template_part( 'snippets/sidebars/sidebar', get_post_type() );
                    else:
                        get_template_part( 'sidebar' );
                    endif;

                    ?>
                </div>
            </div>    
        </div>
    </div>
    <?php

else:
    get_template_part( 'snippets/post/content', 'none' );
endif;

get_footer();
