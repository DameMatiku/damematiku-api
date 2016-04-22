<?php


$app->get('/', function () use ($app) {

    return $app->json([
    	"success" => TRUE
    ]);
});

return $app;