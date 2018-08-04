<?php

$sidebar_id = 'sidebar-partners';

if ( is_active_sidebar( $sidebar_id ) ) :

    ?>

    <div class="container-fluid">
        <section class="partners">
            <h2 class="title"><?php _e( 'Our Partners' ); ?></h2>
            <div class="list">
                <?php dynamic_sidebar( $sidebar_id ); ?>
            </div>
        </section>
    </div>

    <?php

endif;