<?php

namespace App\Application\Restaurant;

use ItDevgroup\CommandBus\Command;

class UpdateRestaurant implements Command
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;

	/**
	 * UpdateAdvice constructor.
	 * @param int $id
	 * @param $name
	 */
    public function __construct(
        $id,
        $name
    ) {
        $this->id = $id;
		$this->name = $name;
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
	public function name(): string
	{
		return $this->name;
	}
}