<?php

namespace App\Application\Restaurant;

use ItDevgroup\CommandBus\Command;

class CreateRestaurant implements Command
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param $name
     */
    public function __construct(
        $name
    ) {
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function name(): string
	{
		return $this->name;
	}

}