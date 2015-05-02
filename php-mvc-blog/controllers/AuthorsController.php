<?php

class AuthorsController extends BaseController
{
    private $model;
    public function onInit()
    {
        $this->title = "Authors";
        $this->model=new AuthorsMOdel();
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
        if($this->isPost){
            // TODO:save user in DB
        }
    }

    public function delete()
    {
        $this->renderView("index");
    }

}

