<?php

namespace App\Application\Booking;

use ItDevgroup\CommandBus\Command;

class UpdateBookingColor implements Command
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $color;

	/**
	 * UpdateAdvice constructor.
	 * @param int $id
	 * @param $color
	 */
    public function __construct(
        $id,
        $color
    ) {
        $this->id = $id;
		$this->color = $color;
	}

    /**
     * @return int
     */
    public function id()
    {
        return $this->id;
    }

	/**
	 * @return string
	 */
	public function color(): string
	{
		return $this->color;
	}
}