<?php

/**
 * sets, gets and checks CSRF-token
 */

namespace Components;

class Token
{

    /**
     * creates a new token for session, if none exists
     * @return void
     */
    private function setToken()
    {
        // if no tokens yet, define one
        $_SESSION['token'] = empty($_SESSION['token']) ? md5(time().openssl_random_pseudo_bytes(48)) : $_SESSION['token'];
    }

    /**
     * checks if token exists
     * @param  string $token
     * @return boolean
     */
    private function checkToken($token)
    {
        if (empty($_SESSION['token'])) {
            // token wasn't defined yet
            return false;
        } elseif ($token != $_SESSION['token']) {
            // token not valid
            return false;
        }
        return true;
    }

    /**
     * to get token as an html-field
     * @return string
     */
    public static function getToken()
    {
        // to avoid errors if token is turned off
        // if (empty($_SESSION['token'])) {
        //     return '';
        // }

        $string = '<input type="hidden" ' .
                         'name="token" ' .
                         'value="' . $_SESSION['token'] . '" />';
        return $string;
    }

    /**
     * checks or creates token depending on request method
     * @return void
     */
    public function run()
    {

        $this->setToken();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // something is posted
            if (!empty($_POST['token'])) {
                // token exist
                if ($this->checkToken($_POST['token'])) {
                    // token is valid
                    return;
                }
            }

            // invalid token - reject POST
            $m = new \Components\Message('Invalid CSRF token, or sesion is expired', 'error'); 
            header('Location: /');
            die;

        }

        // not a POST, continue
        return;

    }

}