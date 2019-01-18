<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * Sign In controller
 */

namespace Controllers;
use Models;

class SigninController
{
    /*
     * saves user's details to session
     *
     * @param array - user's details
     */
    private function setSession($peopleItem)
    {
        // session
        $_SESSION['username'] = $peopleItem['username'];
        $_SESSION['id'] = $peopleItem['id'];
        $_SESSION['is_admin'] = $peopleItem['is_admin'];
        $_SESSION['image'] = (empty($peopleItem['image']) ? '' : \Components\ImgBlob::blobToSrc($peopleItem['image_mime'], $peopleItem['image']));

        // load cart
        $cart = \Models\Cart::loadCart($_SESSION['id']);
        $_SESSION['cart'] = $cart['cart'];

    }
 
    /*
     * empties/destroys session, replaces with a new one
     *
     */
    private function killSession()
    {
        // session destroy
        unset($_SESSION['username']);
        unset($_SESSION['id']);
        unset($_SESSION['is_admin']);
        unset($_SESSION['image']);
        session_destroy();
        session_start();
    }

    /*
     * checks data of user while sign-in
     * sets errors messages
     *
     * @return boolean - success
     */
    public function actionCheck()
    {
        // cancel clicked
        if (isset($_POST['cancel'])) {
            return false;
        }

        // cleanup the field
        $validator = new \Components\Validator();
        $_POST['username'] = $validator->cleanUp($_POST['username']);

        // ask model for method
        $peopleItem = \Models\People::getPeopleItemByUsername($_POST['username']);
        
        if (!empty($peopleItem)) {
            // check for password
            if (password_verify($_POST['password'], $peopleItem['password'])) {
                $this->setSession($peopleItem);
                $message = new \Components\Message('Welcome back, '.$peopleItem['first_name'].' '.$peopleItem['last_name'].'!', 'success');
            } else {
                $message = new \Components\Message('We could not find username provided or password is wrong', 'error');
            }          
        }
        
        return false;   
    }

    /*
     * redirects user to profile if successful login
     *
     * @return boolean - success
     */
    public function actionLogin()
    {
        // assignment #2 requirement
        // will change to homepage redirection
        if (!empty($_SESSION['username'])) {
            header('Location: /people/'.$_SESSION['id']);
            die;
        }
        
        // calling view
        $view = new \Components\Display();
        $view->displayHtml('signin'.DS.'signin', array());
        
        return true;   
    }
    
    /*
     * logouts and redirects user
     */
    public function actionExit()
    {
        // save cart if exists
        if (!empty($_SESSION['cart'])) {
            \Models\Cart::saveCart($_SESSION['id'], $_SESSION['cart']);
        }

        $this->killSession();
        $message = new \Components\Message('See you!', 'success');
        header('Location: /');
        die;
    }
    
}
