<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * sets, gets and checks CSRF-token
 */

namespace Components;

class Token
{

    /*
     * sets new token to session
     */
    private function setToken()
    {
        $_SESSION['token'] = md5(time().openssl_random_pseudo_bytes(48));
    }

    /*
     * checks validity of token
     *
     * @param string - token sent
     * @return boolean - validity of token
     */
    private function checkToken($token)
    {
        if ($token != $_SESSION['token']) {
            return false;
        }

        return true;
    }

    /*
     * gets token to output into form
     *
     * @return string - html-output
     */
    public static function getToken()
    {
        $string = '<input type="hidden" '.
                         'id="token" '.
                         'name="token" '.
                         'value="'.$_SESSION['token'].'" />';
        return $string;
    }

    /*
     * main logic to set and check token
     */
    public function run()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // something is posted
            if (empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                // normal request
                if (!empty($_POST['token'])) {
                    // token exist
                    if ($this->checkToken($_POST['token'])) {
                        // token is valid - let's go on with a new one
                        $this->setToken();
                        return;
                    }
                }
            } elseif (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                // just check, but not change token for ajax
                if ($this->checkToken($_POST['token'])) {
                    return;
                }
            }

            // got to fake path with message
            header('Location: /fake_token');
            die;

        }

        // set new token
        $this->setToken();
        return;

    }

}