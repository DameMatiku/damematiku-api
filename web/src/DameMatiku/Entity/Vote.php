<?php

namespace DameMatiku\Entity;

class Vote extends Entity
{
	/** @var DameMatiku\Entity\Video Video voted on */
	protected $video;

	/** @var DameMatiku\Entity\User Author of the video */
	protected $user;

	/** @var int Value, +1 or -1 */
	protected $value;

	/** @var DateTime Voted on */
	protected $votedOn;

	public function getVideo()
	{
		return $this->video;
	}

	public function setVideo($video)
	{
		$this->video = $video;
	}

	public function getUser()
	{
		return $this->user;
	}

	public function setUser($user)
	{
		$this->user = $user;
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