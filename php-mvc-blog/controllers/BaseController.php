<?php

abstract class BaseController
{
    protected $controllerName;
    protected $action;
    protected $isViewRendered = false;

    function _construct($controllerName, $action)
    {
        $this->controllerName = $controllerName;
        $this->action = $action;
    }

    public function index()
    {
        // Implement the default action in the subclasses
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