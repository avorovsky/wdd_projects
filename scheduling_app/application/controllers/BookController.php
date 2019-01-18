<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * section Book controller
 */

namespace Controllers;
use Models;

class BookController
{

    /*
     * displays list of items
     *
     * @return boolean - success
     */
    public function actionList()
    {
        // ask model for method
        $bookList = array();
        $bookList = \Models\Book::getBookList();

        // calling view
        $view = new \Components\Display();
        $view->displayHtml('book'.DS.'list', $bookList);

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
        $bookItem = \Models\Book::getBookItemById($id);

        // calling view
        $view = new \Components\Display();
        $view->displayHtml('book'.DS.'item', $bookItem);

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
        $bookItem = \Models\Book::getBookNewItem();

        // calling view
        $view = new \Components\Display();
        $view->displayHtml('book'.DS.'item', $bookItem);

        return true;
    }

    /*
     * saves new item
     */
    public function actionSave()
    {
        $blob = \Components\ImgBlob::fileToBlob($_FILES['image'],null,200);

        $saveResult = \Models\Book::saveBookItem($blob);
    }

    /*
     * deletes item
     *
     * @param int - id of item to delete
     */
    public function actionDel($id)
    {
        $saveResult = \Models\Book::delBookItemById($id);
    }

}
