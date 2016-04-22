<?php

namespace DameMatiku\Entity;

class User extends Entity
{
	/** @var string First name */
	protected $firstName;

	/** @var string Last name */
	protected $lastName;

	/** @var string Google User id */
	protected $googleUserId;

	/** @var string Registered on */
	protected $registeredOn;

	public function getFirstName()
	{
		return $this->firstName;
	}

	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;
	}

	public function getLastName()
	{
		return $this->lastName;
	}

	public function setLastName($lastName)
	{
		$this->lastName = $lastName;
	}

	public function getName() {
		return $this->firstName . " " . $this->lastName;
	}

	public function getGoogleUserId()
	{
		return $this->googleUserId;
	}

	public function setGoogleUserId($googleUserId)
	{
		$this->googleUserId = $googleUserId;
	}

	public function getRegisteredOn()
	{
		return $this->registeredOn;
	}

	public function setRegisteredOn($registeredOn)
	{
		$this->registeredOn = $registeredOn;
	}

	public function getUserType()
	{
		return $this->userType;
	}

	public function setUserType($userType)
	{
		$this->userType = $userType;
	}
}