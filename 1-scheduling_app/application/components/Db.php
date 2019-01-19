<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * returns PDO object ready for query
 */

namespace Components;

class Db
{
    /*
     * returns odject of connection to database
     * @return object
     */

    public static function getConnection()
    {
        
        $paramsPath = APP.'config/dbConfig.php';
        $params = include($paramsPath);

        // data source
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        // DB-object
        $db = new \PDO($dsn, $params['user'], $params['password']);
        // errors show mode
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $db;
    }


}
