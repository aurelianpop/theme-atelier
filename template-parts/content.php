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
    <?php if (!is_single()) {
        $feature_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>
        <div class="col s12 m4">
            <div class="card hoverable">
                <div class="card-image truncate blue-link">
                    <a href="<?php echo get_permalink($post->ID); ?>"> <img src="<?php echo $feature_image ?>"/></a>
                </div>
                <div class="card-content">
                    <?php
                    the_title('<h4 class="entry-title truncate"><a class="blue-link" href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h4>');
                    if ('post' === get_post_type() || 'atelier_activities' === get_post_type()) : ?>
                        <div class="entry-meta">
                            <?php theme_atelier_posted_on(); ?>
                        </div><!-- .entry-meta -->
                        <?php
                    endif; ?>
                    <?php
                        the_excerpt();
                    ?>
                    <footer class="entry-footer">
                        <?php theme_atelier_entry_footer(); ?>
                    </footer><!-- .entry-footer -->
                </div>
                <div class="card-action">
                    <a class="truncate" href='<?php echo get_permalink(); ?>'>Detalii despre: <?php the_title(); ?></a>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <header class="entry-header">
            <?php
            the_title('<h1 class="entry-title">', '</h1>');

            if ('post' === get_post_type()) : ?>
                <div class="entry-meta">
                    <?php theme_atelier_posted_on(); ?>
                </div><!-- .entry-meta -->
                <?php
            endif; ?>
        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php
            the_content(sprintf(
            /* translators: %s: Name of current post. */
                wp_kses(__('Continue reading %s <span class="meta-nav">&rarr;</span>', 'theme-atelier'), array('span' => array('class' => array()))),
                the_title('<span class="screen-reader-text">"', '"</span>', false)
            ));
            ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
            <?php theme_atelier_entry_footer(); ?>
        </footer><!-- .entry-footer -->
    <?php } ?>
</article><!-- #post-## -->
