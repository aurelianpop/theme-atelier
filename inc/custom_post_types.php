<?php
/**
 * Created by PhpStorm.
 * User: Pop
 * Date: 2/14/2016
 * Time: 10:58 AM
 */

add_action( 'init', 'ta_custom_posts_init' );
/**
 * Register Children
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function ta_custom_posts_init() {
    $labels = array(
        'name'               => _x( 'Children', 'post type general name', 'your-plugin-textdomain' ),
        'singular_name'      => _x( 'Child', 'post type singular name', 'your-plugin-textdomain' ),
        'menu_name'          => _x( 'Children', 'admin menu', 'your-plugin-textdomain' ),
        'name_admin_bar'     => _x( 'Children', 'add new on admin bar', 'your-plugin-textdomain' ),
        'add_new'            => _x( 'Add Child', 'job', 'your-plugin-textdomain' ),
        'add_new_item'       => __( 'Add New Child', 'your-plugin-textdomain' ),
        'new_item'           => __( 'New Child', 'your-plugin-textdomain' ),
        'edit_item'          => __( 'Edit Child', 'your-plugin-textdomain' ),
        'view_item'          => __( 'View Child', 'your-plugin-textdomain' ),
        'all_items'          => __( 'All Children', 'your-plugin-textdomain' ),
        'search_items'       => __( 'Search Children', 'your-plugin-textdomain' ),
        'parent_item_colon'  => __( 'Parent Children:', 'your-plugin-textdomain' ),
        'not_found'          => __( 'No children found.', 'your-plugin-textdomain' ),
        'not_found_in_trash' => __( 'No children found in Trash.', 'your-plugin-textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'copii' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail' )
    );

    register_post_type( 'atelier_children', $args );

    $labels = array(
        'name'               => _x( 'Activitati', 'post type general name', 'your-plugin-textdomain' ),
        'singular_name'      => _x( 'Activity', 'post type singular name', 'your-plugin-textdomain' ),
        'menu_name'          => _x( 'Activities', 'admin menu', 'your-plugin-textdomain' ),
        'name_admin_bar'     => _x( 'Activities', 'add new on admin bar', 'your-plugin-textdomain' ),
        'add_new'            => _x( 'Add Activity', 'job', 'your-plugin-textdomain' ),
        'add_new_item'       => __( 'Add New Activity', 'your-plugin-textdomain' ),
        'new_item'           => __( 'New Activity', 'your-plugin-textdomain' ),
        'edit_item'          => __( 'Edit Activity', 'your-plugin-textdomain' ),
        'view_item'          => __( 'View Activity', 'your-plugin-textdomain' ),
        'all_items'          => __( 'All Activities', 'your-plugin-textdomain' ),
        'search_items'       => __( 'Search Activities', 'your-plugin-textdomain' ),
        'parent_item_colon'  => __( 'Parent Activities:', 'your-plugin-textdomain' ),
        'not_found'          => __( 'No activity found.', 'your-plugin-textdomain' ),
        'not_found_in_trash' => __( 'No activity found in Trash.', 'your-plugin-textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'activitati' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions' )
    );

    register_post_type( 'atelier_activities', $args );

    $labels = array(
        'name'               => _x( 'Causes', 'post type general name', 'your-plugin-textdomain' ),
        'singular_name'      => _x( 'Cause', 'post type singular name', 'your-plugin-textdomain' ),
        'menu_name'          => _x( 'Causes', 'admin menu', 'your-plugin-textdomain' ),
        'name_admin_bar'     => _x( 'Causes', 'add new on admin bar', 'your-plugin-textdomain' ),
        'add_new'            => _x( 'Add Cause', 'job', 'your-plugin-textdomain' ),
        'add_new_item'       => __( 'Add New Cause', 'your-plugin-textdomain' ),
        'new_item'           => __( 'New Cause', 'your-plugin-textdomain' ),
        'edit_item'          => __( 'Edit Cause', 'your-plugin-textdomain' ),
        'view_item'          => __( 'View Cause', 'your-plugin-textdomain' ),
        'all_items'          => __( 'All Causes', 'your-plugin-textdomain' ),
        'search_items'       => __( 'Search Causes', 'your-plugin-textdomain' ),
        'parent_item_colon'  => __( 'Parent Causes:', 'your-plugin-textdomain' ),
        'not_found'          => __( 'No cause found.', 'your-plugin-textdomain' ),
        'not_found_in_trash' => __( 'No cause found in Trash.', 'your-plugin-textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'causes' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions' )
    );

    register_post_type( 'atelier_causes', $args );
}



// hook into the init action and call create_jobs_taxonomies when it fires
add_action( 'init', 'create_children_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function create_children_taxonomies() {
    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Hobbies', 'taxonomy general name' ),
        'singular_name'     => _x( 'Hobby', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Hobbies' ),
        'all_items'         => __( 'All Hobbies' ),
        'parent_item'       => __( 'Parent Hobby' ),
        'parent_item_colon' => __( 'Parent Hobby:' ),
        'edit_item'         => __( 'Edit Hobby' ),
        'update_item'       => __( 'Update Hobby' ),
        'add_new_item'      => __( 'Add New Hobby' ),
        'new_item_name'     => __( 'New Hobby Name' ),
        'menu_name'         => __( 'Hobbies' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'hobbies' ),
    );

    register_taxonomy( 'atelier_hobbies', array( 'atelier_children' ), $args );

    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Activity Types', 'taxonomy general name' ),
        'singular_name'     => _x( 'Activity Type', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Activity Types' ),
        'all_items'         => __( 'All Activity Types' ),
        'parent_item'       => __( 'Parent Activity Type' ),
        'parent_item_colon' => __( 'Parent Activity Type:' ),
        'edit_item'         => __( 'Edit Activity Type' ),
        'update_item'       => __( 'Update Activity Type' ),
        'add_new_item'      => __( 'Add New Activity Type' ),
        'new_item_name'     => __( 'New Activity TypeActivity Types' ),
        'menu_name'         => __( 'Activity Types' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'activities_type' ),
    );

    register_taxonomy( 'atelier_activities_type', array( 'atelier_activities' ), $args );

}


