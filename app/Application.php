<?php

namespace Key4Events;

use Key4Events\Controllers\CoreController;

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
        
        $this->router->map('GET', '/', 'MainController#login', 'login');
        $this->router->map('POST', '/', 'MainController#login', 'loginPost');
        $this->router->map('GET', '/logout', 'MainController#logout', 'logout');
        $this->router->map('GET', '/home', 'MainController#home', 'home');
        $this->router->map('GET', '/profile/[i:id]', 'UserController#profile', 'profile');
        $this->router->map('POST', '/profile/[i:id]/update', 'UserController#update', 'update');
        $this->router->map('POST', '/profile/create', 'UserController#create', 'create');
        $this->router->map('POST', '/profile/[i:id]/delete', 'UserController#delete', 'delete');
    }
}

