<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package theme-atelier
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-container row grey darken-3">
			<?php dynamic_sidebar( 'at_footer_area' ); ?>
		</div>
		<div class="footer-container-small">
			<div class="social-container grey darken-3">
				<ul>
					<?php
					$social_links = get_option('atelier_social_media_options');
					echo !empty($social_links['facebook_link']) ? '<li class="waves-effect waves-light"><a href="' . $social_links['facebook_link'] . '" target="_blank"><i class="fa fa-facebook"></i></a></li>' : '';
					echo !empty($social_links['twitter_link']) ? '<li class="waves-effect waves-light"><a href="' . $social_links['twitter_link'] . '" target="_blank"><i class="fa fa-twitter"></i></a></li>' : '';
					echo !empty($social_links['linkedin_link']) ? '<li class="waves-effect waves-light"><a href="' . $social_links['linkedin_link'] . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>' : '';
					?>
				</ul>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
