<?php

namespace Lib;

class Database {
    private static $db = NULL;

    private function __construct() {
        $host = DB_HOST;
        $username = DB_USER;
        $password = DB_PASS;
        $dbName = DB_NAME;

        $db = new \mysqli($host, $username, $password, $dbName);
        $db->set_charset("utf8");

        self::$db = $db;
    }

    public static function get_instance() {
        static $instance = NULL;

        if ($instance === NULL) {
            $instance = new static();
        }

        return $instance;
    }

    public static function getDb() {
        return self::$db;
    }
}