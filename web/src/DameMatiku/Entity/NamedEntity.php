<?php

namespace DameMatiku\Entity;

class NamedEntity extends Entity
{
	/** @var string Name */
	protected $name;

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}
}