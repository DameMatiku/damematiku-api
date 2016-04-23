<?php

define('HOME_DIR', __DIR__ . '/..');

require_once HOME_DIR . '/vendor/autoload.php';

$app = new Silex\Application();


require_once HOME_DIR . '/app/config/dev.php';
require_once HOME_DIR . '/src/app.php';
require_once HOME_DIR . '/src/routes.php';

$app->run();