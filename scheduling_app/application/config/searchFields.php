<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * returns list of tables and fields for search, depending on role
 *
 * @return array - searchable fields
 */

if (!empty($_SESSION['username'])) {
    if (!empty($_SESSION['is_admin'])) {
        // admin
        return array(
            array ('table' => 'book', 'field' => 'name'),
            array ('table' => 'book', 'field' => 'author'),
            array ('table' => 'book', 'field' => 'description'),
            array ('table' => 'book', 'field' => 'isbn'),
            array ('table' => 'book', 'field' => 'publisher'),
            array ('table' => 'course', 'field' => 'name'),
            array ('table' => 'course', 'field' => 'description'),
            array ('table' => 'event', 'field' => 'name'),
            array ('table' => 'group', 'field' => 'name'),
            array ('table' => 'people', 'field' => 'first_name'),
            array ('table' => 'people', 'field' => 'last_name'),
            array ('table' => 'people', 'field' => 'phone'),
            array ('table' => 'people', 'field' => 'address'),
            array ('table' => 'people', 'field' => 'city'),
            array ('table' => 'people', 'field' => 'zip_code'),
            array ('table' => 'people', 'field' => 'country'),
            array ('table' => 'people', 'field' => 'doc_id_num'),
            array ('table' => 'people', 'field' => 'username'),
            array ('table' => 'people', 'field' => 'email'),
            array ('table' => 'room', 'field' => 'number'),
            array ('table' => 'room', 'field' => 'description'),
        );
    }
    // authorized user
    return array(
        array ('table' => 'book', 'field' => 'name'),
        array ('table' => 'book', 'field' => 'author'),
        array ('table' => 'book', 'field' => 'description'),
        array ('table' => 'book', 'field' => 'isbn'),
        array ('table' => 'book', 'field' => 'publisher'),
        array ('table' => 'course', 'field' => 'name'),
        array ('table' => 'course', 'field' => 'description'),
        array ('table' => 'event', 'field' => 'name'),
        array ('table' => 'room', 'field' => 'number'),
        array ('table' => 'room', 'field' => 'description'),
    );
}

return [];
