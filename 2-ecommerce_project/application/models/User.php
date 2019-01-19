<?php

/* 
 * User model
 */

namespace Models;

class User
{

    /**
     * returns item by column value
     * @param  string $column
     * @param  string $value
     * @return array
     */
    public static function getByColumn($column, $value)
    {

        if (empty($value)) {
            return [];
        }

        $queryString =
            'SELECT * from `users` ' .
            'WHERE `' . $column . '` = :' . $column . ' ' .
            'LIMIT 1';
        $paramsArray = array(
            $column => $value,
        );

        // query
        $dbh = new \Components\Db();
        $result = $dbh->getResult($queryString, $paramsArray);
            
        return (empty($result) ? [] : $result[0]);

    }

    /**
     * returns list of items
     * @return array
     */
    public static function getList()
    {

        $queryString =
            'SELECT * from `users`';
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
            'SELECT * from `users` ' .
            'WHERE `id` = :id ' .
            'LIMIT 1';
        $paramsArray = array(
            'id' => $id,
        );

        // query
        $dbh = new \Components\Db();
        $result = $dbh->getResult($queryString, $paramsArray);
            
        return (empty($result) ? [] : $result[0]);

    }

    /**
     * gets empty item as array
     * @return array
     */
    public static function getNew()
    {
        // list of fields
        $queryString = 'DESCRIBE `users`';

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
     * saves/updates item
     * @return mixed
     */
    public static function save()
    {

        // check for empty data and user logged
        if (empty($_SESSION['user_data'] OR empty($_SESSION['user_id']))) {
            // set message
            $m = new \Components\Message('Could not find the data to save, or user is not logged in', 'error');
            return false;
        }
        
        $data = $_SESSION['user_data'];
        
        $id = intval($data['id']);

        if ($id) {
            // if password is not passed, do not update
            if (empty($data['password'])) {
                $queryPassword = '';
                $arrayPassword = [];
            } else {
                $queryPassword =
                    'password = :password,';
                $arrayPassword = array(
                    ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
                    );
            }
            // update existing record
            $queryString = 
                    'UPDATE `users` SET '.
                    $queryPassword.
                    'username = :username, '.
                    'email = :email, '.
                    'image = :image, '.
                    'first_name = :first_name, '.
                    'last_name = :last_name, '.
                    'address = :address, '.
                    'city  = :city, '.
                    'province = :province, '.
                    'country = :country, '.
                    'postal_code = :postal_code, '.
                    'phone = :phone, '.
                    'is_admin = :is_admin, '.
                    'verified = :verified, '.
                    'modified_at = CURRENT_TIMESTAMP() '.
                    'WHERE id = :id';
            $paramsArray = array_merge($arrayPassword, array(
                    ':username' => $data['username'],
                    ':email' => $data['email'],
                    ':image' => $data['image'],
                    ':first_name' => $data['first_name'],
                    ':last_name' => $data['last_name'],
                    ':address' => $data['address'],
                    ':city'  => $data['city'],
                    ':province' => $data['province'],
                    ':country' => $data['country'],
                    ':postal_code' => $data['postal_code'],
                    ':phone' => $data['phone'],
                    ':is_admin' => $data['is_admin'],
                    ':verified' => $data['verified'],
                    ':id' => $id,
                    ));
        } else {
            
            // insert new record
            $queryString =
                    'INSERT INTO `users` ('.
                    'username, '.
                    'email, '.
                    'image, '.
                    'first_name, '.
                    'last_name, '.
                    'address, '.
                    'city, '.
                    'province, '.
                    'country, '.
                    'postal_code, '.
                    'phone, '.
                    'is_admin, '.
                    'verified, '.
                    'password) '.
                    'VALUES ('.
                    ':username, '.
                    ':email, '.
                    ':image, '.
                    ':first_name, '.
                    ':last_name ,'.
                    ':address, '.
                    ':city, '.
                    ':province, '.
                    ':country, '.
                    ':postal_code, '.
                    ':phone, '.
                    ':is_admin, '.
                    ':verified, '.
                    ':password)';
            $paramsArray = array(
                    ':username' => $data['username'],
                    ':email' => $data['email'],
                    ':image' => $data['image'],
                    ':first_name' => $data['first_name'],
                    ':last_name' => $data['last_name'],
                    ':address' => $data['address'],
                    ':city'  => $data['city'],
                    ':province' => $data['province'],
                    ':country' => $data['country'],
                    ':postal_code' => $data['postal_code'],
                    ':phone' => $data['phone'],
                    ':is_admin' => $data['is_admin'],
                    ':verified' => $data['verified'],
                    ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
                    );
        }

        // query
        $dbh = new \Components\Db();
        $result = $dbh->getResult($queryString, $paramsArray, 1);
        
        // set message
        $m = new \Components\Message('User <strong>' . $data['username'] . '</strong> saved', 'success');

        return $result;
        
    }

}