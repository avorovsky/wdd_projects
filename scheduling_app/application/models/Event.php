<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * Event model
 */

namespace Models;

class Event
{
    /*
     * saves item to database
     *
     * @param string - image binary data (optional)
     * @return int - id od item saved
     */
    public static function saveEventItem()
    {
        // cancel clicked
        if (isset($_POST['cancel'])) {
            return false;
        }
        
        $id = intval($_POST['id']);

        if ($id) {
            // update existing record
            $queryString = 
                    'UPDATE `event` SET '.
                    'name = :name, '.
                    'room_id = :room_id, '.
                    'group_id = :group_id, '.
                    'instructor_id = :instructor_id, '.
                    'datetime_from = :datetime_from, '.
                    'datetime_to = :datetime_to, '.
                    'modified = CURRENT_TIMESTAMP '.
                    'WHERE id = :id';
            $paramsArray = array(
                    ':name' => $_POST['name'],
                    ':room_id' => $_POST['room'],
                    ':group_id' => $_POST['group'],
                    ':instructor_id' => empty($_POST['instructor']) ? $_SESSION['id'] : $_POST['instructor'],
                    ':datetime_from' => $_POST['date'].' '.$_POST['time_from'],
                    ':datetime_to' => $_POST['date'].' '.$_POST['time_to'],
                    ':id' => $id,
                    );
        } else {
            // insert new record
            $queryString =
                    'INSERT INTO `event` (name, room_id, group_id, instructor_id, '.
                    'datetime_from, datetime_to) VALUES ('.
                    ':name, '.
                    ':room_id, '.
                    ':group_id, '.
                    ':instructor_id, '.
                    ':datetime_from, '.
                    ':datetime_to)';
            $paramsArray = array(
                    ':name' => $_POST['name'],
                    ':room_id' => $_POST['room'],
                    ':group_id' => $_POST['group'],
                    ':instructor_id' => empty($_POST['instructor']) ? $_SESSION['id'] : $_POST['instructor'],
                    ':datetime_from' => $_POST['date'].' '.$_POST['time_from'],
                    ':datetime_to' => $_POST['date'].' '.$_POST['time_to'],
                    );
        }

        // query
        $result = \Components\DbQuery::getResult($queryString, $paramsArray, 1);
        
        // set message
        $message = new \Components\Message('Event '.$_POST['name'].' saved', 'success');

        return $result;
        
    }
    
    /*
     * returns empty item
     *
     * @return array - fields of item requred
     */
    public static function getEventNewItem()
    {
        // list of fields
        $queryString = 'DESCRIBE `event`';

        // query
        $result = \Components\DbQuery::getResult($queryString);
        
        // results to array
        $eventItem = array();
        
        foreach ($result as $value) {
            // name of field is a key, empty value
            $eventItem[$value['Field']] = '';
        }
        
        // default values for trnsforming fields
        $eventItem['date'] = date("Y-m-d");
        $eventItem['time_from'] = '09:00';
        $eventItem['time_to'] = '10:00';
        
        return $eventItem;
        
    }
    
