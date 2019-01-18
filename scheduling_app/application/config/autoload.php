<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * autoload for classes
 */

// namespaces version
spl_autoload_register(function($className) {

    $fileName = APP.lcfirst(str_replace('\\', '/', $className).'.php');

    if (file_exists($fileName)) {
        require_once $fileName;
    } else {
        die('<strong>Autoload:</strong> Could not include class "'.$fileName.'" &#9785;');
    }

});

// filenames version
//spl_autoload_register(function($className) {
//
//    $fileName = $className.'.php';
//
//    // list of all possible folders
//    $pathClass = array(
//                'components',
//                'controllers',
//                'models',
//                );
//
//    foreach ($pathClass as $value) {
//
//        $filePath = APP.$value.DS.$fileName;
//
//        if (file_exists($filePath)) {
//            require $filePath;
//        }
//    }
//
//});
