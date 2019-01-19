<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * displays some info about DB
 */

namespace Controllers;

class DbinfoController
{

    /*
     * array of data to be collested
     */
    private $dbData;

    /*
     * constructor, fills array with data required
     */
    public function __construct()
    {
        // ask model for data
        $dbInfo = new \Models\Dbinfo;
        $this->dbData = $dbInfo::getData();
        
    }

    /*
     * displays data collected
     *
     * @return boolean - success
     */
    public function actionView()
    {
        
        // calling view
        $view = new \Components\Display();
        $view->displayHtml('dbinfo'.DS.'view', $this->dbData);

        return true;

    }

}