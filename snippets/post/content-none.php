<div class="container-fluid">
    <div class="col-lg-8 offset-lg-2">
        <article <?php post_class(); ?>>
            <div class="entry-content">
                <p>
                    <?php

                    if ( is_404() ):
                        _e( 'Either you typed the wrong URL or this page has been removed. Sorry for the inconvenience.', 'viderum' );
                    else:
                        _e( 'Sorry, no content is currently available for this listing.', 'viderum' );
                    endif;

                    ?>
                </p>
            </div><!-- .entry-content -->
        </article>
    </div>
</div>