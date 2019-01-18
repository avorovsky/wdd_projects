<?php

/**
 * filename-based autoload for classes
 */

spl_autoload_register(function($className) {

    $fileName = lcfirst(str_replace('\\', '/', $className).'.php');

    if (file_exists(APP.$fileName)) {
        require_once APP.$fileName;
    } else {
        $m = new \Components\Message('Page you are looking for does not exists', 'warning');
        header('Location: /');
        //die('<strong>Autoload:</strong> Could not include class <em>'.$className.'</em> &#9785;');
        die;
    }

});
