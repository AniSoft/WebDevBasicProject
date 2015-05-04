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
    public function index($page,$pageSize)
    {
        $page=$_GET['page'];
        $pageSize=$_GET['pageSize'];

        $this->authorize();
        $this->books=$this->db->getAll();
        $this->renderView();
    }

    // Method
    public function showBooks(){
        $this->$books=$this->db->getAll();
        $this->renderView(__FUNCTION__,false);
    }
}

