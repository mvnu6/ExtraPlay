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

    /**
     * Récupérer un jeu par son ID.
     */
    public function getAllGames()
    {
        $stmt = $this->db->query('SELECT * FROM Games ORDER BY id_game DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Mettre à jour un jeu existant.
     */
    public function updateGame($id, $name, $description, $idCategory)
    {
        $stmt = $this->db->prepare('UPDATE Games SET name = ?, description = ?, id_category = ? WHERE id_game = ?');
        return $stmt->execute([$name, $description, $idCategory, $id]);
    }
}
