<?php

/* 
 * Product model
 */

namespace Models;

class Product
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
            'SELECT * from `products` ' .
            'WHERE `' . $column . '` = :' . $column . ' ' .
            'LIMIT 1';
        $paramsArray = array(
            $column => $value,
        );

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
            'SELECT * from `products`';
        $paramsArray = array();

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
            'SELECT * from `products` ' .
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
     * gets empty item as array
     * @return array
     */
    public static function getNew()
    {
        // list of fields
        $queryString = 'DESCRIBE `products`';

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
        if (empty($_SESSION['product_data'] OR empty($_SESSION['user_id']))) {
            // set message
            $m = new \Components\Message('Could not find the data to save, or user is not logged in', 'error');
            return false;
        }

        $data = $_SESSION['product_data'];
        
        $id = intval($data['id']);

        // set the seller
        $data['seller_id'] = empty($data['seller_id']) ? $_SESSION['user_id'] : $data['seller_id'];

        if ($id) {

            // update existing record
            $queryString = 
                    'UPDATE `products` SET '.
                    'name = :name, '.
                    'description = :description, '.
                    'category_id = :category_id, '.
                    'sku = :sku, '.
                    'price = :price, '.
                    'seller_id = :seller_id, '.
                    'modified_at = CURRENT_TIMESTAMP() '.
                    'WHERE id = :id';
            $paramsArray = array(
                    ':name' => $data['name'],
                    ':description' => $data['description'],
                    ':category_id' => $data['category_id'],
                    ':sku' => $data['sku'],
                    ':price' => $data['price'],
                    ':seller_id' => $data['seller_id'],
                    ':id' => $id,
                    );
        } else {
            
            // insert new record
            $queryString =
                    'INSERT INTO `products` ('.
                    'name, '.
                    'description, '.
                    'category_id, '.
                    'sku, '.
                    'price, '.
                    'seller_id) '.
                    'VALUES ('.
                    ':name, '.
                    ':description, '.
                    ':category_id, '.
                    ':sku, '.
                    ':price, '.
                    ':seller_id)';
            $paramsArray = array(
                    ':name' => $data['name'],
                    ':description' => $data['description'],
                    ':category_id' => $data['category_id'],
                    ':sku' => $data['sku'],
                    ':price' => $data['price'],
                    ':seller_id' => $data['seller_id'],
                    );
        }

        // query
        $dbh = new \Components\Db();
        $result = $dbh->getResult($queryString, $paramsArray, 1);

        // update images list
        $resultImg = \Models\Image::updateList($id ? $id : $result);

        // set message
        $m = new \Components\Message('Product <strong>' . $data['name'] . '</strong> saved', 'success');

        return $result;
        
    }

}