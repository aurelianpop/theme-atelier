<?php
/*
Template Name: Add Activities Template
*/

get_header(); ?>

    <div id="primary" class="content-area container">
        <main id="main" class="site-main" role="main">

            <?php
            while ( have_posts() ) : the_post();

                $user = wp_get_current_user();

                if ( in_array( 'partner', $user->roles ) ) {
                    get_template_part( 'template-parts/addactivity', 'page' );
                }

            endwhile; // End of the loop.
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();