<?php
namespace App\Domain\Book;

use Carbon\Carbon;

class BookFilter
{
	/**
	 * @var Carbon
	 */
	private $dateOfStart;

	public function dateOfStart()
	{
		return $this->dateOfStart;
	}

	/**
	 * @param mixed $dateOfStart
	 */
	public function setDateOfStart($dateOfStart): void
	{
		$this->dateOfStart = $dateOfStart;
	}
}
