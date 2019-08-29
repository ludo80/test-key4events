<?php

namespace Key4Events;

class Application {

    private $router;

    public function __construct() {
        $baseUrl = isset($_SERVER['BASE_URI']) ? trim($_SERVER['BASE_URI']) : '';

        $this->router = new \AltoRouter();
        $this->router->setBasePath($baseUrl);
        $this->defineRoutes();
    }

    public function run() {
        $match = $this->router->match();

        if ($match) {
            list($controllerName, $methodName) = explode("#", $match['target']);
            $params = $match['params'];
        }
        else {
            $controllerName = 'ErrorController';
            $methodName = 'err404';
            $params = [];
        }

        $controllerName = '\Key4Events\Controllers\\'.$controllerName;

        $controller = new $controllerName($this->router);
        $controller->$methodName(...array_values($params));
    }

    private function defineRoutes() {
        // $this->router->map('HTTP METHOD', 'ROUTE NAME', 'CONTROLLERNAME#METHODNAME', 'ROUTE RETOUR');
        
        $this->router->map('GET', '/lists', 'ListController#list', 'lists-list');
        $this->router->map('POST', '/lists/add', 'ListController#add', 'lists-add');
        $this->router->map('GET', '/lists/[i:id]', 'ListController#detail', 'lists-detail');
        $this->router->map('POST', '/lists/[i:id]/update', 'ListController#update', 'lists-update');
        $this->router->map('POST', '/lists/[i:id]/delete', 'ListController#delete', 'lists-delete');
    }
}

