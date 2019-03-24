<?php
namespace App\Application\Booking;

use ItDevgroup\CommandBus\Command;

class GenerateBorderDocuments implements Command
{
	private $bookingId;

	/**
	 * GenerateBorderDocuments constructor.
	 * @param $bookingId
	 */
	public function __construct($bookingId)
	{
		$this->bookingId = $bookingId;
	}

	/**
	 * @return mixed
	 */
	public function bookingId()
	{
		return $this->bookingId;
	}
}