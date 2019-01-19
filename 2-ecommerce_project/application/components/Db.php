<?php

/*
 * PDO object, query to DB
 */

namespace Components;

class Db
{

    /**
     * Database handle
     * @var PDO object
     */
    private $dbh;

    /**
     * constructor
     * checks/reads/implements database connection parameters
     */
    public function __construct()
    {
        // check for database parameters
        if (file_exists(CFG.'dbConfig.php')) {
            $params = include(CFG.'dbConfig.php');
        } else {
            die('<strong>Database</strong>: Could not find parameters to connect &#9785;');
        }

        // data source
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";

        // DB-object
        try {
            $this->dbh = new \PDO($dsn, $params['user'], $params['password']);
        } catch (\PDOException $e) {
            //echo '<table>'.$e->xdebug_message.'</table>';
            die('<strong>Database</strong>: Failed to connect database &#9785;');
        }

        // errors show mode
        $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    }

    /**
     * Queries database
     * @param  string  $string SQL-query
     * @param  array   $params
     * @param  integer $getInsertId whether to return ID of record inserted
     * @param  integer $delete is it a delete request (no result)
     * @return integer, array
     */
    public function getResult($string, $params=[], $getInsertId=0, $delete=0)
    {

        $statement = $this->dbh->prepare($string);

        try {
            $this->dbh->beginTransaction();
            $statement->execute($params);
            $lastInsertId = $getInsertId ? $this->dbh->lastInsertId() : null;
            $this->dbh->commit();
        } catch (\PDOException $e) {
            //echo '<table>'.$e->xdebug_message.'</table>';
            die('<strong>Database</strong>: Query failed &#9785;');
        }

        if ($getInsertId) {
            return $lastInsertId;
        }

        if ($delete) {
            return true;
        }

        $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

        return $result;

    }

}
