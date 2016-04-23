<?php
namespace DameMatiku\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use DameMatiku\Entity\Subject;
use DameMatiku\Entity\Section;
use DameMatiku\Entity\Chapter;

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

    public function sectionsAction(Request $request, Application $app, $subjectId) {
        $tagIds = $app['request']->get('tags');

        $subject = $app['repository.subject']->find($subjectId);
        $sections = $app['repository.section']->findAllBySubjectId($subjectId, $tagIds);
        $result = array_values(array_map(function (Section $section) {
            return [
                "id" => $section->getId(),
                "name" => $section->getName(),
                "chapters" => array_values(array_map(function (Chapter $chapter) {
                    return [
                        "id" => $chapter->getId(),
                        "name" => $chapter->getName()
                    ];
                }, $section->getChapters()))
            ];
        }, $sections));
        return $app->json($result);
    }
}