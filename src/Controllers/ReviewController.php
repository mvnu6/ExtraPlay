<?php

namespace App\Controllers;

use App\Models\Review;

class ReviewController
{
   
    public function index()
    {
        $reviews = Review::getAllReviews();
        require __DIR__ . '/../../templates/reviews/index.php';
    }

    public function show($id_review)
    {
        $review = Review::getReviewById($id_review);
        require __DIR__ . '/../../templates/reviews/show.php';
    }

    
    public function create()
{
   
    if (!isset($_SESSION['username'])) {
        header('Location: /login?redirect=/reviews/create');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['note']) || empty($_POST['note'])) {
            echo "Veuillez sélectionner une note.";
            exit();  
        }
        $id_game = $_POST['id_game'];
        $username = $_POST['username']; 
        $note = $_POST['note'];  // Note en étoiles
        $comment = $_POST['comment'];  

     
        $review = new Review($_SESSION['user_id'], $id_game, $note, $comment);
        $review->createReview();  

        header('Location: /reviews');
        exit();
    }

    require __DIR__ . '/../../templates/reviews/create.php';
}

    
      
    
    public function edit($id_review)
    {
        if (!isset($_SESSION['username'])) {
            header('Location: /login');
            exit();
        }
    
        $review = Review::getReviewById($id_review);
    
        // Vérifier si l'utilisateur est l'auteur de l'avis
        if ($review['id_user'] != $_SESSION['user_id']) {
            header('Location: /reviews');
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $note = $_POST['note'];
            $comment = $_POST['comment'];
    
            // Mettre à jour l'avis
            $updatedReview = new Review($_SESSION['user_id'], $review['id_game'], $note, $comment);
            $updatedReview->updateReview($id_review);
    
            // Redirige vers la page des avis après mise à jour
            header('Location: /reviews');
            exit();
        }
    
        require __DIR__ . '/../../templates/reviews/edit.php';
    }
    

   
    public function delete()
    {
       
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit();
        }

        if (isset($_POST['id_review']) && is_numeric($_POST['id_review'])) {
            $id_review = $_POST['id_review'];
    
            // Récupérer l'avis à supprimer
            $review = Review::getReviewById($id_review);
    
            
            if ($review['id_user'] != $_SESSION['user_id']) {
                header('Location: /reviews');
                exit();
            }
            Review::deleteReview($id_review, $_SESSION['user_id']);
    
            header('Location: /reviews');
            exit();
        } else {
         
            header('Location: /reviews');
            exit();
        }
    }
    
    
}