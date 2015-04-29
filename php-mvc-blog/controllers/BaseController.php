<?php

abstract class BaseController
{
    protected $controllerName;
    protected $actionName;
    protected $isViewRendered = false;

    public function _construct($controllerName, $actionName)
    {
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
        $this->onInit();
    }

    public function onInit()
    {
        // Implement initializing logic in the subclasses
    }

    // Print Default View for current Action
    public function renderView($viewName = null)
    {
        if (!$this->isViewRendered) {
            if ($viewName == null) {
                $viewName = $this->actionName;
            }

            $viewFileName = 'views/' . $this->controllerName
                . '/' . $viewName . '.php';
            include_once($viewFileName);
            $this->isViewRendered=true;
        }
    }
}