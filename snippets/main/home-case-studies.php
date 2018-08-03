<?php

$args = array(
    'post_type' => 'case-study',
    'posts_per_page' => 6
);

$case_studies = new WP_Query( $args );

if ( $case_studies->have_posts() ):

    ?>
    <div class="container-fluid">
        <section class="col-lg-8 offset-lg-2 case-studies">
            <h2 class="title"><?php echo esc_html( get_post_type_object( $args[ 'post_type' ] )->labels->name ); ?></h2>
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