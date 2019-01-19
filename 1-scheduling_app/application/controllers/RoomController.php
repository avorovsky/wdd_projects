<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * section Rooms controller
 */

namespace Controllers;
use Models;

class RoomController
{
    
    /*
     * displays list of items
     *
     * @return boolean - success
     */
    public function actionList()
    {
        // ask model for method
        $roomList = array();
        $roomList = \Models\Room::getRoomList();
        
        // calling view
        $view = new \Components\Display();
        $view->displayHtml('room'.DS.'list', $roomList);
        
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
        $roomItem = \Models\Room::getRoomItemById($id);
        
        // calling view
        $view = new \Components\Display();
        $view->displayHtml('room'.DS.'item', $roomItem);
        
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
        $roomItem = \Models\Room::getRoomNewItem();
        
        // calling view
        $view = new \Components\Display();
        $view->displayHtml('room'.DS.'item', $roomItem);
        
        return true;   
    }
    
    /*
     * saves new item
     */
    public function actionSave()
    {
        $saveResult = \Models\Room::saveRoomItem();
   }

    /*
     * deletes item
     *
     * @param int - id of item to delete
     */
    public function actionDel($id)
    {
        $saveResult = \Models\Room::delRoomItemById($id);
    }

}
