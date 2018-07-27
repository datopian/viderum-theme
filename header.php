<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <nav class="navbar main-navbar navbar-expand-lg">
            <?php get_template_part( 'snippets/header/site', 'branding' ); ?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavContent" aria-controls="mainNavContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="material-icons">menu</span>
            </button>

            <?php if ( has_nav_menu( 'main' ) ) : ?>
                <?php get_template_part( 'snippets/navigation/navigation', 'main' ); ?>
            <?php endif; ?>

            <?php if ( has_nav_menu( 'call_to_action' ) ) : ?>
                <?php get_template_part( 'snippets/navigation/navigation', 'call-to-action' ); ?>
            <?php endif; ?>
        </nav>
        <?php

        if ( !is_front_page() ):
            get_template_part( '/snippets/navigation/navigation', 'breadcrumbs' );
        endif;

        get_template_part( 'snippets/header/custom', 'header' );

        ?>
        <main class="site-main" role="main">