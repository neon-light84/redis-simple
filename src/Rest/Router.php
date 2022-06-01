<?php
namespace App\Rest;

class Router
{

    public function run() {
        $route = [];
        $isErr = false;
        $pathInfo = $_SERVER['PATH_INFO'] ?? '';  // Кусочек URL который отвечает за маршрут
        if (!$pathInfo) $isErr = true;

        if (!$isErr) {
            // Что бы точно не было слэшей в начале и конце адреса
            if (substr($pathInfo, 0, 1) === '/') {
                $pathInfo = substr($pathInfo, 1);
            }
            if (substr($pathInfo, -1, 1) === '/') {
                $pathInfo = substr($pathInfo, 0, strlen($pathInfo) - 1);
            }
            if (!$pathInfo) $isErr = true;
        }

        if (!$isErr) {
            $pathArr = explode('/', $pathInfo);
            $route['resource'] = $pathArr[0];
            if (isset($pathArr[1])) $route['key'] = $pathArr[1];

            switch (strtoupper($_SERVER['REQUEST_METHOD'])) {
                case 'GET':
                    $route['action'] = 'readAll';
                    break;
                case 'DELETE':
                    $route['action'] = 'delete';
                    break;
//                case 'PUT':  // не реализовано
//                    $route['action'] = 'update';
//                    break;
//                case 'POST':  // не реализовано
//                    $route['action'] = 'create';
//                    break;
                default:
                    $isErr = true;
                    break;
            }
        }

        if ($isErr) {
            $controllerName = 'BaseController';
            $methodName = 'index';
        }
        else {
            switch ($route['resource']) {
                case 'redis':
                    $controllerName = 'ControllerRedis';
                    break;
                default:
                    $controllerName = 'BaseController';
                    break;
            }

            $methodName = $route['action'];
        }

        $controllerName = __NAMESPACE__ . '\\' . $controllerName;

        if (!class_exists($controllerName) || !method_exists($controllerName, $methodName)) {
            $controllerName = __NAMESPACE__  . '\\BaseController';
            $methodName = 'index';
        }
        $controller =  new $controllerName();
        if ($controller->isSuccess()) {
            $controller->$methodName(['key' => $route['key'] ?? '']);
        }
        return $controller->response();
    }


}
