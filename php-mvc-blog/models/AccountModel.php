<?php

class AccountModel extends BaseModel {
    public function __construct() {
        parent::__construct();
        session_set_cookie_params(1800,"/");
    }

    public function register($username, $password) {
        $statement = $this->db->prepare("SELECT Id FROM users WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result();
        if($result->fetch_all()) {
            return false;
        }

        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $statement2 = $this->db->prepare("INSERT INTO users (username, pass_hash) VALUES (?, ?)");
        $statement2->bind_param("ss", $username, $password_hash);
        $statement2->execute();

        return true;
    }

    public function login($username, $password) {
        $statement = $this->db->prepare("SELECT Id, username, pass_hash FROM users WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result();
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['pass_hash'])) {
            return true;
        }

        return false;
    }
}