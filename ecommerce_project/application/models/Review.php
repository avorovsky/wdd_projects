<?php

/* 
 * Review model
 */

namespace Models;

class Review
{
 
    /**
     * returns list of items
     * @return array
     */
    public static function getList($product_id=0)
    {

        $queryString = 'SELECT * from `reviews`';
        $paramsArray = array();

        $product_id = intval($product_id);
        if ($product_id) {
            $queryString .= ' WHERE product_id=:product_id';

            $paramsArray = array(
                ':product_id' => $product_id,
            );
        }

        // query
        $dbh = new \Components\Db();
        $result = $dbh->getResult($queryString, $paramsArray);
            
        return $result;

    }

}
