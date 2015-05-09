<?php

namespace Models;

class Register_Model extends Master_Model
{
    public function __construct($args = array())
    {
        parent::__construct(array('table' => 'users'));
    }

    public function registerUser($userData)
    {
        $firstName = $userData['firstName'];
        $lastName = $userData['lastName'];
        $username = $userData['username'];
        $email = $userData['email'];
        $password = $userData['password'];

        $isUsernameFreeCheck = $this->db->prepare(
            "SELECT COUNT(u.id) AS count
                FROM users u
                WHERE u.username = ?");

        $isUsernameFreeCheck->bind_param("s", $username);

        $count = $this->exuteStatementWithResultArray($isUsernameFreeCheck)[0]['count'];

        if ($count > 0) {
            return FALSE;
        }

        $statement = $this->db->prepare(
            "INSERT INTO users(first_name, last_name, username, password, email)
            VALUES(?, ?, ?, ?, ?)");
        $statement->bind_param("sssss", $firstName, $lastName, $username, md5($password), $email);

        return $this->exuteStatement($statement);
    }
}
