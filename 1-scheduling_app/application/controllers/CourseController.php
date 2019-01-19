<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * section Courses controller
 */

namespace Controllers;
use Models;

class CourseController
{
    
    /*
     * displays list of items
     *
     * @return boolean - success
     */
    public function actionList()
    {
        // ask model for method
        $courseList = array();
        $courseList = \Models\Course::getCourseList();
        
        // calling view
        $view = new \Components\Display();
        $view->displayHtml('course'.DS.'list', $courseList);
        
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
        $courseItem = \Models\Course::getCourseItemById($id);
        
        // calling view
        $view = new \Components\Display();
        $view->displayHtml('course'.DS.'item', $courseItem);
        
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
        $courseItem = \Models\Course::getCourseNewItem();
        
        // calling view
        $view = new \Components\Display();
        $view->displayHtml('course'.DS.'item', $courseItem);
        
        return true;   
    }
    
    /*
     * saves new item
     */
    public function actionSave()
    {
        $blob = \Components\ImgBlob::fileToBlob($_FILES['image']);

        $saveResult = \Models\Course::saveCourseItem($blob);
    }

    /*
     * deletes item
     *
     * @param int - id of item to delete
     */
    public function actionDel($id)
    {
        $saveResult = \Models\Course::delCourseItemById($id);
    }

}
