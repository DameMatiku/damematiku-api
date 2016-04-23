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

    public function save($vote) {
        $data = [
            'user_id' => $vote->getUserId(),
            'video_id' => $vote->getVideoId(),
            'value' => $vote->getValue(),
            'voted_on' => $vote->getVotedOn(),
        ];
        if ($vote->getId()) {
            $this->db->update($this->table, $data, [ 'id' => $vote->getId() ]);
        } else {
            $this->db->insert($this->table, $data);
            // Get the id of the newly created record and set it on the entity.
            $id = $this->db->lastInsertId();
            $vote->setId($id);
        }
    }
}