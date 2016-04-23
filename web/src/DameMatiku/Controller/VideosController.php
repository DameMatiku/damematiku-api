<?php
namespace DameMatiku\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

use DameMatiku\Entity\Video;

class VideosController extends BaseController
{
    public function indexAction(Application $app, $videoId)
    {
        $user = $this->getUser($app);
        $video = $app['repository.video']->findDetail($videoId, $user->getId());
    	$chapter = $app['repository.chapter']->find($video->getChapterId());
        $result = [
            "id"        => $video->getId(),
            "chapter"   => [
                "id"          => $chapter->getId(),
                "name"        => $chapter->getName(),
                "description" => $chapter->getDescription()
            ],
            "author"    => [
                "id"         => $video->getUser()->getId(),
                "name"       => $video->getUser()->getName(),
//                "reputation" => $video->getUser()->getReputation(),
                "avatarUrl"  => $video->getUser()->getAvatarUrl()
            ],
            "youtubeId" => $video->getYoutubeId(),
            "votes"     => $video->getVotes(),
            "description" => $video->getDescription(),
            "myVote"    => $video->getMyVote(),
            "disqusPageId" => $this->getDisqusId($video)
        ];
        return $app->json($result);
    }

    public function upvoteAction(Application $app, $videoId) {
        $user = $this->getUser($app);
        $video = $app['repository.video']->upvote($videoId, $user->getId());
        return $app->json($this->getSuccess());
    }

    public function downvoteAction(Application $app, $videoId) {
        $user = $this->getUser($app);
        $video = $app['repository.video']->downvote($videoId, $user->getId());
        return $app->json($this->getSuccess());
    }

    public function resetVoteAction(Application $app, $videoId) {
        $user = $this->getUser($app);
        $video = $app['repository.video']->resetVote($videoId, $user->getId());
        return $app->json($this->getSuccess());
    }

    private function getDisqusId($video) {
        return "DameMatikuDisqus" . $video->getId();
    }
}