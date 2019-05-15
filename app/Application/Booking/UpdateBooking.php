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
	private $departure_date;
	private $tourists;
	private $leader_id;
	private $tourticket_settings;
	private $checklist;

	/**
	 * UpdateAdvice constructor.
	 * @param int $id
	 * @param $ship_id
	 * @param $group_name
	 * @param $additional_info
	 * @param $arrival_date
	 * @param $departure_date
	 * @param $tourists
	 * @param $leader_id
	 * @param $tourticket_settings
	 * @param $checklist
	 */
    public function __construct(
        $id,
        $ship_id,
        $group_name,
        $additional_info,
        $arrival_date,
        $departure_date,
		$tourists,
		$leader_id,
		$tourticket_settings,
		$checklist
    ) {
        $this->id = $id;
		$this->ship_id = $ship_id;
		$this->group_name = $group_name;
		$this->additional_info = $additional_info;
		$this->arrival_date = $arrival_date;
		$this->departure_date = $departure_date;
		$this->tourists = $tourists;
		$this->leader_id = $leader_id;
		$this->tourticket_settings = $tourticket_settings;
		$this->checklist = $checklist;
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

	/**
	 * @return mixed
	 */
	public function tourticket_settings()
	{
		return $this->tourticket_settings;
	}

	/**
	 * @return mixed
	 */
	public function checklist()
	{
		return $this->checklist;
	}
}