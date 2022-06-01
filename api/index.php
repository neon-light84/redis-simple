<?php
require_once '../main.php';

use \App\Rest\Router;
use \App\Auth;

if (!Auth::isAuth()) {
    $data = [
        'status' => false,
        'code' => 500,
        'data' => ['message' => 'Не авторизован'],
    ];
    http_response_code(500);
    header('Content-Type: application/json');
    exit(json_encode($data));
}

$router = new Router();
$result = $router->run();
@ob_end_clean(); // выкинуть все варнинги и нотисы

echo $result;

