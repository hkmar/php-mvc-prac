<?php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $res = $this->db->resSingle();
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function register($data) {
        // Query
        $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');

        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        // Executes and return True(Success) or False
        return $this->db->execute();
    }

    public function login($data) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $data['email']);
        $res = $this->db->resSingle();
        if (password_verify($data['password'], $res->password)) {
            return $res;
        } else {
            return false;
        }
    }
}
