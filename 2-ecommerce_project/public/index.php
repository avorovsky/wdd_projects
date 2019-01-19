<?php

/*
 * front controller
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
    die('<strong>Boot</strong>: Could not find bootstrap &#9785;');
}

// start session
session_start();

// set a token
$token = new \Components\Token();
$token->run();

// call Router
$router = new \Components\Router();
$router->run();
