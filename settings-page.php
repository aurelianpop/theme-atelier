<?php
/*
Template Name: Account Settings Template
*/

get_header(); ?>

    <div id="primary" class="content-area padding-top60">
        <main id="main" class="site-main" role="main">

            <?php
            while ( have_posts() ) : the_post();

                $user = wp_get_current_user();

                if ( in_array( 'partner', $user->roles ) ) {
                    get_template_part( 'template-parts/settings', 'partners' );
                } else if ( in_array( 'parent', $user->roles ) ) {
                    get_template_part( 'template-parts/settings', 'parents' );
                }

            endwhile; // End of the loop.
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();