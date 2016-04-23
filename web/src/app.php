<?php

// services

$app->register(new AuthBucket\OAuth2\Provider\AuthBucketOAuth2ServiceProvider());
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\MonologServiceProvider(), [
	'monolog.logfile' => HOME_DIR . '/app/cache/development.log'
]);


// security - @todo implement the OAuth endpoints correctly

$app->register(new Silex\Provider\SecurityServiceProvider(), [
	'security.firewalls' => [
	    'api_oauth2_token' => [
	        'pattern' => '^/oauth2/token$',
	        'oauth2_token' => TRUE
	    ],
	]
]);
$app->register(new Silex\Provider\ValidatorServiceProvider());


// models

$app['repository.vote'] = $app->share(function ($app) {
    return new DameMatiku\Repository\VotesRepository($app['db']);
});

$app['repository.user'] = $app->share(function ($app) {
    return new DameMatiku\Repository\UsersRepository($app['db'], $app['avatar.default']);
});

$app['repository.video'] = $app->share(function ($app) {
    return new DameMatiku\Repository\VideosRepository($app['db'], $app['repository.user'], $app['repository.vote']);
});

$app['repository.tag'] = $app->share(function ($app) {
    return new DameMatiku\Repository\TagsRepository($app['db']);
});

$app['repository.subject'] = $app->share(function ($app) {
    return new DameMatiku\Repository\SubjectsRepository($app['db']);
});

$app['repository.chapter'] = $app->share(function ($app) {
    return new DameMatiku\Repository\ChaptersRepository($app['db'], $app['repository.user'], $app['repository.video']);
});

$app['repository.section'] = $app->share(function ($app) {
    return new DameMatiku\Repository\SectionsRepository($app['db'],
    	$app['repository.subject'], $app['repository.chapter']);
});


return $app;