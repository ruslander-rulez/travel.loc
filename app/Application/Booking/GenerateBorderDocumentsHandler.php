<?php

namespace App\Application\Booking;

use App\Domain\Booking\BookingRepository;
use App\Domain\Client\Client;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class GenerateBorderDocumentsHandler implements Handler
{
	/**
	 * @var BookingRepository
	 */
	private $bookingRepository;

	/**
	 * GenerateBorderDocumentsHandler constructor.
	 * @param BookingRepository $bookingRepository
	 */
	public function __construct(BookingRepository $bookingRepository)
	{
		$this->bookingRepository = $bookingRepository;
	}

	/**
	 * Handle a Command object
	 *
	 * @param Command|GenerateBorderDocuments $command
	 * @return mixed
	 * @throws \PhpOffice\PhpSpreadsheet\Exception
	 */
	public function handle(Command $command)
	{
		$booking = $this->bookingRepository->byId($command->bookingId());


		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->getRowDimension(1)->setRowHeight(23);
		$sheet->getColumnDimension("A")->setWidth(45);
		$sheet->getColumnDimension("B")->setWidth(30);
		$sheet->getColumnDimension("C")->setWidth(30);
		$sheet->getColumnDimension("D")->setWidth(30);
		$sheet->
			getStyle("A1:D1")->getFont()->setSize(15)->getColor()->setRGB("1F497D");

		$styleArray = [
			
			'borders' => [
				'bottom' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
					'color' => ['rgb' => '4F81BD'],
				],

			]
		];

		$sheet->getStyle('A1:D1')->applyFromArray($styleArray);

		$sheet->getCell("A1")->setValue("ФИО");
		$sheet->getCell("B1")->setValue("Дата рождения");
		$sheet->getCell("C1")->setValue("Номер паспорта");
		$sheet->getCell("D1")->setValue("Гражданство");
		$keyCell = 2;
		foreach ($booking->tourists as $tourist) {
			/** @var Client $tourist */
			$sheet->getCell("A{$keyCell}")->setValue($tourist->name);
			if ($tourist->birthday) {
				$sheet->getCell("B{$keyCell}")->setValue($tourist->birthday->format("d.m.Y"));
			}
			$sheet->getCell("C{$keyCell}")->setValue($tourist->passport);
			$sheet->getCell("D{$keyCell}")->setValue($tourist->nationality);
			$keyCell ++;
		}


		$writer = new Xlsx($spreadsheet);
		$path = public_path(time() . 'xlsx');
		$writer->save($path);
		return $path;
	}
}