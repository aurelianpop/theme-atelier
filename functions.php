<?php
/**
 * theme-atelier functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package theme-atelier
 */

if (!function_exists('theme_atelier_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function theme_atelier_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on theme-atelier, use a find and replace
         * to change 'theme-atelier' to the name of your theme in all the template files.
         */
        load_theme_textdomain('theme-atelier', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary', 'theme-atelier'),
            'partner' => esc_html__('Partner Menu', 'theme-atelier'),
            'parent' => esc_html__('Parent Menu', 'theme-atelier'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /*
         * Enable support for Post Formats.
         * See https://developer.wordpress.org/themes/functionality/post-formats/
         */
        add_theme_support('post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('theme_atelier_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));
    }
endif;
add_action('after_setup_theme', 'theme_atelier_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function theme_atelier_content_width()
{
    $GLOBALS['content_width'] = apply_filters('theme_atelier_content_width', 640);
}

add_action('after_setup_theme', 'theme_atelier_content_width', 0);

/**
 * Enqueue scripts and styles.
 */
function theme_atelier_scripts()
{
    //check if debug is active and create the suffix for the js files
    $js_suffix = defined('WP_DEBUG') && WP_DEBUG ? '.js' : '.min.js';

    //Colorbox stylesheet
    wp_enqueue_style( 'colorbox', get_template_directory_uri() . '/colorbox/colorbox.css' );
    wp_enqueue_style('theme-atelier-style', get_stylesheet_uri());

    wp_enqueue_script('theme-atelier-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true);

    wp_enqueue_script('theme-atelier-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true);

    // add styles css
    wp_register_style('custom_wp_main_css', get_template_directory_uri() . '/css/main.css', false, '1.0.0');
    wp_enqueue_style('custom_wp_main_css');
    wp_register_style('custom_icons_css', 'https://fonts.googleapis.com/icon?family=Material+Icons', false, '1.0.0');
    wp_enqueue_style('custom_icons_css');
    wp_register_style('custom_font_awesome_css', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', false, '1.0.0');
    wp_enqueue_style('custom_font_awesome_css');
    wp_register_style('custom_font_open_sans','https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic');
    wp_enqueue_style('custom_font_open_sans');

    wp_register_style('custom_wp_materialize_css', get_template_directory_uri() . '/css/styles.css', false, '1.0.0');
    wp_enqueue_style('custom_wp_materialize_css');

    // add main js
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-form', array('jquery'), false, true);
    //Colorbox jQuery plugin js file
    wp_enqueue_script( 'colorbox', get_template_directory_uri() . '/colorbox/jquery.colorbox-min.js', array( 'jquery'   ), '', true );
    wp_enqueue_script('theme-atelier-js', get_template_directory_uri() . '/js/dist/ta-main' . $js_suffix, array('jquery'), '1.0.0', true);
    wp_localize_script('theme-atelier-js', 'ajax_front', array('ajaxurl' => admin_url('admin-ajax.php')));

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'theme_atelier_scripts');

add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
    show_admin_bar(false);
}

function remove_custom_fields() {
    if(defined('WP_DEBUG') && WP_DEBUG === false) {
        remove_menu_page( 'edit.php?post_type=acf-field-group' );
    }
}

add_action( 'admin_menu', 'remove_custom_fields' );

function theme_atelier_admin_scripts()
{
    //check if debug is active and create the suffix for the js files
    $js_suffix = defined('WP_DEBUG') && WP_DEBUG ? '.js' : '.min.js';

    // add admin css
    wp_register_style('custom_wp_admin_css', get_template_directory_uri() . '/admin/css/admin.css', false, '1.0.0');
    wp_enqueue_style('custom_wp_admin_css');

    // add admin js
    wp_enqueue_script('jquery');
    wp_enqueue_media();
    wp_enqueue_script('theme-atelier-admin-js', get_template_directory_uri() . '/admin/js/dist/admin' . $js_suffix, array('jquery'), '1.0.0', true);
}

add_action('admin_enqueue_scripts', 'theme_atelier_admin_scripts');

/**
 * Autoload all files in inc folder anything you add in this folder will be included in all the backend
 */
foreach (scandir(dirname(__FILE__) . "/inc") as $filename) {
    $path = dirname(__FILE__) . '/inc/' . $filename;

    if (is_file($path)) {
        require get_template_directory() . "/inc/" . $filename;
    }
}

function my_nav_wrap() {
    // default value of 'items_wrap' is <ul id="%1$s" class="%2$s">%3$s</ul>'

    // open the <ul>, set 'menu_class' and 'menu_id' values
    $wrap  = '<ul id="%1$s" class="%2$s">';

    // get nav items as configured in /wp-admin/
    $wrap .= '%3$s';

    // add login or logout if the user is logged in
    if (!is_user_logged_in()) {
        $wrap .= '<li><a class="waves-effect waves-light modal-trigger" href="';
        $wrap .= '#at-login-modal';
        $wrap .= '">Autentificare</a></li>';
    } else {
        $wrap .= '<li><a class="waves-effect waves-light" href="';
        $wrap .= urldecode(wp_logout_url(get_bloginfo('url')));
        $wrap .= '">Deconectare</a></li>';
    }

    // close the <ul>
    $wrap .= '</ul>';

    // return the result
    return $wrap;
}

/**
 * Remove the Pre Title text
 */
add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {
        $title = single_cat_title( '', false );

    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );

    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>' ;

    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false ) ;
    }

    return $title;

});

/**
 * Add Backend Menu post types item
 */
add_action('admin_head-nav-menus.php', 'at_add_metabox_menu_posttype_archive');

function at_add_metabox_menu_posttype_archive() {
    add_meta_box('at-metabox-nav-menu-posttype', 'Custom Post Type Archives', 'at_metabox_menu_posttype_archive', 'nav-menus', 'side', 'default');
}

function at_metabox_menu_posttype_archive() {
    $post_types = get_post_types(array('show_in_nav_menus' => true, 'has_archive' => true), 'object');

    if ($post_types) :
        $items = array();
        $loop_index = 999999;

        foreach ($post_types as $post_type) {
            $item = new stdClass();
            $loop_index++;

            $item->object_id = $loop_index;
            $item->db_id = 0;
            $item->object = 'post_type_' . $post_type->query_var;
            $item->menu_item_parent = 0;
            $item->type = 'custom';
            $item->title = $post_type->labels->name;
            $item->url = get_post_type_archive_link($post_type->query_var);
            $item->target = '';
            $item->attr_title = '';
            $item->classes = array();
            $item->xfn = '';

            $items[] = $item;
        }

        $walker = new Walker_Nav_Menu_Checklist(array());

        echo '<div id="posttype-archive" class="posttypediv">';
        echo '<div id="tabs-panel-posttype-archive" class="tabs-panel tabs-panel-active">';
        echo '<ul id="posttype-archive-checklist" class="categorychecklist form-no-clear">';
        echo walk_nav_menu_tree(array_map('wp_setup_nav_menu_item', $items), 0, (object) array('walker' => $walker));
        echo '</ul>';
        echo '</div>';
        echo '</div>';

        echo '<p class="button-controls">';
        echo '<span class="add-to-menu">';
        echo '<input type="submit"' . disabled(1, 0) . ' class="button-secondary submit-add-to-menu right" value="' . __('Add to Menu', 'andromedamedia') . '" name="add-posttype-archive-menu-item" id="submit-posttype-archive" />';
        echo '<span class="spinner"></span>';
        echo '</span>';
        echo '</p>';

    endif;
}



