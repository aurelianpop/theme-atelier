<?php
/**
 * Created by PhpStorm.
 * User: Pop
 * Date: 2/28/2016
 * Time: 12:47 PM
 */

/**
 * Restrict backend access to admins only
 */
function blockusers_init()
{
    if (is_admin() && !current_user_can('administrator') &&
        !(defined('DOING_AJAX') && DOING_AJAX)
    ) {
        wp_redirect(home_url());
        exit;
    }
}

add_action('init', 'blockusers_init');


/**
 * Filter to the authenticate filter hook, to fetch a username based on entered email
 * @param  obj $user
 * @param  string $username [description]
 * @param  string $password [description]
 * @return boolean
 */
function atelier_allow_email_login($user, $username, $password)
{
    if (is_email($username)) {
        $user = get_user_by_email($username);
        if ($user) $username = $user->user_login;
    }
    return wp_authenticate_username_password(null, $username, $password);
}

add_filter('authenticate', 'atelier_allow_email_login', 20, 3);


/**
 * This is what happens when you enter wrong login credentials on the front end
 * @param $username
 */
function atelier_front_end_login_fail($username)
{
    // Get the reffering page, where did the post submission come from?
    $referrer = $_SERVER['HTTP_REFERER'];

    // if there's a valid referrer, and it's not the default log-in screen
    if (!empty($referrer) && !strstr($referrer, 'wp-login') && !strstr($referrer, 'wp-admin')) {
        // let's append some information (login=failed) to the URL for the theme to use
        wp_redirect($referrer . '?login=failed');
        exit;
    }
}

add_action('wp_login_failed', 'atelier_front_end_login_fail');

/**
 * If the credentials are not filled in throw an error
 *
 * @param $user
 * @param $username
 * @param $password
 * @return WP_Error
 */
function atelier_authenticate_username_password($user, $username, $password)
{
    if (is_a($user, 'WP_User')) {
        return $user;
    }

    if (empty($username) || empty($password)) {
        $error = new WP_Error();
        $user = new WP_Error('authentication_failed', __('<strong>Eroare</strong>: User sau parola incorecte.'));

        return $error;
    }
}

add_filter('authenticate', 'atelier_authenticate_username_password', 30, 3);


/**
 * This adds the lost password link
 * @return string
 */
function add_lost_password_link()
{
    return '<a class="lost-password right" href="' .  get_bloginfo('url') . '/resetare-parola/">Ai uitat parola?</a>';
}

add_action('login_form_middle', 'add_lost_password_link');


/**
 * Error message Handle
 * @return string
 */
function return_error_message()
{
    if (isset($_GET['login']) && $_GET['login'] == 'failed') {
        return '<div id="login-error"><p><strong>Autentificare esuata </strong><br/>Ai introdus Username-ul sau Parola gresite. Te rog mai incearca odata.</p></div>';
    } else {
        return '';
    }

}

add_action('login_form_top', 'return_error_message');