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
        if(isset($_SESSION['username'])){
            header('Location: /games');
        }
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

                header('Location: /games');
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

    public function games()
    {


        $games = $this->gameModel->getAllGames();

        // Inclure les vues nécessaires
        require __DIR__ . '/../../templates/partials/header.php';
        require __DIR__ . '/../../templates/games.php';
        require __DIR__ . '/../../templates/partials/footer.php';
    }
    public function playGame()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])){
            header('Location: /login');
            exit;
        }

        // Récupérer l'ID du jeu sélectionné
        $gameId = $_GET['game_id'] ?? null;

        if ($gameId) {
            // Redirige vers la page du jeu, par exemple dans le dossier /games
            header("Location: /games/quiz.php?game_id={$gameId}");
            exit;
        } else {
            echo "Aucun jeu sélectionné.";
        }
    }
}

?>




