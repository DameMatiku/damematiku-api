<?php

namespace DameMatiku\Entity;

class Vote extends Entity
{
	/** @var int Id of the video voted on */
	protected $videoId;

	/** @var int Id of the author of the video */
	protected $userId;

	/** @var int Value, +1 or -1 */
	protected $value;

	/** @var DateTime Voted on */
	protected $votedOn;

	public function getVideoId()
	{
		return $this->videoId;
	}

	public function setVideoId($videoId)
	{
		$this->videoId = $videoId;
	}

	public function getUserId()
	{
		return $this->userId;
	}

	public function setUserId($userId)
	{
		$this->userId = $userId;
	}

	public function getValue()
	{
		return $this->value;
	}

	public function setValue($value)
	{
		$this->value = $value;
	}

	public function getVotedOn()
	{
		return $this->votedOn;
	}

	public function setVotedOn($votedOn)
	{
		$this->votedOn = $votedOn;
	}
}