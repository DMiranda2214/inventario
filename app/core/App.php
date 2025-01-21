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

        $controllerName = $this->getControllerName($url);
        $this->loadController($controllerName);

        $methodName = $this->getMethodName($url);
        $this->setMethod($methodName);

        $this->params = $this->getParams($url);

        $this->callControllerMethod();
    }

    private function parseURL() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }

    private function getControllerName(&$url) {
        if (isset($url[0]) && class_exists('App\\Controllers\\' . $url[0] . 'Controller')) {
            $controllerName = 'App\\Controllers\\' . $url[0] . 'Controller';
            unset($url[0]);
            return $controllerName;
        }
        return 'App\\Controllers\\' . $this->controller;
    }

    private function loadController($controllerName) {
        require_once '../app/controllers/' . basename($controllerName) . '.php';
        $this->controller = new $controllerName;
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
        return $url ? array_values($url) : [];
    }

    private function callControllerMethod() {
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
}
?>