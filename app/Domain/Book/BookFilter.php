<?php
namespace App\Domain\Book;

use Carbon\Carbon;

class BookFilter
{
	/**
	 * @var Carbon
	 */
	private $dateOfStart;
	/**
	 * @var Carbon
	 */
	private $dateOfStartFrom;
	/**
	 * @var Carbon
	 */
	private $dateOfEndTo;

	/**
	 * @return Carbon
	 */
	public function dateOfStartFrom(): Carbon
	{
		return $this->dateOfStartFrom;
	}

	/**
	 * @param Carbon $dateOfStartFrom
	 */
	public function setDateOfStartFrom(Carbon $dateOfStartFrom): void
	{
		$this->dateOfStartFrom = $dateOfStartFrom;
	}

	/**
	 * @return Carbon
	 */
	public function dateOfEndTo(): Carbon
	{
		return $this->dateOfEndTo;
	}

	/**
	 * @param Carbon $dateOfEndTo
	 */
	public function setDateOfEndTo(Carbon $dateOfEndTo): void
	{
		$this->dateOfEndTo = $dateOfEndTo;
	}

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
