<?php

namespace App\Models;

use App\Database\Database;
use PDO;

class Review
{
    private $id_review;
    private $id_user;
    private $id_game;
    private $note;
    private $comment;

    public function __construct($id_user = null, $id_game = null, $note = null, $comment = null)
    {
        $this->id_user = $id_user;
        $this->id_game = $id_game;
        $this->note = $note;
        $this->comment = $comment;
    }

    // Récupérer toutes les reviews
    public static function getAllReviews()
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->query("SELECT * FROM review");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer une review par son ID
    public static function getReviewById($id_review)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM review WHERE id_review = :id_review");
        $stmt->execute(['id_review' => $id_review]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ajouter une review
    public function createReview()
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("INSERT INTO review (id_user, id_game, note, comment) 
                               VALUES (:id_user, :id_game, :note, :comment)");
        $stmt->execute([
            'id_user' => $this->id_user,
            'id_game' => $this->id_game,
            'note' => $this->note,
            'comment' => $this->comment
        ]);
    }

    // Mettre à jour une review
    public function updateReview($id_review)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("UPDATE review SET note = :note, comment = :comment 
                               WHERE id_review = :id_review AND id_user = :id_user");
        $stmt->execute([
            'note' => $this->note,
            'comment' => $this->comment,
            'id_review' => $id_review,
            'id_user' => $this->id_user
        ]);
    }

    // Supprimer une review
    public static function deleteReview($id_review, $id_user)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("DELETE FROM review WHERE id_review = :id_review AND id_user = :id_user");
        $stmt->execute([
            'id_review' => $id_review,
            'id_user' => $id_user
        ]);
    }

    // Récupérer toutes les reviews pour un jeu
    public static function getReviewsByGame($id_game)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT * FROM review WHERE id_game = :id_game");
        $stmt->execute(['id_game' => $id_game]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}