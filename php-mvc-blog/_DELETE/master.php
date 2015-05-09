<?php

namespace Models;

class Master_Model {

    protected $table;
    protected $limit;
    protected $db;

    public function __construct($args = array()) {
        $defaults = array(
            'limit' => 0
        );

        $args = array_merge($defaults, $args);

        if (!isset($args['table'])) {
            // TODO: Make corect behavier!
            die('Table not definde.');
        }

        extract($args);

        $this->table = $table;
        $this->limit = $limit;

        $db_object = \Lib\Database::get_instance();
        $this->db = $db_object::getDb();
    }

    public function exuteStatementWithResultArray($statement) {
        $statement->execute();
        $rows = $statement->get_result();
        return $this->processResultSet($rows);
    }

    public function exuteStatement($statement) {
        if ($statement->execute()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getById($id) {
        return $this->find(array('where' => "id = $id"));
    }

    public function update($args = array()) {
        $defaults = array(
            'table' => $this->table,
            'set' => '',
            'where' => ''
        );

        $args = array_merge($defaults, $args);
        extract($args);
        $query = "UPDATE {$table} SET {$set} WHERE {$where}";
        $resultSet = $this->db->query($query);
        if (gettype($resultSet) == 'boolean') {
            return $resultSet;
        }

        $results = $this->processResultSet($resultSet);
        return $results;
    }

    public function insert($args = array()) {
        $defaults = array(
            'table' => $this->table,
            'columns' => '',
            'values' => ''
        );

        $args = array_merge($defaults, $args);
        extract($args);
        $query = "INSERT IGNORE INTO {$table}({$columns}) VALUES({$values})";
        $resultSet = $this->db->query($query);
        if (gettype($resultSet) == 'boolean') {
            return $resultSet;
        }

        $results = $this->processResultSet($resultSet);
        return $results;
    }

    public function find($args = array()) {
        $defaults = array(
            'table' => $this->table,
            'limit' => $this->limit,
            'where' => '',
            'columns' => '*',
            'order' => ''
        );

        $args = array_merge($defaults, $args);
        extract($args);

        $query = "SELECT {$columns} FROM {$table}";

        if (!empty ($where)) {
            $query .= " WHERE $where";
        }

        if (!empty ($limit)) {
            $query .= " LIMIT $limit";
        }

        if (!empty($order)) {
            $query .= " ORDER BY $order";
        }

        $resultSet = $this->db->query($query);
        $results = $this->processResultSet($resultSet);
        return $results;
    }

    // Delete
    public function delete_by_id($id)
    {
        $query = "DELETE FROM `blog`.`{$this->table}` WHERE `id`= " . $this->db->real_escape_string($id);
        $this->db->query($query);
        return $this->db->affected_rows;
    }



    protected function processResultSet($resultSet) {
        $result = array();

        if (!empty($resultSet) && $resultSet->num_rows > 0) {
            while ($row = $resultSet->fetch_assoc()){
                $result[] = $row;
            }
        }

        return $result;
    }
}
