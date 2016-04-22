<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

require_once __DIR__.'/../app/config/dev.php';
require_once __DIR__.'/../src/app.php';
require_once __DIR__.'/../src/routes.php';

$app->run();