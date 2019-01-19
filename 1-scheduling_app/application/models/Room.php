<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * Room model
 */

namespace Models;

class Room
{
    /*
     * saves item to database
     *
     * @param string - image binary data (optional)
     * @return int - id od item saved
     */
    public static function saveRoomItem()
    {
        // cancel clicked
        if (isset($_POST['cancel'])) {
            return false;
        }
        
        $id = intval($_POST['id']);

        if ($id) {
            // update existing record
            $queryString = 
                    'UPDATE `room` SET '.
                    'number = "'.$_POST['number'].'", '.
                    'description="'.$_POST['description'].'", '.
                    'capacity='.$_POST['capacity'].', '.
                    'modified = CURRENT_TIMESTAMP '.
                    'WHERE id='.$_POST['id'];
            $paramsArray = array(
                    ':number' => $_POST['number'],
                    ':description' => $_POST['description'],
                    ':capacity' => $_POST['capacity'],
                    ':id' => $id,
                    );
        } else {
            // insert new record
            $queryString =
                    'INSERT INTO `room` (number, description, capacity) VALUES ('.
                    ':number, '.
                    ':description, '.
                    ':capacity)';
            $paramsArray = array(
                    ':number' => $_POST['number'],
                    ':description' => $_POST['description'],
                    ':capacity' => $_POST['capacity'],
                    );
        }
        
        // query
        $result = \Components\DbQuery::getResult($queryString, $paramsArray, 1);
        
        // set message
        $message = new \Components\Message('Room '.$_POST['number'].' saved', 'success');

        return $result;
        
    }
    
    /*
     * returns empty item
     *
     * @return array - fields of item requred
     */
    public static function getRoomNewItem()
    {
        // list of fields
        $queryString = 'DESCRIBE `room`';

        // query
        $result = \Components\DbQuery::getResult($queryString);
        
        // results to array
        $roomItem = array();
        
        foreach ($result as $value) {
            // name of field is a key, empty value
            $roomItem[$value['Field']] = '';
        }
        
        return $roomItem;
        
    }
    
    /*
     * returns one item by id
     *
     * @param int - id of item requested
     * @return array - details if item requested
     */
    public static function getRoomItemById($id)
    {
        
        $id = intval($id);

        if ($id) {
            // query
            $queryString = 'SELECT * FROM `room` WHERE id = :id';
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
    public static function getRoomList()
    {
        // query
        $queryString = 'SELECT * FROM `room` ORDER BY number ASC';
        
        $result = \Components\DbQuery::getResult($queryString);
        
        return $result;
        
    }

    /*
     * marks item as deleted/restore
     *
     * @param int - id of item to be deleted
     */
    public static function delRoomItemById($id)
    {

        $id = intval($id);
        if ($id) {

            $data = \Models\Room::getRoomItemById($id);

            // query
            $queryString = 'UPDATE `room` SET deleted='.abs($data['deleted']-1).' WHERE id = :id';
            $paramsArray = array(
                    ':id' => $id,
                    );

            $result = \Components\DbQuery::getResult($queryString, $paramsArray, 1);

            // set message
            $message = new \Components\Message('Room '.$data['number'].(empty($data['deleted']) ? ' marked as deleted' : ' restored'), 'success');

        }

        header('Location: /room');
        die;

    }

}
