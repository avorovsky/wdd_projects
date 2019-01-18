<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * section Events controller
 */

namespace Controllers;

class EventController
{
    
    /*
     * displays list of items for user
     *
     * @return boolean - success
     */
    public function actionMy()
    {
        // set interval if asked for
        // (default period is willfully wide, but limited for 
        //  simple and single select-construction in the model)
        $date_from = (!empty($_POST['date_from']) ? $_POST['date_from'] : '2000-01-01');
        // $date_from = (!empty($_POST['date_from']) ? $_POST['date_from'] : date('Y-m-d'));
        $date_to = (!empty($_POST['date_to']) ? $_POST['date_to'] : '2099-12-31');

        // ask model for method
        $eventList = array();
        $eventList = \Models\Event::getMyEventList($date_from, $date_to, $_SESSION['id']);
        
        // calling view
        $view = new \Components\Display();
        $view->displayHtml('event'.DS.'list', $eventList);
        
        return true;   
    }
    
    /*
     * displays list of items
     *
     * @return boolean - success
     */
    public function actionList()
    {
        // set interval from filter if asked for
        // default - starting from today
        $date_from = (!empty($_POST['date_from']) ? $_POST['date_from'] : date('Y-m-d'));
        $date_to = (!empty($_POST['date_to']) ? $_POST['date_to'] : '2099-12-31');

        // ask model for method
        $eventList = array();
        $eventList = \Models\Event::getEventList($date_from, $date_to);
        
        // calling view
        $view = new \Components\Display();
        $view->displayHtml('event'.DS.'list', $eventList);
        
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
        $eventItem = \Models\Event::getEventItemById($id);
        
        // calling view
        $view = new \Components\Display();
        $view->displayHtml('event'.DS.'item', $eventItem);
        
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
        $eventItem = \Models\Event::getEventNewItem();
        
        // calling view
        $view = new \Components\Display();
        $view->displayHtml('event'.DS.'item', $eventItem);
        
        return true;   
    }
    
    /*
     * saves new item
     */
    public function actionSave()
    {
        $saveResult = \Models\Event::saveEventItem();
    }

    /*
     * deletes item
     *
     * @param int - id of item to delete
     */
    public function actionDel($id)
    {
        $saveResult = \Models\Event::delEventItemById($id);
    }

}
