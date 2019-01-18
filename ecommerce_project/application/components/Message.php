<?php

/*
 * flash message
 */

namespace Components;

class Message
{

    /**
     * constructor
     * @param string $text
     * @param string $type
     */
    public function __construct($text='', $type='info')
    {

        if (!empty($text)) {
            $this->setMessage($text, $type);
        }

    }

    /**
     * saves message to session
     * @param string $text
     * @param string $type
     */
    private function setMessage($text, $type)
    {

        $_SESSION['message'] = $text;
        $_SESSION['message_type'] = $type;

    }

    /**
     * gets HTML-message from session, and clears it
     * @param integer $short
     * @return string
     */
    public function getMessage($short=1)
    {

        if (!empty($_SESSION['message'])) {

            $string = '<p '.
                          //'id="message" '.
                          'class="'.$_SESSION['message_type'].'">'.
                           $_SESSION['message'].
                      '</p>';

            // for blinking message, according to design
            $string .= ($short ? '' : $string); 

            // message shown, let's clear it
            $this->setMessage('','');

            return $string;

        }
        
    }

}