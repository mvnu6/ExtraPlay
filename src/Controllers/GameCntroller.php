<?php
// Controller/GameController.php
namespace App\Controllers;

use App\Models\Game;

class GameController
{
    private $gameModel;

    public function __construct()
    {
        $this->gameModel = new Game();
    }

    // Afficher la liste des jeux
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

        if (!isset($_SESSION['user_id'])) {
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
