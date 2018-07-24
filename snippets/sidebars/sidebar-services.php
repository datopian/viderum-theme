<?php

$sidebar_id = 'sidebar-services';

if ( is_active_sidebar( $sidebar_id ) ) :

    ?>

    <div class="services">
        <div class="container">
            <div class="row">
                <?php dynamic_sidebar( $sidebar_id ); ?>
            </div>
        </div>
    </div>

    <?php

endif;