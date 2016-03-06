<?php
/**
 * Template part for displaying page content in page.php.
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
        <div class="ta-add-news">
            <form id="at_save_news" action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="post_title" type="text" name="post_title" required="" aria-required="true" value="" class="validate">
                        <label for="post_title">Titlul</label>
                    </div>
                    <div class="file-field input-field col s6">
                        <div class="btn light-blue accent-4">
                            <span>Adauga imagine</span>
                            <input type="file" name="fileToUpload" required="" aria-required="true" id="fileToUpload">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" name="img" type="text">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="post_content" name="post_content" required="" aria-required="true" class="materialize-textarea"></textarea>
                        <label for="post_content">Continut stire</label>
                    </div>
                </div>
                <input type='hidden' value="<?php echo wp_create_nonce( 'save_new_post' ); ?>" name='nonce' />
                <input type="hidden" name="action" id="action" value="save_news">
                <button class="btn waves-effect waves-light  light-blue accent-4" type="submit" >Adauga stire
                    <i class="material-icons right">send</i>
                </button>
            </form>
        </div>
        <div class="pending-news">
            <h2>Stiri care asteapta aprobare</h2>
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
