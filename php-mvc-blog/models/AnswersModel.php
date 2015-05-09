<?php

class AnswersModel extends BaseModel
{
    public function getInfo($id)
    {
        $query = sprintf(
            "SELECT * FROM answers WHERE Id = %s",
            addslashes($id));
        $data = self::$db->query($query);
        $result = $this->process_results($data);

        return $result[0];
    }

    public function add($questionId, $content, $authorName, $authorEmail)
    {
        $query = sprintf(
            "INSERT INTO answers(Content, Date, Question, AuthorName, AuthorEmail)
            VALUES ('%s', NOW(), %s, '%s', '%s')",
            addslashes($content), addslashes($questionId), addslashes($authorName), addslashes($authorEmail));
        $data = self::$db->query($query);
        $answerId = self::$db->insert_id;

        if ($answerId > 0) {
            return true;
        }

        return false;
    }

    public function edit($answerId, $content, $authorName, $authorEmail)
    {
        $query = sprintf("UPDATE answers SET Content= '%s', AuthorName = '%s', AuthorEmail = '%s' WHERE Id = %s",
            addslashes($content), addslashes($authorName), addslashes($authorEmail), addslashes($answerId));
        $data = self::$db->query($query);

        return data;
    }

    public function delete($id)
    {
        $queryDelete = sprintf("DELETE FROM answers WHERE Id = %s",
            addslashes($id));
        $data = self::$db->query($queryDelete);

        return $data;
    }
}