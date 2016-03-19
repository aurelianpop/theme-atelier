<?php
/*
Template Name: Single Partner Template
*/

if(!isset($_GET['partner']) || empty($_GET['partner']) ) {
     wp_redirect( home_url() ); exit;
}

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php
            while ( have_posts() ) : the_post();

                get_template_part( 'template-parts/partner', 'page' );

            endwhile; // End of the loop.
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_sidebar();
get_footer();