<?php

namespace App\Application\Place;

use App\Domain\Place\Place;
use App\Domain\Place\PlaceRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class UpdatePlaceHandler implements Handler
{

	/**
	 * @var PlaceRepository
	 */
	private $placeRepository;

	/**
	 * UpdateAdviceHandler constructor.
	 * @param PlaceRepository $placeRepository
	 */
    public function __construct(PlaceRepository $placeRepository)
    {
		$this->placeRepository = $placeRepository;
	}

    /**
     * Handle a Command object
     *
     * @param Command|UpdatePlace $command
     */
    public function handle(Command $command)
    {
		/** @var Place $place */
		$place = $this->placeRepository->byId($command->id());
        $place->name = $command->name();
        $this->placeRepository->store($place);
    }
}