<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/* 
 * List of sections depending on role
 *
 * @return array - list of displayable sections
 */

if (!empty($_SESSION['username'])) {
    if (!empty($_SESSION['is_admin'])) {
        // admin
        return array(
            'event' => 'Events',
            'group' => 'Groups',
            'people' => 'People',
            'room' => 'Rooms',
            'course' => 'Courses',
            'book' => 'Books',
            'pages/about' => 'About',
            'pages/contact' => 'Contact',
            'register' => 'Register',
            'cart' => 'Cart',
            'dbinfo' => 'DB info',
        );
    }
    // authorized user
    return array(
        'event/my' => 'My events',
        'course' => 'Courses',
        'people/'.$_SESSION['id'] => 'Me',
        'pages/about' => 'About',
        'pages/contact' => 'Contact',
        'cart' => 'Cart',
    );
} else {
    // anonymous
    return array(
        'event' => 'Events',
        'course' => 'Courses',
        'pages/about' => 'About',
        'pages/contact' => 'Contact',
        'register' => 'Register',
    );
}
