<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package theme-atelier
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        if ( is_single() ) {
            the_title( '<h1 class="entry-title">', '</h1>' );
        } else {
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        }

        if ( 'post' === get_post_type() || 'atelier_activities' === get_post_type() ) : ?>
            <div class="entry-meta">
                <?php theme_atelier_posted_on(); ?>
            </div><!-- .entry-meta -->
            <?php
        endif; ?>
        <?php
        $feature_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
        ?>
        <div class="row">
            <div class="ta-featured-image col s12 m4">
                <img src="<?php echo $feature_image ?>"/>
            </div>
        </div>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php the_excerpt(); ?>
        <a href='<?php echo get_permalink(); ?>'>Detalii despre: <?php the_title(); ?></a>


        <?php
        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'theme-atelier' ),
            'after'  => '</div>',
        ) );
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php theme_atelier_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->