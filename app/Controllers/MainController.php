<?php

namespace Key4Events\Controllers;

use \Key4Events\Controllers\CoreController;

class MainController extends CoreController {

    public function home() {
        $this->show('home');
    }
}