<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * registration form point of entry
 */

$validator = new \Components\Validator();

// errors array
$errors = array();

// form to include
$includeName = APP.'views'.DS.'register'.DS.'itemForm.php';

// in-page actions
if (isset($_POST['send'])) {

    include APP.'views'.DS.'register'.DS.'validate.php';

    // return values to fields
    foreach ($data as $key => $value) {
        $data[$key] = (isset($_POST[$key]) ? $_POST[$key] : '');
    }

    // calling form validation function
    $errors = validate($validator);

    if(empty($errors)) {
        //no errors, should go to save

        $savePeople = new \Models\People();
        $newId = $savePeople->savePeopleItem();

        $data = $savePeople->getPeopleItemById($newId);

        $includeName = APP.'views'.DS.'register'.DS.'itemSuccess.php';
    } else {

        // flash message
        $message = new \Components\Message('We found some errors. Please check below', 'error');
        echo $message->getMessage();

    }

}

include $includeName;

?>
<br/>
<span class="db_data">Modified: <?=(!empty($data['modified']) ? $data['modified'] : 'N/A')?></span>
<span class="db_data">Created: <?=(!empty($data['created']) ? $data['created'] : 'N/A')?></span>
<span class="db_data">ID: <?=(!empty($data['id']) ? $data['id'] : 'N/A')?></span>
