<?php

namespace App\Application\Ship;

use App\Domain\Ship\Ship;
use App\Domain\Ship\ShipRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class CreateShipHandler implements Handler
{
	/**
	 * @var ShipRepository
	 */
	private $shipRepository;

	/**
	 * CreateShipHandler constructor.
	 * @param ShipRepository $shipRepository
	 */
	public function __construct(ShipRepository $shipRepository)
    {
		$this->shipRepository = $shipRepository;
	}

    /**
     * Handle a Command object
     *
     * @param Command|CreateShip $command
     * @return mixed
     */
    public function handle(Command $command)
    {
        $ship = new Ship();

        $ship->name = $command->name();

        $this->shipRepository->store($ship);
    }
}