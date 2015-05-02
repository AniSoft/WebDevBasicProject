<?php

abstract class BaseController
{
    protected $controllerName;
    protected $actionName;
    protected $layoutName = DEFAULT_LAYOUT;
    protected $isViewRendered = false;
    protected $isPost = false;

    function __construct($controllerName, $actionName)
    {
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->isPost = true;
        }
        $this->onInit();
    }

    public function onInit()
    {
        // Implement initializing logic in the subclasses
    }

    public function index()
    {
        // Implement the default action in the subclasses
    }

    public function renderView($viewName = null, $includeLayout = true)
    {
        if (!$this->isViewRendered) {
            if ($viewName == null) {
                $viewName = $this->actionName;
            }
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

    public function redirectToUrl($url)
    {
        header("Location: " . $url);
        die;
    }

    public function redirect(
        $controllerName, $actionName = null, $params = null)
    {
        $url = '/' . urlencode($controllerName);
        if ($actionName != null) {
            $url .= '/' . urlencode($actionName);
        }
        if ($params != null) {
            $encodedParams = array_map($params, 'urlencode');
            $url .= implode('/', $encodedParams);
        }
        $this->redirectToUrl($url);
    }

    function addMessage($msg, $type)
    {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = array();
        };
        array_push($_SESSION['messages'],
            array('text' => $msg, 'type' => $type));
    }

    function addInfoMessage($msg)
    {
        $this->addMessage($msg, 'info');
    }

    function addErrorMessage($msg)
    {
        $this->addMessage($msg, 'error');
    }
}
