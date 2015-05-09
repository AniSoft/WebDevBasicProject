<?php

namespace Controllers;

class Home_Controller extends Master_Controller{
    public function __construct() {
        parent::__construct(get_class(), 'home', '/views/home/');
    }

    function index() {
        $template = ROOT_DIR . $this->viewsDir . 'index.php';
        include_once $this->layout;
    }
}

// <?php
//class HomeController extends BaseController {
//    function index() {
//        $this-> renderView();
//    }
//}
