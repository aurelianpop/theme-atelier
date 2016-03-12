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

<div id="at-subscribe-modal" class="at-subscribe-modal modal">
    <div class="modal-header light-blue accent-4">
        <img class="padding-top10" src="<?php echo get_template_directory_uri(); ?>/img/logo.png"/>
    </div>
    <div class="modal-icon-container white">
        <i class="modal-icon tiny material-icons light-blue-text text-accent-4">email</i>
    </div>
    <div>
        <form class="modal-form">
           Email:<br>
            <input type="text" class="input-field" name="firstname">
            <br>
            <button type="submit" class="button-primary login-button">Submit</button>
        </form>
        </div>
</div>
<footer id="colophon" class="site-footer white-text" role="contentinfo">
    <?php if (is_front_page()) { ?>
        <div class="newsletter-container light-blue accent-4">
            <div class="container row">
                <div class="inline-block col s7">
                    <h4>Afla mai multe despre noi.<span class="font-weight700"> Inscrie-te la newsletter</span></h4>
                    <p>Lorem ipsum sit amet</p>
                    <a href="#at-subscribe-modal" class="btn waves-effect waves-light grey darken-3 join-btn modal-trigger lock_open">Abonare</a>
                </div>
                <div class="col s1"></div>
                <div class="col s4">
                    <?php
                    $social_links = get_option('atelier_newsletter_image');
                    echo !empty($social_links['newsletter_img_url']) ? '<img class="newsletter-img z-depth-3 hide-on-small-only" src="' . $social_links['newsletter_img_url'] . '"></img>' : '';
                    ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="footer-partners black-text padding-top30">
        <h4 class="center-align"><span class="font-weight700">Partenerii</span> nostri</h4>
        <div class="container row">
            <?php
            $partners = get_users('role=Partner');
            $partner_logos = array();
            foreach ($partners as $partner) {
                if ($partner->logo) {
                    $partner_logos[] = $partner;
                }
            }
            if (count($partner_logos) > 4) {
                $partner_keys = array_rand($partner_logos, 4);
                foreach ($partner_keys as $key) {
                    echo '<div class="col s12 m3 center-align"><img class="partner-logo" src="' . $partner_logos[$key]->logo . '"></img></div>';
                }
            } else {
                if ($partner_logos) {
                    foreach ($partner_logos as $partner) {
                        echo '<div class="col s12 m3 center-align"><img class="partner-logo" src="' . $partner->logo . '"></img></div>';
                    }
                }
            }
            ?>
        </div>
    </div>
    <div class="footer-container row grey darken-3 margin0">
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
                <ul class="margin0">
                    <?php
                    $social_links = get_option('atelier_social_media_options');
                    echo !empty($social_links['facebook_link']) ? '<li class="waves-effect waves-light"><a class="white-text" href="' . $social_links['facebook_link'] . '" target="_blank"><i class="fa fa-facebook"></i></a></li>' : '';
                    echo !empty($social_links['twitter_link']) ? '<li class="waves-effect waves-light"><a class="white-text" href="' . $social_links['twitter_link'] . '" target="_blank"><i class="fa fa-twitter"></i></a></li>' : '';
                    echo !empty($social_links['linkedin_link']) ? '<li class="waves-effect waves-light"><a class="white-text" href="' . $social_links['linkedin_link'] . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>' : '';
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
