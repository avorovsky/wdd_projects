<?php

/* 
 * News model
 */

namespace Models;

class News
{
 
    /**
     * gets empty item as array
     * @return array
     */
    public static function getNew()
    {
        // list of fields
        $queryString = 'DESCRIBE `news`';

        // query
        $dbh = new \Components\Db();
        $result = $dbh->getResult($queryString);
        
        // results to array
        $data = array();
        
        foreach ($result as $value) {
            // name of field is a key, empty value
            $data[$value['Field']] = '';
        }
        
        return $data;
        
    }

    /**
     * returns list of items
     * @return array
     */
    public static function getList()
    {

        $queryString = 'SELECT * from `news` ORDER BY created_at DESC';

        $paramsArray = array();

        // query
        $dbh = new \Components\Db();
        $result = $dbh->getResult($queryString, $paramsArray);
            
        return $result;

    }

    /**
     * returns item by ID
     * @param  integer $id
     * @return array
     */
    public static function getById($id)
    {

        $id = intval($id);

        if (empty($id)) {
            return [];
        }

        $queryString =
            'SELECT * from `news` ' .
            'WHERE `id` = :id ' .
            'LIMIT 1';
        $paramsArray = array(
            'id' => $id,
        );

        $dbh = new \Components\Db();
        $result = $dbh->getResult($queryString, $paramsArray);
            
        return (empty($result) ? [] : $result[0]);

    }

    /**
     * saves/updates item
     * @return mixed
     */
    public static function save()
    {

        // check for empty data and user logged
        if (empty($_SESSION['news_data'] OR empty($_SESSION['user_id']))) {
            // set message
            $m = new \Components\Message('Could not find the data to save, or user is not logged in', 'error');
            return false;
        }

        $data = $_SESSION['news_data'];
        
        $id = intval($data['id']);

        // set the author
        $data['user_id'] = empty($data['user_id']) ? $_SESSION['user_id'] : $data['user_id'];

        if ($id) {

            // update existing record
            $queryString = 
                    'UPDATE `news` SET '.
                    'user_id = :user_id, '.
                    'title = :title, '.
                    'body = :body, '.
                    'image = :image, '.
                    'modified_at = CURRENT_TIMESTAMP() '.
                    'WHERE id = :id';
            $paramsArray = array(
                    ':user_id' => $data['user_id'],
                    ':title' => $data['title'],
                    ':body' => $data['body'],
                    ':image' => $data['image'],
                    ':id' => $id,
                    );
        } else {
            
            // insert new record
            $queryString =
                    'INSERT INTO `news` ('.
                    'user_id, '.
                    'title, '.
                    'body, '.
                    'image) '.
                    'VALUES ('.
                    ':user_id, '.
                    ':title, '.
                    ':body, '.
                    ':image)';
            $paramsArray = array(
                    ':user_id' => $data['user_id'],
                    ':title' => $data['title'],
                    ':body' => $data['body'],
                    ':image' => $data['image'],
                    );
        }

        // query
        $dbh = new \Components\Db();
        $result = $dbh->getResult($queryString, $paramsArray, 1);

        // set message
        $m = new \Components\Message('News article <strong>' . $data['title'] . '</strong> saved', 'success');

        return $result;
        
    }

}
