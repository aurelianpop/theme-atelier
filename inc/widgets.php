<?php
/**
 * Created by PhpStorm.
 * User: Pop
 * Date: 2/21/2016
 * Time: 6:44 AM
 */

if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name'=> 'Header',
        'id' => 'atelier_header',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="offscreen">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name'=> 'Top Sidebar',
        'id' => 'atelier_top',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name'=> 'Left Sidebar',
        'id' => 'left_sidebar',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name'=> 'Right Sidebar',
        'id' => 'right_sidebar',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
}