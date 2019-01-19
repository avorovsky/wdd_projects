<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * display entire page with contetn requested
 */

namespace Components;

class Display
{
    /*
     * displays output for user
     *
     * @param string - name of view
     * @param array - data to display
     */
    public function displayHtml($view, $data=[])
    {

        ob_start();
        include ROOT.'templates'.DS.'header.php';
        include ROOT.'templates'.DS.'left.php';
        // flash message
        $message = new \Components\Message();
        echo $message->getMessage();
        include APP.'views'.DS.$view.'.php';
        include ROOT.'templates'.DS.'footer.php';
        ob_end_flush();
        
    }
    
}
