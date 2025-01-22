<?php

namespace App\Core;

session_start();
$GLOBALS['PAGE'] = '';
$GLOBALS['SECTION'] = 'index';
class App {
    protected $controller = 'AuthController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseURL();
       //$this->printDebugInfo($url);

        $controllerName = $this->getControllerName($url);
        $this->loadController($controllerName);

        $methodName = $this->getMethodName($url);
        $this->setMethod($methodName);

        $this->params = $this->getParams($url);

        $this->callControllerMethod();
    }

    private function parseURL() {
        if (isset($_GET['url'])) {
            $url = filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL);
            $url = str_replace('public/', '', $url); // Quita la parte 'public/' si está en la URL
            return explode('/', $url);
        }
        return [];
    }

    private function getControllerName(&$url) {
        if (isset($url[0]) && class_exists('App\\Controllers\\' . ucfirst($url[0]) . 'Controller')) {
            $controllerName = 'App\\Controllers\\' . ucfirst($url[0]) . 'Controller';
            unset($url[0]);
            return $controllerName;
        }
        return 'App\\Controllers\\' . $this->controller;
    }

    private function loadController($controllerName) {
        if (file_exists('../app/controllers/' . basename($controllerName) . '.php')) {
            require_once '../app/controllers/' . basename($controllerName) . '.php';
            $this->controller = new $controllerName;
        }

    }

    private function getMethodName(&$url) {
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $methodName = $url[1];
            unset($url[1]);
            return $methodName;
        }
        return $this->method;
    }

    private function setMethod($methodName) {
        $this->method = $methodName;
    }

    private function getParams($url) {
        return array_values($url);
    }

    private function callControllerMethod() {
        if (method_exists($this->controller, $this->method)) {
            call_user_func_array([$this->controller, $this->method], $this->params);
        } else {
            // Manejo de errores en caso de que el método no exista
            echo "Método no encontrado.";
        }
    }

    private function printDebugInfo($url) {
        $fullUrl = $_SERVER['HTTP_HOST'] . '/' . implode('/', $url);
        $method = $_SERVER['REQUEST_METHOD'];
        $params = $this->getParams($url);

        echo "Params: ";
        print_r($params);
    }
}
?>