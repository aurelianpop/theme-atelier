<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package theme-atelier
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="at-login-modal" class="at-login-modal modal" style="min-height: 300px; padding: 20px;">
    <?php

    $args = array(
        'echo' => true,
        'redirect' => home_url(''),
        'form_id' => 'loginform',
        'label_username' => __('Username sau Email'),
        'label_password' => __('Parola'),
        'label_remember' => __('Pastreaza-ma Autentificat'),
        'label_log_in' => __('Log In'),
        'id_username' => 'user_login',
        'id_password' => 'user_pass',
        'id_remember' => 'rememberme',
        'id_submit' => 'wp-submit',
        'remember' => true,
        'value_username' => NULL,
        'value_remember' => true
    );

    at_wp_login_form($args);

    ?>

</div>
<?php
if (isset($_GET['login']) && $_GET['login'] == 'failed') { ?>
    <script>
        jQuery(document).ready(function ($) {
            $('#at-login-modal').openModal();
        });

    </script>
    <?php
}
?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'theme-atelier'); ?></a>

    <header id="masthead" class="site-header" role="banner">
        <nav id="site-navigation" class="main-navigation light-blue accent-4" role="navigation">
            <div class="nav-wrapper">
                <div class="logo-container">
                    <a href="#">Logo</a>
                </div>
                <?php if (!is_user_logged_in()) { ?>
                    <div class="at-login right hide-on-med-and-down">
                        <a class="waves-effect waves-light modal-trigger lock_open" href="#at-login-modal"><i class="large material-icons">account_circle</i></a>
                    </div>
                <?php } else { ?>
                    <div class="at-logout right hide-on-med-and-down">
                        <a class="waves-effect waves-light" href="javascript:void(0)"><i class="large material-icons">account_circle</i></a>
                        <ul class="logout-menu ta-inactive">
                            <li><a href="<?php echo wp_logout_url( get_bloginfo('url') ); ?>">Logout</a></li>
                        </ul>
                    </div>
                <?php } ?>
                <div class="at-social right hide-on-med-and-down">
                    <ul>
                        <?php
                        $social_links = get_option('atelier_social_media_options');
                        echo !empty($social_links['facebook_link']) ? '<li class="waves-effect waves-light"><a href="' . $social_links['facebook_link'] . '" target="_blank"><i class="fa fa-facebook"></i></a></li>' : '';
                        echo !empty($social_links['twitter_link']) ? '<li class="waves-effect waves-light"><a href="' . $social_links['twitter_link'] . '" target="_blank"><i class="fa fa-twitter"></i></a></li>' : '';
                        echo !empty($social_links['linkedin_link']) ? '<li class="waves-effect waves-light"><a href="' . $social_links['linkedin_link'] . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>' : '';
                        ?>
                    </ul>

                </div>
                <button class="menu-toggle" aria-controls="primary-menu"
                        aria-expanded="false"><?php esc_html_e('Primary Menu', 'theme-atelier'); ?></button>
                <?php wp_nav_menu(array('container_class' => 'right hide-on-med-and-down', 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'walker' => new Atelier_Walker())); ?>

            </div><!-- .site-branding -->
        </nav><!-- #site-navigation -->
        <?php if (is_user_logged_in()) { ?>
<!--            <nav id="site-navigation" class="main-navigation light-blue accent-4" role="navigation">-->
<!--                <ul class="account-navigation">-->
<!--                    <li></li>-->
<!--                    <li></li>-->
<!--                    <li></li>-->
<!--                </ul>-->
<!--            </nav>-->
        <?php } ?>


    </header><!-- #masthead -->
    <div id="top">
        <?php
        if (is_front_page()) {
            echo do_shortcode('[rev_slider home]');
        } else {
            if (!is_page_template('page-templates/product-page.php')) {
                ?>

                <h1 class="entry-title"><?php the_title(); ?></h1>

                <?php
            }
        } ?>
    </div>

    <div id="content" class="site-content">
