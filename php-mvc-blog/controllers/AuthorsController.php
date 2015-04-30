<?php

class AuthorsController extends BaseController
{
    public function onInit()
    {
        $this->title = "Pesho";
    }

    // Presentation Logic
    public function index()
    {
        $model=new AuthorsModel();
        $this->authors= $model->getAll();

    }

    // Method Action create
    public function create()
    {
        $this->renderView("create");
    }

    public function delete()
    {
        $this->renderView("index");
    }

}

