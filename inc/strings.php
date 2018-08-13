<?php

/*
 * Don't do anything if Polylang is not available
 */
if ( !function_exists( 'pll_register_string' ) ):
    return;
endif;

pll_register_string( 'viderum_read_more', 'Read more', 'viderum' );
