<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * bootstrap
 */

// error display parameters
ini_set('display_errors',1);
error_reporting(E_ALL);

// timezone
date_default_timezone_set('America/Winnipeg');

// constants
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__).DS);
define('APP', ROOT.'application'.DS);
define('CFG', APP.'config'.DS);
define('IMG', '../public/images/');
define('SCR', '../public/scripts/');
define('TAX', 0.13);

// start session
session_start();

// set autoload for classes
require_once CFG.'autoload.php';

