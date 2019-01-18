<?php

/**
 * Wishlist controller
 */

namespace Controllers;

class WishlistController
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
     * gets list of items and displays
     * @param  array $params
     * @return void
     */
    public function actionList($params)
    {

        $data = \Models\Wishlist::getById($params[0]);
        $this->display->run('wishlist'.DS.'list', $data, $params);

    }

    /**
     * adds item to wishlist
     * @param integer $id
     * @return void
     */
    public function actionAdd($params)
    {
        
        $id = intval($params[0]);


        if ($id AND (!empty($_SESSION['user_id']))) {

            $wishlist = new \Models\Wishlist();
            $wishlist->save($_SESSION['user_id'], $id);

        } else {

            //set message
            $m = new \Components\Message('To use wishlist please login first', 'warning');

        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);

    }

    /**
     * deletes item to wishlist
     * @param integer $id
     * @return void
     */
    public function actionDelete($params)
    {
        
        $id = intval($params[0]);


        if ($id AND (!empty($_SESSION['user_id']))) {

            $wishlist = new \Models\Wishlist();
            $wishlist->delete($_SESSION['user_id'], $id);

        } else {

            //set message
            $m = new \Components\Message('To use wishlist please login first', 'warning');

        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);

    }

    /**
     * default action for unknown routes
     * @param array $parameters
     * @return void
     */
    public function actionDefault($params)
    {

        if (empty($_SESSION['user_id'])) {
            $m = new \Components\Message('Could not define wishlist properly', 'warning');
            header('Location: /');
            die;
        }

        header('Location: /wishlist/list/' . $_SESSION['user_id']);

    }

}