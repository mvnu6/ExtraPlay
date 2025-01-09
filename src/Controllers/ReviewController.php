<?php

namespace App\Controllers;

use App\Models\Review;
use App\Models\User;
use App\Database\Database;

class ReviewController
{
    // Afficher toutes les reviews
    public function index()
    {
        $reviews = Review::getAllReviews();
        require_once __DIR__ . '/../../templates/reviews/index.php';
    }

    // Afficher une review spécifique
    public function show($id_review)
    {
        $review = Review::getReviewById($id_review);
        require_once __DIR__ . '/../../templates/reviews/show.php';
    }

    // Ajouter une review
    public function create()
    {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $review = new Review($_SESSION['user_id'], $_POST['id_game'], $_POST['note'], $_POST['comment']);
            $review->createReview();
            header('Location: /reviews');
            exit();
        }

        include 'templates/reviews/create.php';
    }

    // Modifier une review
    public function edit($id_review)
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        $review = Review::getReviewById($id_review);
        // Vérifier si l'utilisateur est l'auteur de la review
        if ($review['id_user'] != $_SESSION['user_id']) {
            header('Location: /reviews');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $updatedReview = new Review($_SESSION['user_id'], $review['id_game'], $_POST['note'], $_POST['comment']);
            $updatedReview->updateReview($id_review);
            header('Location: /reviews');
            exit();
        }

        include 'templates/reviews/edit.php';
    }

    // Supprimer une review
    public function delete($id_review)
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        $review = Review::getReviewById($id_review);
        if ($review['id_user'] == $_SESSION['user_id']) {
            Review::deleteReview($id_review, $_SESSION['user_id']);
        }
        header('Location: /reviews');
        exit();
    }
}
