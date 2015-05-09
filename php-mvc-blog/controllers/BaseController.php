<?php
class BaseController {
    protected $controller;
    protected $isViewRendered = false;
    protected $layoutName = DEFAULT_LAYOUT;
    protected $isPost = false;

    public function __construct ($controller) {
        $this->controller = $controller;
        $this->onInit();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $this->isPost = true;
        }
        if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == true){
            $this->layoutName = "admin";
        }
    }

    public function onInit(){

    }

    public function index() {
        $this->renderView();
    }

    public function renderView($viewName = DEFAULT_ACTION){
        if(! $this->isViewRendered) {
            include_once('views/layouts/' . $this->layoutName . '/header.php');
            include_once('views/' . $this->controller . '/' . $viewName . '.php');
            include_once('views/layouts/' . $this->layoutName . '/footer.php');
            $this->isViewRendered = true;
        }
    }

    public function authorize() {
        if(!isset($_SESSION['username'])){
            $this->addErrorMessage("Please login first");
            $this->redirect('accounts', 'login');
        }
    }

    public function isAdmin() {
        if(!isset($_SESSION['isAdmin'])){
            $this->addErrorMessage("Please login as admin first");
            $this->redirect('accounts', 'login');
        }
    }

    function addMessage($msg, $type) {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = array();
        };
        array_push($_SESSION['messages'],
            array('text' => $msg, 'type' => $type));
    }

    function addSuccessMessage($msg) {
        $this->addMessage($msg, 'success');
    }

    function addErrorMessage($msg) {
        $this->addMessage($msg, 'danger');
    }

    public function redirectToUrl($url) {
        header("Location: " . $url);
        die;
    }

    public function redirect(
        $controllerName, $actionName = DEFAULT_ACTION, $params = null) {
        $url = '/' . urlencode($controllerName);
        $url .= '/' . urlencode($actionName);
        if ($params != null) {
            $encodedParams = array_map($params, 'urlencode');
            $url .= implode('/', $encodedParams);
        }
        $this->redirectToUrl($url);
    }
}