<?php
namespace DameMatiku\Repository;

use Doctrine\DBAL\Connection;

use DameMatiku\Exception\NotImplementedException;

/**
 * BaseRepository
 *
 * "The Repository pattern just means putting a façade over your persistence
 * system so that you can shield the rest of your application code from having
 * to know how persistence works."
 */
class BaseRepository
{
    protected $table;

    /** @var \Doctrine\DBAL\Connection */
    protected $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    /**
     * Saves the entity to the database.
     * @param object $entity
     */
    public function save($entity) {
        throw new NotImplementedException;
    }

    /**
     * Deletes the entity.
     * @param integer $id
     */
    public function delete($id) {
        return $this->db->delete($this->table, [ 'id' => $id ]);
    }

    /**
     * Returns the total number of entities.
     * @return int The total number of entities.
     */
    public function getCount() {
        return $this->db->fetchColumn("SELECT COUNT(id) FROM $this->table");
    }

    /**
     * Returns an entity matching the supplied id.
     * @param integer $id
     * @return object|false An entity object if found, false otherwise.
     */
    public function find($id) {
        $data = $this->db->fetchAssoc("SELECT * FROM $this->table WHERE id = ?", [ $id ]);
        return $data ? $this->build($data) : FALSE;
    }

    /**
     * Returns a collection of entities.
     * @param integer $limit
     * @param integer $offset
     * @param array $orderBy
     *   Optionally, the order by info, in the $column => $direction format.
     * @return array A collection of entity objects.
     */
    public function findAll($conditions = [], $orderBy = [], $limit = NULL, $offset = 0) {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
            ->select('c.*')
            ->from($this->table, 'c')
            ->setFirstResult($offset);

        $parameters = [];
        foreach ($conditions as $key => $value) {
            $parameters[':' . $key] = $value;
            $where = $queryBuilder->expr()->eq('c.' . $key, ':' . $key);
            $queryBuilder->andWhere($where);
        }
        $queryBuilder->setParameters($parameters);

        if (count($orderBy) > 0) {
            foreach ($orderBy as $key => $value) {
                $queryBuilder->orderBy('c.' . $key, $value);
            }
        }

        if ($limit !== NULL) {
            $queryBuilder->setMaxResults($limit);
        }
        
        $statement = $queryBuilder->execute();
        $data = $statement->fetchAll();

        $entities = [];
        foreach ($data as $row) {
            $entities[] = $this->build($row);
        }
        return $entities;
    }

    protected function build($data) {
        throw new NotImplementedException;
    }
}