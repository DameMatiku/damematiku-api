<?php

namespace DameMatiku\Entity;

class Tag extends OrderedNamedEntity
{
	/** @var DameMatiku\Entity\Tag Parent tag - might be NULL for top level tags */
	protected $parentTagId;

	/** @var array Ordered array of children tags */
	protected $childrenTags;

	public function getParentTagId()
	{
		return $this->parentTagId;
	}

	public function setParentTagId($parentTagId)
	{
		$this->parentTagId = $parentTagId;
	}

	public function getChildrenTags()
	{
		return $this->childrenTags;
	}

	public function setChildrenTags($childrenTags)
	{
		$this->childrenTags = $childrenTags;
	}
}