<?php

namespace App\Controllers;

use App\Models\game;

class MainController
{
    private $gameModel;

    public function __construct()
    {
        $this->gameModel = new game();
        require __DIR__ . '/../../templates/partials/header.php';
    }

    public function index()
    {
        $game = $this->gameModel->getAllGames();
        require __DIR__ . '/../../templates/home.php';
    }
    public function login()
    {
        require __DIR__ . '/../../templates/login.php';
    }
    public function footer()
    {
        require __DIR__ . '/../../templates/partials/footer.php';
    }
}
