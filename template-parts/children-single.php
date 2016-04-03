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
			<h2 class="entry-title"><span class="font-weight700">Informatii</span> copil</h2>
			<hr class="blue accent-4"/>
			<?php
			$feature_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			?>
			<div class="row padding-top10">
				<div class="ta-featured-image col s12 m2">
					<img src="<?php echo $feature_image ?>"/>
				</div>
				<div class="col s12 m10 at-child-details">
					<?php the_title( '<h2 class="margin0">', '</h2>' ); ?>
					<?php the_content(); ?>
				</div>
			</div>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
			$post_categories = get_the_terms( $post->ID, 'atelier_hobbies' );
			?>
			<table class="striped responsive-table all-borders at-child-table">
				<thead></thead>
				<tbody>
				<tr>
					<td class="font-weight700">Data nasterii</td>
					<td><?php echo get_field( "date_of_birth" ); ?></td>
				</tr>
				<tr>
					<td class="font-weight700">Sex</td>
					<td><?php echo get_field( "sex" ); ?></td>
				</tr>
				<tr>
					<td class="font-weight700">Oras</td>
					<td><?php echo get_field( "place_of_birth" ); ?></td>
				</tr>
				<tr>
					<td class="font-weight700">Hobby-uri</td>
					<td><?php
						$hobby_list = '';
						foreach($post_categories as $category) {
							$hobby_list = $hobby_list . ", " . $category->name;
						}
						echo trim($hobby_list, ",");
						?>
					</td>
				</tr>

				</tbody>
			</table>

			<h3 class="padding-top30">Activitati la care <?php the_title(); ?> a participat</h3>
			<hr class="blue accent-4"/>

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
							<a class="blue-link" href="<?php echo $post->guid; ?>"><h4 class="margin0"><?php echo $post->post_title; ?></h4></a>
							<p class="padding-top10">
								<?php $content = substr($post->post_content, 0, strpos($post->post_content, "<")); ?>
								<?php echo substr($content, 0, 300); ?>
							</p>
						</li>
					<?php } ?>
				</ul>
				<?php
			}
			else {
				?><p>Momentan nu exista nici o activitate.</p><?php
			}
			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->
