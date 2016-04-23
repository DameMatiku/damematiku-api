<?php

namespace DameMatiku\Repository;

use Doctrine\DBAL\Connection;
use DameMatiku\Entity\Section;

/**
 * Section repository
 */
class SectionsRepository extends BaseRepository
{
    protected $table = "section";

    /** @var DameMatiku\Repository\ChaptersRepository */
    protected $subjectsRepository;

    /** @var DameMatiku\Repository\ChaptersRepository */
    protected $chaptersRepository;

    public function __construct(Connection $db, $subjectsRepository, $chaptersRepository)
    {
        $this->db = $db;
        $this->subjectsRepository = $subjectsRepository;
        $this->chaptersRepository = $chaptersRepository;
    }

    /**
     * Instantiates a section entity and sets its properties using db data.
     * @param array $data
     *   The array of db data.
     * @return DameMatiku\Entity\Section
     */
    protected function build($data)
    {
        $subject = $this->subjectsRepository->find($data['subject_id']);
        $chapters = $this->chaptersRepository->findAllBySectionId($data['id']);

        $section = new Section();
        $section->setId($data['id']);
        $section->setName($data['name']);
        $section->setSequence($data['sequence']);
        $section->setSubject($subject);
        $section->setChapters($chapters);
        return $section;
    }

    public function findAllBySubjectId($subjectId, $tagIds = []) {

        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('c.*')
            ->from($this->table, 'c');

        if (empty($tagIds)) {
            $queryBuilder->where('c.subject_id', $subjectId);
        } else {
            $queryBuilder->where('c.subject_id = ? AND t.tag_id IN (?)')
                ->innerJoin('c', 'tag_section', 't', 'c.id = t.section_id');
            $queryBuilder->setParameters([
                $subjectId,
                $tagIds
            ], [
                \PDO::PARAM_INT,
                Connection::PARAM_INT_ARRAY
            ]);
        }

        $queryBuilder->orderBy('c.sequence', 'ASC');

        $statement = $queryBuilder->execute();
        $data = $statement->fetchAll();

        $entities = [];
        foreach ($data as $row) {
            $entities[] = $this->build($row);
        }
        return $entities;
    }
}