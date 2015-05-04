<?php

class BooksController extends BaseController
{
    private $db;

    public function onInit()
    {
        $this->title = "Books";
        $this->db=new BooksModel();
    }

    // Presentation Logic
    public function index()
    {
        $this->authorize();
        $this->renderView();
    }

    // Method
    public function showBooks(){
        $this->$books=$this->db->getAll();
        $this->renderView(__FUNCTION__,false);
    }
}

