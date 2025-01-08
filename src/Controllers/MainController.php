<?php

namespace App\Controllers;

use App\Models\game;
use App\Database\Database;

class MainController
{
    private $gameModel;

    public function __construct()
    {
        $this->gameModel = new game();
    }

    public function index()
    {
        $game = $this->gameModel->getAllGames();
        require __DIR__ . '/../../templates/partials/header.php';
        require __DIR__ . '/../../templates/home.php';
        require __DIR__ . '/../../templates/partials/footer.php';
    }

    public function footer()
    {
        require __DIR__ . '/../../templates/partials/footer.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (!empty($username) && !empty($email) && !empty($password)) {
                $pdo = Database::getInstance()->getConnection();

                $stmt = $pdo->prepare("SELECT id_user FROM users WHERE email = :email");
                $stmt->execute(['email' => $email]);
                $existingUser = $stmt->fetch();

                if (!$existingUser) {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
                    $stmt->execute([
                        'username' => $username,
                        'email' => $email,
                        'password' => $hashed_password
                    ]);

                    header('Location: /login');
                    exit;
                } else {
                    $error = "L'email est déjà utilisé.";
                }
            } else {
                $error = "Veuillez remplir tous les champs.";
            }
        }

        require __DIR__ . '/../../templates/register.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $pdo = Database::getInstance()->getConnection();

            $stmt = $pdo->prepare("SELECT id_user, username, password FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id_user'];
                $_SESSION['username'] = $user['username'];

                header('Location: /');
                exit;
            } else {
                $error = "Email ou mot de passe incorrect.";
            }
        }

        require __DIR__ . '/../../templates/login.php';
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: /");
        exit;
    }
}
