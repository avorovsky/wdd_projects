<?php

/**
 * admin zone controller
 */

namespace Controllers;

class AdminController
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

        // check if user is an admin
        if (empty($_SESSION['is_admin'])) {
            // set message
            $m = new \Components\Message('You are not authorized to access this section', 'error');
            header('Location: /');
            die;
        }

        $this->display = new \Components\Display('admin');

    }

    /**
     * renders table view page
     * @param  array $params
     * @return void
     */
    public function actionList($params)
    {

        $tables = new \Models\Schema();
        $params['tables'] = $tables->getTablesList();
        $params['fields'] = $tables->getFields($params[0]);

        if ($params['fields']) {

            $data = $tables->getData($params[0]);

            $this->display->run('admin'.DS.'list', $data, $params);

        } else {

            // table not found
            header('Location: /admin');
            die;

        }

    }

    /**
     * renders edit page (form) for new item
     * @param  array $params
     * @return void
     */
    public function actionNew($params)
    {

        // check for empty values
        if (empty($params[0])) {

            // set message
            $m = new \Components\Message('Not enough parameters to create', 'error');

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die;
           
        }

        $tables = new \Models\Schema();
        $params['tables'] = $tables->getTablesList();
        $params['fields'] = $tables->getFields($params[0]);

        // create emty item
        $data = [];
        foreach ($params['fields'] as $key => $value) {
            $data[0][$value['COLUMN_NAME']] = '';
        }

        $this->display->run('admin'.DS.'item', $data, $params);

    }

    /**
     * renders edit page (form)
     * @param  array $params
     * @return void
     */
    public function actionEdit($params)
    {

        // check for empty values
        if (empty($params[0]) OR empty($params[1])) {

            // set message
            $m = new \Components\Message('Not enough parameters to edit', 'error');

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die;
           
        }

        $tables = new \Models\Schema();
        $params['tables'] = $tables->getTablesList();
        $params['fields'] = $tables->getFields($params[0]);

        $data = $tables->getData($params[0], $params[1]);

        $this->display->run('admin'.DS.'item', $data, $params);

    }

    /**
     * deletes item from database
     * @param  array $params
     * @return void
     */
    public function actionDelete($params)
    {

        // check for empty values
        if (empty($params[0]) OR empty($params[1])) {

            // set message
            $m = new \Components\Message('Not enough parameters to delete', 'error');

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die;
           
        }

        $action = new \Models\Schema();
        $result = $action->deleteRecord($params[0], $params[1]);

        // set message
        $m = new \Components\Message('Record deleted', 'success');

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die;

    }

    /**
     * saves item to database
     * @param  array $params
     * @return void
     */
    public function actionSave($params)
    {

        $schema = new \Models\Schema();

        // check for empty values
        if (empty($_POST['table']) OR empty($schema->getFields($_POST['table'])) OR empty($_SESSION['user_id'])) {

            // set message
            $m = new \Components\Message('Table not defined, or you are not logged in', 'error');

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die;
           
        }

        $schema->saveRecord($_POST);

        // set message
        $m = new \Components\Message('Record saved', 'success');

        header('Location: /admin/list/' . $_POST['table']);
        die;

    }

    /**
     * renders default page
     * @param  array $parameters
     * @return void
     */
    public function actionDefault($params)
    {

        $tables = new \Models\Schema();
        $params['tables'] = $tables->getTablesList();
        $data = [];

        $this->display->run('admin'.DS.'dashboard', $data, $params);
    }

}