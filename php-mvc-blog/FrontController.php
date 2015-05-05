<?php

class FrontController
{
    const DEFAULT_CONTROLLER = "home";
    const DEFAULT_ACTION = "index";

    public function parse()
    {
        $requestParts = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        $controllerName = self::DEFAULT_CONTROLLER;
        if (count($requestParts) >= 2 && $requestParts[1] != '') {
            $controllerName = $requestParts[1];
        }

        $action = self::DEFAULT_ACTION;
        if (count($requestParts) >= 3 && $requestParts[2] != '') {
            $action = $requestParts[2];
        }

        $params = array_splice($requestParts, 3);

        $controllerClassName = ucfirst(strtolower($controllerName)) . 'Controller';
        $controllerFileName = "controllers/" . $controllerClassName . '.php';

        if (class_exists($controllerClassName)) {
            $controller = new $controllerClassName($controllerName, $action);
        } else {
            die("Cannot find controller '$controllerName' in class '$controllerFileName'");
        }

        if (method_exists($controller, $action)) {
            call_user_func_array(array($controller, $action), $params);
        } else {
            die("Cannot find action '$action' in controller '$controllerClassName'");
        }
    }
}