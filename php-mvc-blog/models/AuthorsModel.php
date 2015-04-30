<?php
class AuthorModel extends BaseModel{
    public function getAll(){
        $statement = self::$db->query(
            "SELECT * FROM authors ORDER BY id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
}