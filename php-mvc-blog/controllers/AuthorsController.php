<?php

class AuthorsController extends BaseController
{
    private $db;
    public function onInit()
    {
        $this->title = "Authors";
        $this->db=new AuthorsMOdel();
    }

    // Presentation Logic
    public function index()
    {
        $this->authors= $this->db->getAll();
    }

    // Method Action create
    public function create()
    {
        if($this->isPost){
            $name=$_POST['name'];
            $this->author=$this->db->createaAuthor($name);
        }
    }

    public function delete()
    {
        $this->renderView("index");
    }

}

