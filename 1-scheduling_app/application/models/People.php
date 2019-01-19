<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * People model
 */

namespace Models;

class People
{
    /*
     * saves item to database
     *
     * @param string - image binary data (optional)
     * @return int - id od item saved
     */
    public static function savePeopleItem($blob = [])
    {
        // cancel clicked
        if (isset($_POST['cancel'])) {
            return false;
        }
        
        $id = intval($_POST['id']);

        if ($id) {
            // if image is not passed, do not update image
            if (empty($blob['image']) || empty($blob['image_mime'])) {
                $queryImage = '';
                $arrayImage = [];
            } else {
                $queryImage = 
                    'image = :image, '.
                    'image_mime = :image_mime, ';
                $arrayImage = array(
                    ':image' => (empty($blob['image'])? '' : $blob['image']),
                    ':image_mime' => (empty($blob['image_mime'])? '' : $blob['image_mime']),
                    );
            }
            // if password is not passed, do not update
            if (empty($_POST['password'])) {
                $queryPassword = '';
                $arrayPassword = [];
            } else {
                $queryPassword =
                    'password = :password, ';
                $arrayPassword = array(
                    ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    );
            }
            // update existing record
            $queryString = 
                    'UPDATE `people` SET '.
                    'first_name = :first_name, '.
                    'last_name = :last_name, '.
                    'birthdate = :birthdate, '.
                    'phone = :phone, '.
                    'address = :address, '.
                    'city = :city, '.
                    'zip_code = :zip_code, '.
                    'country = :country, '.
                    'doc_id_num = :doc_id_num, '.
                    'doc_id_valid = :doc_id_valid, '.
                    'username = :username, '.
                    'email = :email, '.
                    $queryPassword.
                    $queryImage.
                    'comment = :comment, '.
                    'is_student = :is_student, '.
                    'is_instructor = :is_instructor, '.
                    'is_admin = :is_admin, '.
                    'not_verified = :not_verified, '.
                    'modified = CURRENT_TIMESTAMP '.
                    'WHERE id = :id';
            $paramsArray = array_merge($arrayImage, $arrayPassword, array(
                    ':first_name' => $_POST['first_name'],
                    ':last_name' => $_POST['last_name'],
                    ':birthdate' => $_POST['birthdate'],
                    ':phone' => $_POST['phone'],
                    ':address' => $_POST['address'],
                    ':city' => $_POST['city'],
                    ':zip_code' => $_POST['zip_code'],
                    ':country' => $_POST['country'],
                    ':doc_id_num' => $_POST['doc_id_num'],
                    ':doc_id_valid' => $_POST['doc_id_valid'],
                    ':username' => $_POST['username'],
                    ':email' => $_POST['email'],
                    ':comment' => $_POST['comment'],
                    ':is_student' => (isset($_POST['is_student']) ? 1 : 0),
                    ':is_instructor' => (isset($_POST['is_instructor']) ? 1 : 0),
                    ':is_admin' => (isset($_POST['is_admin']) ? 1 : 0),
                    ':not_verified' => (isset($_POST['not_verified']) ? 1 : 0),
                    ':id' => $id,
                    ));
        } else {
            
            // insert new record
            $queryString =
                    'INSERT INTO `people` (first_name, last_name, birthdate, '.
                    'phone, address, city, zip_code, country, doc_id_num, '.
                    'doc_id_valid, username, email, password, image, image_mime, '.
                    'comment, is_student, is_instructor, is_admin, not_verified) '.
                    'VALUES ('.
                    ':first_name, '.
                    ':last_name, '.
                    ':birthdate, '.
                    ':phone, '.
                    ':address, '.
                    ':city, '.
                    ':zip_code, '.
                    ':country, '.
                    ':doc_id_num, '.
                    ':doc_id_valid, '.
                    ':username, '.
                    ':email, '.
                    ':password, '.
                    ':image, '.
                    ':image_mime, '.
                    ':comment, '.
                    ':is_student, '.
                    ':is_instructor, '.
                    ':is_admin, '.
                    ':not_verified)';
            $paramsArray = array(
                    ':first_name' => $_POST['first_name'],
                    ':last_name' => $_POST['last_name'],
                    ':birthdate' => $_POST['birthdate'],
                    ':phone' => $_POST['phone'],
                    ':address' => $_POST['address'],
                    ':city' => $_POST['city'],
                    ':zip_code' => $_POST['zip_code'],
                    ':country' => $_POST['country'],
                    ':doc_id_num' => $_POST['doc_id_num'],
                    ':doc_id_valid' => $_POST['doc_id_valid'],
                    ':username' => $_POST['username'],
                    ':email' => $_POST['email'],
                    ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                    ':image' => (empty($blob['image'])? '' : $blob['image']),
                    ':image_mime' => (empty($blob['image_mime'])? '' : $blob['image_mime']),
                    ':comment' => $_POST['comment'],
                    ':is_student' => (isset($_POST['is_student']) ? 1 : 0),
                    ':is_instructor' => (isset($_POST['is_instructor']) ? 1 : 0),
                    ':is_admin' => (isset($_POST['is_admin']) ? 1 : 0),
                    ':not_verified' => (isset($_POST['not_verified']) ? 1 : 0),
                    );
        }

        // query
        $result = \Components\DbQuery::getResult($queryString, $paramsArray, 1);
        
        // set message
        $message = new \Components\Message('Person '.$_POST['first_name'].' '.$_POST['last_name'].' saved', 'success');

        return $result;
        
    }
    
