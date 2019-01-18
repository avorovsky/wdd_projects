<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * Course model
 */

namespace Models;

class Course
{

    /*
     * saves item to database
     *
     * @param string - image binary data (optional)
     * @return int - id od item saved
     */
    public static function saveCourseItem($blob = [])
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
            // update existing record
            $queryString = 
                    'UPDATE `course` SET '.
                    'name = :name, '.
                    'description = :description, '.
                    $queryImage.
                    'price = :price, '.
                    'modified = CURRENT_TIMESTAMP '.
                    'WHERE id = :id';
            $paramsArray = array_merge($arrayImage, array(
                    ':name' => $_POST['name'],
                    ':description' => $_POST['description'],
                    ':price' => $_POST['price'],
                    ':id' => $id,
                    ));
        } else {
            // insert new record
            $queryString =
                    'INSERT INTO `course` (name, description,  image, image_mime, price) '.
                    'VALUES ('.
                    ':name, '.
                    ':description, '.
                    ':image, '.
                    ':image_mime, '.
                    ':price)';
            $paramsArray = array(
                    ':name' => $_POST['name'],
                    ':description' => $_POST['description'],
                    ':image' => (empty($blob['image'])? '' : $blob['image']),
                    ':image_mime' => (empty($blob['image_mime'])? '' : $blob['image_mime']),
                    ':price' => $_POST['price'],
                    );
        }
        
        // query
        $result = \Components\DbQuery::getResult($queryString, $paramsArray, 1);
        
        // set message
        $message = new \Components\Message('Course '.$_POST['name'].' saved', 'success');

        return $result;
        
    }
    
    /*
     * returns empty item
     *
     * @return array - fields of item requred
     */
    public static function getCourseNewItem()
    {
        // list of fields
        $queryString = 'DESCRIBE `course`';

        // query
        $result = \Components\DbQuery::getResult($queryString);
        
        // results to array
        $courseItem = array();
        
        foreach ($result as $value) {
            // name of field is a key, empty value
            $courseItem[$value['Field']] = '';
        }
        
        return $courseItem;
        
    }
    
    /*
     * returns one item by id
     *
     * @param int - id of item requested
     * @return array - details if item requested
     */
    public static function getCourseItemById($id)
    {
        
        $id = intval($id);

        if ($id) {
            // query
            $queryString = 'SELECT * FROM `course` WHERE id = :id';
            $paramsArray = array(
                    ':id' => $id,
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
    public static function getCourseList()
    {
        // show deleted records for admin only
        $noDeleted = (empty($_SESSION['is_admin']) ? 'WHERE course.deleted<>1 ' : '');

        // query
        $queryString = 'SELECT * FROM `course` '.$noDeleted.'ORDER BY name ASC';
        
        $result = \Components\DbQuery::getResult($queryString);
        
        return $result;
        
    }

    /*
     * marks item as deleted/restore
     *
     * @param int - id of item to be deleted
     */
    public static function delCourseItemById($id)
    {

        $id = intval($id);
        if ($id) {

            $data = \Models\Course::getCourseItemById($id);

            // query
            $queryString = 'UPDATE `course` SET deleted='.abs($data['deleted']-1).' WHERE id = :id';
            $paramsArray = array(
                    ':id' => $id,
                    );

            $result = \Components\DbQuery::getResult($queryString, $paramsArray, 1);

            // set message
            $message = new \Components\Message('Course '.$data['name'].(empty($data['deleted']) ? ' marked as deleted' : ' restored'), 'success');

        }

        header('Location: /course');
        die;

    }
    
}
