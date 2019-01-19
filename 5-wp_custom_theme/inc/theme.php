<?php

/**
 * Function is to register WP-thumbnails
 *
 * @return void
 */
if (function_exists('add_theme_support')) {

    add_theme_support('post-thumbnails');
 
}

/**
 * Function is to register WP-menus
 *
 * @return void
 */
if (function_exists('register_nav_menus')) {
    register_nav_menus();
}