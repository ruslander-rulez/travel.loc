<?php
namespace App\Domain\Booking;

use Carbon\Carbon;

class BookingFilter
{
	/**
	 * @var Carbon
	 */
	private $arrivalDateFrom;
	/**
	 * @var Carbon
	 */
	private $arrivalDateTo;

	/**
	 * @return Carbon
	 */
	public function arrivalDateTo(): ?Carbon
	{
		return $this->arrivalDateTo;
	}

	/**
	 * @param Carbon $arrivalDateTo
	 */
	public function setArrivalDateTo(?Carbon $arrivalDateTo): void
	{
		$this->arrivalDateTo = $arrivalDateTo;
	}

	/**
	 * @return Carbon
	 */
	public function arrivalDateFrom(): ?Carbon
	{
		return $this->arrivalDateFrom;
	}

	/**
	 * @param Carbon $arrivalDateFrom
	 */
	public function setArrivalDateFrom(?Carbon $arrivalDateFrom): void
	{
		$this->arrivalDateFrom = $arrivalDateFrom;
	}
}