    /*
     * returns empty item
     *
     * @return array - fields of item requred
     */
    public static function getPeopleNewItem()
    {
        // list of fields
        $queryString = 'DESCRIBE `people`';

        // query
        $result = \Components\DbQuery::getResult($queryString);
        
        // results to array
        $peopleItem = array();
        
        foreach ($result as $value) {
            // name of field is a key, empty value
            $peopleItem[$value['Field']] = '';
        }
        
        return $peopleItem;
        
    }
    
    /*
     * returns one item by id
     *
     * @param int - id of item requested
     * @return array - details if item requested
     */
    public static function getPeopleItemById($id)
    {
        
        $id = intval($id);

        if ($id) {
            // query
            $queryString = 'SELECT * FROM `people` WHERE id = :id';
            $paramsArray = array(
                    ':id' => $id,
                    );
            $result = \Components\DbQuery::getResult($queryString, $paramsArray);
            
            return (empty($result) ? [] : $result[0]);
        }
        
        return [];
        
    }
    
    /*
     * returns one item by username
     *
     * @param string - username of item requested
     * @return array - details if item requested
     */
    public static function getPeopleItemByUsername($username)
    {

        $username = preg_replace('!\s+!', '', htmlspecialchars(strip_tags(stripslashes(trim($username)))));

        if ($username) {
            // query
            $queryString = 'SELECT * FROM `people` WHERE username = :username';
            $paramsArray = array(
                           ':username' => $username,
                           );

            $result = \Components\DbQuery::getResult($queryString, $paramsArray);

            return (empty($result) ? [] : $result[0]);

        }

        return [];

    }

    /*
     * returns one item by email
     *
     * @param string - email of item requested
     * @return array - details if item requested
     */
    public static function getPeopleItemByEmail($email)
    {

        if ($email) {
            // query
            $queryString = 'SELECT * FROM `people` WHERE email = :email';
            $paramsArray = array(
                           ':email' => $email,
                           );

            $result = \Components\DbQuery::getResult($queryString, $paramsArray);

            return (empty($result) ? [] : $result[0]);

        }

        return [];

    }

    /*
     * returns list of items as an array
     *
     * @return array - list of items/details
     */
    public static function getPeopleList($role='')
    {
        // query
        $queryString = 'SELECT * FROM `people` '.
                       ($role == 's' ? 'WHERE is_student = 1 ' : '').
                       ($role == 'i' ? 'WHERE is_instructor = 1 ' : '').
                       ($role == 'a' ? 'WHERE is_admin = 1 ' : '').
                       ($role == 'v' ? 'WHERE not_verified = 1 ' : '').
                       'ORDER BY last_name ASC';
        
        $result = \Components\DbQuery::getResult($queryString);
        
        return $result;
        
    }

    /*
     * marks item as deleted/restore
     *
     * @param int - id of item to be deleted
     */
    public static function delPeopleItemById($id)
    {

        $id = intval($id);
        if ($id) {

            $data = \Models\People::getPeopleItemById($id);

            // query
            $queryString = 'UPDATE `people` SET deleted='.abs($data['deleted']-1).' WHERE id = :id';
            $paramsArray = array(
                    ':id' => $id,
                    );

            $result = \Components\DbQuery::getResult($queryString, $paramsArray, 1);

            // set message
            $message = new \Components\Message('Person '.$data['first_name'].' '.$data['last_name'].(empty($data['deleted']) ? ' marked as deleted' : ' restored'), 'success');

        }

        header('Location: /people');
        die;

    }

}
