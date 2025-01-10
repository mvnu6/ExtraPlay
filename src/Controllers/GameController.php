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

    public function quiz(){
        require_once __DIR__ . '/../../templates/games/quiz.php';
    }
    public function motus(){
        require_once __DIR__ . '/../../templates/games/motus.php';
    }
    public function memory(){
        require_once __DIR__ . '/../../templates/games/memory.php';
    }
    
}