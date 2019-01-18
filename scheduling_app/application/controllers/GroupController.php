<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * section Groups controller
 */

namespace Controllers;
use Models;

class GroupController
{
    
    /*
     * displays list of items
     *
     * @return boolean - success
     */
    public function actionList()
    {
        // ask model for method
        $groupList = array();
        $groupList = \Models\Group::getGroupList();
        
        // calling view
        $view = new \Components\Display();
        $view->displayHtml('group'.DS.'list', $groupList);
        
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
        $groupItem = \Models\Group::getGroupItemById($id);
        
        // calling view
        $view = new \Components\Display();
        $view->displayHtml('group'.DS.'item', $groupItem);
        
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
        $groupItem = \Models\Group::getGroupNewItem();
        
        // calling view
        $view = new \Components\Display();
        $view->displayHtml('group'.DS.'item', $groupItem);
        
        return true;   
    }
    
    /*
     * saves new item
     */
    public function actionSave()
    {
        $saveResult = \Models\Group::saveGroupItem();
    }

    /*
     * deletes item
     *
     * @param int - id of item to delete
     */
    public function actionDel($id)
    {
        $saveResult = \Models\Group::delGroupItemById($id);
    }

}
