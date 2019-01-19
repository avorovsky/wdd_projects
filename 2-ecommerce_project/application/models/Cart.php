<?php

/*
 * Cart Model
 */
 // session start
 //

namespace Models;

class Cart
{
  public static function getCart()
  {
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

  public static function saveCart()
  {
    // check if is not set make new variable
    if(!empty($_SESSION['cart']) && !empty($_SESSION['user_id'])){
      $data = json_encode($_SESSION['cart']);
      $id = intval($_SESSION['user_id']);

      $queryString =
      'UPDATE `users` SET `cart`  = :data WHERE `id` = :id';

      $paramsArray = array('data' => $data, 'id' => $id);

      /// query
      $dbh = new \Components\Db();
      $result = $dbh->getResult($queryString, $paramsArray, 1);
    }// end of if statment
  }

  public function deleteCart()
  {
    // check if isset
  }

  public static function subTotalCart($data)
  {
    if(!empty($data)){
      $total = 0;
      foreach ($data as $key => $value) {
        $total += floatval($value['sub_total']);
        $_SESSION['alexa']['sub_total'] = $total;
      }
      return $total;
    } else {
      $m = new \Components\Message('Your cart is empty!!', 'warning');
      header('Location: /products');
      die;
    }
  }// end of subTotalCart


  public static function taxesCart($data)
  {
    // check for database parameters
    if (file_exists(CFG.'provTax.php')) {
        $params = include(CFG.'provTax.php');
    } else {
        die;
    }

    if(!empty($_SESSION['user_id'])){
      $user = \Models\User::getById(intval($_SESSION['user_id']));
      if(empty($user['province'])){
        $u_prov = 'manitoba';
      } else {
        $u_prov = strtolower($user['province']);
      }
      if($params[$u_prov]){
        $tax = floatval(intval($params[$u_prov]) / 100);
      } else {
        $tax = 0;
      }

    }

    if(!empty($data)){
      $total = 0;
      foreach ($data as $key => $value) {
        $total += floatval($value['sub_total']);
      }
      $total = $total * $tax;

      $_SESSION['alexa']['taxes'] = $total;
      return $total;
    } else {
      $m = new \Components\Message('Your cart is empty!!', 'warning');
      header('Location: /products');
      die;
    }
  }

  public static function grandTotalCart($data)
  {
    // check for database parameters
    if (file_exists(CFG.'provTax.php')) {
        $params = include(CFG.'provTax.php');
    } else {
        die;
    }

    if(!empty($_SESSION['user_id'])){
      $user = \Models\User::getById(intval($_SESSION['user_id']));

      if(empty($user['province'])){
        $u_prov = 'manitoba';
      } else {
        $u_prov = strtolower($user['province']);
      }

      if($params[$u_prov]){
        $tax = 1 + floatval(intval($params[$u_prov]) / 100);
      } else {
        $tax = 1;
      }
    } else {
      $tax = 1;
    }

    if(!empty($data)){
      $total = 0;
      foreach ($data as $key => $value) {
        $total += floatval($value['sub_total']);
        $_SESSION['alexa']['without_ship'] = $total;
      }
      if(!empty($_SESSION['shipping'])){
        $total = $total + $_SESSION['shipping']['ship_cost'];
        $_SESSION['alexa']['with_ship'] = $total;
      }
      $total = $total * $tax;
      $_SESSION['alexa']['total'] = $total;
      return $total;
    } else {
      $m = new \Components\Message('Your cart is empty!!', 'warning');
      header('Location: /products');
      die;
    }
  }// end of totalCArt

  /**
   * returns list of shipping methods
   * @return array
   */
  public static function getShipping()
  {
    $queryString =
        'SELECT * FROM `shipping_methods` ORDER BY RAND()';
    $paramsArray = array();

    // query
    $dbh = new \Components\Db();
    $result = $dbh->getResult($queryString, $paramsArray);

    return $result;
  }

  public static function getShipById($id)
  {
    $id = intval($id);

    if (empty($id)) {
        return [];
    }

    $queryString = 'SELECT * FROM `shipping_methods`WHERE `id` = :id';

    $paramsArray = array('id' => $id);
    // query
    $dbh = new \Components\Db();
    $result = $dbh->getResult($queryString, $paramsArray);

    return $result;
  }

}
// home page
// product list
// user profile
//
