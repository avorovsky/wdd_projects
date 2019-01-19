<?php

/*
 * Checkout Model
 */
namespace Models;

class Checkout
{
  public static function getCart()
  {
    // check if is not set make new variable
    if(empty($_SESSION['cart'])){
      $_SESSION['cart'] = array();
    } else {
      $queryString =
      'SELECT `cart` from `users` ' .
      'WHERE `id` = :id ' .
      'LIMIT 1';

      $id = intval($_SESSION['user_id']);

      $paramsArray = array('id' => $id);
      // query
      $dbh = new \Components\Db();
      $result = $dbh->getResult($queryString, $paramsArray);

      $data = json_decode($result);

      $_SESSION['cart'] = $data;
    }
  }

  public static function saveInvoice()
  {
    $queryString =
    'INSERT INTO `invoices`(`user_id`,`cart`,`total_price`,`taxes`,`total_invoice`,`total_paid`,`shipping_method_id`)VALUES(:id,:data,:total_price,:taxes,:total_invoice,:total_paid,:shipping_method)';

    $pay['card_num'] = "**** " . substr($_POST['card_num'], -4);
    $pay['card_name'] = $_POST['card_name'];
    $pay['card_type'] =$_POST['card_type'];
    echo "<pre>";
    $all = array('payment' => $pay, 'cart' => $_SESSION['cart']);


    $id = intval($_SESSION['user_id']);
    $data = json_encode($all);
    $total_price = floatval($_SESSION['alexa']['sub_total']);
    $taxes = floatval($_SESSION['alexa']['taxes']);
    $total_invoice = floatval($_SESSION['alexa']['total']);
    $total_paid = floatval($_SESSION['alexa']['total']);
    $shipping_method = intval($_SESSION['shipping']['ship_id']);

    $paramsArray =
      array(
        ':id' => $id,
        ':data' => $data,
        ':total_price' => $total_price,
        ':taxes' => $taxes,
        ':total_invoice' => $total_invoice,
        ':total_paid' => $total_paid,
        ':shipping_method' => $shipping_method,
      );


    /// query
    $dbh = new \Components\Db();
    $result = $dbh->getResult($queryString, $paramsArray, 1);
    return $result;
  }

  public static function getInvoice($id)
  {
    $queryString =
    'SELECT * from `invoices` WHERE `id` = :id';

    $id = intval($id);

    $paramsArray = array('id' => $id);
    // query
    $dbh = new \Components\Db();
    $result = $dbh->getResult($queryString, $paramsArray);
    return $result;
  }
}
