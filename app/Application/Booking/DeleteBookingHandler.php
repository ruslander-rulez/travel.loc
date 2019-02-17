<?php
namespace App\Application\Booking;

use App\Domain\Booking\BookingRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class DeleteBookingHandler implements Handler
{
    /**
     * @var BookingRepository
     */
    private $bookingRepository;

    /**
     * DeleteAdviceHandler constructor.
     * @param BookingRepository $bookingRepository
     */
    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * Handle a Command object
     *
     * @param Command|DeleteBooking $command
     * @return mixed
     */
    public function handle(Command $command)
    {
        $booking = $this->bookingRepository->byId($command->id());
        $this->bookingRepository->delete($booking);
    }
}