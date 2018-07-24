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
                <span class="navbar-toggler-icon"></span>
            </button>

            <?php if ( has_nav_menu( 'main' ) ) : ?>
                <?php get_template_part( 'snippets/navigation/navigation', 'main' ); ?>
            <?php endif; ?>

            <?php if ( has_nav_menu( 'call_to_action' ) ) : ?>
                <?php get_template_part( 'snippets/navigation/navigation', 'call-to-action' ); ?>
            <?php endif; ?>

            <ul class="list-inline list-languages">
                <?php

                $languages = pll_the_languages( array(
                    'hide_if_empty' => 0,
                    'display_names_as' => 'slug',
                        ) );

                ?>
            </ul>
        </nav>
        <?php

        get_template_part( 'snippets/header/custom', 'header' );

        ?>
        <main role="main">