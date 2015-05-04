<?php

class BooksController extends BaseController
{
    private $db;
    public function onInit()
    {
        $this->title = "Books";
        $this->db=new BooksMOdel();
    }

    // Presentation Logic
    public function index()
    {
        $this->authorize();
        $this->renderView();
    }

    // Method
    public function showBooks(){

    }
}

