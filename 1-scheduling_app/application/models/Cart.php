<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * shopping cart model
 */

namespace Models;

class Cart
{

    /*
     * load cart saved to database
     *
     * @param int - id of person
     * @return string - JSON of cart data
     */
    public static function loadCart($id)
    {
        $id = intval($id);

        // update existing record
        $queryString =
                'SELECT cart FROM `people` WHERE id = :id';
        $paramsArray = array(
                ':id' => $id,
                );

        // query
        $result = \Components\DbQuery::getResult($queryString, $paramsArray);

        return $result[0];

    }

    /*
     * saves cart to database
     *
     * @param int - id of person
     * @param string - JSON-string of cart data
     * @return int - id of updated record
     */
    public static function saveCart($id, $cart)
    {
        $id = intval($id);

        // update existing record
        $queryString =
                'UPDATE `people` SET '.
                'cart = :cart '.
                'WHERE id = :id';
        $paramsArray = array(
                ':cart' => $cart,
                ':id' => $id,
                );
        // query
        $result = \Components\DbQuery::getResult($queryString, $paramsArray, 1);

        return $result;

    }

    /*
     * converts JSON-string to array
     *
     * @return array - cart data
     */
    public static function getCart()
    {
        $cart = array();
        if (!empty($_SESSION['cart'])) {
            $cart = json_decode($_SESSION['cart'], true);
        }
        return $cart;
    }

    /*
     * converts array to JSON-string
     *
     * @param array - cart data
     * @return boolean - success
     */
    public static function setCart($cart)
    {
        if (!empty($cart)) {
            $_SESSION['cart'] = json_encode($cart);
        } else {
            unset($_SESSION['cart']);
        }
        return true;
    }

    /*
     * returns number of items in cart
     *
     * @return int - number of items in cart
     */
    public static function itemCount()
    {
        $cart = self::getCart();
        return count($cart);
    }

    /*
     * saves cart as an order to database
     *
     * @param array - detaild of customer in database
     * @return int - id of record updated
     */
    public static function placeOrder($invoice)
    {

        // insert new record
        $queryString =
                'INSERT INTO `order` (people_id, cart) VALUES ('.
                ':people_id, '.
                ':cart)';
        $paramsArray = array(
                ':people_id' => $invoice['people_id'],
                ':cart' => json_encode($invoice),
                );

        // query
        $result = \Components\DbQuery::getResult($queryString, $paramsArray, 1);

        // set message
        $message = new \Components\Message('Order is placed. Please print and save invoice for your records', 'success');

        return $result;

    }

}