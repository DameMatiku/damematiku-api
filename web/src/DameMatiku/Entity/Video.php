<?php

namespace DameMatiku\Entity;

class Video extends Entity
{
	/** @var DameMatiku\Entity\User Author of the video */
	protected $user;

	/** @var string Chapter id */
	protected $chapterId;


	/** @var string YouTube video id */
	protected $youtubeId;

	/** @var string HTML description */
	protected $description;

	/** @var int Total vote count */
	protected $votes;

	/** @var int How the current user (aka "me") voted on this video: +1, 0 or -1*/
	protected $myVote;

	public function getUser()
	{
		return $this->user;
	}

	public function setUser($user)
	{
		$this->user = $user;
	}

	public function getChapterId()
	{
		return $this->chapterId;
	}

	public function setChapterId($chapterId)
	{
		$this->chapterId = $chapterId;
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

	public function getVotes()
	{
		return $this->votes;
	}

	public function setVotes($votes)
	{
		$this->votes = $votes;
	}

	public function getMyVote()
	{
		return $this->myVote;
	}

	public function setMyVote($myVote)
	{
		$this->myVote = $myVote;
	}
}