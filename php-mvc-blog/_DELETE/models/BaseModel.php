<?php

abstract class BaseModel {
    protected static $db;

    public function __construct() {
        if (self::$db == null) {
            self::$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, 3306);
            if (self::$db->connect_errno) {
			var_dump(self::$db->connect_errno);
                die('Cannot connect to database');
            }
            self::$db->set_charset("utf8");
        }
    }

    protected function process_results( $result_set ) {
        $results = array();

        if( ! empty( $result_set ) && $result_set->num_rows > 0) {
            while($row = $result_set->fetch_assoc()) {
                $results[] = $row;
            }
        }

        return $results;
    }


}
