<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * (Static) Pages controller
 */

namespace Controllers;

class PagesController
{
    /*
     * displays page
     *
     * @return boolean - success
     */
    public function actionContact()
    {
        // calling view
        $view = new \Components\Display();
        $view->displayHtml('pages'.DS.'contact');

        return true;
    }

    /*
     * displays page
     *
     * @return boolean - success
     */
    public function actionAbout()
    {
        // calling view
        $view = new \Components\Display();
        $view->displayHtml('pages'.DS.'about');

        return true;
    }

}
