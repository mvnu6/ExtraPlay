<?php

namespace App\Controllers;

use App\Models\Review;

class ReviewController
{
    // Afficher toutes les reviews
    public function index()
    {
        $reviews = Review::getAllReviews();
        require __DIR__ . '/../../templates/reviews/index.php';
    }

    // Afficher une review spécifique
    public function show($id_review)
    {
        $review = Review::getReviewById($id_review);
        require __DIR__ . '/../../templates/reviews/show.php';
    }

    // Ajouter une review
    public function create()
{
    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['username'])) {
        header('Location: /login?redirect=/reviews/create');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Vérifier que la note est bien présente
        if (!isset($_POST['note']) || empty($_POST['note'])) {
            // Si la note n'est pas définie ou est vide, rediriger ou afficher une erreur
            echo "Veuillez sélectionner une note.";
            exit();  // Terminer l'exécution si la note est absente
        }
        $id_game = $_POST['id_game'];
        $username = $_POST['username'];  // Nom d'utilisateur récupéré depuis la session
        $note = $_POST['note'];  // Note en étoiles
        $comment = $_POST['comment'];  // Commentaire de l'utilisateur

        // Créer un nouvel avis avec les données soumises
        $review = new Review($_SESSION['user_id'], $id_game, $note, $comment);
        $review->createReview();  // Méthode pour enregistrer l'avis

        // Rediriger vers la page des avis
        header('Location: /reviews');
        exit();
    }

    // Afficher le formulaire de création d'avis
    require __DIR__ . '/../../templates/reviews/create.php';
}

    
      
    // Modifier une review
    public function edit($id_review)
    {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['username'])) {
            header('Location: /login');
            exit();
        }
    
        // Récupérer l'avis existant
        $review = Review::getReviewById($id_review);
    
        // Vérifier si l'utilisateur est l'auteur de l'avis
        if ($review['id_user'] != $_SESSION['user_id']) {
            header('Location: /reviews');
            exit();
        }
    
        // Si la méthode est POST, effectuer la mise à jour
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $note = $_POST['note'];
            $comment = $_POST['comment'];
    
            // Mettre à jour l'avis
            $updatedReview = new Review($_SESSION['user_id'], $review['id_game'], $note, $comment);
            $updatedReview->updateReview($id_review);
    
            // Rediriger vers la page des avis après mise à jour
            header('Location: /reviews');
            exit();
        }
    
        // Afficher le formulaire de mise à jour de l'avis
        require __DIR__ . '/../../templates/reviews/edit.php';
    }
    

    // Supprimer une review
    public function delete()
    {
        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }
    
        // Vérifier si l'ID de l'avis est passé en POST
        if (isset($_POST['id_review']) && is_numeric($_POST['id_review'])) {
            $id_review = $_POST['id_review'];
    
            // Récupérer l'avis à supprimer
            $review = Review::getReviewById($id_review);
    
            // Vérifier si l'utilisateur est l'auteur de l'avis
            if ($review['id_user'] != $_SESSION['user_id']) {
                // Si l'utilisateur n'est pas l'auteur, rediriger vers la page des avis
                header('Location: /reviews');
                exit();
            }
    
            // Supprimer l'avis de la base de données
            Review::deleteReview($id_review, $_SESSION['user_id']);
    
            // Rediriger vers la page des avis après la suppression
            header('Location: /reviews');
            exit();
        } else {
            // Si l'ID de l'avis n'est pas valide, rediriger vers la page des avis
            header('Location: /reviews');
            exit();
        }
    }
    
    
}