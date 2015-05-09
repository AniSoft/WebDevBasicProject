<?php
include_once '/config/db.php';
include_once '/controllers/master.php';
include_once '/models/master.php';
include_once '/library/phpLib/database.php';
include_once '/library/phpLib/auth.php';
include_once '/library/phpLib/Paging/Zebra_Pagination.php';
include_once '/library/phpLib/Validator/Validator.php';

use Valitron\Validator as V;

V::langDir(__DIR__.'/library/phpLib/Validator/lang');
V::lang('en');

define('ROOT_DIR', dirname(__FILE__)) . '/';
define('ROOT_DIR_NAME', basename(dirname(__FILE__)));
$request = $_SERVER['REQUEST_URI'];
$controller = 'master';
$method = 'index';
$params = array();

if (!empty($request)) {
    $requestAsParts = explode('/', $request);
    $index = array_search(ROOT_DIR_NAME, $requestAsParts);
    $newRequstParts = array_slice($requestAsParts, $index + 1);
    $request = implode('/', $newRequstParts);
    $routPrams = explode('/', $request, 3);

    if (count($routPrams) > 1) {
        list($controller, $method) = $routPrams;

        if (isset($routPrams[2])) {
            $params = $routPrams[2];
        }

        if (!file_exists('controllers/' . $controller . '.php')) {
            header("Location: " .'home/index');
            exit();
        }

        include_once 'controllers/' . $controller . '.php';
    }

    $controller_class = '\Controllers\\' . ucfirst($controller) . '_Controller';
    $instance = new $controller_class();

    $db_object = \Lib\Database::get_instance();
    $dbConnection = $db_object::getDb();

    //var_dump($db_object::getDb());


    if (method_exists($instance, $method)) {
        call_user_func_array(array($instance, $method), array($params));

    } else {
        header("Location: " . '/home/index');
        exit();
    }
}


//<?php
//require_once('application.php');
//require_once('/includes/config.php');
//
//include_once '/library/phpLib/Paging/Zebra_Pagination.php';
//include_once '/library/phpLib/Validator/Validator.php';
//
//session_start();
//$app = Application::getInstance();
//$app->start();
//
//function __autoload($class_name)
//{
//    if (file_exists("controllers/$class_name.php")) {
//        include "controllers/$class_name.php";
//    }
//    if (file_exists("models/$class_name.php")) {
//        include "models/$class_name.php";
//    }
//}