<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * registration form validation procdure
 */

function validate($validator)
{
    // errors array
    $errors = array();

    // cleanup fields first
    foreach ($_POST as $key => $value) {
        $_POST[$key] = \Components\Validator::cleanUp($value);
    }

    // first name
    if (empty($_POST['first_name'])) {
        $errors['first_name'] = 'First name could not be empty';
    } else {
        $result = $validator->nameCheck($_POST['first_name']);
        if ($result) {
            $errors['first_name'] = 'First name '.$result;
        }
    }

    // last name
    if (empty($_POST['last_name'])) {
        $errors['last_name'] = 'Last name could not be empty';
    } else {
        $result = $validator->nameCheck($_POST['last_name']);
        if ($result) {
            $errors['last_name'] = 'Last name '.$result;
        }
    }

    // birthdate
    if (empty($_POST['birthdate'])) {
        $errors['birthdate'] = 'Birthdate could not be empty';
    } else if(strtotime(date('Y-m-d')) <= strtotime($_POST['birthdate'])) {
        $errors['birthdate'] = 'Birthdate could not be in the future';
    }

    // phone
    if (empty($_POST['phone'])) {
        $errors['phone'] = 'Phone could not be empty';
    } else {
        $strippedPhone = $validator->stripPhone($_POST['phone']);
        $result = $validator->lenghtControl($strippedPhone, 10, 14);
        if ($result) {
            $errors['phone'] = 'Phone\'s '.$result.($strippedPhone !== $_POST['phone'] ? '; digits only' : '');
        }
        $_POST['phone'] = ($strippedPhone ? $validator->formatPhone($strippedPhone) : '');
    }

    // address
    if (empty($_POST['address'])) {
        $errors['address'] = 'Address could not be empty';
    } else {
        $result = $validator->addressCheck($_POST['address']);
        if ($result) {
            $errors['address'] = 'Address '.$result;
        }
    }

    // city
    if (empty($_POST['city'])) {
        $errors['city'] = 'City could not be empty';
    } else {
        $result = $validator->cityCheck($_POST['city']);
        if ($result) {
            $errors['city'] = 'City '.$result;
        }
    }

    // zip code
    if (empty($_POST['zip_code'])) {
        $errors['zip_code'] = 'ZIP code could not be empty';
    } else {
        $result = $validator->zipCheck(str_replace(' ', '', $_POST['zip_code']));
        if ($result) {
            $errors['zip_code'] = 'ZIP code '.$result;
        }
        $_POST['zip_code'] = $validator->formatZip($_POST['zip_code']);
    }

    // country
    if (empty($_POST['country'])) {
        $errors['country'] = 'Country could not be empty';
    }

    // doc ID number
    if (empty($_POST['doc_id_num'])) {
        $errors['doc_id_num'] = 'ID number could not be empty';
    } else {
        $result = $validator->addressCheck($_POST['doc_id_num']);
        if ($result) {
            $errors['doc_id_num'] = 'ID number '.$result;
        }
    }

    // doc ID valid date
    if (empty($_POST['doc_id_valid'])) {
        $errors['doc_id_valid'] = 'ID valid date could not be empty';
    } else if(strtotime(date('Y-m-d')) >= strtotime($_POST['doc_id_valid'])) {
        $errors['doc_id_valid'] = 'ID valid date could not be in the past';
    }

    // username
    if (empty($_POST['username'])) {
        $errors['username'] = 'Username could not be empty';
    } else {
        $result = $validator->usernameCheck($_POST['username']);
        if ($result) {
            $errors['username'] = 'Username '.$result;
        }
    }

    // email
    if (empty($_POST['email'])) {
        $errors['email'] = 'Email could not be empty';
    } else {
        $result = $validator->emailCheck($_POST['email']);
        if ($result) {
            $errors['email'] = 'Email '.$result;
        }
    }

    // password
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password could not be empty';
    } else {
        $result = $validator->passwordCheck($_POST['password']);
        if ($result) {
            $errors['password'] = 'Password '.$result;
        }
    }

    // confirm
    if ($_POST['confirm'] !== $_POST['password']) {
        $errors['confirm'] = 'Password and confirmation do not match';
    }

    return $errors;

}
