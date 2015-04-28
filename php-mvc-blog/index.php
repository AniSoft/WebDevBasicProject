<?php
require_once('includes/config.php');

$requestParts = explode('/', $_SERVER['REQUEST_URI']);

$controller = DEFAULT_CONTROLLER;
if (count($requestParts) >= 2 && $requestParts[1] != '') {
    $controller = $requestParts[1];
}

$action = DEFAULT_ACTION;
if (count($requestParts) >= 3 && $requestParts[2] != '') {
    $action = $requestParts[2];
}

var_dump($requestParts);
var_dump($controller);
var_dump($action);