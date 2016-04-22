<?php
namespace DameMatiku\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class SectionsController extends BaseController
{
    public function indexAction(Request $request, Application $app, $subjectId)
    {
        $result = $this->getSuccess();
        $result['subjectId'] = $subjectId;
        return $app->json();
    }
}