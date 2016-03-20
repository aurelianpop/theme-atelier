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
        <h2>Lista de copii</h2>
        <hr class="light-blue accent-4"/>

        <div class="row">
            <?php $user = wp_get_current_user();
            if(isset($user->children) && !empty($user->children)) {
                foreach ($user->children as $child) {
                    $post = get_post($child);
                    ?>
                    <div class="col s12 m4">
                        <div class="card">
                            <div class="card-image">
                                <?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
                                <img src="<?php echo $feat_image ?>">
                                <h4><?php echo $post->post_title; ?></h4>
                            </div>
                            <div class="card-content">
                                <p>
                                    <?php echo substr($post->post_content, 0, 300); ?>
                                </p>
                            </div>
                            <div class="card-action">
                                <a href="<?php echo $post->guid; ?>">Detalii</a>
                            </div>
                        </div>
                    </div>
                <?php }
            }
            ?>

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
