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
     * Récupérer tous les jeux.
     */
    public function getAllGames()
    {
        $stmt = $this->db->query('SELECT * FROM Games ORDER BY id_game DESC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupérer un jeu par son ID.
     */
    public function getGameById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM Games WHERE id_game = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
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
