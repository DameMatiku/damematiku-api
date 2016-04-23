<?php

namespace DameMatiku\Repository;

use Doctrine\DBAL\Connection;
use DameMatiku\Entity\Chapter;

/**
 * Chapter repository
 */
class ChaptersRepository extends BaseRepository
{
    protected $table = "chapter";

    /** @var DameMatiku\Repository\VideosRepository */
    protected $videosRepository;

    /** @var DameMatiku\Repository\UserRepository */
    protected $usersRepository;

    public function __construct(Connection $db, $usersRepository, $videosRepository)
    {
        $this->db = $db;
        $this->usersRepository = $usersRepository;
        $this->videosRepository = $videosRepository;
    }

    /**
     * Instantiates a chapter entity and sets its properties using db data.
     * @param array $data
     *   The array of db data.
     * @return DameMatiku\Entity\Chapter
     */
    protected function build($data)
    {
        //$sponsor = $this->sponsorRepository->find($data['subject_id']);

        $chapter = new Chapter();
        $chapter->setId($data['id']);
        $chapter->setName($data['name']);
        $chapter->setSequence($data['sequence']);
        $chapter->setDescription($data['description']);
        $chapter->setSectionId($data['section_id']);
        //$chapter->setSponsor($sponsor);

        return $chapter;
    }

    public function findAllBySectionId($subjectId) {
        return $this->findAll([ 'section_id' => $subjectId ], [ 'sequence' => 'ASC']);
    }

    public function getChapterDetail($chapterId, $userId) {
        $chapter = $this->find($chapterId);

        $allChapters = array_values($this->findAllBySectionId($chapter->getSectionId()));

        foreach ($allChapters as $key => $ch) {
            if ($chapter->getId() == $ch->getId()) {
                if (isset($allChapters[$key - 1])) {
                    $chapter->setPreviousChapter($allChapters[$key - 1]);
                }

                if (isset($allChapters[$key + 1])) {
                    $chapter->setNextChapter($allChapters[$key + 1]);
                }
            }
        }
        
        $videos = $this->videosRepository->findAllByChapterId($chapterId);

        $chapter->setVideos($videos);

        return $chapter;
    }
}