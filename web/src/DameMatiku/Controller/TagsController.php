<?php
namespace DameMatiku\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use DameMatiku\Entity\Tag;

class TagsController extends BaseController
{
    public function indexAction(Request $request, Application $app)
    {
        $tags = $app['repository.tag']->getTagTree();
        $result = array_values(array_map(function (Tag $tag) {
            return $this->proccessTag($tag);
        }, $tags));
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