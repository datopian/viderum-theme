<?php

$theme_settings = get_theme_settings();
$container_class = 'container-fluid';
$grid_class = 'offset-md-1 col-md-5';

if ( !is_front_page() ):
    $container_class = 'container';
    $grid_class = 'col-md-8';
endif;

?>
<div class="custom-header">

    <div class="custom-header-media">
        <div class="<?php echo esc_attr( $container_class ); ?>">
            <div class="row">
                <header class="<?php echo esc_attr( $grid_class ); ?> page-header">
                    <?php if ( is_front_page() ): ?>
                        <?php if ( isset( $theme_settings[ 'hero_title' ] ) ): ?>
                            <h1 class="page-title"><?php echo esc_html( $theme_settings[ 'hero_title' ] ); ?></h1>
                        <?php endif; ?>
                        <?php if ( isset( $theme_settings[ 'hero_description' ] ) ): ?>
                            <p class="lead"><?php echo esc_html( $theme_settings[ 'hero_description' ] ); ?></p>
                        <?php endif; ?>
                        <?php if ( isset( $theme_settings[ 'hero_link' ] ) ): ?>
                            <a href="<?php echo the_permalink( $theme_settings[ 'hero_link' ] ) ?>" class="btn btn-lg btn-primary btn-hero"><?php echo __( 'More about', 'viderum' ) . ' ' . get_the_title( $theme_settings[ 'hero_link' ] ); ?></a>
                        <?php endif; ?>    
                    <?php elseif ( is_archive() ): ?>
                        <h1 class="page-title"><?php _e('Archive', 'viderum'); ?></h1>
                    <?php elseif ( is_post_type_archive() ): ?>
                        <h1 class="page-title"><?php post_type_archive_title(); ?></h1>
                    <?php else: ?>
                        <h1 class="page-title"><?php single_post_title(); ?></h1>
                    <?php endif; ?>
                </header>
                <?php

                if ( is_page() ):
                    if ( has_post_thumbnail() ):

                        ?>
                        <div class="col-md-4 d-none d-md-block">
                            <figure class="custom-header-icon">
                                <?php the_post_thumbnail(); ?>
                            </figure>
                        </div>

                        <?php

                    endif;
                endif;

                ?>
            </div>
        </div>
        <?php

        if ( is_front_page() ):
            the_custom_header_markup();
        endif;

        ?>
    </div>

</div><!-- .custom-header -->
