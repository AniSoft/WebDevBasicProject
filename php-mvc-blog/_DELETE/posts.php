<?php

namespace Models;

class Post_Model extends Master_Model{
    public function __construct($args = array()) {
        parent::__construct(array('table' => 'posts'));
    }

    public function getAllPosts($tagName = NULL, $date = NULL) {

        if ($tagName != NULL) {
            $tagName = '%' . mysql_real_escape_string($tagName) . '%';
            $statement = $this->db->prepare(
                "SELECT
                    p.id,
                    p.text,
                    p.user_id,
                    p.visits,
                    p.title,
                    p.date
                FROM posts p
                LEFT JOIN posts_tags pt
                ON p.id = pt.post_id
                LEFT JOIN tags t
                ON pt.tag_id = t.id
                WHERE t.text LIKE ?
                ORDER BY p.DATE DESC");
            $statement->bind_param("s", $tagName);
            return $this->exuteStatementWithResultArray($statement);
        }

        if ($date != NULL) {
            return $this->find(array(
                'order' => 'date DESC',
                'where' => "date >= '$date'" ));
        }

        return $this->find(array('order' => 'date DESC'));
    }

    public function getByPeriod($date) {
        $statement = $this->db->prepare(
            "SELECT
                p.id,
                p.text,
                p.user_id,
                p.visits,
                p.title,
                p.date
            FROM posts p
            LEFT JOIN posts_tags pt
            ON p.id = pt.post_id
            LEFT JOIN tags t
            ON pt.tag_id = t.id
            WHERE p.date > ?
            ORDER BY p.DATE DESC");
        $statement->bind_param("s", $date);

        return $this->exuteStatementWithResultArray($statement);
    }

    public function getTagsForPost($postId){
        $statement = $this->db->prepare(
            "SELECT
            t.id,
            t.text
        FROM tags t
        JOIN posts_tags pt
        ON t.id = pt.tag_id
        WHERE pt.post_id = ?
        LIMIT 5");

        $statement->bind_param("i", $postId);
        return $this->exuteStatementWithResultArray($statement);
    }

    public function addPost($postData) {

        // Post insertation preparation
        $queryData = array();
        $queryData['columns'] = 'user_id, text, visits, title, date';
        $queryData['values'] =
            mysql_real_escape_string($postData['user_id']) . ", '"
            . mysql_real_escape_string($postData['text']) . "', "
            . mysql_real_escape_string($postData['visits']) . ", '"
            . mysql_real_escape_string($postData['title']) . "', '"
            . mysql_real_escape_string($postData['date']) . "'";

        $this->db->autocommit(FALSE);
        $postInsertResult = $this->insert($queryData);
        $post_id = $this->db->insert_id;

        $tagsInsertQuery = "INSERT IGNORE INTO tags(text) VALUES";
        $tagsInsertQuery .= "('" . implode("'), ('", $postData['tags']) . "')";

        $insertTagsStatement = $this->db->prepare($tagsInsertQuery);
        $isertTagsResult = $this->exuteStatement($insertTagsStatement);

        if (!$isertTagsResult) {
            $this->db->trans_rollback();
            return FALSE;
        }

        $getTagsIdQuery = "SELECT t.id FROM tags t WHERE t.text IN ";
        $getTagsIdQuery .= "('" . implode("', '", $postData['tags']) . "')";

        $getTagsIdStatement = $this->db->prepare($getTagsIdQuery);
        $tagsIds = $this->exuteStatementWithResultArray($getTagsIdStatement);
        if (count($tagsIds) < 1) {
            $this->db->rollback();
            return FALSE;
        }

        $finalTagsIdsList = array();
        foreach ($tagsIds as $value) {
            $finalTagsIdsList[] = $value['id'];
        }

        // Posts_tags insertation preparation
        $postsTagsQueryData = array(
            'table' => 'posts_tags',
            'columns' => 'post_id, tag_id',
            'values' => "'$post_id', '" . implode("'), ('$post_id', '", $finalTagsIdsList) . "'"
        );

        $postsTagsIsnertResult = $this->insert($postsTagsQueryData);

        if (!$postsTagsIsnertResult) {
            $this->db->rollback();
            return FALSE;
        }

        $this->db->commit();
        $this->db->autocommit(TRUE);
        return TRUE;
    }

    public function getPostById($id) {
        return $this->getById(mysql_real_escape_string($id));
    }

    public function getAllCommentsForPost($id) {
        $queryData = array();
        $queryData['table'] = " comments";
        $queryData['where'] = " post_id = " . mysql_real_escape_string($id);
        return $this->find($queryData);
    }

    public function insertComment($commentData) {
        $queryData = array();
        $queryData['table'] = 'comments';
        $queryData['columns'] = 'author, email, text, post_id, date';
        $queryData['values'] =
            "'" . mysql_real_escape_string($commentData['author']) . "', '"
            . mysql_real_escape_string($commentData['email'] == '' ? NULL : $commentData['email']) . "', '"
            . mysql_real_escape_string($commentData['text']) . "', '"
            . mysql_real_escape_string($commentData['post_id']) . "', '"
            . mysql_real_escape_string($commentData['date']) . "'";
        return $this->insert($queryData);
    }

    public function updateCounter($id) {
        $queryData = array();
        $queryData['table'] = 'posts';
        $queryData['set'] = "visits = visits + 1";
        $queryData['where'] = "id = " . mysql_real_escape_string($id);
        return $this->update($queryData);
    }

    public function getThenMostPopularTags() {
        $statement = $this->db->prepare("SELECT
                t.id,
                t.text,
                COUNT(t.text) AS popularity
        FROM blog_system.posts_tags pt
        LEFT JOIN tags t
        ON pt.tag_id = t.id
        GROUP BY t.text
        ORDER BY popularity DESC
        LIMIT 10");
        return $this->exuteStatementWithResultArray($statement);
    }
}