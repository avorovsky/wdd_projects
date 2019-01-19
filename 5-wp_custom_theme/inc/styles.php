<?php

/**
 * Loads libraries and styles
 * 
 * @return void
 */
if (!function_exists('load_my_styles')) {

    function load_my_styles() {

        wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css', [], '4.1.3', 'all');

        wp_enqueue_style('assignment2', get_stylesheet_uri(), ['bootstrap'], false, 'all');

        wp_enqueue_style('font-awesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', ['bootstrap'], '4.7.0', 'all');

        wp_enqueue_script('bootstrapjs', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', ['jquery'], '4.1.3', true);

    }

    add_action('wp_enqueue_scripts', 'load_my_styles', 10, 1);

}
