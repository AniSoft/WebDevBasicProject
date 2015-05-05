<?php

class BooksModel extends BaseModel {
    public function getAll() {
        $statement = $this->db->query("SELECT * FROM Books ORDER BY Title");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllWithLimit($from, $to) {
        $statement = $this->db->prepare("SELECT * FROM Books ORDER BY Title LIMIT ?,?");
        $statement->bind_param("ii", $from, $to);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}