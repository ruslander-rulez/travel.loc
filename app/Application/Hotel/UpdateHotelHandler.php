<?php

namespace App\Application\Hotel;

use App\Domain\Hotel\Hotel;
use App\Domain\Hotel\HotelRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class UpdateHotelHandler implements Handler
{

	/**
	 * @var HotelRepository
	 */
	private $HotelRepository;

	/**
	 * UpdateAdviceHandler constructor.
	 * @param HotelRepository $HotelRepository
	 */
    public function __construct(HotelRepository $HotelRepository)
    {
		$this->HotelRepository = $HotelRepository;
	}

    /**
     * Handle a Command object
     *
     * @param Command|UpdateHotel $command
     */
    public function handle(Command $command)
    {
		/** @var Hotel $Hotel */
		$Hotel = $this->HotelRepository->byId($command->id());
        $Hotel->name = $command->name();
        $this->HotelRepository->store($Hotel);
    }
}