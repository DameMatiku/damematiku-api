<?php

// hello world to make us happy all the time
$app->get('/', function () use ($app) {
    return $app->json([
    	"success" => TRUE
    ]);
});

// tags
$app->get('/tags', 'DameMatiku\Controller\TagsController::indexAction');

// subjects
$app->get('/subjects', 'DameMatiku\Controller\SubjectsController::indexAction');
$app->get('/subjects/{subjectId}/sections', 'DameMatiku\Controller\SubjectsController::sectionsAction');

// chapter detail
$app->get('/chapters/{chapterId}', 'DameMatiku\Controller\ChaptersController::indexAction');

// video actions
$app->get('/videos/{videoId}', 'DameMatiku\Controller\VideosController::indexAction');
$app->post('/videos/{videoId}/upvote', 'DameMatiku\Controller\VideosController::upvoteAction');
$app->post('/videos/{videoId}/downvote', 'DameMatiku\Controller\VideosController::downvoteAction');
$app->post('/videos/{videoId}/resetVote', 'DameMatiku\Controller\VideosController::resetVoteAction');