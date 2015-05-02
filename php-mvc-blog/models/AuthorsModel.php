<?php
class AuthorModel extends BaseModel{
    public function getAll(){
        $statement = self::$db->query(
            "SELECT * FROM authors ORDER BY id");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function createAuthor($name){
        if ($name == '') {
            return false;
        }
        $statement = self::$db->prepare(
            "INSERT INTO authors VALUES(NULL, ?)");
        $statement->bind_param("s", $name);
        $statement->execute();
        return $statement->affected_rows > 0;
    }
}