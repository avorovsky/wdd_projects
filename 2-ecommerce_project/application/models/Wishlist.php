<?php

/* 
 * Wishlist model
 */

namespace Models;

class Wishlist
{

    /**
     * returns item by IDs
     * @param  integer $user_id
     * @param  integer $product_id
     * @return array
     */
    public static function getById($user_id, $product_id=0)
    {

        $user_id = intval($user_id);
        $product_id = intval($product_id);

        if (empty($user_id)) {
            return [];
        }

        if ($product_id) {
            $queryString =
                'SELECT * from `wishlist` '.
                'WHERE (user_id=:user_id '.
                'AND product_id=:product_id)';
            $paramsArray = array(
                ':user_id' => $user_id,
                ':product_id' => $product_id,
                );
        } else {
            $queryString =
                'SELECT * from `wishlist` '.
                'WHERE user_id=:user_id';
            $paramsArray = array(
                ':user_id' => $user_id,
                );
        }

        // query
        $dbh = new \Components\Db();
        $result = $dbh->getResult($queryString, $paramsArray);
            
        return $result;

    }

    /**
     * saves/updates item
     * @return void
     */
    public function save($user_id, $product_id)
    {

        $user_id = intval($user_id);
        $product_id = intval($product_id);

        if ($user_id AND $product_id) {

            // get product
            $item = \Models\Product::getById($product_id);

            // check if already exists
            if (!self::getById($user_id, $product_id)) {

                // insert new record
                $queryString =
                        'INSERT INTO `wishlist` ('.
                        'user_id, '.
                        'product_id) '.
                        'VALUES ('.
                        ':user_id, '.
                        ':product_id)';
                $paramsArray = array(
                    ':user_id' => $user_id,
                    ':product_id' => $product_id,
                    );

                // query
                $dbh = new \Components\Db();
                $result = $dbh->getResult($queryString, $paramsArray, 1);

                // set message
                $m = new \Components\Message('Item <strong>'.$item['name'].'</strong> added into wishlist', 'success');

           } else {
                
                // set message
                $m = new \Components\Message('Item <strong>'.$item['name'].'</strong> is already in the wishlist', 'info');

           }

        } else {
                
            // set message
            $m = new \Components\Message('Please sign in or select product', 'warning');

        }
        
    }

    /**
     * deletes item
     * @return void
     */
    public function delete($user_id, $product_id)
    {

        $user_id = intval($user_id);
        $product_id = intval($product_id);

        if ($user_id AND $product_id) {

            // insert new record
            $queryString =
                    'DELETE FROM `wishlist` '.
                    'WHERE ('.
                    'user_id = :user_id AND '.
                    'product_id = :product_id)';
            $paramsArray = array(
                ':user_id' => $user_id,
                ':product_id' => $product_id,
                );

            // query
            $dbh = new \Components\Db();
            $result = $dbh->getResult($queryString, $paramsArray, 1);

            // set message
            $m = new \Components\Message('Item removed from the wishlist', 'success');

        } else {
                
            // set message
            $m = new \Components\Message('Could not remove item from the wishlist', 'warning');

        }
        
    }

}
 