<?php

namespace App\Application\Place;

use App\Domain\Place\PlaceRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class GetPlaceListHandler implements Handler
{
	/**
	 * @var PlaceRepository
	 */
	private $placeRepository;

	/**
	 * GetAdviceListHandler constructor.
	 * @param PlaceRepository $placeRepository
	 */
    public function __construct(PlaceRepository $placeRepository)
    {
		$this->placeRepository = $placeRepository;
	}

    /**
     * Handle a Command object
     *
     * @param Command|GetPlaceList $command
     * @return mixed
     */
    public function handle(Command $command)
    {
        return $this->placeRepository->all($command->filter(), $command->pagination(), $command->sort());
    }
}