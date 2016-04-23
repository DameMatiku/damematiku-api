<?php

namespace DameMatiku\Entity;

class Chapter extends OrderedNamedEntity
{
	/** @var int Parent section id */
	protected $sectionId;

	/** @var string Html description */
	protected $description;

	/** @var DameMatiku\Entity\Sponsor Sponsor of the chapter */
	protected $sponsor;

	/** @var DameMatiku\Entity\Chapter Previous chapter */
	protected $previousChapter;

	/** @var DameMatiku\Entity\Chapter Next chapter */
	protected $nextChapter;

	/** @var array Array of videos */
	protected $videos;

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

	public function getSectionId()
	{
		return $this->sectionId;
	}

	public function setSectionId($sectionId)
	{
		$this->sectionId = $sectionId;
	}

	public function getPreviousChapter()
	{
		return $this->previousChapter;
	}

	public function setPreviousChapter($previousChapter)
	{
		$this->previousChapter = $previousChapter;
	}

	public function getNextChapter()
	{
		return $this->nextChapter;
	}

	public function setNextChapter($nextChapter)
	{
		$this->nextChapter = $nextChapter;
	}

	public function getVideos()
	{
		return $this->videos;
	}

	public function setVideos($videos)
	{
		$this->videos = $videos;
	}
}