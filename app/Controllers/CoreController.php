<?php

namespace Key4Events\Controllers;

abstract class CoreController {

    private $viewVars;
    protected $router;

    public function __construct($router) {
        $this->router = $router;

        $base_url = isset($_SERVER['BASE_URI']) ? trim($_SERVER['BASE_URI']) : '/';

        $this->assign('baseUrl', $base_url);
        $this->assign('router', $this->router);
    }

    protected function assign($varName, $varValue) {
        $this->viewVars[$varName] = $varValue;
    }

    protected function show($viewName) {
        $this->viewVars;
        extract($this->viewVars);

        require __DIR__."/../views/header.tpl.php";
        require __DIR__."/../views/$viewName.tpl.php";
        require __DIR__."/../views/footer.tpl.php";
    }
}