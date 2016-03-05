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
        <nav id="site-navigation" class="main-navigation" role="navigation">
            <div class="nav-wrapper menu-container">
                <a href="#" data-activates="mobile-demo"
                   class="button-collapse mobile_navbar">
                    <i class="material-icons">menu</i>
                </a>

                <div class="logo-container">
                    <a href="<?php echo home_url(); ?>">
                        <img class="padding-top10" src="<?php echo get_template_directory_uri(); ?>/img/logo.png"/>
                    </a>
                </div>

                <?php if (!is_user_logged_in()) { ?>
                    <div class="at-login right grey darken-3">
                        <a class="waves-effect waves-light modal-trigger lock_open center-align" href="#at-login-modal"><i
                                class="large material-icons">account_circle</i></a>
                    </div>
                <?php } else { ?>
                    <div class="at-logout right grey darken-3">
                        <a class="waves-effect waves-light center-align" href="javascript:void(0)"><i
                                class="large material-icons">account_circle</i></a>
                        <ul class="logout-menu ta-inactive">
                            <li><a class="waves-effect waves-light"
                                   href="<?php echo wp_logout_url(get_bloginfo('url')); ?>">Deconectare</a></li>
                        </ul>
                    </div>
                <?php } ?>

                <div class="at-social right">
                    <ul>
                        <?php
                        $social_links = get_option('atelier_social_media_options');
                        echo !empty($social_links['facebook_link']) ? '<li class="waves-effect waves-light"><a href="' . $social_links['facebook_link'] . '" target="_blank"><i class="fa fa-facebook"></i></a></li>' : '';
                        echo !empty($social_links['twitter_link']) ? '<li class="waves-effect waves-light"><a href="' . $social_links['twitter_link'] . '" target="_blank"><i class="fa fa-twitter"></i></a></li>' : '';
                        echo !empty($social_links['linkedin_link']) ? '<li class="waves-effect waves-light"><a href="' . $social_links['linkedin_link'] . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>' : '';
                        ?>
                    </ul>

                </div>

                <?php wp_nav_menu(array('container_class' => 'right hide-on-med-and-down', 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'walker' => new Atelier_Walker())); ?>
                <?php wp_nav_menu(array('menu_id' => 'mobile-demo', 'menu_class' => 'side-nav', 'theme_location' => 'primary', 'container' => false, 'walker' => new Atelier_Walker())); ?>

            </div><!-- .site-branding -->
        </nav><!-- #site-navigation -->
        <?php if (is_user_logged_in()) { ?>
            <nav id="site-navigation" class="main-navigation grey darken-3 sub-menu-bar" role="navigation">
                <?php $user = wp_get_current_user();
                if (in_array('partner', $user->roles)) {
                    wp_nav_menu(array('container_class' => 'right', 'theme_location' => 'partner', 'menu_id' => 'partner-menu', 'walker' => new Atelier_Walker()));
                }

                if (in_array('parent', $user->roles)) {
                    wp_nav_menu(array('container_class' => 'right', 'theme_location' => 'parent', 'menu_id' => 'parent-menu', 'walker' => new Atelier_Walker()));
                } ?>
            </nav>
        <?php } ?>


    </header><!-- #masthead -->
    <div id="top">
        <?php
        if (is_front_page()) {
            echo do_shortcode('[rev_slider home]');
        } else {
            if (!is_page_template('settings-page.php')) {
                ?>

                <h1 class="entry-title"><?php the_title(); ?></h1>

                <?php
            }
        } ?>
    </div>

    <div id="content" class="site-content">
