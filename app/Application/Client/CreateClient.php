<?php

namespace App\Application\Client;

use ItDevgroup\CommandBus\Command;

class CreateClient implements Command
{
    /**
     * @var string
     */
    private $name;
	private $email;
	private $phone;
	private $passport;
	private $nationality;
	private $birthday;
	private $notes;

	/**
	 * @param $name
	 * @param $email
	 * @param $phone
	 * @param $passport
	 * @param $nationality
	 * @param $birthday
	 * @param $notes
	 */
	public function __construct(
		$name,
		$email,
		$phone,
		$passport,
		$nationality,
		$birthday,
		$notes
	) {
		$this->name = $name;
		$this->email = $email;
		$this->phone = $phone;
		$this->passport = $passport;
		$this->nationality = $nationality;
		$this->birthday = $birthday;
		$this->notes = $notes;
	}

	/**
	 * @return string
	 */
	public function name(): string
	{
		return $this->name;
	}

	/**
	 * @return mixed
	 */
	public function email()
	{
		return $this->email;
	}

	/**
	 * @return mixed
	 */
	public function phone()
	{
		return $this->phone;
	}

	/**
	 * @return mixed
	 */
	public function passport()
	{
		return $this->passport;
	}

	/**
	 * @return mixed
	 */
	public function nationality()
	{
		return $this->nationality;
	}

	/**
	 * @return mixed
	 */
	public function birthday()
	{
		return $this->birthday;
	}

	/**
	 * @return mixed
	 */
	public function notes()
	{
		return $this->notes;
	}
}