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

/*    public function __construct(Connection $db, $subjectsRepository, $chaptersRepository)
    {
        $this->db = $db;
        $this->subjectsRepository = $subjectsRepository;
        $this->chaptersRepository = $chaptersRepository;
    }*/

    /**
     * Instantiates a chapter entity and sets its properties using db data.
     * @param array $data
     *   The array of db data.
     * @return DameMatiku\Entity\Chapter
     */
    protected function build($data)
    {
        //$sponsor = $this->sponsorRepository->find($data['subject_id']);
        //$videos = $this->chaptersRepository->findBySectionId($data['id']);

        $chapter = new Chapter();
        $chapter->setId($data['id']);
        $chapter->setName($data['name']);
        $chapter->setSequence($data['sequence']);
        $chapter->setDescription($data['description']);
        //$chapter->setSponsor($sponsor);
        //$chapter->setVideos($chapters);
        return $chapter;
    }

    public function findAllBySectionId($subjectId) {
        return $this->findAll([ 'section_id' => $subjectId ], [ 'sequence' => 'ASC']);
    }
}