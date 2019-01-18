<?php

/* 
 * Category model
 */

namespace Models;

class Category
{
 
    /**
     * returns list of items related to the parameter given
     * @param  integer $category_id
     * @return array
     */
    public static function getProductsList($category_id)
    {

        // I don't use complicated JOINs knowingly
        // to easier understanding of the code ('baby-steps')
        // by other team members

        $category_id = intval($category_id);
        $result = [];

        if ($category_id) {


            // ========================================
            //  As we changed category to product to
            //  one-to-one, this no longer work
            //  =======================================
            // ask for list of products in the category
            // $queryString = 
            //     'SELECT * from `category_product` '.
            //     'WHERE category_id=:category_id';

            // $paramsArray = array(
            //     ':category_id' => $category_id,
            //     );

            // // query
            // $dbh = new \Components\Db();
            // $result = $dbh->getResult($queryString, $paramsArray);

        // }

        // if ($result) {

            // build the list of IDs required
            // $product_ids = '';
            // foreach ($result as $key => $value) {
            //     $product_ids .= $value['product_id'].', ';
            // }
            // $product_ids = rtrim($product_ids,", ");

            // $queryString = 
            //     'SELECT * from `products` '.
            //     'WHERE id IN (:product_ids)';
            // $paramsArray = array(
            //     ':product_ids' => $product_ids,
            //     );

            $queryString = 
                'SELECT * from `products` '.
                'WHERE category_id=:category_id';
            $paramsArray = array(
                ':category_id' => $category_id,
                );

            $dbh = new \Components\Db();
            $result = $dbh->getResult($queryString, $paramsArray);

        }
            
        return $result;
 
    }
 
    /**
     * returns list of items
     * @param  integer $top_level top level only
     * @return array
     */
    public static function getList($top_level = 0)
    {

        $queryString = 'SELECT * from `categories`';

        // only top level, no subcategories
        $queryString .= ($top_level ? ' WHERE parent_id IS NULL' : '');

        $paramsArray = array();

        // query
        $dbh = new \Components\Db();
        $result = $dbh->getResult($queryString, $paramsArray);
            
        return $result;

    }

    /**
     * returns list of items by parent's ID
     * @param  integer $id
     * @return array
     */
    public static function getListById($id)
    {

        $id = intval($id);

        if (empty($id)) {
            return [];
        }

        $queryString = 
            'SELECT * from `categories` '.
            'WHERE parent_id=:parent_id';

        $paramsArray = array(
            ':parent_id' => $id,
            );

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
            'SELECT * from `categories` ' .
            'WHERE `id` = :id ' .
            'LIMIT 1';
        $paramsArray = array(
            'id' => $id,
        );

        $dbh = new \Components\Db();
        $result = $dbh->getResult($queryString, $paramsArray);
            
        return (empty($result) ? [] : $result[0]);

    }

}
