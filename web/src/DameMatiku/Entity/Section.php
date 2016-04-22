<?php

namespace DameMatiku\Entity;

class Section extends OrderedNamedEntity
{
	/** @var DameMatiku\Entity\Subject Teaching subject */
	protected $subject;

	public function getSubject()
	{
		return $this->subject;
	}

	public function setSubject($subject)
	{
		$this->subject = $subject;
	}
}