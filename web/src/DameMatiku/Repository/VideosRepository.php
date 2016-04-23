<?php

namespace DameMatiku\Repository;

use Doctrine\DBAL\Connection;
use DameMatiku\Entity\Video;

/**
 * Video repository
 */
class VideosRepository extends BaseRepository
{
    protected $table = "video";

    /** @var DameMatiku\Repository\UserRepository */
    protected $usersRepository;

    public function __construct(Connection $db, $usersRepository)
    {
        $this->db = $db;
        $this->usersRepository = $usersRepository;
    }

    /**
     * Instantiates a video entity and sets its properties using db data.
     * @param array $data
     *   The array of db data.
     * @return DameMatiku\Entity\Video
     */
    protected function build($data)
    {
        $user = $this->usersRepository->find($data['user_id']);
        //$videos = $this->chaptersRepository->findBySectionId($data['id']);

        $video = new Video();
        $video->setId($data['id']);
        $video->setDescription($data['description']);
        $video->setYoutubeId($data['youtube_id']);
        $video->setUser($user);
        return $video;
    }

    public function findAllByChapterId($chapterId) {
        return $this->findAll([ 'chapter_id' => $chapterId ]);
    }
}