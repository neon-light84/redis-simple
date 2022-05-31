<?php
require_once '../main.php';

use \App\Rest\Router;

$router = new Router();
$result = $router->run();
@ob_end_clean(); // выкинуть все варнинги и нотисы

echo $result;

