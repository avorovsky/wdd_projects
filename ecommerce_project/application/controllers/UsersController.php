<?php

/**
 * users controller
 */

namespace Controllers;

class UsersController
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
     * signs in user
     * @return void
     */
    public function actionSignin()
    {

        if (!empty($_SESSION['username'])) {
            $m = new \Components\Message('You are already signed in', 'info');
        } elseif (empty($_POST['username']) || empty($_POST['password'])) {
            $m = new \Components\Message('Username and password could not be empty', 'error');
        } else {

            // defaul message
            $m = new \Components\Message('User <strong>' . $_POST['username'] . '</strong> is not registered, or password is wrong', 'error');

            $user = \Models\User::getByColumn('username', strtolower($_POST['username']));

            if ($user) {
                // check for password
                if (password_verify($_POST['password'], $user['password'])) {
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['is_admin'] = $user['is_admin'];
                    //$_SESSION['image'] = $user['image'];
                    $m = new \Components\Message('Welcome back, <strong>' . $user['username'] . '</strong>!', 'success');
                }
            }

        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);

    }

    /**
     * signs out user
     * @return void
     */
    public function actionSignout()
    {
        // destroy login variables
        unset($_SESSION['username']);
        unset($_SESSION['user_id']);
        unset($_SESSION['is_admin']);
        unset($_SESSION['image']);
        unset($_SESSION['cart']);
        // i added this hahaha im dumb don't kill me - Diego
        unset($_SESSION['invoice']);
        unset($_SESSION['shipping']);
        unset($_SESSION['alexa']);
        $m = new \Components\Message('See you!', 'success');

        header('Location: ' . $_SERVER['HTTP_REFERER']);

    }

    /**
     * gets item by ID and displays
     * @return void
     */
    public function actionShow($params)
    {

        $data = \Models\User::getById($params[0]);
        // check for emty data
        if ($data) {
            $this->display->run('user'.DS.'show', $data);
        } else {
            $m = new \Components\Message('The user you are looking for does not exist!', 'error');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

    }

    /**
     * gets list of items and displays
     * @return void
     */
    public function actionList()
    {

        $data = \Models\User::getList();
        $this->display->run('user'.DS.'list', $data);

    }

    /**
     * gets item by ID and displays in form
     * @return void
     */
    public function actionEdit($params)
    {

        // only user can edit his own data, or admin
        if (empty($_SESSION['user_id']) OR ($_SESSION['user_id'] != $params[0])) {
            if (empty($_SESSION['is_admin'])) {
                // set message
                $m = new \Components\Message('You have no privileges for this page', 'error');
                header('Location: /');
                die;
            }
        }

        $param = empty($params[0]) ? 0 : $params[0];

        $data = \Models\User::getById($param);
        $this->display->run('user'.DS.'edit', $data);

    }

    /**
     * gets empty item and displays in form
     * @return void
     */
    public function actionNew()
    {

        $data = \Models\User::getNew();
        $this->display->run('user'.DS.'register', $data);

    }

    /**
     * displays register form
     * @return void
     */
    public function actionRegister()
    {

        $data = \Models\User::getNew();
        $this->display->run('user'.DS.'register', $data);

    }

    /**
     * saves item to database
     * @return void
     */
    public function actionSave()
    {

        $data = \Models\User::save();

        header('Location: /');

    }

    /**
     * default action for unknown routes
     * @param array $parameters
     * @return void
     */
    public function actionDefault($params)
    {
        //$m = new \Components\Message('Page you are looking for does not exists', 'warning');
        header('Location: /users/list');
    }

}
