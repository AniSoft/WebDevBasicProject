<?php

abstract class BaseController
{
    protected $controllerName;
    protected $action;
    protected $isViewRendered = false;

    public function _construct($controllerName, $action)
    {
        $this->controllerName = $controllerName;
        $this->action = $action;
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
                $viewName = $this->action;
            }

            $viewFileName = 'views/' . $this->controllerName
                . '/' . $viewName . '.php';
            include_once($viewFileName);
            $this->isViewRendered=true;
        }
    }
}