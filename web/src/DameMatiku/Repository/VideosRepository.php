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

    /** @var DameMatiku\Repository\UsersRepository */
    protected $usersRepository;

    /** @var DameMatiku\Repository\VotesRepository */
    protected $votesRepository;

    public function __construct(Connection $db, $usersRepository, $votesRepository)
    {
        $this->db = $db;
        $this->usersRepository = $usersRepository;
        $this->votesRepository = $votesRepository;
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
        $video->setChapterId($data['chapter_id']);
        $video->setYoutubeId($data['youtube_id']);
        $video->setUser($user);
        return $video;
    }

    public function findAllForChapter($chapterId, $userId) {
        return $this->findAllDetailed([ 'chapter_id' => $chapterId ], $userId);
    }

    public function findDetail($videoId, $userId) {
        return $this->findAllDetailed([ 'id' => $videoId ], $userId)[0];
    }

    protected function findAllDetailed($conditions, $userId) {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('vi.*, SUM(vo.value) AS votes')
            ->from($this->table, 'vi')
            ->leftJoin('vi', 'vote', 'vo', 'vi.id = vo.video_id')
            ->orderBy('SUM(vo.value)')
            ->groupBy('vi.id');

        $parameters = [];
        foreach ($conditions as $key => $value) {
            $parameters[':' . $key] = $value;
            $where = $queryBuilder->expr()->eq('vi.' . $key, ':' . $key);
            $queryBuilder->andWhere($where);
        }
        $queryBuilder->setParameters($parameters);
        
        $statement = $queryBuilder->execute();
        $data = $statement->fetchAll();

        // potentially slow part when user voted 10,000 times :-P
        $votes = $this->votesRepository->findAll([ 'user_id' => $userId ]);
        $votesByVideoId = [];
        foreach ($votes as $vote) {
            $votesByVideoId[$vote->getVideoId()] = $vote;
        }

        $entities = [];
        foreach ($data as $row) {
            $video = $this->build($row);
            $video->setVotes($row['votes'] ? $row['votes'] : 0);

            // find out how the user voted - -1, 0 or +1
            $myVote = 0;
            if (isset($votesByVideoId[$video->getId()])) {
                $myVote = $votesByVideoId[$video->getId()]->getValue();
            
                if ($myVote != 0) {
                    if ($myVote > 0) {
                        $myVote = 1;
                    } else {
                        $myVote = -1;
                    }
                }
            }
            $video->setMyVote($myVote);

            $entities[] = $video;
        }
        return $entities;
    }
}