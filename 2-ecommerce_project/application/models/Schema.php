<?php

/*
 * DB schema
 */

namespace Models;

class Schema
{

    /**
     * Database name
     * @var string
     */
    private $dbname;

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
            die('<strong>Schema</strong>: Could not find parameters to connect database &#9785;');
        }

        // DB-name
        $this->dbname = $params['dbname'];

    }

    /**
     * gets list of tables
     * @return array
     */
    public function getTablesList()
    {

        // query string
        $queryString = 
            'SELECT TABLE_NAME FROM `INFORMATION_SCHEMA`.`TABLES` '.
            'WHERE `INFORMATION_SCHEMA`.`TABLES`.`TABLE_SCHEMA`="'.$this->dbname.'"';
        // query parameters
        $paramsArray = [];

        // query
        $dbh = new \Components\Db();
        $result = $dbh->getResult($queryString, $paramsArray);

        return $result;

    }

    /**
     * gets table fields with attributes
     * @param  string $table
     * @return array
     */
    public function getFields($table)
    {

        // query string
        $queryString = 'SELECT '. 
            'TABLE_NAME, '.
            'COLUMN_NAME, '.
            'DATA_TYPE, '.
            'CHARACTER_MAXIMUM_LENGTH, '.
            'COLUMN_TYPE, '.
            'COLUMN_KEY, '.
            'EXTRA, '.
            'IS_NULLABLE '.
            'FROM `INFORMATION_SCHEMA`.`COLUMNS` '.
            'WHERE `INFORMATION_SCHEMA`.`COLUMNS`.`TABLE_SCHEMA`="'.$this->dbname.'"'.
            (empty($table) ? '' : ' AND `INFORMATION_SCHEMA`.`COLUMNS`.`TABLE_NAME`="'.$table.'"');
        // query parameters
        $paramsArray = [];

        // query
        $dbh = new \Components\Db();
        $result = $dbh->getResult($queryString, $paramsArray);

        return $result;

    }

    /**
     * gets restrictions (foreign keys)
     * @param  string $table
     * @return array
     */
    public function getRestrictions($table='', $field='')
    {

        // query string
        $queryString = 'SELECT '. 
            'TABLE_NAME, '.
            'COLUMN_NAME, '.
            'REFERENCED_TABLE_NAME, '.
            'REFERENCED_COLUMN_NAME '.
            'FROM `INFORMATION_SCHEMA`.`KEY_COLUMN_USAGE` '.
            'WHERE `INFORMATION_SCHEMA`.`KEY_COLUMN_USAGE`.`TABLE_SCHEMA`="'.$this->dbname.'" '.
            'AND `INFORMATION_SCHEMA`.`KEY_COLUMN_USAGE`.`REFERENCED_TABLE_NAME` IS NOT NULL'.
            (empty($table) ? '' : ' AND `INFORMATION_SCHEMA`.`KEY_COLUMN_USAGE`.`TABLE_NAME`="'.$table.'"').
            (empty($field) ? '' : ' AND `INFORMATION_SCHEMA`.`KEY_COLUMN_USAGE`.`COLUMN_NAME`="'.$field.'"');
        // query parameters
        $paramsArray = [];

        // query
        $dbh = new \Components\Db();
        $result = $dbh->getResult($queryString, $paramsArray);

        return $result;

    }

    /**
     * gets all the data from a table
     * @param  string $table
     * @return array
     */
    public function getData($table='', $id='')
    {

        if (!$table) {
            return [];
        }

        $id = intval($id);

        // query string
        $queryString = 
            'SELECT * FROM `'.$table.'`'.
            ($id ? ' WHERE id=:id' : '');
        // query parameters
        $paramsArray = ($id ? [':id' => $id] : []);

        // query
        $dbh = new \Components\Db();
        $result = $dbh->getResult($queryString, $paramsArray);

        return $result;

    }

    /**
     * deletes record from database
     * @param  string $table
     * @param  integer $id
     * @return void
     */
    public function deleteRecord($table, $id)
    {

        $id = intval($id);

        // query string
        $queryString = 
            'DELETE FROM `'.$table.'` '.
            'WHERE id=:id';
        // query parameters
        $paramsArray = array(
            ':id' => $id,
            );

        // query
        $dbh = new \Components\Db();
        $result = $dbh->getResult($queryString, $paramsArray, 0, 1);

        return $result;

    }

    /**
     * uploads file
     * @param  string $folder
     * @param  array $img
     * @return boolean
     */
    private function uploadFile($folder, $img)
    {

        // initial code is taken from w3scools.com
        $target_dir = $_SERVER['DOCUMENT_ROOT'].IMG.$folder.DS;
        $target_file = $target_dir . basename($img["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($img["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            //echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            //echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            //echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            // echo "Sorry, your file was not uploaded.";
            return false;
        } else {
            if (move_uploaded_file($img["tmp_name"], $target_file)) {
                // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                return true;
            } else {
                // echo "Sorry, there was an error uploading your file.";
                return false;
            }
        }

    }

    /**
     * saves record to database
     * @param  array $data
     * @return mixed
     */
    public function saveRecord($data)
    {

        $fields = $this->getFields($data['table']);

        // check if record exists
        $record = $this->getData($data['table'], $data['id']);

        if ($record AND !empty($data['id'])) {

            // update existing
            $queryString = 'UPDATE '.$data['table'].' SET ';
            
            foreach ($fields as $key => $value) {
                // check for image file, add name to post
                if (($value['COLUMN_NAME']=='image') AND !empty($_FILES['image']['name'])) {
                    $data[$value['COLUMN_NAME']] = $_FILES['image']['name'];
                    // upload file
                    $this->uploadFile($data['table']=='images' ? 'products' : $data['table'], $_FILES['image']);
                }
                // skip empty not required fields
                if ($value['IS_NULLABLE']=='YES' AND empty($data[$value['COLUMN_NAME']])) {
                    continue;
                }
                $queryString .= $value['COLUMN_NAME'].'=:'.$value['COLUMN_NAME'].',';
                $paramsArray[':'.$value['COLUMN_NAME']] = empty($data[$value['COLUMN_NAME']]) ? '' : $data[$value['COLUMN_NAME']];
            }

            // trim last comma
            $queryString = rtrim($queryString, ',');

            $queryString .= ' WHERE id='.$data['id'];
            
        } else {

            // insert new one
            $queryString = 'INSERT INTO '.$data['table'].' (';
            $paramsArray = [];
            
            foreach ($fields as $key => $value) {
                // check for image file, add name to post
                if (($value['COLUMN_NAME']=='image') AND !empty($_FILES['image']['name'])) {
                    $data[$value['COLUMN_NAME']] = $_FILES['image']['name'];
                    // upload file
                    $this->uploadFile($data['table']=='images' ? 'products' : $data['table'], $_FILES['image']);
                }
                if (!empty($data[$value['COLUMN_NAME']])) {
                    $queryString .= $value['COLUMN_NAME'].',';
                }
            }

            // trim last comma
            $queryString = rtrim($queryString, ',');

            $queryString .= ') VALUES (';
            
            foreach ($fields as $key => $value) {
                if (!empty($data[$value['COLUMN_NAME']])) {
                    $queryString .= ':'.$value['COLUMN_NAME'].',';
                    $paramsArray[':'.$value['COLUMN_NAME']] = empty($data[$value['COLUMN_NAME']]) ? '' : $data[$value['COLUMN_NAME']];
                }
            }

            // trim last comma
            $queryString = rtrim($queryString, ',');

            $queryString .= ')';

        }

        // query
        $dbh = new \Components\Db();
        $result = $dbh->getResult($queryString, $paramsArray, 1);

        return $result;

    }

}
