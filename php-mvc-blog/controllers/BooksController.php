<?php

class BooksController extends BaseController
{
    public function onInit()
    {
        $this->title = "Books";
    }

    // Presentation Logic
    public function index()
    {
        $this->renderView();
    }
}

