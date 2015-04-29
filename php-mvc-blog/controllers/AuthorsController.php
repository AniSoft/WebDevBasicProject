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
        $this->authors = array(
            array('id' => 10, 'name' => "Ivan"),
            array('id' => 20, 'name' => "Pesho"),
            array('id' => 30, 'name' => "Maria")
        );
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
