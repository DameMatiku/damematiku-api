<?php

namespace DameMatiku\Repository;

use Doctrine\DBAL\Connection;
use DameMatiku\Entity\Tag;

/**
 * Tag repository
 */
class TagsRepository extends BaseRepository
{
    protected $table = "tag";

    /**
     * Instantiates a section entity and sets its properties using db data.
     * @param array $data
     *   The array of db data.
     * @return DameMatiku\Entity\Tag
     */
    protected function build($data)
    {
        $tag = new Tag();
        $tag->setId($data['id']);
        $tag->setName($data['name']);
        $tag->setSequence($data['sequence']);
        $tag->setParentTagId($data['parent_tag_id']);
        return $tag;
    }

    public function getTagTree() {
        $tags = $this->findAll([], [ 'sequence' => 'ASC']);

        $tagsChildren = [];
        foreach ($tags as $tag) {
            $parentId = $tag->getParentTagId() !== NULL ? $tag->getParentTagId() : -1;
            if (!isset($tagsChildren[$parentId])) {
                $tagsChildren[$parentId] = [];
            }
            $tagsChildren[$parentId][] = $tag;
        }
        
        foreach ($tags as $key => $tag) {
            if (isset($tagsChildren[$tag->getId()])) {
                $tags[$key]->setChildrenTags($tagsChildren[$tag->getId()]);
            }
        }

        $result = [];
        foreach ($tags as $tag) {
            if ($tag->getParentTagId() === NULL) {
                $result[] = $tag;
            }
        }

        return $result;
    }
}