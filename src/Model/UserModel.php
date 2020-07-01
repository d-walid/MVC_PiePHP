<?php

use Core\ORM;
use Core\Request;

class UserModel extends Entity
{
    private $email;
    private $password;
    private $db;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=pie_php;charset=UTF8', 'root', 'rootroot');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function create($email, $password)
    {
        $query = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $userID = $this->db->lastInsertId();
        $stmt->closeCursor();
        return $userID;
    }

    public function login($email, $password)
    {
        if (!empty($email) && !empty($password)) {
            $query = "SELECT * FROM users WHERE email = ? and password = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(1, $email);
            $stmt->bindParam(2, $password);
            $stmt->execute();
            if ($stmt->rowCount() == 1) {
                header('Location: home');
            } else {
                echo "Bad login. Please try again";
            }
        }
    }

    public function read($id)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $res = $stmt->fetchAll();
        $stmt->closeCursor();
        return $res;
    }

    public function update($id, $column, $value)
    {
        $query = "UPDATE users SET $column = :val WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':val', $value);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function delete($id)
    {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam('id', $id);
        $stmt->execute();
        $stmt->closeCursor();
    }

    public function read_all($id)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $res = $stmt->fetchAll();
        $stmt->closeCursor();
        return $res;
    }

    public function find()
    {
        $query = "SELECT email FROM users WHERE email = ?";
        $checkEmail = $this->db->prepare($query);
        $checkEmail->execute([$this->email]);
        $mailExists = $checkEmail->rowCount();
        if ($mailExists >= 1) {
            return true;
        } else
            return false;
    }

    public function displayAccount($email) {
        $query = "SELECT email, password FROM users WHERE email = ?";
        $stmt = $this->db->prepare($query);
        if ($stmt->execute(array($this->email))) {
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                return $row;
            }
        }
        return null;
    }
}
