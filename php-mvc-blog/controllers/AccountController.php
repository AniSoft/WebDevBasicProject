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
        if ($this->isPost) {
            $username = $_POST['username'];
            if ($username == null || strlen($username < 3)) {
                $this->addErrorMessage("Username is invalid!");
                $this->redirect("account", "register");
            }

            $password = $_POST['password'];
            $isRegistered = $this->db->register($username, $password);
            if ($isRegistered) {
                $this->redirect("books", "index");
            } else {
                $this->addErrorMessage("Register failed");
            }
        }

        $this->renderView(__FUNCTION__);
    }

    public function login()
    {

        $this->renderView(__FUNCTION__);
    }

    public function logout()
    {

    }

}