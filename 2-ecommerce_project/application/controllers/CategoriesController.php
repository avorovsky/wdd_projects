<?php

/**
 * Categories controller
 */

namespace Controllers;

class CategoriesController
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

        $data = \Models\Category::getProductsList($params[0]);
        $this->display->run('category'.DS.'list', $data, $params);

    }    

    /**
     * default action for unknown routes
     * @param array $parameters
     * @return void
     */
    public function actionDefault($params)
    {
        $m = new \Components\Message('Could not define category properly', 'warning');
        header('Location: /');
    }

    // TENPORAR
    public function actionShow($params)
    {
        header('Location: /categories/list/'.$params[0]);
    }

}