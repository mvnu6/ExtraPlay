<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\MainController;
use App\Controllers\GameController;

ob_start();

$controller = new MainController();
$gamecontroller = new GameController();

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

    case '/games': // Nouvelle route
        $controller->games(); // Appelle la méthode games() du contrôleur
        break;
    default:
        http_response_code(404);
        echo "Page cheh";
        break;
        // $gameController = new GameController();

        // Liste des jeux
        $router->get('/games', [$gameController, 'listGames']);

        // Charger un jeu spécifique
        $router->get('/game/:id', [$gameController, 'loadGame']);
}

ob_end_flush();

?>
