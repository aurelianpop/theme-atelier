<?php
/**
 * Created by PhpStorm.
 * User: Pop
 * Date: 2/21/2016
 * Time: 6:44 AM
 */

if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name'=> 'Footer Area',
        'id' => 'at_footer_area',
        'before_widget' => '<div id="%1$s" class="widget col s12 m3 %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3><hr class="white-text" />',
    ));
}