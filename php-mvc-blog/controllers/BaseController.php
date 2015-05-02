<?php

abstract class BaseController
{
    protected $controllerName;
    protected $actionName;
    protected $layoutName=DEFAULT_LAYOUT;
    protected $isViewRendered = false;
    protected $isPost=false;

    public function _construct($controllerName, $actionName)
    {
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $this->isPost=true;
        }
        $this->onInit();
    }

    public function onInit()
    {
        // Implement initializing logic in the subclasses
    }

    // Print Default View for current Action
    public function renderView($viewName = null,$includeLayout=true)
    {
        if (!$this->isViewRendered) {
            if ($viewName == null) {
                $viewName = $this->actionName;
            }

            $viewFileName = 'views/' . $this->controllerName
                . '/' . $viewName . '.php';
            if($includeLayout){
                $headerFile='views/layout/'.$this->layoutName.'/header.php';
                include_once($headerFile);
            }

            include_once($viewFileName);

            if($includeLayout){
                $footerFile='views/layout/'.$this->layoutName.'/footer.php';
                include_once($footerFile);
            }

            $this->isViewRendered=true;
        }
    }
}