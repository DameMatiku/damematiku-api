<?php

namespace DameMatiku\Entity;

class Chapter extends OrderedNamedEntity
{
	/** @var string Html description */
	protected $description;

	/** @var DameMatiku\Entity\Sponsor Sponsor of the chapter */
	protected $sponsor;

	public function getDescription()
	{
		return $this->description;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}

	public function getSponsor()
	{
		return $this->sponsor;
	}

	public function setSponsor($sponsor)
	{
		$this->sponsor = $sponsor;
	}
}