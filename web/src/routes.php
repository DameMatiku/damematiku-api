<?php

// hello world to make us happy all the time
$app->get('/', function () use ($app) {
    return $app->json([
    	"success" => TRUE
    ]);
});

$app->get('/tags', 'DameMatiku\Controller\TagsController::indexAction');
$app->get('/subjects', 'DameMatiku\Controller\SubjectsController::indexAction');
$app->get('/subjects/{subjectId}/sections', 'DameMatiku\Controller\SubjectsController::sectionsAction');
$app->get('/chapters/{chapterId}', 'DameMatiku\Controller\ChaptersController::indexAction');