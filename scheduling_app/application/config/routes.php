<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/* 
 * List of routes depending on role
 *
 * @return array - list of routes accessible
 */

if (!empty($_SESSION['username'])) {
    if (!empty($_SESSION['is_admin'])) {
        // admin
        return array(
            'event/([0-9]+)' => 'event/view/$1',
            'event/new' => 'event/new',
            'event/save' => 'event/save',
            'event/del/([0-9]+)' => 'event/del/$1',
            'event/my' => 'event/my',
            'event' => 'event/list',
            'course/([0-9]+)' => 'course/view/$1',
            'course/new' => 'course/new',
            'course/save' => 'course/save',
            'course/del/([0-9]+)' => 'course/del/$1',
            'course' => 'course/list',
            'group/([0-9]+)' => 'group/view/$1',
            'group/new' => 'group/new',
            'group/save' => 'group/save',
            'group/del/([0-9]+)' => 'group/del/$1',
            'group' => 'group/list',
            'people/([0-9]+)' => 'people/view/$1',
            'people/new' => 'people/new',
            'people/save' => 'people/save',
            'people/del/([0-9]+)' => 'people/del/$1',
            'people' => 'people/list',
            'room/([0-9]+)' => 'room/view/$1',
            'room/new' => 'room/new',
            'room/save' => 'room/save',
            'room/del/([0-9]+)' => 'room/del/$1',
            'room' => 'room/list',
            'register' => 'register/new',
            'signin/check' => 'signin/check',
            'signin/exit' => 'signin/exit',
            'signin' => 'signin/login',
            'pages/about' => 'pages/about',
            'pages/contact' => 'pages/contact',
            'book/([0-9]+)' => 'book/view/$1',
            'book/new' => 'book/new',
            'book/save' => 'book/save',
            'book/del/([0-9]+)' => 'book/del/$1',
            'book' => 'book/list',
            'cart/add/([0-9]+)' => 'cart/add/$1',
            'cart/del/([0-9]+)' => 'cart/del/$1',
            'cart/checkout' => 'cart/checkout',
            'cart' => 'cart/view',
            'search/suggest' => 'search/suggest',
            'search/result' => 'search/result',
            'dbinfo' => 'dbinfo/view',
        );
    }
    // authorized user
    return array(
        'event/([0-9]+)' => 'event/view/$1',
        'event/my' => 'event/my',
        'event' => 'event/list',
        'course/([0-9]+)' => 'course/view/$1',
        'course' => 'course/list',
        'group' => 'group/list',
        'people/'.$_SESSION['id'] => 'people/view/'.$_SESSION['id'],
        'people/save' => 'people/save',
        'people' => 'event/my', // special route after people/save, 'cause people/list is forbidden
        'signin/exit' => 'signin/exit',
        'signin' => 'signin/login',
        'pages/about' => 'pages/about',
        'pages/contact' => 'pages/contact',
        'book/([0-9]+)' => 'book/view/$1',
        'cart/add/([0-9]+)' => 'cart/add/$1',
        'cart/del/([0-9]+)' => 'cart/del/$1',
        'cart/checkout' => 'cart/checkout',
        'cart' => 'cart/view',
        'search/suggest' => 'search/suggest',
        'search/result' => 'search/result',
    );
} else {
    // anonymous
    return array(
        'event' => 'event/list',
        'course' => 'course/list',
        'register' => 'register/new',
        'signin/check' => 'signin/check',
        'signin/exit' => 'signin/exit',
        'signin' => 'signin/login',
        'pages/about' => 'pages/about',
        'pages/contact' => 'pages/contact',
    );
}
