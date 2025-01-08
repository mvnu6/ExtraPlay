<?php

namespace App\Models;

use App\Database\Database;
use PDO;

class User
{
    private $id_user;
    private $username;
    private $email;
    private $password;

    // Constructeur
    public function __construct($username = null, $email = null, $password = null)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    // Méthode pour authentifier un utilisateur avec email et mot de passe
    public static function authenticate($email, $password)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;  // Si l'utilisateur est trouvé et que le mot de passe est correct, on le retourne
        }

        return false; // Si les informations sont incorrectes
    }

    // Enregistrer un nouvel utilisateur (enregistrer le mot de passe crypté)
    public function register()
    {
        $pdo = Database::getInstance()->getConnection();
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);  // Cryptage du mot de passe
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        $stmt->execute([
            'username' => $this->username,
            'email' => $this->email,
            'password' => $hashedPassword
        ]);
    }

    // Récupérer un utilisateur par ID
    public static function getUserById($id_user)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id_user = :id_user");
        $stmt->execute(['id_user' => $id_user]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
