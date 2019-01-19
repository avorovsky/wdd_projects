<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
* returns array of query results
*/

namespace Components;

class DbQuery
{
    /*
     * returns result of database query, or last inserted record's id
     *
     * @param string - query
     * @param array - query parameters to substitute (optional)
     * @param int - fetch or no flag (optional)
     * @return array
     * @return int
     */

    public static function getResult($string, $params=[], $noFetch=0)
    {

        $db = \Components\Db::getConnection();
        $statement = $db->prepare($string);
        $statement->execute($params);
        
        if ($noFetch) {
            return $db->lastInsertId();
        }
        
        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
        
        return $result;
        
    }
}
