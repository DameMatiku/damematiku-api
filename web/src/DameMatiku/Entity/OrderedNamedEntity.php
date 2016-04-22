<?php

namespace DameMatiku\Entity;

class OrderedNamedEntity extends NamedEntity
{
	/** @var string Sequence */
	protected $sequence;

	public function getSequence()
	{
		return $this->sequence;
	}

	public function setSequence($sequence)
	{
		$this->sequence = $sequence;
	}
}