    /*
     * returns one item by id
     *
     * @param int - id of item requested
     * @return array - details if item requested
     */
    public static function getEventItemById($id)
    {
        
        $id = intval($id);

        if ($id) {
            // query
            $queryString = 'SELECT id, name, room_id, group_id, instructor_id, '.
                           'created, modified, deleted, '.
                           'DATE_FORMAT(datetime_from, "%Y-%m-%d") AS date, '.
                           'DATE_FORMAT(datetime_from, "%H:%i") AS time_from, '.
                           'DATE_FORMAT(datetime_to, "%H:%i") AS time_to '.
                           'FROM `event` '.
                           'WHERE id = :id';
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
    public static function getEventList($dateFrom, $dateTo)
    {

        // show deleted records for admin only
        $noDeleted = (empty($_SESSION['is_admin']) ? 'AND event.deleted<>1 ' : '');

        // query
        $queryString = 'SELECT event.id, event.name, event.room_id, event.group_id, event.instructor_id, '.
                       'DATE_FORMAT(datetime_from, "%M %e, %Y") AS date_string, '.
                       'DATE_FORMAT(datetime_from, "%Y-%m-%d") AS date, '.
                       'DATE_FORMAT(datetime_from, "%a") AS weekday, '.
                       'DATE_FORMAT(datetime_from, "%l:%i %p") AS time_from, '.
                       'DATE_FORMAT(datetime_to, "%l:%i %p") AS time_to, '.
                       'event.created, event.modified, event.deleted, '.
                       'group.name AS group_name, '.
                       'room.number AS room, '.
                       'people.first_name, people.last_name '.
                       'FROM `event` '.
                       'JOIN `group` ON group.id = group_id '.
                       'JOIN `room` ON room.id = room_id '.
                       'JOIN `people` ON people.id = instructor_id '.
                       'WHERE (event.datetime_from BETWEEN "'.
                       $dateFrom.' 00:00:00" AND "'.
                       $dateTo.' 23:59:59") '.
                       $noDeleted.
                       'ORDER BY datetime_from ASC, datetime_to ASC';

        $result = \Components\DbQuery::getResult($queryString);

        return $result;
        
    }
    
    /*
     * returns list of items by criterias
     *
     * @param string - date of start
     * @param string - date of end
     * @param int - id of item related
     * @return array - list of items/details
     */
    public static function getMyEventList($dateFrom, $dateTo, $id)
    {
                
        $id = intval($id);

        // list of related groups
        $my_groups = 'SELECT group_id FROM `people_in_group` WHERE people_id = :id';
        
        // query
        $queryString = 'SELECT event.id, event.name, event.room_id, event.group_id, event.instructor_id, '.
                       'DATE_FORMAT(datetime_from, "%M %e, %Y") AS date_string, '.
                       'DATE_FORMAT(datetime_from, "%Y-%m-%d") AS date, '.
                       'DATE_FORMAT(datetime_from, "%a") AS weekday, '.
                       'DATE_FORMAT(datetime_from, "%l:%i %p") AS time_from, '.
                       'DATE_FORMAT(datetime_to, "%l:%i %p") AS time_to, '.
                       'event.created, event.modified, event.deleted, '.
                       'group.name AS group_name, '.
                       'room.number AS room, '.
                       'people.first_name, people.last_name '.
                       'FROM `event` '.
                       'JOIN `group` ON group.id = group_id '.
                       'JOIN `room` ON room.id = room_id '.
                       'JOIN `people` ON people.id = instructor_id '.
                       'WHERE (event.datetime_from BETWEEN "'.
                        $dateFrom.' 00:00:00" AND "'.
                        $dateTo.' 23:59:59") '.
                       'AND (event.group_id IN ('.$my_groups.') '.
                       'OR event.instructor_id = :id) '.
                       'ORDER BY datetime_from ASC, datetime_to ASC';
            $paramsArray = array(
                       ':id' => $id,
                       );

            $result = \Components\DbQuery::getResult($queryString, $paramsArray);

        return $result;
        
    }

    /*
     * marks item as deleted/restore
     *
     * @param int - id of item to be deleted
     */
    public static function delEventItemById($id)
    {

        $id = intval($id);
        if ($id) {

            $data = \Models\Event::getEventItemById($id);

            // query
            $queryString = 'UPDATE `event` SET deleted='.abs($data['deleted']-1).' WHERE id = :id';
            $paramsArray = array(
                    ':id' => $id,
                    );

            $result = \Components\DbQuery::getResult($queryString, $paramsArray, 1);

            // set message
            $message = new \Components\Message('Event '.$data['name'].(empty($data['deleted']) ? ' marked as deleted' : ' restored'), 'success');

        }

        header('Location: /event');
        die;

    }

}
