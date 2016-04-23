<?php
namespace DameMatiku\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use DameMatiku\Entity\Section;
use DameMatiku\Entity\Chapter;

class SearchController extends BaseController
{
    public function indexAction(Request $request, Application $app)
    {
        $query = $app['request']->get('q');
        $sections = $app['repository.section']->search($query);
        $chapters = $app['repository.chapter']->search($query);
        $result = array_merge(
            array_values(array_map(function (Section $section) {
                return [
                    "type" => "section",
                    "id" => $section->getId(),
                    "name" => $section->getName(),
                    "chapters" => array_values(array_map(function (Chapter $chapter) {
                        return [
                            "id" => $chapter->getId(),
                            "name" => $chapter->getName()
                        ];
                    }, $section->getChapters()))
                ];
            }, $sections)),
            array_values(array_map(function (Chapter $chapter) {
                return [
                    "type" => "chapter",
                    "id" => $chapter->getId(),
                    "name" => $chapter->getName()
                ];
            }, $chapters))
        );
        return $app->json($result);
    }

    private function proccessTag($tag)
    {
        $children = $tag->getChildrenTags();
        $children = $children ? array_values(array_map(function (Tag $innerTag) {
            return $this->proccessTag($innerTag);
        }, $children)) : [];
        return [
            "id" => $tag->getId(),
            "name" => $tag->getName(),
            "subtags" => $children
        ];
    }
}