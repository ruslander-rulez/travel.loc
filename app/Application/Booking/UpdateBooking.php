<?php

namespace App\Application\Booking;

use ItDevgroup\CommandBus\Command;

class UpdateBooking implements Command
{
    /**
     * @var int
     */
    private $id;
	private $ship_id;
	private $group_name;
	private $additional_info;
	private $arrival_date;
	private $evening_program;
	private $departure_date;
	private $tourists;
	private $leader_id;

	/**
	 * UpdateAdvice constructor.
	 * @param int $id
	 * @param $ship_id
	 * @param $group_name
	 * @param $additional_info
	 * @param $arrival_date
	 * @param $departure_date
	 * @param $evening_program
	 * @param $tourists
	 * @param $leader_id
	 */
    public function __construct(
        $id,
        $ship_id,
        $group_name,
        $additional_info,
        $arrival_date,
        $departure_date,
        $evening_program,
		$tourists,
		$leader_id
    ) {
        $this->id = $id;
		$this->ship_id = $ship_id;
		$this->group_name = $group_name;
		$this->additional_info = $additional_info;
		$this->arrival_date = $arrival_date;
		$this->evening_program = $evening_program;
		$this->departure_date = $departure_date;
		$this->tourists = $tourists;
		$this->leader_id = $leader_id;
	}

	/**
	 * @return int
	 */
	public function id(): int
	{
		return $this->id;
	}

	/**
	 * @return mixed
	 */
	public function ship_id()
	{
		return $this->ship_id;
	}

	/**
	 * @return mixed
	 */
	public function group_name()
	{
		return $this->group_name;
	}

	/**
	 * @return mixed
	 */
	public function additional_info()
	{
		return $this->additional_info;
	}

	/**
	 * @return mixed
	 */
	public function arrival_date()
	{
		return $this->arrival_date;
	}

	/**
	 * @return mixed
	 */
	public function evening_program()
	{
		return $this->evening_program;
	}

	/**
	 * @return mixed
	 */
	public function departure_date()
	{
		return $this->departure_date;
	}

	/**
	 * @return mixed
	 */
	public function tourists()
	{
		return $this->tourists;
	}

	/**
	 * @return mixed
	 */
	public function leader_id()
	{
		return $this->leader_id;
	}
}