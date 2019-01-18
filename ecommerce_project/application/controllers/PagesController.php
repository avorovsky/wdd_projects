<?php

/**
 * default controller
 * (supposed to load homepage, or 404)
 */

namespace Controllers;

class PagesController
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
     * renders game page
     * @param  array $parameters
     * @return void
     */
    public function actionShow($params)
    {
        $this->display->run('pages'.DS.$params[0], $params);
    }

    /**
     * renders default page
     * @param  array $parameters
     * @return void
     */
    public function actionDefault($params)
    {
        //$this->display->run('default', $params);
        header('Location: /');
        die;
    }

}