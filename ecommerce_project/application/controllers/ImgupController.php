<?php

namespace Controllers;

class ImgupController
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
  
  public function actionUpload(){
    // check if ajax-request
    $is_ajax = empty($_SERVER['HTTP_X_REQUESTED_WITH']) ? 'not_ajax' : strtolower($_SERVER['HTTP_X_REQUESTED_WITH']);

    if($is_ajax != 'xmlhttprequest') {

        // set message
        $m = new \Components\Message('Something went wrong with uploading the image', 'error');
        header('Location: /');
        die;

    }

    if(empty($_FILES['image'])) {
        // stop script
        die;
    }

    // ask Component for method
    $img = new \Components\ImgToFile();
    $img_name = $img->ajaxUpoad($_FILES['image']);

    echo $img_name;
  }

}// end of class
