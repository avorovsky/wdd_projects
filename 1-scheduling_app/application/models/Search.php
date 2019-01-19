<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
* Search/suggest model
*/

namespace Models;

class Search
{
    // list of searchable fields
    private $search_fields;
    // default views for entities
    private $default_view;

    /*
     * constructor, sets list of fields searchable and their default views
     */
    public function __construct()
    {

        // list of fields
        if(file_exists(CFG.'searchFields.php')) {
            $this->search_fields = include(CFG.'searchFields.php');
        } else {
            $this->search_fields = array();
        }

        // default views
        if(file_exists(CFG.'defaultView.php')) {
            $this->default_view = include(CFG.'defaultView.php');
        } else {
            $this->default_view = array();
        }

    }

    /*
     * gets suggestions for live search
     *
     * @param string - text input
     * @return array - result of query to database
     */
    public function getSuggestions($string)
    {

        $queryString = '';
        // UNION from all the tables
        foreach($this->search_fields as $value) {
            $queryString .= 'SELECT '.
                            '`'.$value['table'].'`.`'.$value['field'].'` '.
                            'AS `suggestion` '.
                            'FROM `'.$value['table'].'` '.
                            'WHERE `'.$value['table'].'`.`'.$value['field'].'` '.
                            'LIKE "%'.$string.'%" UNION ';
        }
        // cut off the last ' UNION '
        $queryString = substr($queryString, 0, strlen($queryString)-7);

        // query
        $result = \Components\DbQuery::getResult($queryString);

        return $result;

    }

    /*
     * gets suggestions for final search
     *
     * @param string - text input
     * @return array - result of query to database
     */
    public function getResult($string)
    {

        $queryString = '';
        // UNION from all the tables
        foreach($this->search_fields as $value) {
            // default view
            $default_view = array_key_exists($value['table'], $this->default_view) ? $this->default_view[$value['table']] : '""';
            $queryString .= 'SELECT `created`, '.
                            '`'.$value['table'].'`.`'.$value['field'].'` '.
                            'AS `result`, '.
                            'CONCAT("/'.$value['table'].DS.'", `'.$value['table'].'`.`id`) '.
                            'AS `route`, '.
                            '"'.$value['table'].'" '.
                            'AS `entity`, '.
                            '"'.$value['field'].'" '.
                            'AS `field`, '.
                            $default_view.
                            'AS `view` '.
                            'FROM `'.$value['table'].'` '.
                            'WHERE `'.$value['table'].'`.`'.$value['field'].'` '.
                            'LIKE "%'.$string.'%" UNION ';
        }
        // cut off the last ' UNION '
        $queryString = substr($queryString, 0, strlen($queryString)-6);
        // sort by creation date-time
        $queryString .= 'ORDER BY `created` DESC';

        // query
        $result = \Components\DbQuery::getResult($queryString);

        // set message
        $message = new \Components\Message(count($result).' search result(s) found', 'success');

        return $result;

    }
    
}