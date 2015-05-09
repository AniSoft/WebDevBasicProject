<?php
class AccountsModel extends BaseModel {

    public function register($username, $password, $email, $fullName){
        $query = sprintf("SELECT COUNT(Id) FROM users WHERE Username =  '%s'",
            addslashes($username));
        $data = self::$db->query($query);
        $result = $this->process_results($data);
        if($result['COUNT(Id)'] != 0){
            return false;
        }
        $hash_password = password_hash($password, PASSWORD_BCRYPT);
        $queryInsert = sprintf(
            "INSERT INTO users (Username, Password, Email, FullName, IsAdmin)
            VALUES ('%s', '%s', '%s', '%s', 0)",
            addslashes($username), $hash_password, addslashes($email), addslashes($fullName));
        $dataInsert = self::$db->query($queryInsert);
        $userId = self::$db->insert_id;
        if($userId > 0){
            return true;
        } else {
            return false;
        }
    }

    public function login($username, $password){
        $query = sprintf("SELECT * FROM users WHERE Username =  '%s'",
            addslashes($username));
        $data = self::$db->query($query);
        $result = $this->process_results($data);
        if(password_verify($password, $result[0]['Password'])){
            return $result;
        }
        return false;
    }

    public function editProfile($username, $fullName, $email, $isAdmin = 0){
        $query = sprintf("UPDATE users SET FullName= '%s', Email = '%s', IsAdmin = %s WHERE Username = '%s'",
            addslashes($fullName), addslashes($email), $isAdmin, addslashes($username));
        $data = self::$db->query($query);
        $result = self::$db->affected_rows;
        if($result > 0){
            return true;
        }
        return false;
    }

    public function editPassword($username, $oldPassword, $newPassword){
        $query = sprintf("SELECT Password FROM users WHERE Username =  '%s'",
            addslashes($username));
        $data = self::$db->query($query);
        $result = $this->process_results($data);

        if(password_verify($oldPassword, $result[0]['Password'])){
            $pass_hash = password_hash($newPassword, PASSWORD_BCRYPT);
            $queryEdit = sprintf("UPDATE users SET Password= '%s' WHERE Username = '%s'",
                $pass_hash, addslashes($username));
            $dataEdit = self::$db->query($queryEdit);
            $resultEdit = self::$db->affected_rows;
            if($resultEdit > 0){
                return true;
            }
        }
        return false;
    }

    public function getInfo($username){
        $query = sprintf("Select Id, Username, Email, FullName from users WHERE Username =  '%s'",
            addslashes($username));
        $data = self::$db->query($query);
        $result = $this->process_results($data);

        if($result[0]['Id'] == 0){
            return false;
        }

        return $result[0];
    }

    public function getInfoById($id){
        $query = sprintf("Select Id, Username, Email, FullName, IsAdmin from users WHERE Id =  '%s'",
            addslashes($id));
        $data = self::$db->query($query);
        $result = $this->process_results($data);

        if($result[0]['Id'] == 0){
            return false;
        }

        return $result[0];
    }

    public function getMaxCount(){
        $data = self::$db->query("SELECT COUNT(Id) as maxCount FROM users ");
        return $this->process_results($data);
    }

    public function getAll($from, $pageSize){
        $query = sprintf("SELECT * FROM users LIMIT %s, %s", addslashes($from), addslashes($pageSize));
        $data = self::$db->query($query);
        $result = $this->process_results($data);
        return $result;
    }

    public function delete($id){
        $questionModel = new QuestionsModel();
        $allQuestion = $questionModel->getAllByUserId($id);
        foreach ($allQuestion as $question) {
            $questionModel->delete($question['Id']);
        }

        $query = sprintf(
            "DELETE FROM users WHERE Id = %s",
            addslashes($id));
        $data = self::$db->query($query);
        $isChange = self::$db->affected_rows;
        if($isChange > 0){
            return true;
        } else {
            return false;
        }
    }
}