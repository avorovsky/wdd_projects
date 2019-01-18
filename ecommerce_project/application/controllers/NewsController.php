<?php

/**
 * News controller
 */

namespace Controllers;

class NewsController
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
     * gets empty item and displays in form
     * @return void
     */
    public function actionNew()
    {

        $data = \Models\News::getNew();
        $this->display->run('news'.DS.'edit', $data);

    }

    /**
     * gets item by ID and displays in form
     * @return void
     */
    public function actionEdit($params)
    {

        // only user can edit his own data, or admin
        if (empty($_SESSION['user_id'])) {
            if (empty($_SESSION['is_admin'])) {
                // set message
                $m = new \Components\Message('You have no privileges for this page', 'error');
                header('Location: /');
                die;
            }
        }

        $param = empty($params[0]) ? 0 : $params[0];

        $data = \Models\News::getById($param);
        $this->display->run('news'.DS.'edit', $data);

    }

    /**
     * gets list of items and displays
     * @param  array $params
     * @return void
     */
    public function actionList($params)
    {

        $data = \Models\News::getList();
        $this->display->run('news'.DS.'list', $data, $params);

    }

    /**
     * gets iteb by ID and displays
     * @param  array $params
     * @return void
     */
    public function actionShow($params)
    {

        $data = \Models\News::getById($params[0]);

        // check for emty data
        if ($data) {
            $this->display->run('news'.DS.'show', $data, $params);
        } else {
            $m = new \Components\Message('The news you are looking for does not exist!', 'error');
            header('Location: /news/list');
        }

    }

    /**
     * saves item to database
     * @return void
     */
    public function actionSave()
    {

        $data = \Models\News::save();

        header('Location: /news');

    }

    /**
     * renders default page
     * @param  array $params
     * @return void
     */
    public function actionDefault($params)
    {
        header('Location: /news/list');
    }

}