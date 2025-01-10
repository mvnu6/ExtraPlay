<?php

namespace App\Models;

use App\Database\Database;
use PDO;

class Game
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllGames()
    {
        $stmt = $this->db->query('SELECT * FROM Games ORDER BY id_game DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
 
}
