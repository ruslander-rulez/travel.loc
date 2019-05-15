<?php

namespace App\Application\Booking;

use App\Domain\Booking\Booking;
use App\Domain\Booking\BookingRepository;
use App\Domain\Ship\ShipRepository;
use Carbon\Carbon;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class UpdateBookingHandler implements Handler
{

	/**
	 * @var BookingRepository
	 */
	private $bookingRepository;
	/**
	 * @var ShipRepository
	 */
	private $shipRepository;

	/**
	 * UpdateAdviceHandler constructor.
	 * @param BookingRepository $bookingRepository
	 * @param ShipRepository $shipRepository
	 */
    public function __construct(
    	BookingRepository $bookingRepository,
		ShipRepository $shipRepository
	) {
		$this->bookingRepository = $bookingRepository;
		$this->shipRepository = $shipRepository;
	}

    /**
     * Handle a Command object
     *
     * @param Command|UpdateBooking $command
     */
    public function handle(Command $command)
    {
		/** @var Booking $booking */
		$booking = $this->bookingRepository->byId($command->id());
		$ship = $this->shipRepository->byId($command->ship_id());
        $booking->ship()->associate($ship);
        $booking->leader_id = $command->leader_id();
        $booking->tourticket_settings = $command->tourticket_settings();
        $booking->group_name = $command->group_name();
        $booking->additional_info = $command->additional_info();
        $booking->checklist = $command->checklist();
        $booking->arrival_date = Carbon::createFromFormat("Y-m-d", $command->arrival_date());
        $booking->departure_date = Carbon::createFromFormat("Y-m-d", $command->departure_date());
        $touristIds = collect($command->tourists())->pluck("id")->all();
		$this->bookingRepository->store($booking);
		$booking->tourists()->sync($touristIds);
	}
}