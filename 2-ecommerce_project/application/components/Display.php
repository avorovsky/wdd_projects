<?php


/**
 * renders HTML-pages from templates/views
 */

namespace Components;

class Display
{

    /**
     * section name
     * @var string
     */
    private $sections;

    /**
     * constructor
     * reads and sets list of required sections
     * @param string $template
     */
    public function __construct($template='front')
    {
        // sections list
        if (file_exists(CFG.'templates_'.$template.'.php')) {
            $this->sections = include(CFG.'templates_'.$template.'.php');
        } else {
            die('<strong>Display</strong>: Could not find list of <em>'.$template.'</em> sections &#9785;');
        }

    }

    /**
     * includes static content from file
     * @param  string $section
     * @return void
     */
    private function displayStatic($section, $data, $params)
    {
        // display if exists
        if (file_exists(TMPL.$section.'.php')) {
            include_once TMPL.$section.'.php';
        }

    }

    /**
     * includes dynamic content from view
     * @param  string $view
     * @param  array $data
     * @return void
     */
    private function displayDynamic($view, $data, $params)
    {
        // display if exists
        if (file_exists(APP.'views'.DS.$view.'.php')) {
            include_once APP.'views'.DS.$view.'.php';
        } else {
            echo '<div><strong>Display</strong>: Could not find <em>'.$view.'</em> view &#9785;</div>';
        }

    }

    /**
     * output buffer
     * @param  string $view
     * @param  array  $parameters
     * @return void
     */
    public function run($view, $data=[], $params=[])
    {

        ob_start();

        // flash message -> moved to header.php
        // $message = new \Components\Message();
        // echo $message->getMessage();

        // sections
        foreach ($this->sections as $section) {
            if ($section) {
                // static section
                $this->displayStatic($section, $data, $params);
            } else {
                // view
                $this->displayDynamic($view, $data, $params);
            }
        }

        ob_end_flush();

    }

}