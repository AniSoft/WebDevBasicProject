<?php

session_start();

require_once('includes/config.php');
require_once('library/password_hash.php');
$requestParts = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$controllerName = DEFAULT_CONTROLLER;
if(count($requestParts) > 1 && $requestParts[1] != '') {
    $controllerName = strtolower($requestParts[1]);
    if (! preg_match('/^[a-zA-Z0-9_]+$/', $controllerName)) {
        die('Invalid controller name. Use letters, digits and underscore only.');
    }
}

$actionName = DEFAULT_ACTION;
if (count($requestParts) > 2 && $requestParts[2] != '') {
    $actionName = strtolower($requestParts[2]);
    if (! preg_match('/^[a-zA-Z0-9_]+$/', $actionName)) {
        die('Invalid action name. Use letters, digits and underscore only.');
    }
}

$params = array_splice($requestParts, 3);

$controllerClassName = ucfirst($controllerName) . 'Controller';
$controllerFileName = "controllers/" . $controllerClassName . '.php';


if (class_exists($controllerClassName)) {
    $controller = new $controllerClassName($controllerName, $actionName);
} else {
    die("Cannot find controller '$controllerName' in class '$controllerFileName'");
}

if (method_exists($controller, $actionName)) {
    call_user_func_array(array($controller, $actionName), $params);
} else {
    die("Cannot find action '$actionName' in controller '$controllerClassName'");
}

function __autoload($class_name) {
    if (file_exists("controllers/$class_name.php")) {
        include "controllers/$class_name.php";
    }
    if (file_exists("models/$class_name.php")) {
        include "models/$class_name.php";
    }
}