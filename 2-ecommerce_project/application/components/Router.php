<?php

/*
 * main router
 */

namespace Components;

class Router
{

    /**
     * URI to parse
     * @var array
     */
    private $uri;

    /**
     * constructor
     * clears and parses URI-request
     */
    public function __construct()
    {
        // remove leading and ending slashes
        // uri - array (controller, action, parameters...)
        $this->uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

    }

    /**
     * gets controller object by name
     * @param  string $name
     * @return object
     */
    private function getController($name)
    {

        $name = '\\Controllers\\' . (empty($name) ? 'Default' : ucfirst($name)) . 'Controller';
        $controller = new $name;
        return $controller;

    }

    /**
     * gets action (method) name of controller
     * @param  objecy $controller
     * @return string
     */
    private function getAction($controller)
    {
        // if something
        if (!empty($this->uri)) {
            $action = 'action'.ucfirst(array_shift($this->uri));
            // check if action exists
            if (method_exists($controller, $action)) {
                return $action;
            }
        }

        // predefined default method
        return 'actionDefault';

    }

    /**
     * extracts controller/action/params from URI
     * @return void
     */
    public function run()
    {
 
        // controller always exists
        $controller = $this->getController(array_shift($this->uri));

        // try to get action
        $action = $this->getAction($controller);

        // the rest is(are) parameter(s)
        $parameters = $this->uri;

        // run controller/action itself
        $controller->$action($parameters);

    }

}