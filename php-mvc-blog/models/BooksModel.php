<?php
class BooksModel extends BaseModel{
    public function getAll(){
        $statement=self::$db->prepare("SELECT id,title FROM books");
        $result=$statement->fetch_all();
        return $result;
    }
}