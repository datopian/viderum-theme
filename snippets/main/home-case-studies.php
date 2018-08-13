<?php

$args = array(
    'post_type' => 'case-study',
    'posts_per_page' => 3
);

$case_studies = new WP_Query( $args );

if ( $case_studies->have_posts() ):

    ?>
    <div class="container-fluid">
        <section class="col-lg-8 offset-lg-2 case-studies">
            <?php get_template_part( '/snippets/sidebars/sidebar', 'case-studies' ); ?>
            <div class="row">
                <?php

                while ( $case_studies->have_posts() ):

                    $case_studies->the_post();

                    get_template_part( '/snippets/post/content', 'card' );

                endwhile;

                get_template_part( '/snippets/navigation/navigation', 'pagination' );

                ?>
            </div>
        </section>
    </div>
    <?php

endif;