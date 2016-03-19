<?php
/**
 * Template part for displaying partners in partners-page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package theme-atelier
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'theme-atelier' ),
            'after'  => '</div>',
        ) );
        ?>

        <div class="row">
            <?php
            $args = array(
                'role'         => 'partner',

            );
            $users = get_users( $args );
            if(!empty($users)) {
                foreach($users as $user) { ?>
                    <div class="col s12 m4">
                        <div class="card-panel center-align light-blue accent-4">
                            <h5 class="white-text at-parner-name"><strong><?php echo $user->first_name; ?></strong></h5>
                            <div class="at-partner-logo">
                                <img src="<?php echo $user->logo; ?>" />
                            </div>
                            <h5 class="white-text">Persoana de Contact:</h5>
                            <p class="white-text">Nume: <?php echo $user->contact_name; ?></p>
                            <p class="white-text">Prenume: <?php echo $user->contact_surname; ?></p>
                            <p class="white-text">Telefon: <?php echo $user->contact_phone; ?></p>
                            <br/><br/>
                            <?php $pages = get_pages(array(
                                'number' => 1,
                                'meta_key' => '_wp_page_template',
                                'meta_value' => 'partner-page.php'
                            ));
                            ?>
                            <div class="card-action">
                                <?php
                                foreach($pages as $page){ ?>
                                    <a class="waves-effect waves-light btn white light-blue-text text-accent-4" href="<?php echo esc_url( get_permalink( $page->ID ) ) . '?partner=' . $user->ID; ?>">mai mult ...</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } ?>
        </div>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php
        edit_post_link(
            sprintf(
            /* translators: %s: Name of current post */
                esc_html__( 'Edit %s', 'theme-atelier' ),
                the_title( '<span class="screen-reader-text">"', '"</span>', false )
            ),
            '<span class="edit-link">',
            '</span>'
        );
        ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
