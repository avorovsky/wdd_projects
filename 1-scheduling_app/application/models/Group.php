<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * Group model
 */

namespace Models;

class Group
{
    /*
     * saves item to database
     *
     * @param string - image binary data (optional)
     * @return int - id od item saved
     */
    public static function saveGroupItem()
    {
        // cancel clicked
        if (isset($_POST['cancel'])) {
            return false;
        }
        
        $id = intval($_POST['id']);

        if ($id) {
            // update existing record
            $queryString = 
                    'UPDATE `group` SET '.
                    'name = :name, '.
                    'course_id = :course_id, '.
                    'modified = CURRENT_TIMESTAMP '.
                    'WHERE id = :id';
            $paramsArray = array(
                    ':name' => $_POST['name'],
                    ':course_id' => $_POST['course_id'],
                    ':id' => $id,
                    );
        } else {
            // insert new record
            $queryString =
                    'INSERT INTO `group` (name, course_id) VALUES ('.
                    ':name, '.
                    ':course_id)';
            $paramsArray = array(
                    ':name' => $_POST['name'],
                    ':course_id' => $_POST['course_id'],
                    );
        }
        
        // query
        $result = \Components\DbQuery::getResult($queryString, $paramsArray, 1);
        
        // set message
        $message = new \Components\Message('Group '.$_POST['name'].' saved', 'success');

        return $result;
        
    }
    
    /*
     * returns empty item
     *
     * @return array - fields of item requred
     */
    public static function getGroupNewItem()
    {
        // list of fields
        $queryString = 'DESCRIBE `group`';

        // query
        $result = \Components\DbQuery::getResult($queryString);
        
        // results to array
        $groupItem = array();
        
        foreach ($result as $value) {
            // name of field is a key, empty value
            $groupItem[$value['Field']] = '';
        }
        
        return $groupItem;
        
    }
    
    /*
     * returns one item by id
     *
     * @param int - id of item requested
     * @return array - details if item requested
     */
    public static function getGroupItemById($id)
    {
        
        $id = intval($id);

        if ($id) {
            // query
            $queryString = 'SELECT * FROM `group` WHERE id = :id';
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
    public static function getGroupList()
    {
        // query
        $queryString = 'SELECT group.id, group.name, group.modified, '.
                       'group.created, group.deleted, '.
                       'course.name AS course_name '.
                       'FROM `group` '.
                       'JOIN `course` ON group.course_id=course.id '.
                       'ORDER BY group.created DESC';
        $result = \Components\DbQuery::getResult($queryString);
        
        return $result;
        
    }

    /*
     * marks item as deleted/restore
     *
     * @param int - id of item to be deleted
     */
    public static function delGroupItemById($id)
    {

        $id = intval($id);
        if ($id) {

            $data = \Models\Group::getGroupItemById($id);

            // query
            $queryString = 'UPDATE `group` SET deleted='.abs($data['deleted']-1).' WHERE id = :id';
            $paramsArray = array(
                    ':id' => $id,
                    );

            $result = \Components\DbQuery::getResult($queryString, $paramsArray, 1);

            // set message
            $message = new \Components\Message('Group '.$data['name'].(empty($data['deleted']) ? ' marked as deleted' : ' restored'), 'success');

        }

        header('Location: /group');
        die;

    }

}
