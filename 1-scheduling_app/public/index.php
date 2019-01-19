<?php

//die('403 Forbidden');

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * Front controller
 */

// check if https
if (empty($_SERVER['HTTPS']) OR $_SERVER['HTTPS'] != 'on') {
    header('Location: https://' . $_SERVER["HTTP_HOST"]);
    die;
}

// initialization
if (file_exists('boot.php')) {
    require_once 'boot.php';
} else {
    die('<strong>Boot:</strong> Could not find myself &#9785;');
}

// set/check token
$token = new \Components\Token();
$token->run();

// call Router
$router = new \Components\Router();
$router->run();
