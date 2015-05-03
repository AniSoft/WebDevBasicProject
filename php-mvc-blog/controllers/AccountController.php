<?php

class AccountController extends BaseController
{
    private $db;

    public function onInit(){
        $this->db=new AccountModel();
    }

    public function register()
    {
        var_dump($_POST);
        $this->renderView(__FUNCTION__);
    }

    public function login()
    {

    }

    public function logout()
    {

    }

}