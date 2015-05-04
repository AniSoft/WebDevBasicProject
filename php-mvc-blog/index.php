<?php

require_once('application.php');
require_once('/includes/config.php');

session_start();
$app = Application::getInstance();
$app->start();

function __autoload($class_name)
{
    if (file_exists("controllers/$class_name.php")) {
        include "controllers/$class_name.php";
    }
    if (file_exists("models/$class_name.php")) {
        include "models/$class_name.php";
    }
}