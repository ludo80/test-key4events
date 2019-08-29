<?php

namespace Key4Events\Controllers;

use \Key4Events\Controllers\CoreController;

class ErrorController extends CoreController {

    public function err404() {
        header('HTTP/1.0 404 Not Found');
        $this->show('404');
    }
}