<?php
class BooksModel extends BaseModel{
    public function getAll(){
        $statement=self::$db->prepare("SELECT title FROM books");
        $result=$statement->fetch_all();
        var_dump($result);
        return $result;
    }
}