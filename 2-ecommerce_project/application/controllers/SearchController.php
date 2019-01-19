<?php

/*
 * Search/live-search controller
 */

namespace Controllers;

class SearchController
{

    /**
     * Display-class object
     * @var object
     */
    private $display;

    /**
     * constructor
     * creates Display-object
     */
    public function __construct()
    {
        $this->display = new \Components\Display();
    }

    /**
     * removes unnecessary spaces, quotes, special chars, tags
     * multi-spaces replaced with single ones
     *
     * @param string - field's input
     * @return string - cleaned string
     */
    private static function cleanUp($string)
    {
        
        $string = trim($string); // leading and ending spaces
        $string = strip_tags($string); // tags
        $string = htmlspecialchars($string); // HTML entities
        $string = urldecode($string); // URL-related
        $string = stripslashes($string); // slashes
        $result = preg_replace('!\s+!', ' ', $string); // multi to mono space
        
        return $result;   
        
    }

    /**
     * displays pop-up list of suggestions
     *
     * @return boolean - success
     */
    public function actionSuggest()
    {

        // check if ajax-request
        $is_ajax = empty($_SERVER['HTTP_X_REQUESTED_WITH']) ? 'not_ajax' : strtolower($_SERVER['HTTP_X_REQUESTED_WITH']);
        
        if($is_ajax != 'xmlhttprequest') {

            // set message
            $m = new \Components\Message('Something went wrong with a search', 'error');
            header('Location: /');
            die;

        }

        if(empty($_POST['search_field'])) {
            // stop script
            die;
        }

        // cleanup input
        $search_field = self::cleanUp($_POST['search_field']);

        // ask model for method
        $search = new \Models\Search();
        $suggestList = $search->getSuggestions($search_field);

        // calling view
        include APP.'views'.DS.'search'.DS.'suggest.php';

        return true;

    }

    /**
     * displays search results
     *
     * @return boolean - success
     */
    public function actionResult()
    {

        // could be POST or GET
        if (!empty($_POST['search_field'])) {
            $string = self::cleanUp($_POST['search_field']);
        } elseif (!empty($_GET['search'])) {
            $string = self::cleanUp($_GET['search']);
        } else {
            $m = new \Components\Message('Search request is empty', 'warning');
        }

        if(empty($string)) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die;
        }

        // ask model for method
        $search = new \Models\Search();
        $data = $search->getResult($string);

        // add search string to results
        $data['search_field'] = $string;

        // calling view
        $this->display->run('search'.DS.'result', $data);

        return true;

    }

}
