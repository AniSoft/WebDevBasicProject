<?php

class AccountController extends BaseController {
    private $model;
    function __construct() {
        parent::__construct("Account");
        $this->model = new AccountModel();
    }

    public function register() {
        if($this->isPost) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $registrationSuccess = $this->model->register($username, $password);
            if($registrationSuccess) {
                $_SESSION['username'] = $username;
                $this->addInfoMessage("Successful registration");
            }
            else {
                $this->addErrorMessage("Registration error!");
            }

            $this->redirect("authors");
        }

        $this->renderView(__FUNCTION__);
    }

    public function login() {
        if($this->isPost) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $loginSuccess = $this->model->login($username, $password);
            if ($loginSuccess) {
                $_SESSION['username'] = $username;
                $this->addInfoMessage("Login success");
                $this->redirect("authors");
            }
            else {
                $this->addErrorMessage("Login error");
                $this->redirect("account", "login");
            }
        }

        $this->renderView(__FUNCTION__);
    }

    public function logout() {
        $this->authorize();

        var_dump($this->isPost);
        if($this->isPost) {
            session_destroy();
            session_start();
            $this->addInfoMessage("You are logged out!");
            $this->redirect("Home");
        }
    }
}