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
        $games = $this->gameModel->getAllGames();

        require_once __DIR__ . '/../../templates/partials/header.php';
        require_once __DIR__ . '/../../templates/home.php';
        require_once __DIR__ . '/../../templates/partials/footer.php';
    }

    public function footer()
    {
        require_once __DIR__ . '/../../templates/partials/footer.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $redirect = $_GET['redirect'] ?? '/games'; // URL par défaut

            $pdo = Database::getInstance()->getConnection();

            $stmt = $pdo->prepare("SELECT id_user, username, password FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user_id'] = $user['id_user'];
                $_SESSION['username'] = $user['username'];

                // Rediriger vers l'URL précédente ou la page par défaut
                header("Location: $redirect");
                exit;
            } else {
                $error = "Email ou mot de passe incorrect.";
            }
        }

        
        require_once __DIR__ . '/../../templates/login.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $redirect = $_GET['redirect'] ?? '/games'; 

            if (!empty($username) && !empty($email) && !empty($password)) {
                $pdo = Database::getInstance()->getConnection();

                // Vérifier si l'email est déjà utilisé
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

                    // Récupére l'utilisateur nouvellement créé
                    $stmt = $pdo->prepare("SELECT id_user, username FROM users WHERE email = :email");
                    $stmt->execute(['email' => $email]);
                    $user = $stmt->fetch();

                    // Enregistre l'utilisateur dans la session
                    if (session_status() === PHP_SESSION_NONE) {
                        session_start();
                    }
                    $_SESSION['user_id'] = $user['id_user'];
                    $_SESSION['username'] = $user['username'];

                   
                    header("Location: $redirect");
                    exit;
                } else {
                    $error = "L'email est déjà utilisé.";
                }
            } else {
                $error = "Veuillez remplir tous les champs.";
            }
        }

        require_once __DIR__ . '/../../templates/register.php';
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: /");
        exit;
    }

    public function games()
    {

        $games = $this->gameModel->getAllGames();

       
        require_once __DIR__ . '/../../templates/partials/header.php';
        require_once __DIR__ . '/../../templates/games.php';
        require_once __DIR__ . '/../../templates/partials/footer.php';
    }

    public function construction()
    {
        require __DIR__ . '/../../templates/construction.php';
    }
}
