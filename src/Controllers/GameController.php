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
        require_once __DIR__ . '/../../templates/partials/header.php';
    }

    // Afficher la liste des jeux
    public function listGames()
    {
        $games = $this->gameModel->getAllGames();
        require_once __DIR__ . '/../views/gameList.php';
    }

    public function quiz(){
        require_once __DIR__ . '/../../templates/games/quiz.php';
    }
    public function motus(){
        require_once __DIR__ . '/../../templates/games/motus.php';
    }
    public function memory(){
        require_once __DIR__ . '/../../templates/games/memory.php';
    }
    // Charger un jeu spécifique
    public function loadGame($id)
    {
        $game = $this->gameModel->getGameById($id);
        if ($game['type'] === 'quiz') {
            require_once __DIR__ . '/../views/quizGame.php';
        } elseif ($game['type'] === 'memo') {
            require_once __DIR__ . '/../views/memoGame.php';
        } else {
            echo "Jeu non reconnu.";
        }
    }
}