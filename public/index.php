<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\MainController;
ob_start();

$controller = new MainController();

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($path) {
    case '/':
        $controller->index();
        $controller->footer();
        break;
    case '/create':
        $controller->create();
        break;
    case '/logout':
        $controller->logout();
        break;
        
    case '/toggle':
        $controller->toggle($_GET['id'] ?? 0);
        break;
    case '/login':
        $controller->login();
        break;
    case '/register':
        $controller->register();
        break;
    case '/delete':
        $controller->delete($_GET['id'] ?? 0);
        break;
    default:
        http_response_code(404);
        echo "Page not found";
      
        ob_end_flush();

}