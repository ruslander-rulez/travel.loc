<?php

namespace App\Application\Book;

use App\Domain\Book\BookRepository;
use App\Domain\Booking\Booking;
use App\Domain\Booking\BookingRepository;
use Dompdf\Dompdf;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class GenerateProgramDocumentHandler implements Handler
{
	/**
	 * @var BookingRepository
	 */
	private $bookRepository;

	/**
	 * GenerateBorderDocumentsHandler constructor.
	 * @param BookRepository $bookRepository
	 */
	public function __construct(BookRepository $bookRepository)
	{
		$this->bookRepository = $bookRepository;
	}

	/**
	 * Handle a Command object
	 *
	 * @param Command|GenerateProgramDocument $command
	 * @return mixed
	 */
	public function handle(Command $command)
	{
		/** @var Booking $booking */
		$book = $this->bookRepository->byId($command->bookId());
		$dompdf = new Dompdf();
		$dompdf->loadHtml(view("book-program.program", [
			"book" => $book
		]));


		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();

// Output the generated PDF to Browser
		return $dompdf->output();
	}
}