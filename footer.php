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
    <?php if (is_front_page()) { ?>
        <div class="newsletter-container">

        </div>
    <?php } ?>
    <div class="footer-partners">
        <h4 class="center-align">Our <strong>Partners</strong></h4>
        <div class="container row">
            <?php
            $partners = get_users('role=Partner');
            $partner_logos = array();
            foreach ($partners as $partner) {
                if ($partner->logo) { $partner_logos[] = $partner; }
            }
            if(count($partner_logos)>4) {
                $partner_keys = array_rand($partner_logos, 4);
                foreach ($partner_keys as $key) {
                    echo '<div class="col s12 m3 center-align"><img class="partner-logo" src="' . $partner_logos[$key]->logo . '"></img></div>';
                }
            }
            else
            {
                if($partner_logos) {
                    foreach ($partner_logos as $partner) {
                        echo '<div class="col s12 m3 center-align"><img class="partner-logo" src="' . $partner->logo . '"></img></div>';
                    }
                }
            }
            ?>
        </div>
    </div>
    <div class="footer-container row grey darken-3">
        <div class="container">
            <?php dynamic_sidebar('at_footer_area'); ?>
        </div>
    </div>
    <div class="footer-container-small">
        <div class="container">
            <div class="left copyright-container">
                <span>Copyright 2016. All rights reserved.</span>
            </div>
            <div class="social-container grey darken-3 right">
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
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
