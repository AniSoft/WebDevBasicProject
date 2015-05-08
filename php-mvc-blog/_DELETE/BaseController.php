<?php

abstract class BaseController {
    protected $controllerName;
    protected $layoutName = DEFAULT_LAYOUT;
    protected $isViewRendered = false;
    protected $isPost = false;

    function __construct($controllerName) {
        $this->controllerName = $controllerName;
        $this->title = $controllerName;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->isPost = true;
        }
    }

    public function index() {
        // Implement the default action in the subclasses
    }

    public function renderView($viewName = "Index", $includeLayout = true) {
        if (!$this->isViewRendered) {
            $viewFileName = 'views/' . $this->controllerName
                . '/' . $viewName . '.php';
            if ($includeLayout) {
                $headerFile = 'views/layouts/' . $this->layoutName . '/header.php';
                include_once($headerFile);
            }

            include_once($viewFileName);
            if ($includeLayout) {
                $footerFile = 'views/layouts/' . $this->layoutName . '/footer.php';
                include_once($footerFile);
            }
            $this->isViewRendered = true;
        }
    }

    public function redirectToUrl($url) {
        header("Location: " . $url);
        die;
    }

    public function redirect($controllerName, $actionName = "Index", $params = null) {
        $url = '/' . urlencode($controllerName);
        $url .= '/' . urlencode($actionName);

        if ($params != null) {
            $encodedParams = array_map($params, 'urlencode');
            $url .= implode('/', $encodedParams);
        }

        $this->redirectToUrl($url);
    }

    function addInfoMessage($msg) {
        $this->addMessage($msg, 'info');
    }

    function addErrorMessage($msg) {
        $this->addMessage($msg, 'error');
    }

    function addMessage($msg, $type) {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = array();
        };
        array_push($_SESSION['messages'],
            array('text' => $msg, 'type' => $type));
    }

    public function isLoggedIn() {
        if ( isset( $_SESSION['username'] ) ) {
            return true;
        }

        return false;
    }

    public function getUsername() {
        if ($this->isLoggedIn()) {
            return $_SESSION['username'];
        }

        return null;
    }

    public function authorize() {
        if (!$this->isLoggedIn()) {
            $this->addErrorMessage("Please login first");
            $this->redirect("account", "login");
        }
    }
}
