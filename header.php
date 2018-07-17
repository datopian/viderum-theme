<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div class="container">
            <header id="masthead" class="site-header" role="banner">
                <?php get_template_part( 'snippets/header/site', 'branding' ); ?>

                <?php if ( has_nav_menu( 'main' ) ) : ?>
                    <div class="navigation-main">
                        <div class="wrap">
                            <?php get_template_part( 'snippets/navigation/navigation', 'main' ); ?>
                        </div><!-- .wrap -->
                    </div><!-- .navigation-main -->
                <?php endif; ?>

            </header><!-- #masthead -->
            <?php get_template_part( 'snippets/header/custom', 'header' ); ?>
            <main>

            </main>
            <footer>

            </footer>
        </div>