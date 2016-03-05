<?php
/*
Template Name: Account Settings Template
*/

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php
            while ( have_posts() ) : the_post();

                $user = wp_get_current_user();

                if ( in_array( 'partner', $user->roles ) ) {
                    get_template_part( 'template-parts/settings', 'partners' );
                } else if ( in_array( 'partner', $user->roles ) ) {
                    get_template_part( 'template-parts/settings', 'parents' );
                }

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();