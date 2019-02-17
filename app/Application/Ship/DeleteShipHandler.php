<?php
namespace App\Application\Ship;

use App\Domain\Ship\ShipRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class DeleteShipHandler implements Handler
{
    /**
     * @var ShipRepository
     */
    private $shipRepository;

    /**
     * DeleteAdviceHandler constructor.
     * @param ShipRepository $shipRepository
     */
    public function __construct(ShipRepository $shipRepository)
    {
        $this->shipRepository = $shipRepository;
    }

    /**
     * Handle a Command object
     *
     * @param Command|DeleteShip $command
     * @return mixed
     */
    public function handle(Command $command)
    {
        $advice = $this->shipRepository->byId($command->id());
        $this->shipRepository->delete($advice);
    }
}