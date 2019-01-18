<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * section Peoples controller
 */

namespace Controllers;
use Models;

class PeopleController
{
    
    /*
     * displays list of items
     *
     * @return boolean - success
     */
    public function actionList()
    {
        // check exact role asked for
        $role = (!empty($_POST['role']) ? $_POST['role'] : '');

        // ask model for method
        $peopleList = array();
        $peopleList = \Models\People::getPeopleList($role);
        
        // calling view
        $view = new \Components\Display();
        $view->displayHtml('people'.DS.'list', $peopleList);
        
        return true;   
    }
    
    /*
     * displays details of items
     *
     * @param int - id of item
     * @return boolean - success
     */
    public function actionView($id)
    {
        // ask model for method
        $peopleItem = \Models\People::getPeopleItemById($id);
        
        // calling view
        $view = new \Components\Display();
        $view->displayHtml('people'.DS.'item', $peopleItem);
        
        return true;   
    }
    
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
        $view->displayHtml('people'.DS.'item', $peopleItem);
        
        return true;   
    }
    
    /*
     * saves new item
     */
    public function actionSave()
    {
        $blob = \Components\ImgBlob::fileToBlob($_FILES['image']);

        $saveResult = \Models\People::savePeopleItem($blob);
    }

    /*
     * deletes item
     *
     * @param int - id of item to delete
     */
    public function actionDel($id)
    {
        $saveResult = \Models\People::delPeopleItemById($id);
    }

}
