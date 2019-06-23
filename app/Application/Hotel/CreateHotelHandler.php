<?php

namespace App\Application\Hotel;

use App\Domain\Hotel\Hotel;
use App\Domain\Hotel\HotelRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class CreateHotelHandler implements Handler
{
	/**
	 * @var HotelRepository
	 */
	private $HotelRepository;

	/**
	 * CreateHotelHandler constructor.
	 * @param HotelRepository $HotelRepository
	 */
	public function __construct(HotelRepository $HotelRepository)
    {
		$this->HotelRepository = $HotelRepository;
	}

    /**
     * Handle a Command object
     *
     * @param Command|CreateHotel $command
     * @return mixed
     */
    public function handle(Command $command)
    {
        $Hotel = new Hotel();

        $Hotel->name = $command->name();

        $this->HotelRepository->store($Hotel);
    }
}