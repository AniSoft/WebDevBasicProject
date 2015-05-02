<?php

class AuthorsController extends BaseController {
    private $db;

    public function onInit() {
        $this->title = "Authors";
        $this->db = new AuthorsModel();
    }

    public function index() {
        $this->authors = $this->db->getAll();
    }

    public function create() {
        if ($this->isPost) {
            $name = $_POST['author_name'];
            if ($this->db->createAuthor($name)) {
                $this->addInfoMessage("Author created.");
                $this->redirect('authors');
            } else {
                $this->addErrorMessage("Error creating author.");
            }
        }
    }

    public function delete($id) {
        if ($this->db->deleteAuthor($id)) {
            $this->addInfoMessage("Author deleted.");
        } else {
            $this->addErrorMessage("Cannot delete author.");
        }
        $this->redirect('authors');
    }
}