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
	<?php $feature_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
	<div class="col s12 m4">
		<div class="card hoverable">
			<div class="card-image truncate">
				<a href="<?php echo get_permalink($post->ID); ?>"> <img src="<?php echo $feature_image ?>"/></a>
			</div>
			<div class="card-content">
				<?php
				if ( is_single() ) {
					the_title( '<h1 class="entry-title truncate">', '</h1>' );
				} else {
					the_title( '<h2 class="entry-title truncate"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				}

				if ( 'post' === get_post_type() || 'atelier_activities' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php theme_atelier_posted_on(); ?>
					</div><!-- .entry-meta -->
					<?php
				endif; ?>
				<?php
				the_content( sprintf(
				/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'theme-atelier' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) ); ?>
				<footer class="entry-footer">
					<?php theme_atelier_entry_footer(); ?>
				</footer><!-- .entry-footer -->
			</div>
			<div class="card-action">
				<a class="truncate" href='<?php echo get_permalink(); ?>'>Detalii despre: <?php the_title(); ?></a>
			</div>
		</div>
	</div>
	<?php
	wp_link_pages( array(
		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'theme-atelier' ),
		'after'  => '</div>',
	) ); ?>
</article><!-- #post-## -->
