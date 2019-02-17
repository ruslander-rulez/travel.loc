<?php

namespace App\Application\Ship;

use ItDevgroup\CommandBus\Command;

class CreateShip implements Command
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