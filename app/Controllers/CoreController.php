<?php

namespace Key4Events\Controllers;

class CoreController {

    protected function show($viewName, $viewVars=[]) {

        $baseUrl = isset($_SERVER['BASE_URI']) ? trim($_SERVER['BASE_URI']) : '';

        foreach ($viewVars as $varName => $varValue) {
            $$varName = $varValue;
        }

        require __DIR__."/../views/header.tpl.php";
        require __DIR__."/../views/nav.tpl.php";
        require __DIR__."/../views/infos.tpl.php";
        require __DIR__."/../views/$viewName.tpl.php";
        require __DIR__."/../views/footer.tpl.php";
    }

    protected function redirectToLogin() {
        header('Location: www.key4events.lnachez.com');
    }
}