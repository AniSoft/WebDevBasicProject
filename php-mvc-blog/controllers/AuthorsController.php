<?php

class AuthorsController extends BaseController
{
    private $db;

    public function onInit()
    {
        $this->title = "Authors";
        $this->db = new AuthorsMOdel();
    }

    // Presentation Logic
    public function index()
    {
        $this->authors = $this->db->getAll();
    }

    // Method Action create
    public function create()
    {
        if ($this->isPost) {
            $name = $_POST['author_name'];

            if ($this->db->createaAuthor($name)) {
                $this->addInfoMessage("Author created.");
            } else {
                $this->addInfoMessage("Error creating Author.");
            }
            $this->redirect('authors');
        }
    }

    public function delete($id)
    {
        $this->db->deleteAuthor($id);
        $this->redirect('authors');
    }
}

