<?php

namespace App\Application\Ship;

use App\Domain\Ship\Ship;
use App\Domain\Ship\ShipRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class UpdateShipHandler implements Handler
{

	/**
	 * @var ShipRepository
	 */
	private $shipRepository;

	/**
	 * UpdateAdviceHandler constructor.
	 * @param ShipRepository $shipRepository
	 */
    public function __construct(ShipRepository $shipRepository)
    {
		$this->shipRepository = $shipRepository;
	}

    /**
     * Handle a Command object
     *
     * @param Command|UpdateShip $command
     */
    public function handle(Command $command)
    {
		/** @var Ship $ship */
		$ship = $this->shipRepository->byId($command->id());
        $ship->name = $command->name();
        $this->shipRepository->store($ship);
    }
}