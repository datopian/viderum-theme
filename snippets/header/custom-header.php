<?php

$theme_settings = get_theme_settings();

?>
<div class="custom-header">

    <div class="custom-header-media">
        <div class="container-fluid">
            <div class="row">
                <header class="offset-md-1 col-md-5 page-header">
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
                    <?php else: ?>
                        <h1 class="page-title"><?php single_post_title(); ?></h1>
                    <?php endif; ?>
                </header>
            </div>
        </div>
        <?php the_custom_header_markup(); ?>
    </div>

</div><!-- .custom-header -->
