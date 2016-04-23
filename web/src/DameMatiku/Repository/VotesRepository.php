<?php

namespace DameMatiku\Repository;

use Doctrine\DBAL\Connection;
use DameMatiku\Entity\Vote;

/**
 * User repository
 */
class VotesRepository extends BaseRepository
{
    protected $table = "vote";

    /**
     * Instantiates a user entity and sets its properties using db data.
     * @param array $data
     *   The array of db data.
     * @return DameMatiku\Entity\Vote
     */
    protected function build($data)
    {
        $user = new Vote();
        $user->setId($data['id']);
        $user->setUserId($data['user_id']);
        $user->setVideoId($data['video_id']);
        $user->setValue($data['value']);
        $user->setVotedOn($data['voted_on']);

        return $user;
    }
}