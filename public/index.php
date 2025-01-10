<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\MainController;
use App\Controllers\GameController;
use App\Controllers\ReviewController;

ob_start();

$controller = new MainController();
$gamecontroller = new GameController();
$reviewcontroller = new ReviewController();

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($path) {
    case '/':
        $controller->index();
        $controller->footer();
        break;

    case '/logout':
        $controller->logout();
        break;

    case '/login':
        $controller->login();
        break;
    case '/register':
        $controller->register();
        break;
    case '/games/quiz':
        $gamecontroller->quiz();
        break;
    case '/games/motus':
        $gamecontroller->motus();
        break;
    case '/games/memory':
        $gamecontroller->memory();
        break;

    case '/games': // Nouvelle route
        $controller->games(); // Appelle la méthode games() du contrôleur
        break;
    case '/reviews':
        $reviewcontroller->index();
        break;
    case '/reviews/create':
        $reviewcontroller->create();
        break;
    case '/reviews/edit':
        $id = $_GET['id'] ?? null;
        $reviewcontroller->edit($id);
        break;
    case '/reviews/delete':
        $reviewcontroller->delete();
        break;
    case '/reviews/index':
        $id = $_GET['id'] ?? null;
        $reviewcontroller->index($id);
        break;

    default:
        http_response_code(404);
        echo "Page cheh";
        break;
        
}

ob_end_flush();
