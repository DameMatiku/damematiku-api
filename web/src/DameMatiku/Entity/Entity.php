<?php

namespace DameMatiku\Entity;

class Entity
{
	/** @var integer Entity id */
	protected $id;
	
	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}
}