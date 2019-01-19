<?php

/* 
 * Country model
 */

namespace Models;

class Country
{
 
    /**
     * returns list of items
     * @return array
     */
    public static function getList()
    {

        $queryString = 'SELECT * from `countries` ORDER BY id ASC';

        $paramsArray = array();

        // query
        $dbh = new \Components\Db();
        $result = $dbh->getResult($queryString, $paramsArray);
            
        return $result;

    }

}
