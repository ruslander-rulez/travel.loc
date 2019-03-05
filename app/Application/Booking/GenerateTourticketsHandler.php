<?php

namespace App\Application\Booking;

use App\Domain\Booking\Booking;
use Dompdf\Dompdf;


class GenerateTourticketsHandler implements \ItDevgroup\CommandBus\Handler
{
	/**
	 * @var \App\Infrastructure\Eloquent\BookingRepositoryEloquent
	 */
	private $bookingRepositoryEloquent;

	/**
	 * GenerateTourticketsHandler constructor.
	 * @param \App\Infrastructure\Eloquent\BookingRepositoryEloquent $bookingRepositoryEloquent
	 */
	public function __construct(\App\Infrastructure\Eloquent\BookingRepositoryEloquent $bookingRepositoryEloquent)
	{
		$this->bookingRepositoryEloquent = $bookingRepositoryEloquent;
	}

	/**
	 * Handle a Command object
	 *
	 * @param \ItDevgroup\CommandBus\Command|GenerateTourtickets $command
	 * @return mixed
	 */
	public function handle(\ItDevgroup\CommandBus\Command $command)
	{
		/** @var Booking $booking */
		$booking = $this->bookingRepositoryEloquent->byId($command->bookingId());

		$dompdf = new Dompdf();
		$dompdf->loadHtml(view("tourtickets.content", [
			"groupNumber" => time(),
			"ship" => $booking->ship->name,
			"tourists" => $booking->tourists,
			"exits" => $booking->tourticket_settings,
			"excludeTourists" => $command->excludeIds()
		]));


		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();

// Output the generated PDF to Browser
		return $dompdf->output();
	}
}