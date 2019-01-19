<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * shopping cart controller
 */

namespace Controllers;

class CartController
{

    /*
     * adds item
     *
     * @param int - id of item to add
     */
    public function actionAdd($id)
    {

        $cart = new \Models\Cart;
        $items = $cart->getCart();

        // add new element
        $items[] = $id;

        // make values unique
        $items = array_flip(array_flip($items));

        $cart->setCart($items);

        // set message
        $message = new \Components\Message('Item added. You have '.$cart->itemCount().' item(s) in your cart', 'success');

        // go back
        header('Location: '.$_SERVER['HTTP_REFERER']);
        die;

     }

    /*
     * deletes item
     *
     * @param int - id of item to delete
     */
    public function actionDel($id)
    {

        $cart = new \Models\Cart;
        $items = $cart->getCart();

        // look for element
        $to_del = array_search($id, $items);

        // unset if found
        if (isset($to_del)) {
            unset($items[$to_del]);
        }

        $cart->setCart($items);

        // set message
        $message = new \Components\Message('Item deleted. You have '.$cart->itemCount().' item(s) in your cart', 'success');

        // go back
        header('Location: '.$_SERVER['HTTP_REFERER']);
        die;

     }

    /*
     * displays details of items
     *
     * @return boolean - success
     */
    public function actionView()
    {
        // ask model
        $cart = new \Models\Cart;

        // calling view
        $view = new \Components\Display();
        $view->displayHtml('cart'.DS.'view', $cart->getCart());

        return true;

    }

    /*
     * displays invoice, seves order to database
     *
     * @return boolean - success
     */
    public function actionCheckout()
    {
        // ask model
        $cart = new \Models\Cart;
        $items = $cart->getCart();

        $invoice = array();
        // ask model
        $book = new \Models\Book();
        // counters
        $itemCount = 0;
        $subtotal = 0;
        foreach ($items as $id) {
            // counter
            $itemCount += 1;
            // get book
            $bookItem = $book->getBookItemById($id);
            // item - array
            $invoice[$itemCount]['name'] = $bookItem['name'].' by '.$bookItem['author'];
            $invoice[$itemCount]['price'] = $bookItem['price'];
            $subtotal += $bookItem['price'];
        }
        $invoice['count'] = $itemCount;
        $invoice['subtotal'] = $subtotal;
        $invoice['tax'] = number_format($subtotal*TAX, 2);
        $invoice['total'] = number_format($subtotal*(TAX+1), 2);

        // customer
        $people = new \Models\People();
        $peopleItem = $people->getPeopleItemById($_SESSION['id']);
        $invoice['people_id'] = $_SESSION['id'];
        $invoice['invoice_to'] = $peopleItem['last_name'].', '.$peopleItem['first_name'];
        $invoice['phone'] = $peopleItem['phone'];
        $invoice['billing_address'] = $peopleItem['address'].'<br/>'.
                                      $peopleItem['city'].'<br/>'.
                                      $peopleItem['zip_code'].'<br/>'.
                                      $peopleItem['country'];

        // save to DB, get ID
        $invoice['invoice_num'] = $cart->placeOrder($invoice);

        // clear cart
        $cart->setCart('');

        // calling view
        $view = new \Components\Display();
        $view->displayHtml('cart'.DS.'checkout', $invoice);

        return true;

    }

}