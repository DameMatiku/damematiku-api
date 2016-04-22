<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app['debug'] = TRUE;

$app->get('/', function () use ($app) {

    return $app->json([
    	"success" => TRUE
    ]);
});

$app->run();