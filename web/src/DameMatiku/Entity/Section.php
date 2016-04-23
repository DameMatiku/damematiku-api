<?php

namespace DameMatiku\Entity;

class Section extends OrderedNamedEntity
{
	/** @var DameMatiku\Entity\Subject Teaching subject */
	protected $subject;

	/** @var array Ordered array of chapters */
	protected $chapters;

	public function getSubject()
	{
		return $this->subject;
	}

	public function setSubject($subject)
	{
		$this->subject = $subject;
	}

	public function getChapters()
	{
		return $this->chapters;
	}

	public function setChapters($chapters)
	{
		$this->chapters = $chapters;
	}
}