<?php

$sidebar_id = 'sidebar-partners';
$title = (function_exists( 'pll__' ) ? pll__( 'Our Partners' ) : __( 'Our Partners', 'viderum' ) );

if ( is_active_sidebar( $sidebar_id ) ) :

    ?>

    <div class="container-fluid">
        <section class="partners">
            <h2 class="title"><?php echo esc_html( $title ); ?></h2>
            <div class="list">
                <?php dynamic_sidebar( $sidebar_id ); ?>
            </div>
        </section>
    </div>

    <?php

endif;