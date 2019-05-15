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
	 * @var Carbon
	 */
	private $departureDateFrom;
	/**
	 * @var Carbon
	 */
	private $departureDateTo;

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

	/**
	 * @return Carbon
	 */
	public function departureDateFrom(): ?Carbon
	{
		return $this->departureDateFrom;
	}

	/**
	 * @param Carbon $departureDateFrom
	 */
	public function setDepartureDateFrom(?Carbon $departureDateFrom): void
	{
		$this->departureDateFrom = $departureDateFrom;
	}

	/**
	 * @return Carbon
	 */
	public function departureDateTo(): ?Carbon
	{
		return $this->departureDateTo;
	}

	/**
	 * @param Carbon $departureDateTo
	 */
	public function setDepartureDateTo(?Carbon $departureDateTo): void
	{
		$this->departureDateTo = $departureDateTo;
	}
}
