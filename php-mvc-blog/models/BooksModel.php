<?php
class BookModel extends  BaseModel{
    public function getAll(){
        $statement=self::$db->prepare("SELECT title FROM books");
        $result=$statement->fetch_all();
        return $result;
    }
}