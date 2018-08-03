<?php

/**
 * Sidebar snippet for Action_Block widgets
 *
 * @link https://github.com/ViderumGlobal/viderum-theme
 *
 * @package WordPress
 * @subpackage Viderum
 */
$sidebar_id = 'sidebar-action-block';

if ( is_active_sidebar( $sidebar_id ) ) :

    ?>

    <div class="action-block">
        <ul class="list-inline list-wide">
            <?php

            dynamic_sidebar( $sidebar_id );

            ?>
        </ul>
    </div>

    <?php

endif;