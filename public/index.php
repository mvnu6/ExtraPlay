<?php 
session_start();
require_once '../vendor/autoload.php';

use App\Controllers\ReviewController;
use App\Controllers\AuthController;
use App\Controllers\MainController;

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Instances des contrôleurs
$reviewController = new ReviewController();
$authController = new AuthController();
$mainController = new MainController();

switch ($path) {
    case '/':
        $mainController->index(); // Page d'accueil
        $mainController->footer(); // Page d'accueil
        break;
    case '/reviews':
        $reviewController->index(); // Affichage des reviews
        break;
    case '/reviews/create':
        $reviewController->create(); // Création d'une review
        break;
    case preg_match('/\/reviews\/(\d+)/', $path, $matches) ? true : false:
        $reviewController->show($matches[1]); // Affichage d'une review spécifique
        break;
    case preg_match('/\/reviews\/edit\/(\d+)/', $path, $matches) ? true : false:
        $reviewController->edit($matches[1]); // Modification d'une review
        break;
    case preg_match('/\/reviews\/delete\/(\d+)/', $path, $matches) ? true : false:
        $reviewController->delete($matches[1]); // Suppression d'une review
        break;
    case '/login':
        $authController->login(); // Page de login
        break;
    case '/logout':
        $authController->logout(); // Déconnexion
        break;
    default:
        http_response_code(404);
        echo "Page not found";
}
