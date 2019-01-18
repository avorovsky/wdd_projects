<?php

/* 
 * serves simple requests to DB
 * - get all elements
 * - get element by id
 * - insert element
 * - get fields array for new elements (describe)
 */

namespace Models;

class Simple
{

    /**
    * Database handle
    * @var PDO object
    */
    private $dbh;

    /**
     * constructor
     * creates DBH-object
     */
    public function __construct()
    {
        $this->dbh = new \Components\Db();
    }

    /**
     * gets all element from table
     * @param  string $table
     * @return array
     */
    public function getElements($table)
    {
        // query string
        $query = 'SELECT * FROM `'.$table.'`';

        $result = $this->dbh->getResult($query);

        return $result;

    }

    /**
     * gets elemnt from table by ID
     * @param  string $table
     * @param  integer $id
     * @return array
     */
    public function getElementById($table, $id)
    {
        // query string
        $query = 'SELECT * FROM `'.$table.'` WHERE id = :id';
        $params = array(':id' => intval($id));

        $result = $this->dbh->getResult($query, $params);

        return $result[0];

    }

    /**
     * inserts new element into table and returns its ID
     * @param  string $table
     * @param  array $params
     * @return integer
     */
    public function insertElement($table, $params)
    {
        // query string
        $query = 'INSERT INTO `'.$table.'` (';
        foreach ($params as $key => $value) {
            $query .= str_replace(':', '', $key).($key != end($params) ? ', ' : '');
        }
        $query .= ') VALUES (';
        foreach ($params as $key => $value) {
            $query .= str_replace($key).($key != end($params) ? ', ' : '');
        }

        $result = $this->dbh->getResult($query, $params, 1);

        return $result;

    }

    /**
     * gets list of fields (describes) table
     * @param  string $table
     * @return array
     */
    public function describeElement($table)
    {
        // query string
        $query = 'DESCRIBE `'.$table.'`';

        $result = $this->dbh->getResult($query);

        $description = array();
        foreach ($result as $value) {
            // name of field is a key, value is empty
            $description[$value['Field']] = '';
        }

        return $description;
    }

}