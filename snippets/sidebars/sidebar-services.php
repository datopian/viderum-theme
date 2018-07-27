<?php

$sidebar_id = 'sidebar-services';

if ( is_active_sidebar( $sidebar_id ) ) :

    ?>

    <div class="services">
        <div class="container-fluid">
            <div class="col-lg-8 offset-lg-2">
                <div class="row services-border">
                    <?php dynamic_sidebar( $sidebar_id ); ?>
                </div>
            </div>
        </div>
    </div>

    <?php

endif;