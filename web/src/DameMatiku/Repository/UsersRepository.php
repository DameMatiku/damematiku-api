<?php

namespace DameMatiku\Repository;

use Doctrine\DBAL\Connection;
use DameMatiku\Entity\User;

/**
 * User repository
 */
class UsersRepository extends BaseRepository
{
    protected $table = "user";

    /** @var string defaultAvatarUrl */
    protected $defaultAvatarUrl;

    public function __construct(Connection $db, $defaultAvatarUrl) {
        $this->db = $db;
        $this->defaultAvatarUrl = $defaultAvatarUrl;
    }

    /**
     * Instantiates a user entity and sets its properties using db data.
     * @param array $data
     *   The array of db data.
     * @return DameMatiku\Entity\User
     */
    protected function build($data)
    {
        $user = new User();
        $user->setId($data['id']);
        $user->setFirstName($data['first_name']);
        $user->setLastName($data['last_name']);
        $user->setGoogleUserId($data['google_user_id']);
        $user->setRegisteredOn($data['registered_on']);
        $user->setUserType($data['user_type']);
        if (empty($data['avatar_url'])) {
            $user->setAvatarUrl($this->defaultAvatarUrl);
        } else {
            $user->setAvatarUrl($data['avatar_url']);
        }

        return $user;
    }
}