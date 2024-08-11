<?php

namespace App\Models;

use PDO;

class Users
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getUserByUsername($username)
    {
        $stmt = $this->pdo->prepare('SELECT id, username, password FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // public function createUser($username, $passwordHash)
    // {
    //     $stmt = $this->pdo->prepare("INSERT INTO users (username, password_hash) VALUES (:username, :password_hash)");
    //     $stmt->execute([
    //         'username' => $username,
    //         'password_hash' => $passwordHash
    //     ]);
    // }
}
