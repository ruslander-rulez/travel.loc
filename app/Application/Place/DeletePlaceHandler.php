<?php
namespace App\Application\Place;

use App\Domain\Place\PlaceRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class DeletePlaceHandler implements Handler
{
    /**
     * @var PlaceRepository
     */
    private $placeRepository;

    /**
     * DeleteAdviceHandler constructor.
     * @param PlaceRepository $placeRepository
     */
    public function __construct(PlaceRepository $placeRepository)
    {
        $this->placeRepository = $placeRepository;
    }

    /**
     * Handle a Command object
     *
     * @param Command|DeletePlace $command
     * @return mixed
     */
    public function handle(Command $command)
    {
        $advice = $this->placeRepository->byId($command->id());
        $this->placeRepository->delete($advice);
    }
}