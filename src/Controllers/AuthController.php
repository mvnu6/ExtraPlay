<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    // Méthode pour se connecter
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = User::authenticate($_POST['email'], $_POST['password']);
            if ($user) {
                $_SESSION['user_id'] = $user['id_user'];  // Enregistrer l'ID de l'utilisateur dans la session
                header('Location: /reviews');
                exit();
            } else {
                echo "Invalid credentials";  // Afficher un message d'erreur si les identifiants sont incorrects
            }
        }
        require __DIR__ . '/../../templates/auth/login.php';  // Afficher le formulaire de connexion
    }

    // Méthode pour se déconnecter
    public function logout()
    {
        session_destroy();  // Détruire la session
        header('Location: /');  // Rediriger vers la page d'accueil
        exit();
    }
}
