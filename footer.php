</main>
<?php

// Show Action Block widget section on all static pages
if ( is_page() && !is_front_page() ) :
    get_template_part( 'snippets/sidebars/sidebar', 'action-block' );
endif;

?>
<footer class="site-footer bg-dark">
    <div class="container-fluid">
        <div class="col-lg-8 offset-lg-2 widgets-wrap">
<?php get_template_part( '/snippets/sidebars/sidebar', 'footer' ); ?>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
<?php get_template_part( '/snippets/footer/google-analytics' ); ?>
</body>
</html>
