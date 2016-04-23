<?php

$app->register(new Silex\Provider\DoctrineServiceProvider());

$app['repository.subject'] = $app->share(function ($app) {
    return new DameMatiku\Repository\SubjectsRepository($app['db']);
});

return $app;