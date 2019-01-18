<?php

namespace Controllers;
use Pagerange\Bx\_5bx;

class CheckoutController
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
   * redirects to /checkout/show
   * this is safety
   * @return void
   */
  public function actionDefault()
  {
    $m = new \Components\Message('Can\'t access that', 'warning');
    header('Location: /checkout/show');
    die;
  }

  public function actionShow($params)
  {
    $data = "";
    if(empty($_SESSION['cart']))
    {
      $m = new \Components\Message('Your cart is empty!!', 'warning');
      header('Location: /');
      die;
    } else if(empty($_SESSION['user_id'])){
      $m = new \Components\Message('Please login to Checkout!!!', 'warning');
      header('Location: /');
      die;
    } else {
      $this->display->run('checkout'.DS.'show', $_SESSION['cart'], $params);
    }
  }

  public function actionPayment($params)
  {
    $success = self::validatePayment();
    $response = self::processTransaction();
    echo "<pre>";
    //var_dump($success);
    //var_dump($_POST);
    var_dump($response);
    echo "</pre>";
    die;

    if(!$success){
      $m = new \Components\Message('Please check payment info', 'warning');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      die;
    } else {

      $m = new \Components\Message('Payment info is good', 'success');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      die;
    }
  }// end payment

  public static function validatePayment()
  {
    $v=new \Components\Validator();

    if($_SERVER['REQUEST_METHOD']=='POST'){
      $errors=[];

      //required fields checking
      $v->required('card_name');
      $v->required('card_type');
      $v->required('card_num');
      $v->required('card_cvv');
      $v->required('card_month');
      $v->required('card_year');

      $v->checkCVV('card_cvv');
      $v->checkNumber('card_num');
      $v->checkCardName('card_name');

      $errors = $v->errors();

      if(count($errors) == 0){
        $success = 1;
        return $success;
      } else {
        $success = 0;
        return $success;
      }
    }// end if
  }// end cNc function

  public static function processTransaction()
  {
    $ref = substr(md5(uniqid(rand(), true)), 0, 8);
    $month = sprintf("%02d", $_POST['card_month']);
    $date = intval($month.$_POST['card_year']);

    $cred = include(CFG.'gateway.php');
    try {
      $transaction = new _5bx($cred['login_login_id'], $cred['api_key']);
      $transaction->amount($_SESSION['alexa']['total']);
      $transaction->card_num($_POST['card_num']); // credit card number
      $transaction->exp_date ($date); // expiry date month and year
      $transaction->cvv(intval($_POST['card_cvv'])); // card cvv number
      $transaction->ref_num($ref); // your reference or invoice number
      $transaction->card_type($_POST['card_type']); // card type
      $response = $transaction->authorize_and_capture(); // returns JSON object
    } catch (Exception $e) {
      die($e->getMessage());
    }

    if ($response->transaction_response->response_code == '1') {
      // Your transaction was authorized... do something
      $data = \Models\Checkout::saveInvoice();
      unset($_SESSION['cart']);
      unset($_SESSION['shipping']);
      unset($_SESSION['alexa']);
      $_SESSION['invoice'] = $data;
      $m = new \Components\Message('Payment made!', 'success');
      header('Location: /checkout/invoice', $_SESSION['invoice'], $params);
      die;
      //echo "Success! Authorization Code: " . $response->transaction_response->auth_code;
      var_dump($response->transaction_response);
    } elseif(count($response->transaction_response->errors)) {
        foreach($response->transaction_response->errors as $error) {
          echo $error . '<br />';
        }
    }
    return $response;
  }

  public function actionInvoice($params)
  {
    $data = "";
    if(empty($_SESSION['invoice']))
    {
      $m = new \Components\Message('No invoices available', 'error');
      header('Location: /');
      die;
    } else {
      $this->display->run('checkout'.DS.'invoice', $_SESSION['invoice'], $params);
    }
  }

}
