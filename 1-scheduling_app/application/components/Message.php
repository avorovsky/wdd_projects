<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * flash messages
 */

namespace Components;

class Message
{
    /*
     * constructor
     *
     * @param string - text of message (optional)
     * @param string - type of message (optional)
     * @return boolean
     */
    public function __construct($text='', $type='success')
    {

        if (!empty($text)) {
            $this->setMessage($text, $type);
        }

        return true;

    }

    /*
     * sets message to session
     *
     * @param string - text of message
     * @param string - type of message
     */
    private function setMessage($text, $type)
    {

        $_SESSION['message'] = $text;
        $_SESSION['message_type'] = $type;

    }

    /*
     * gets message to session
     *
     * @param string - html-ouput of message
     */
    public function getMessage()
    {
        if (!empty($_SESSION['message'])) {

            $string = '<div id="message" '.
                           'class="'.$_SESSION['message_type'].'">'.
                           $_SESSION['message'].'</div>';

            // message shown, let's clear it
            $this->setMessage('','');

            return $string;

        }
    }

}