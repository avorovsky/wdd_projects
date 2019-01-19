<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * section Register controller
 */

namespace Controllers;
use Models;

class RegisterController
{
    
    /*
     * displays form for details of new item
     *
     * @return boolean - success
     */
    public function actionNew()
    {
        // ask model for method
        $peopleItem = \Models\People::getPeopleNewItem();
        
        // calling view
        $view = new \Components\Display();
        $view->displayHtml('register'.DS.'item', $peopleItem);
        
        return true;   
    }
    
}
