<?php

$theme_settings = get_theme_settings();
$container_class = 'container-fluid';
$grid_class = 'col-lg-6 offset-lg-1';
$page_header_class = '';
$page_header_default_class = '';
$page_header_background = get_header_image();
$page_header_background_style = '';


if ( !is_front_page() ):
    $grid_class = 'col-lg-8 offset-lg-2';
endif;

if ( 'case-study' == get_post_type() ):
    $page_header_background = get_the_post_thumbnail_url( get_the_ID() );
endif;

if ( is_front_page() || (!is_post_type_archive( 'case-study' ) && 'case-study' == get_post_type()) ):
    $page_header_background_style = 'style="background: url(' . $page_header_background . ') center bottom no-repeat; background-size: cover;"';
endif;

if ( is_front_page() && $page_header_background == DEFAULT_HEADER_IMAGE ):
    $page_header_default_class = 'custom-header-media-default';
endif;

if ( is_single() || is_author() ):
    $page_header_class = 'page-header-avatar';
endif;

?>
<div class="custom-header">

    <div class="custom-header-media <?php echo esc_attr( $page_header_default_class ); ?>" <?php echo $page_header_background_style; ?>>
        <div class="<?php echo esc_attr( $container_class ); ?>">
            <div class="<?php echo esc_attr( $grid_class ); ?>">
                <div class="row">
                    <header class="page-header col-lg-8 <?php echo esc_attr( $page_header_class ); ?>">
                        <?php

                        if ( is_singular( array( 'post' ) ) || is_author() ):
                            viderum_author_avatar( get_post_field( 'post_author', get_the_ID() ) );
                        endif;

                        ?>
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
                        <?php elseif ( is_author() ): ?>
                            <h1 class="page-title"><?php _e( 'Archive', 'viderum' ); ?>: <span class="text-secondary"><?php echo esc_html( get_the_author_meta( 'display_name', get_queried_object_id() ) ); ?></span></h1>
                        <?php elseif ( is_post_type_archive() ): ?>
                            <h1 class="page-title"><?php _e( 'Archive', 'viderum' ); ?>: <span class="text-secondary"><?php post_type_archive_title(); ?></span></h1>
                        <?php elseif ( is_archive() ): ?>
                            <h1 class="page-title"><?php _e( 'Archive', 'viderum' ); ?></h1>
                        <?php elseif ( is_search() ): ?>
                            <h1 class="page-title"><?php _e( 'Search', 'viderum' ); ?>: <span class="text-secondary"><?php echo get_search_query(); ?></span></h1>
                        <?php else: ?>
                            <h1 class="page-title"><?php single_post_title(); ?></h1>
                        <?php endif; ?>
                    </header>
                    <?php

                    if ( is_page() && !is_front_page() ):
                        if ( has_post_thumbnail() ):

                            ?>
                            <div class="col-lg-4 d-none d-md-block">
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
        </div>
    </div>

</div><!-- .custom-header -->
