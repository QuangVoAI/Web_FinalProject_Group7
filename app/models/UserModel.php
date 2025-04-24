<?php
require_once '../database/config.php';

class UserModel {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function register($email, $password) {
        $stmt = $this->conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        return $stmt->execute([$email, password_hash($password, PASSWORD_DEFAULT)]);
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}