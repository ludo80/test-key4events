<?php

use Key4Events\Application;

require __DIR__.'/../vendor/autoload.php';

session_start();

$app = new Application();
$app->run();