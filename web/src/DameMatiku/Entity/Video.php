<?php

namespace DameMatiku\Entity;

class Video extends NamedEntity
{
	/** @var DameMatiku\Entity\User Author of the video */
	protected $user;

	/** @var string YouTube video id */
	protected $youtubeId;

	/** @var string HTML description */
	protected $description;

	public function getUser()
	{
		return $this->user;
	}

	public function setUser($user)
	{
		$this->user = $user;
	}

	public function getYoutubeId()
	{
		return $this->youtubeId;
	}

	public function setYoutubeId($youtubeId)
	{
		$this->youtubeId = $youtubeId;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}
}