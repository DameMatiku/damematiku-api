<?php

$app->register(new Silex\Provider\DoctrineServiceProvider());

$app['repository.tag'] = $app->share(function ($app) {
    return new DameMatiku\Repository\TagsRepository($app['db']);
});

$app['repository.subject'] = $app->share(function ($app) {
    return new DameMatiku\Repository\SubjectsRepository($app['db']);
});

$app['repository.chapter'] = $app->share(function ($app) {
    return new DameMatiku\Repository\ChaptersRepository($app['db']);
});

$app['repository.section'] = $app->share(function ($app) {
    return new DameMatiku\Repository\SectionsRepository($app['db'],
    	$app['repository.subject'], $app['repository.chapter']);
});


return $app;