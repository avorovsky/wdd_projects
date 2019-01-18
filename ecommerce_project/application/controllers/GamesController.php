<?php

/**
 * default controller
 * (supposed to load homepage, or 404)
 */

namespace Controllers;

class GamesController
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
    public function actionRun($params)
    {
        $this->display->run('games'.DS.'frame_'.$params[0], $params);
    }

    /**
     * renders game in frame
     * @param  array $parameters
     * @return void
     */
    public function actionLoad($params)
    {
        // display if exists
        if (file_exists(APP.'views'.DS.'games'.DS.$params[0].'.php')) {
            include_once APP.'views'.DS.'games'.DS.$params[0].'.php';
        }
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