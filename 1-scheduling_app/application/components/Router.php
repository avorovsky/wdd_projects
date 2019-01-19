<?php

/*
 * Project: PHP Capstone Project
 * Instructor: Steve George
 * Student: Oleksandr Vorovskyi
 * Date: September 11, 2018
 */

/*
 * main router
 */
namespace Components;

class Router

{

    /* array of accessible routes */
    private $routes;

    /*
     * constructor, sets array of accessible routes
     */
    public function __construct()
    {
        $routesPath = APP.'config'.DS.'routes.php';
        $this->routes = include($routesPath);
    }

    /*
     * gets URI requested and format it
     *
     * @return string - cleared/formatted URI
     */
    private function getURI()
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        if (!$uri) {
            // default controller/action
            $uri = 'event'.DS.(empty($_SESSION['username']) || $_SESSION['is_admin'] ? '' : 'my');
        }
        return $uri;
    }

    /*
     * main call of component, transfers URI to M/V/C, and calls them
     */
    public function run()
    {
        // get request string
        $uri = $this->getURI();

        // looking for predefined routes
        foreach ($this->routes as $uriPattern => $path) {
            
            // compare $uriPattern vs $uri
            // divider ~ used because we may have / in uri
            if (preg_match("~$uriPattern~", $uri)) {

                // define internal route with possible parameters
                // (see regexp is in routes.php)
                $intRoute = preg_replace("~$uriPattern~", $path, $uri);
                
                // get controller and action name
                $segments = explode('/', $intRoute);
                $controllerName = 'Controllers\\'.ucfirst(array_shift($segments).'Controller');
                $actionName = 'action'.ucfirst(array_shift($segments));
                
                // controller and action are deleted by array_shift
                // all the rest are parameters
                $parameters = $segments;
                
                // create controller instance and call action with parameters
                $controllerObject = new $controllerName;
                // 1st way: parameters as an array
                //$result = $controllerObject->$actionName($parameters);
                // 2nd way: paramaters are separate variables
                // (appropriate way must be used in action methods @ controllers)
                $result = call_user_func_array(
                              array($controllerObject, $actionName),
                              $parameters);

                // break the loop on routes if call is successful
                if ($result != null) {
                    break;
                }
            }
        }

        if (empty($result)) {
            // we did not find accessible route, go to main page
            $message = new \Components\Message('Oops! You probably lost. Let\'s start from here', 'error');
            header('Location: /');
            die;
        }
    }
}
