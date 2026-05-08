<?php
class Admin {
    private $conn;
    private $table = "admins";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($username, $password) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO " . $this->table . " (username, password) VALUES (:user, :pass)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['user' => $username, 'pass' => $hashed]);
    }

    public function login($username, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :user";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['user' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
    
    public function resetPassword($username, $newPassword) {
        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
        $query = "UPDATE " . $this->table . " SET password = :pass WHERE username = :user";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['pass' => $hashed, 'user' => $username]);
    }
}
?>