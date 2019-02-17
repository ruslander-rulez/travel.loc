<?php

namespace App\Application\Booking;

use App\Domain\Booking\Booking;
use App\Domain\Booking\BookingRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class UpdateBookingColorHandler implements Handler
{
	/**
	 * @var BookingRepository
	 */
	private $bookingRepository;

	/**
	 * UpdateAdviceHandler constructor.
	 * @param BookingRepository $bookingRepository
	 */
    public function __construct(BookingRepository $bookingRepository)
    {
		$this->bookingRepository = $bookingRepository;
	}

    /**
     * Handle a Command object
     *
     * @param Command|UpdateBookingColor $command
     */
    public function handle(Command $command)
    {
		/** @var Booking $booking */
		$booking = $this->bookingRepository->byId($command->id());
        $booking->color = $command->color();
        $this->bookingRepository->store($booking);
    }
}