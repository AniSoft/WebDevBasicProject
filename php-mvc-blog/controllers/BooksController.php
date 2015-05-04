<?php

class BooksController extends BaseController {
    private $db;

    function __construct() {
        parent::__construct("Books");
        $this->db = new BooksModel();
    }

    public function index() {
        $this->authorize();

        $this->books = $this->db->getAll();

        $this->renderView(__FUNCTION__, false);
    }

    public function all() {
        $this->page = 0;
        $this->pageSize = 10;
        if (isset($_GET['page'])) {
            $this->page = $_GET['page'];
        }

        if (isset($_GET['pageSize'])) {
            $this->pageSize = $_GET['pageSize'];
        }

        $from = $this->page * $this->pageSize;
        $to = $from + $this->pageSize;
        $this->books = $this->db->getAllWithLimit($from, $to);
        $this->renderView(__FUNCTION__);
    }
}
