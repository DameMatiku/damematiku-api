<?php
namespace DameMatiku\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use DameMatiku\Entity\Subject;

class SubjectsController extends BaseController
{
    public function indexAction(Request $request, Application $app)
    {
    	$subjects = $app['repository.subject']->findAll();
        $result = array_values(array_map(function (Subject $entity) {
        	return [
        		"id" => $entity->getId(),
        		"name" => $entity->getName()
        	];
        }, $subjects));
        return $app->json($result);
    }
}