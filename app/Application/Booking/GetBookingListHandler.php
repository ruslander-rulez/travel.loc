<?php

namespace App\Application\Booking;

use App\Domain\Booking\BookingRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class GetBookingListHandler implements Handler
{
	/**
	 * @var BookingRepository
	 */
	private $bookingRepository;

	/**
	 * GetAdviceListHandler constructor.
	 * @param BookingRepository $bookingRepository
	 */
    public function __construct(BookingRepository $bookingRepository)
    {
		$this->bookingRepository = $bookingRepository;
	}

    /**
     * Handle a Command object
     *
     * @param Command|GetBookingList $command
     * @return mixed
     */
    public function handle(Command $command)
    {
        return $this->bookingRepository->all($command->filter(), $command->pagination(), $command->sort());
    }
}