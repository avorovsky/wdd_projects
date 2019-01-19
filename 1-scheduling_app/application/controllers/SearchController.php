<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * Search/suggest controller
 */

namespace Controllers;

class SearchController
{

    /*
     * displays pop-up list of suggestions
     *
     * @return boolean - success
     */
    public function actionSuggest()
    {
        // check if ajax-request
        $is_ajax = empty($_SERVER['HTTP_X_REQUESTED_WITH']) ? 'not_ajax' : strtolower($_SERVER['HTTP_X_REQUESTED_WITH']);
        if($is_ajax != 'xmlhttprequest') {
            $message = new \Components\Message('Oops! You probably lost. Let\'s start from here', 'error');
            header('Location: /');
            die;
        }

        if(empty($_POST['search_field'])) {
            // stop script
            die;
        }

        // cleanup input
        $search_field =  \Components\Validator::cleanUp($_POST['search_field']);

        // ask model for method
        $search = new \Models\Search();
        $suggestList = $search->getSuggestions($search_field);

        // calling view
        include APP.'views'.DS.'search'.DS.'suggest.php';

        return true;

    }

    /*
     * displays search results
     *
     * @return boolean - success
     */
    public function actionResult()
    {

        // cleanup input
        $string = \Components\Validator::cleanUp($_POST['search_field']);

        if(empty($string)) {
            return true;
        }

        // ask model for method
        $search = new \Models\Search();
        $searchResult = $search->getResult($string);

        // add search string to results
        $searchResult['search_field'] = $string;

        // set message

        // calling view
        $view = new \Components\Display();
        $view->displayHtml('search'.DS.'result', $searchResult);

        return true;

    }

}
