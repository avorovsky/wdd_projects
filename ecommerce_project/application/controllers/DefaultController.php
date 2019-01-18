<?php

/**
 * default controller
 * (supposed to load homepage, or 404)
 */

namespace Controllers;

class DefaultController
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
     * renders default page
     * @param  array $parameters
     * @return void
     */
    public function actionDefault($params)
    {
        $this->display->run('default', $params);
    }

}