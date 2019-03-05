<?php
namespace App\Application\Booking;


use ItDevgroup\CommandBus\Command;

class GenerateTourtickets implements Command
{
	private $bookingId;
	private $excludeIds;

	/**
	 * GenerateTourtickets constructor.
	 * @param $bookingId
	 * @param $excludeIds
	 */
	public function __construct($bookingId, $excludeIds)
	{
		$this->bookingId = $bookingId;
		$this->excludeIds = $excludeIds;
	}

	/**
	 * @return mixed
	 */
	public function bookingId()
	{
		return $this->bookingId;
	}

	/**
	 * @return mixed
	 */
	public function excludeIds()
	{
		return $this->excludeIds;
	}
}