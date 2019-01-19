<?php

/*
 * Paginator class
 * gets array, 'page' number, and quantity of items
 * returns 'page'-array of elements
 */

namespace Components;

class Paginator
{

    /**
     * array with 'pages'
     * @var array
     */
    private $pages;

    /**
     * number of 'pages' (max page number)
     * @var integer
     */
    private $pagesNum;

    /**
     * constructor; creates 'pages'
     * @param array $data
     * @param integer $itemsPerPage
     */
    public function __construct($data, $itemsPerPage)
    {

        // correct possible errors
        $itemsPerPage = intval($itemsPerPage);
        $itemsPerPage = $itemsPerPage == 0 ? 1 : $itemsPerPage;
        $data = is_array($data) ? $data : (array)$data;

        $this->pages = array_chunk($data, $itemsPerPage, true);

        $this->pagesNum = max(empty($this->pages) ? 0 : array_keys($this->pages))+1;

    }

    /**
     * gives a 'page' by number
     * @param  integer $pageNum
     * @return array
     */
    public function getPage($pageNum=1)
    {
        // we can't return negative, or greater than maximun array index
        $pageNum = min(max(1, intval($pageNum)), $this->pagesNum);

        return $this->pages[$pageNum-1];

    }

    /**
     * getter for number of 'pages'
     * @return integer
     */
    public function getPagesNum()
    {
        return $this->pagesNum;
    }

}

