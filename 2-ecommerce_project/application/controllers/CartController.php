<?php

namespace Controllers;

class CartController
{
  /**
   * Display-class object
   * @var object
   */
  private $display;

  /**
   * constructor
   * creates Display-object
   */
  public function __construct()
  {
      $this->display = new \Components\Display();
  }

  /**
   * redirects to /cart/show
   * this is safety
   * @return void
   */
  public function actionDefault()
  {
    $m = new \Components\Message('Can\'t access that', 'warning');
    header('Location: /cart/show');
    die;
  }

  /**
   * gets the $_SESSION['cart'] and displays
   * @param  array $params
   * @return void
   */
  public function actionShow($params)
  {
    $data = "";
    if(empty($_SESSION['cart']))
    {
      $m = new \Components\Message('Your cart is empty!!', 'warning');
      header('Location: /');
      die;
    } else {
      $this->display->run('cart'.DS.'show', $_SESSION['cart'], $params);
    }
    // $data = \Models\Product::getById($params[0]);
  }

  /**
   * adds a new array to $_SESSION['cart'][$id]
   * @param integer $id
   * @return void
   */
  public function actionAdd($id)
  {// check if is not set make new variable
    if(empty($_SESSION['cart'])){
      $_SESSION['cart'] = array();
    }// end of if statment

    $quantity = 1;

    // string to int from array
    $id = intval($id[0]);

    // product
    $product = \Models\Product::getById($id);

    if(empty($product)){
      $m = new \Components\Message('Item doesn\'t exist!', 'error');
      header('Location: /');
      die;
    }

    $product['quantity'] =  $quantity;

    $product['sub_total'] = $quantity * floatval($product['price']);

    $_SESSION['cart'][$id] = $product ;
    $m = new \Components\Message('Added new Item to cart', 'success');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die;
  }// end of addToCart function

  /**
   * update quantity in $_SESSION['cart']['id']['quantity']
   * and sub_total in $_SESSION['cart']['id']['sub_total']
   * @param array $params
   * @return void
   */
  public function actionUpdate($params)
  {
    if(empty($_SESSION['cart'])){
      $m = new \Components\Message('Your cart is empty!!', 'warning');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      die;
    }// end of if statment

    // product id into int
    $id = intval($params[0]);
    // quantity of product into int
    $qty = intval($params[1]);

    if($qty <= 0 ){
      unset($_SESSION['cart'][$id]);
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id]['quantity'] = $qty;
        $_SESSION['cart'][$id]['sub_total'] = $_SESSION['cart'][$id]['quantity'] * $_SESSION['cart'][$id]['price'];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die;
      } else {
        $m = new \Components\Message('Your cart is empty!!', 'warning');
        header('Location: /');
        die;
      }
    }
  }// end of actionUpdate

  /**
   * removes a whole item from $_SESSION['cart'][$id]
   * @param integer $id
   * @return void
   */
  public function actionRemove($id)
  {
    if(empty($_SESSION['cart'])){
      $m = new \Components\Message('Your cart is empty!!', 'warning');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      die;
    }// end of if statment

    // string to int from array
    $id = intval($id[0]);

    if(isset($_SESSION['cart'][$id])){
      unset($_SESSION['cart'][$id]);
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die;

  }// end of removeFromCart function

  /**
   * unsets $_SESSION['cart'] & redirects to /products
   * @return void
   */
  public function actionClear()
  {
    unset($_SESSION['cart']);
    unset($_SESSION['shipping']);
    unset($_SESSION['alexa']);
    $m = new \Components\Message('Your cart is empty!!', 'warning');
    header('Location: /products');
    die;
  }

  /**
   * ajax Shipping method selection and sets price to $_SESSION['shipping]
   * @return void
   */
  public function actionShipping()
  {
    // check if ajax-request
    $is_ajax = empty($_SERVER['HTTP_X_REQUESTED_WITH']) ? 'not_ajax' : strtolower($_SERVER['HTTP_X_REQUESTED_WITH']);

    if($is_ajax != 'xmlhttprequest') {

        // set message
        $m = new \Components\Message('Something went wrong with the shipping', 'error');
        header('Location: /');
        die;

    }

    if(empty($_POST['region_id'])) {
        // stop script
        die;
    }
    $s = \Models\Cart::getShipById($_POST['region_id']);
    $_SESSION['shipping']['ship_cost'] = number_format($_POST['region_id'],2,'.',',');
    $_SESSION['shipping']['ship_method'] = $s[0]['name'];
    $_SESSION['shipping']['ship_id'] = $_POST['region_id'];
    echo $_SESSION['shipping']['ship_cost'];
  }

  /**
   * save cart as a json in database
   * @return void
   */
  public function actionSavecart()
  {
    if(empty($_SESSION['user_id'])){
      $m = new \Components\Message('Please login to save your cart!!', 'warning');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      die;
    } else {
      \Models\Cart::saveCart();
      $m = new \Components\Message('Cart has been saved!!', 'warning');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      die;
    }
  }

  /**
   * load cart from database
   * @return void
   */
  public function actionLoadcart()
  {
    if(empty($_SESSION['user_id'])){
      $m = new \Components\Message('Please login to load your cart!!', 'warning');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      die;
    } else {
      \Models\Cart::getCart();
      $m = new \Components\Message('Cart has been loaded!!', 'warning');
      header('Location: /cart/show');
      die;
    }
  }
}
