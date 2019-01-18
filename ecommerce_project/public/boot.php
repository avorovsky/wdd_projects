<?php

// error display parameters
ini_set('display_errors',1);
error_reporting(E_ALL);

// timezone
date_default_timezone_set('America/Winnipeg');

// constants
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__).DS);
define('APP', ROOT.'application'.DS);
define('CFG', APP.'configs'.DS);
define('TMPL', APP.'templates'.DS);
define('PUB', DS.'public'.DS);
define('IMG', PUB.'images'.DS);
define('IMGPH', IMG.'no_image.jpg');

// autoload classes
if (file_exists(CFG.'autoload.php')) {
    require_once CFG.'autoload.php';
} else {
    die('<strong>Boot</strong>: Could not initialize autoload &#9785;');
}

// check DB-connection
$db = new \Components\Db();
