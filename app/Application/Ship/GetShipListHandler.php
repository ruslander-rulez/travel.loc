<?php

namespace App\Application\Ship;

use App\Domain\Ship\ShipRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class GetShipListHandler implements Handler
{
	/**
	 * @var ShipRepository
	 */
	private $shipRepository;

	/**
	 * GetAdviceListHandler constructor.
	 * @param ShipRepository $shipRepository
	 */
    public function __construct(ShipRepository $shipRepository)
    {
		$this->shipRepository = $shipRepository;
	}

    /**
     * Handle a Command object
     *
     * @param Command|GetShipList $command
     * @return mixed
     */
    public function handle(Command $command)
    {
        return $this->shipRepository->all($command->filter(), $command->pagination(), $command->sort());
    }
}