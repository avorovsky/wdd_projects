<?php

/**
 * products controller
 */

namespace Controllers;

class ProductsController
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
     * gets iteb by ID and displays
     * @param  array $params
     * @return void
     */
    public function actionShow($params)
    {

        $data = \Models\Product::getById($params[0]);

        // check for emty data
        if ($data) {
            $this->display->run('product'.DS.'show', $data, $params);
        } else {
            $m = new \Components\Message('The product you are looking for does not exist!', 'error');
            header('Location: /products/list');
        }

    }

    /**
     * gets list of items and displays
     * @param  array $params
     * @return void
     */
    public function actionList($params)
    {

        $data = \Models\Product::getList();
        $this->display->run('product'.DS.'list', $data, $params);

    }

    /**
     * opens form to edit item
     * @param  array $params
     * @return void
     */
    public function actionEdit($params)
    {

        $param = empty($params[0]) ? 0 : $params[0];

        $data = \Models\Product::getById($param);

        // user can edit only own products, or admin can do that
        if (empty($_SESSION['user_id']) OR (empty($data['seller_id'])) OR ($_SESSION['user_id'] != empty($data['seller_id']))) {
            if (empty($_SESSION['is_admin'])) {
                // set message
                $m = new \Components\Message('You have no privileges for this page', 'error');
                header('Location: /');
                die;
            }
        }

        $this->display->run('product'.DS.'edit', $data);

    }

    /**
     * gets empty item and displays in form
     * @return void
     */
    public function actionNew()
    {

        $data = \Models\Product::getNew();
        $this->display->run('product'.DS.'edit', $data);

    }

    /**
     * saves item to database
     * @return void
     */
    public function actionSave()
    {

        $data = \Models\Product::save();

        header('Location: /products');

    }

    /**
     * default action for unknown routes
     * @param array $parameters
     * @return void
     */
    public function actionDefault($params)
    {
        //$m = new \Components\Message('Page you are looking for does not exists', 'warning');
        header('Location: /products/list');
    }

}