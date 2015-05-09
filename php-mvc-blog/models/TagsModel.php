<?php

class TagsModel extends BaseModel
{

    public function getMaxCount()
    {
        $data = self::$db->query("SELECT COUNT(Id) as maxCount FROM tags ");
        return $this->process_results($data);
    }

    public function getAllWithPage($from, $pageSize)
    {
        $query = sprintf("SELECT * FROM tags ORDER BY Id LIMIT %s, %s",
            addslashes($from), addslashes($pageSize));
        $data = self::$db->query($query);
        return $this->process_results($data);
    }

    public function getInfo($id)
    {
        $query = sprintf("SELECT * FROM tags WHERE Id = %s",
            addslashes($id));
        $data = self::$db->query($query);
        $result = $this->process_results($data);
        return $result[0];
    }

    public function add($title)
    {
        $query = sprintf(
            "INSERT INTO tags (Title) VALUES ('%s')",
            addslashes($title));
        $data = self::$db->query($query);
        $isChange = self::$db->insert_id;
        if ($isChange > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function edit($id, $title)
    {
        $query = sprintf("UPDATE tags SET Title= '%s' WHERE Id = %s",
            addslashes($title), addslashes($id));
        $data = self::$db->query($query);
        $isChange = self::$db->affected_rows;
        if ($isChange > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $query = sprintf(
            "DELETE FROM tags WHERE Id = %s",
            addslashes($id));
        $data = self::$db->query($query);
        $isChange = self::$db->affected_rows;
        if ($isChange > 0) {
            return true;
        } else {
            return false;
        }
    }
}