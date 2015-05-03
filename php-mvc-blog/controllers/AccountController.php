<?php

class AccountController extends BaseController
{
    private $db;

    public function onInit()
    {
        $this->db = new AccountModel();
    }

    public function register()
    {
        if($this->isPost){s
            // Get username
            // Get password
            // Register user
            // Redirect user
            $this->redirect("books","index");
        }

        $this->renderView(__FUNCTION__);
    }

    public function login()
    {

    }

    public function logout()
    {

    }

}