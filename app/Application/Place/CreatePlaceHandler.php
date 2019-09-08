<?php

namespace App\Application\Place;

use App\Domain\Place\Place;
use App\Domain\Place\PlaceRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class CreatePlaceHandler implements Handler
{
	/**
	 * @var PlaceRepository
	 */
	private $placeRepository;

	/**
	 * CreatePlaceHandler constructor.
	 * @param PlaceRepository $placeRepository
	 */
	public function __construct(PlaceRepository $placeRepository)
    {
		$this->placeRepository = $placeRepository;
	}

    /**
     * Handle a Command object
     *
     * @param Command|CreatePlace $command
     * @return mixed
     */
    public function handle(Command $command)
    {
        $place = new Place();

        $place->name = $command->name();

        $this->placeRepository->store($place);
    }
}