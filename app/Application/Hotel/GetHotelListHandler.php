<?php

namespace App\Application\Hotel;

use App\Domain\Hotel\HotelRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class GetHotelListHandler implements Handler
{
	/**
	 * @var HotelRepository
	 */
	private $HotelRepository;

	/**
	 * GetAdviceListHandler constructor.
	 * @param HotelRepository $HotelRepository
	 */
    public function __construct(HotelRepository $HotelRepository)
    {
		$this->HotelRepository = $HotelRepository;
	}

    /**
     * Handle a Command object
     *
     * @param Command|GetHotelList $command
     * @return mixed
     */
    public function handle(Command $command)
    {
        return $this->HotelRepository->all($command->filter(), $command->pagination(), $command->sort());
    }
}