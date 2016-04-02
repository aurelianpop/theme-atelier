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
	<div class="container">
		<header class="entry-header">
			<h1 class="entry-title"><strong>Informatii</strong> Copil</h1>
			<?php
			$feature_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			?>
			<div class="row">
				<div class="ta-featured-image col s12 m2">
					<img src="<?php echo $feature_image ?>"/>
				</div>
				<div class="col s12 m10">
					<?php the_title( '<h2>', '</h2>' ); ?>
					<?php the_content(); ?>
				</div>
			</div>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
			$post_categories = get_the_terms( $post->ID, 'atelier_hobbies' );
			?>
			<table class="bordered striped responsive-table ta-child-details">
				<tbody>
				<tr>
					<td><strong>Data nasterii</strong></td>
					<td><?php echo get_field( "date_of_birth" ); ?></td>
				</tr>
				<tr>
					<td><strong>Sex</strong></td>
					<td><?php echo get_field( "sex" ); ?></td>
				</tr>
				<tr>
					<td><strong>Oras</strong></td>
					<td><?php echo get_field( "place_of_birth" ); ?></td>
				</tr>
				<tr>
					<td><strong>Hobby-uri</strong></td>
					<td><?php
						foreach($post_categories as $category) {
							echo $category->name . ", ";
						}
						?></td>
				</tr>

				</tbody>
			</table>

			<h3>Activitati la care <?php the_title(); ?> a participat</h3>

			<?php $args = array(
				'numberposts'      => -1,
				'orderby'          => 'date',
				'order'            => 'DESC',
				'post_type'        => 'atelier_activities',
				'post_status'      => 'publish',
				'suppress_filters' => true,
				'meta_query'	=> array(
					'relation'		=> 'AND',
					array(
						'key'	 	=> 'children',
						'value'	  	=> $post->ID,
						'compare' 	=> 'LIKE',
					),
				),
			);
			$posts_array = get_posts( $args );
			if($posts_array) { ?>
				<ul class="at-pending-news-list collection">
					<?php foreach ($posts_array as $post) {
						$url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
						?>
						<li class="at-news-item-<?php echo $post->ID; ?> collection-item avatar">
							<img src="<?php echo $url; ?>" alt="" class="circle">
							<a href="<?php echo $post->guid; ?>"><h4><?php echo $post->post_title; ?></h4></a>
							<p>
								<?php $content = substr($post->post_content, 0, strpos($post->post_content, "<")); ?>
								<?php echo substr($content, 0, 300); ?>
							</p>
						</li>
					<?php } ?>
				</ul>
				<?php
			}
			?>
		</div><!-- .entry-content -->
		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
		?>
	</div>
</article><!-- #post-## -->
