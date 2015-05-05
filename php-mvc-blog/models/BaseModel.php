<?php

abstract class BaseModel
{
    protected $db;

    public function __construct()
    {
        if ($this->db == null) {
            $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            $this->db->set_charset("utf8");
            if ($this->db->connect_errno) {
                die('Cannot connect to database');
            }
        }
    }
}
