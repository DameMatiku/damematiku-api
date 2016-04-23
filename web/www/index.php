<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

define('HOME_DIR', __DIR__ . '/..');

require_once HOME_DIR . '/app/config/dev.php';
require_once HOME_DIR . '/src/app.php';
require_once HOME_DIR . '/src/routes.php';

$app->run();