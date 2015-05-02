<?php
session_start();

require_once('includes/config.php');

$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestParts = explode('/', $requestPath);

// Parse Controller name
$controllerName = DEFAULT_CONTROLLER;
if (count($requestParts) >= 2 && $requestParts[1] != '') {
    $controllerName = $requestParts[1];
}

// Parse Action
$action = DEFAULT_ACTION;
if (count($requestParts) >= 3 && $requestParts[2] != '') {
    $action = $requestParts[2];
}

// Parse Parameters
$params = array_splice($requestParts, 3);

$controllerClassName = ucfirst(strtolower($controllerName)) . 'Controller';
$controllerFileName = "controllers/" . $controllerClassName . '.php';

// Create controller
if (class_exists($controllerClassName)) {
    $controller = new $controllerClassName($controllerName,$action);
} else {
    die("Cannot find controller '$controllerName' in class '$controllerFileName'");
}

// Call action
if (method_exists($controller, $action)) {
    //$controller->{$action}($params);
    call_user_func_array(array($controller, $action), $params);
    $controller->renderView();
} else {
    die("Cannot find action '$action' in controller '$controllerClassName'");
}

// Rending View
$controller->renderView();

function __autoload($class_name)
{
    if (file_exists("controllers/$class_name.php")) {
        include "controllers/$class_name.php";
    }
    if (file_exists("models/$class_name.php")) {
        include "models/$class_name.php";
    }
}

