<?php

namespace Core;

use Core\Request;

class ORM
{
    private $db;

    public function __construct()
    {
        try {
            $this->db = new \PDO('mysql:host=localhost;dbname=pie_php;charset=UTF8', 'root', 'rootroot');
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function orm_create($table, $fields)
    {
        $query = 'INSERT INTO :table (';
        $query = str_replace(":table", $table, $query);
        $query .= implode(", ", array_keys($fields)) . ") VALUES (";
        foreach ($fields as $key => $value) {
            $fields[$key] = '"' . $value . '"';
        }
        $query .= implode(", ", array_values($fields)) . ")";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $userID = $this->db->lastInsertId();
        $stmt->closeCursor();
        return $userID;
    }

    public function orm_read($table, $id)
    {
        $query = "SELECT * FROM $table WHERE id = $id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $res = $stmt->fetchAll();
        $stmt->closeCursor();
        return $res;
    }

    public function orm_update($table, $id, $fields)
    {
        $col = "";
        foreach ($fields as $key => $value) {
            $col .= " " . $key . " = " . "'" . $value . "',";
        }
        $col = substr($col, 0, -1);
        $query = "UPDATE $table SET $col WHERE id = $id";
        $stmt = $this->db->prepare($query);
        $res = $stmt->execute();
        $stmt->closeCursor();
        return $res;
    }

    public function orm_delete($table, $id)
    {
        $query = "DELETE FROM $table WHERE id = $id";
        $stmt = $this->db->prepare($query);
        $res = $stmt->execute();
        $stmt->closeCursor();
        return $res;
    }


    public function orm_find($table, $params = array(
        'WHERE' => '1',
        'ORDER BY' => 'id ASC',
        'LIMIT' => ''
    ))
    {
        $res = "";
        foreach ($params as $key => $element) {
            if (!empty($element)) {
                $res .= $key . " " . $element . " ";
            } else {
                $key = null;
            }
        }
        $query = "SELECT * FROM $table $res";
        $query = substr($query, 0, -1);
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $stmt->closeCursor();
        return $results;
    }
}
