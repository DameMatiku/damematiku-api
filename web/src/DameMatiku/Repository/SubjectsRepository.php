<?php

namespace DameMatiku\Repository;

use DameMatiku\Entity\Subject;

/**
 * Subject repository
 */
class SubjectsRepository extends BaseRepository
{
    protected $table = "subject";

    /**
     * Instantiates a comment entity and sets its properties using db data.
     * @param array $data
     *   The array of db data.
     * @return DameMatiku\Entity\Subject
     */
    protected function build($data)
    {
        $subject = new Subject();
        $subject->setId($data['id']);
        $subject->setName($data['name']);
        $subject->setSequence($data['sequence']);
        return $subject;
    }
}