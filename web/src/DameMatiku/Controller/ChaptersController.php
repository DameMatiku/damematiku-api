<?php
namespace DameMatiku\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use DameMatiku\Entity\Chapter;
use DameMatiku\Entity\Video;

class ChaptersController extends BaseController
{
    public function indexAction(Request $request, Application $app, $chapterId)
    {
        $user = $this->getUser($app);
        $chapter = $app['repository.chapter']->getChapterDetail($chapterId, $user->getId());
        $result = [
            "id"          => $chapter->getId(),
            "name"        => $chapter->getName(),
            "description" => $chapter->getDescription(),
            "videos"      => array_values(array_map(function (Video $video) {
                return [
                    "id"        => $video->getId(),
                    "author"    => [
                        "id"         => $video->getUser()->getId(),
                        "name"       => $video->getUser()->getName(),
//                        "reputation" => $video->getUser()->getReputation(),
                        "avatarUrl"  => $video->getUser()->getAvatarUrl()
                    ],
                    "youtubeId" => $video->getYoutubeId(),
//                    "votes"     => $video->getVotes(),
//                    "myVote"    => $video->getMyVote()
                ];
            }, $chapter->getVideos())),
            "sponsor"     => $chapter->getSponsor(),
            "previousChapter" => $this->getSimpleChapter($chapter->getPreviousChapter()),
            "nextChapter" => $this->getSimpleChapter($chapter->getNextChapter())
        ];
        return $app->json($result);
    }

    private function getSimpleChapter(Chapter $chapter) {
        return $chapter ? [
            "id" => $chapter->getId(),
            "name" => $chapter->getName()
        ] : NULL;
    }
}