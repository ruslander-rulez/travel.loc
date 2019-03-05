<?php

namespace App\Application\Booking;

use App\Domain\Booking\Booking;
use App\Domain\Booking\BookingRepository;
use App\Domain\Ship\ShipRepository;
use Carbon\Carbon;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class CreateBookingHandler implements Handler
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
	 * CreateBookingHandler constructor.
	 * @param BookingRepository $bookingRepository
	 * @param ShipRepository $shipRepository
	 */
	public function __construct(BookingRepository $bookingRepository, ShipRepository $shipRepository)
    {
		$this->bookingRepository = $bookingRepository;
		$this->shipRepository = $shipRepository;
	}

    /**
     * Handle a Command object
     *
     * @param Command|CreateBooking $command
     * @return mixed
     */
    public function handle(Command $command)
    {
        $booking = new Booking();
		$ship = $this->shipRepository->byId($command->ship_id());
		$booking->color = "#ffffff";
		$booking->leader_id = $command->leader_id();
		$booking->tourticket_settings = $command->tourticket_settings();
		$booking->group_name = $command->group_name();
		$booking->additional_info = $command->additional_info();
		$booking->arrival_date = Carbon::createFromFormat("Y-m-d", $command->arrival_date());
		$booking->departure_date = Carbon::createFromFormat("Y-m-d", $command->departure_date());
		$booking->ship()->associate($ship);

		$this->bookingRepository->store($booking);

		$touristIds = collect($command->tourists())->pluck("id")->all();
		$booking->tourists()->sync($touristIds);
    }
}