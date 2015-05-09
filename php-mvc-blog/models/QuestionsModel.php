<?php

class QuestionsModel extends BaseModel
{
    public function getAll()
    {
        $data = self::$db->query(
            "SELECT
                q.Id,
                q.Title,
                q.Date,
                q.Counter,
                c.Title as Category,
                u.Username
            FROM questions q
            left join categories c on q.Category=c.Id
            left join users u on q.User=u.Id
            ORDER BY Date DESC");

        return $data->fetch_all(MYSQL_ASSOC);
    }

    public function getMaxCount($category)
    {
        $query = sprintf(
            "SELECT COUNT(q.Id) as maxCount
            FROM questions q
            left join categories c on q.Category=c.Id
            left join users u on q.User=u.Id
            WHERE c.Title LIKE '%s'
            ORDER BY Date DESC",
            addslashes($category));
        $data = self::$db->query($query);

        return $this->process_results($data);
    }

    public function getAllWithPageAndCategory($from, $pageSize, $category)
    {
        $query = sprintf(
            "SELECT
                q.Id,
                q.Title,
                q.Date,
                q.Counter,
                c.Title as Category,
                u.Username,
                (SELECT COUNT(qu.Id) FROM users us JOIN questions qu ON us.Id = qu.User Where us.Id = u.Id) as UserRating
            FROM questions q
            left join categories c on q.Category=c.Id
            left join users u on q.User=u.Id
            WHERE c.Title LIKE '%s'
            ORDER BY Date DESC
            LIMIT %s, %s",
            addslashes($category),
            addslashes($from),
            addslashes($pageSize));
        $data = self::$db->query($query);

        return $this->process_results($data);
    }

    public function getMaxCountAnswer($id)
    {
        $query = sprintf(
            "SELECT COUNT(a.Id) as maxCount
            FROM questions q
            left join categories c on q.Category=c.Id
            left join users u on q.User=u.Id
            left join answers a on a.Question = q.Id
            where q.id = %s",
            addslashes($id));
        $data = self::$db->query($query);

        return $this->process_results($data);
    }

    public function getByIdWithAnswer($id, $from, $pageSize)
    {
        $queryUpdate = sprintf("Update questions Set Counter = Counter + 1 Where Id = %s", $id);
        $dataUpdate = self::$db->query($queryUpdate);

        $queryQuestion = sprintf(
            "SELECT
                q.Id,
                q.Title,
                q.Date,
                q.Counter,
                q.Content,
                c.Title as Category,
                u.Username,
                a.Id as AnswerId,
                a.Content as AnswerContent,
                a.Date as AnswerDate,
                a.AuthorName as AnswerAuthor,
                a.AuthorEmail as AnswerAuthorEmail,
                (SELECT COUNT(qu.Id) FROM users us JOIN questions qu ON us.Id = qu.User Where us.Id = u.Id) as UserRating
            FROM questions q
            left join categories c on q.Category=c.Id
            left join users u on q.User=u.Id
            left join answers a on a.Question = q.Id
            where q.id = %s
            LIMIT %s, %s",
            addslashes($id), addslashes($from), addslashes($pageSize));
        $dataQuestion = self::$db->query($queryQuestion);
        $dataWithTags = $this->process_results($dataQuestion);

        $query = sprintf(
            "SELECT
                group_concat(' ', t.Title) as Tags
            FROM questions q
            left join questions_tags qt on q.Id = qt.questionId
            left join tags t on qt.tagId = t.Id
            where q.id = %s",
            addslashes($id));
        $data = self::$db->query($query);
        $tagsFetch = $this->process_results($data);
        $dataWithTags[0]['Tags'] = $tagsFetch[0]['Tags'];

        return $dataWithTags;
    }

    public function getAllByUserId($id)
    {
        $queryQuestion = sprintf(
            "SELECT
                q.Id
            FROM questions q
            where q.User = %s",
            addslashes($id));
        $dataQuestion = self::$db->query($queryQuestion);

        return $this->process_results($dataQuestion);
    }

    public function getAllTagsAndCategories()
    {
        $categories = self::$db->query("SELECT * FROM categories");
        $categoriesFetch = $this->process_results($categories);

        $tags = self::$db->query("SELECT * FROM tags");
        $tagsFetch = $this->process_results($tags);

        $union = array();
        $union['categories'] = $categoriesFetch;
        $union['tags'] = $tagsFetch;

        return $union;
    }

    public function add($title, $content, $categoryId, $tags)
    {
        $queryUser = sprintf("SELECT Id FROM users WHERE username = '%s'", $_SESSION['username']);
        $data = self::$db->query($queryUser);
        $user = $this->process_results($data);
        $userId = $user[0]['Id'];

        $query = sprintf(
            "INSERT INTO questions (Title, Content, Date, Counter, Category, User)
            VALUES ('%s', '%s', NOW(), %s , %s, %s)",
            addslashes($title), addslashes($content), 0, addslashes($categoryId), addslashes($userId));
        $data = self::$db->query($query);
        $questionId = self::$db->insert_id;

        if ($questionId > 0) {
            foreach ($tags as $tag) {
                $query = sprintf(
                    "INSERT INTO questions_tags (questionId, tagId)
                    VALUES (%s, %s)",
                    addslashes($questionId), addslashes($tag));
                $data = self::$db->query($query);
            }
        } else {
            return false;
        }

        return $questionId;
    }

    public function getInfo($id)
    {
        $query = sprintf(
            "SELECT q.Title as Title, q.Content as Content, c.Title as Category
            FROM questions q JOIN categories c ON q.Category = c.Id WHERE q.Id = %s",
            addslashes($id));
        $data = self::$db->query($query);
        $result = $this->process_results($data);

        $queryTags = sprintf(
            "SELECT t.Title
            FROM questions q
            JOIN questions_tags qt ON q.Id = qt.questionId
            JOIN tags t ON qt.tagId = t.Id
            WHERE q.Id = %s",
            addslashes($id));
        $dataTags = self::$db->query($queryTags);
        $tags = $this->process_results($dataTags);
        $tagsArr = array();
        foreach ($tags as $t) {
            $tagsArr[] = $t['Title'];
        }
        $result[0]['Tags'] = $tagsArr;
        return $result[0];
    }

    public function edit($id, $title, $content, $categoryId, $tags)
    {
        $query = sprintf("UPDATE questions SET Title= '%s', Content = '%s', Category = %s WHERE Id = %s",
            addslashes($title), addslashes($content), addslashes($categoryId), addslashes($id));
        $data = self::$db->query($query);
        if ($data) {
            $queryDelete = sprintf("DELETE FROM questions_tags WHERE questionId = %s",
                addslashes($id));
            self::$db->query($queryDelete);
            foreach ($tags as $tag) {
                $query = sprintf(
                    "INSERT INTO questions_tags (questionId, tagId)
                    VALUES (%s, %s)",
                    addslashes($id), addslashes($tag));
                $data = self::$db->query($query);
            }

            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $queryDeleteReferenceTags = sprintf("DELETE FROM questions_tags WHERE questionId = %s",
            addslashes($id));
        self::$db->query($queryDeleteReferenceTags);
        $queryDeleteAnswer = sprintf("DELETE FROM answers WHERE Question = %s",
            addslashes($id));
        self::$db->query($queryDeleteAnswer);
        $query = sprintf(
            "DELETE FROM questions WHERE Id = %s",
            addslashes($id));
        $data = self::$db->query($query);

        return $data;
    }

    public function searchByQuestion($searchWord)
    {
        $query = sprintf(
            "SELECT
                q.Id,
                q.Title
            FROM questions q
            WHERE q.Title LIKE '%s' OR q.Content LIKE '%s'
            ORDER BY Date DESC",
            addslashes($searchWord), addslashes($searchWord));
        $data = self::$db->query($query);

        return $this->process_results($data);
    }

    public function searchByAnswer($searchWord)
    {
        $query = sprintf(
            "SELECT
                distinct q.Id,
                q.Title
            FROM questions q
            JOIN answers a on a.Question = q.Id
            WHERE a.Content LIKE '%s'
            ORDER BY q.Date DESC",
            addslashes($searchWord));
        $data = self::$db->query($query);

        return $this->process_results($data);
    }

    public function searchByTag($searchWord)
    {
        $query = sprintf(
            "SELECT
                distinct q.Id,
                q.Title
            FROM questions q
            JOIN questions_tags qt on q.Id = qt.questionId
            JOIN tags t on qt.tagId = t.Id
            WHERE t.Title LIKE '%s'
            ORDER BY Date DESC",
            addslashes($searchWord));
        $data = self::$db->query($query);

        return $this->process_results($data);
    }

    public function ranking()
    {
        $query = sprintf(
            "SELECT Username, COUNT(qu.Id) as Activity
              FROM users us LEFT JOIN questions qu ON us.Id = qu.User
              GROUP BY qu.User
              ORDER BY COUNT(qu.Id) desc
              LIMIT 0, 10");
        $data = self::$db->query($query);

        return $this->process_results($data);
    }
}