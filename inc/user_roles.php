<?php
/**
 * Created by PhpStorm.
 * User: Pop
 * Date: 2/14/2016
 * Time: 11:20 AM
 */

// remove the other user roles so we can have a clean site

remove_role('subscriber');
remove_role('employer');
remove_role('contributor');
remove_role('author');
remove_role('editor');

// Add parent and partner user roles
add_role(
    'parent',
    __('Parent'),
    array(
        'read' => true,  // true allows this capability
        'edit_posts' => false,
        'publish_posts' => false,
        'delete_posts' => false // Use false to explicitly deny
    )
);

add_role(
    'partner',
    __('Partner'),
    array(
        'read' => true,  // true allows this capability
        'edit_posts' => false,
        'publish_posts' => false,
        'delete_posts' => false // Use false to explicitly deny
    )
);


add_action('show_user_profile', 'atelier_show_extra_profile_fields');
add_action('edit_user_profile', 'atelier_show_extra_profile_fields');
add_action("user_new_form", "atelier_show_extra_profile_fields");

function atelier_show_extra_profile_fields($user)
{

    require_once(dirname(dirname(__FILE__)) . '/partials/user-fields.php');
}

add_action('personal_options_update', 'atelier_save_extra_profile_fields');
add_action('edit_user_profile_update', 'atelier_save_extra_profile_fields');
add_action('user_register', 'atelier_save_extra_profile_fields');

function atelier_save_extra_profile_fields($user_id)
{

    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }

    /* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
    update_user_meta($user_id, 'phone', $_POST['phone']);
    update_user_meta($user_id, 'cnp', $_POST['cnp']);
    update_user_meta($user_id, 'address', $_POST['address']);
    update_user_meta($user_id, 'job', $_POST['job']);
    update_user_meta($user_id, 'help', $_POST['help']);
    update_user_meta($user_id, 'children', $_POST['children']);
    update_user_meta($user_id, 'anonymus', $_POST['anonymus']);
    update_user_meta($user_id, 'has_children', $_POST['has_children']);
    update_user_meta($user_id, 'married', $_POST['married']);
    update_user_meta($user_id, 'logo', $_POST['logo']);
    update_user_meta($user_id, 'contact_name', $_POST['contact_name']);
    update_user_meta($user_id, 'contact_surname', $_POST['contact_surname']);
    update_user_meta($user_id, 'contact_function', $_POST['contact_function']);
    update_user_meta($user_id, 'contact_phone', $_POST['contact_phone']);
}

add_filter('manage_users_columns', 'atelier_add_user_columns');

/**
 * Adds meta columns to the user display dashboard.
 */
function atelier_add_user_columns($columns)
{

    //Parents
    $columns['phone'] = __('Phone', 'theme');
    $columns['cnp'] = __('CNP', 'theme');
    $columns['address'] = __('Address', 'theme');
    $columns['job'] = __('Job Details', 'theme');
    $columns['help'] = __('Help Type', 'theme');
    $columns['children'] = __('Children', 'theme');
    $columns['anonymus'] = __('Anonymus', 'theme');
    $columns['has_children'] = __('Has Children', 'theme');
    $columns['married'] = __('Marital Status', 'theme');

    // Partners
    $columns['contact_name'] = __('Contact Name', 'theme');
    $columns['contact_surname'] = __('Contact Surname', 'theme');
    $columns['contact_function'] = __('Contact Function', 'theme');
    $columns['contact_phone'] = __('Contact Phone', 'theme');


    return $columns;

}

add_action('manage_users_custom_column', 'atelier_show_user_data', 10, 3);

/**
 * Populates the columns with the specified user's metadata
 *
 * @param    $value        An empty string
 * @param    $column_name    The name of the column to populate
 * @param    $user_id    The ID of the user for which we're working with
 * @return            The zip code associated with the user
 */
function atelier_show_user_data($value, $column_name, $user_id)
{
    if ('phone' == $column_name) {
        return get_user_meta($user_id, 'phone', true);
    }

    if ('cnp' == $column_name) {
        return get_user_meta($user_id, 'cnp', true);
    }

    if ('address' == $column_name) {
        return get_user_meta($user_id, 'address', true);
    }

    if ('job' == $column_name) {
        return get_user_meta($user_id, 'job', true);
    }

    if ('help' == $column_name) {
        return get_user_meta($user_id, 'help', true);
    }

    if ('children' == $column_name) {
        $the_children = get_user_meta($user_id, 'children', false);

        $children = "";
        foreach ($the_children as $childs) {
            if($childs) {
                foreach ($childs as $child_id) {
                    $child = get_post($child_id);
                    $children .= $child->post_title . ", ";
                }
            }

        }
        return $children;
    }

    if ('anonymus' == $column_name) {
        return get_user_meta($user_id, 'anonymus', true);
    }

    if ('has_children' == $column_name) {
        return get_user_meta($user_id, 'has_children', true);
    }

    if ('married' == $column_name) {
        return get_user_meta($user_id, 'married', true);
    }

    if ('contact_name' == $column_name) {
        return get_user_meta($user_id, 'contact_name', true);
    }

    if ('contact_surname' == $column_name) {
        return get_user_meta($user_id, 'contact_surname', true);
    }

    if ('contact_function' == $column_name) {
        return get_user_meta($user_id, 'contact_function', true);
    }

    if ('contact_phone' == $column_name) {
        return get_user_meta($user_id, 'contact_phone', true);
    }
}

add_action('wp_ajax_progressive_children_search', 'atelier_progresive_search_action');

/**
 * Progresive search for the children input function
 */
function atelier_progresive_search_action()
{
    // being an input let's do some cleanup
    $s = wp_unslash($_POST['q']);
    $s = trim($s);

    //search for the posts we need
    $args = array(
        'post_type' => array('atelier_children'),
        'orderby' => 'ID',
        'order' => 'ASC',
        'post_status' => 'publish',
        's' => $s,
        'numberposts' => -1
    );
    $posts_array = get_posts($args);

    //get the id and title
    foreach ($posts_array as $post) {
        $results[$post->ID]['id'] = $post->ID;
        $results[$post->ID]['title'] = $post->post_title;
    }

    // if we have results return them otherwise return an empty string
    if (isset($results)) {
        print_r(json_encode($results));
    } else {
        echo '';
    }

    wp_die(); // this is required to terminate immediately and return a proper response
}








