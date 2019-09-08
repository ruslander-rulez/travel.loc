<?php

namespace App\Http\Controllers\Dashboard;


use App\Application\Booking\CreateBooking;
use App\Application\Booking\DeleteBooking;
use App\Application\Booking\GenerateBorderDocuments;
use App\Application\Booking\GenerateTourtickets;
use App\Application\Booking\GetBookingList;
use App\Application\Booking\UpdateBooking;
use App\Application\Booking\UpdateBookingColor;
use App\Domain\Book\Book;
use App\Domain\Book\BookFilter;
use App\Domain\Book\BookRepository;
use App\Domain\Client\Client;
use App\Domain\Core\Sort;
use App\Domain\Booking\Booking;
use App\Domain\Booking\BookingFilter;
use App\Domain\Core\Pagination;
use App\Domain\Hotel\Hotel;
use App\Domain\Ship\Ship;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class BookController extends Controller
{
    public function index()
    {
        return view("dashboard.book.index");
    }

	/**
	 * @param Request $request
	 * @param BookRepository $bookRepository
	 * @return Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function list(Request $request, BookRepository $bookRepository)
    {
        $this->validate($request, [
            "perPage" => "numeric|min:1",
            "page" => "numeric|min:1",

			"dateFrom" => "string",
			"dateTo" => "string",

			"sortField" => "string",
			"sortDirection" => "string|in:ASC,DESC"
        ]);
        $filter = new BookFilter();

/*
		if ($request->get("dateFrom")) {
			$filter->setDepartureDateFrom(Carbon::parse($request->get("dateFrom")));
		}
		if ($request->get("dateTo")) {
			$filter->setDepartureDateTo(Carbon::parse($request->get("dateTo")));
		}*/


		$sort = new Sort();
        $sort->setField($request->get("sortField", "id"));
        $sort->setDirection($request->get("sortDirection", "DESC"));

        $pagination = new Pagination($request->get("page"), $request->get("perPage"));

        $items = $bookRepository->all($filter, $pagination, $sort);

		/** @var Book $val */
//		$val = $items["items"][0];
//		$ship = Ship::query()->first();
//        $val->type()->associate($ship)->save();

        return new Response($items["items"], Response::HTTP_OK, ["maxCountItems" => $items["total"]]);
    }

	/**
	 * @param Request $request
	 * @return Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function nearestBookingList(Request $request)
    {
        $this->validate($request, [

        ]);
        $filter = new BookingFilter();


		$filter->setArrivalDateFrom(Carbon::now());
		$filter->setArrivalDateTo(Carbon::now()->setTimezone(new \DateTimeZone("+3"))->addDays(4)->endOfDay());

		$sort = new Sort();
        $sort->setField("arrival_date");
        $sort->setDirection($request->get("arrival_date", "ASC"));

        $items = $this->dispatch(new GetBookingList($filter, null, $sort));

        return new Response($items, Response::HTTP_OK);
    }

	/**
	 * @param Request $request
	 * @return Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function save(Request $request)
    {
        $this->validate( $request,  [
            "id" => "required|numeric|exists:" . Booking::ENTITY_TABLE . ",id",
            "type_type" => "required|string",
            "type_id" => "required|integer",
            "group_name" => "required|string|max:191",
            "leader_name" => "required|string|max:191",
            "total_tourists" => "required|array",
            "driver" => "nullable|string|max:191",
            "guide" => "nullable|string|max:191",
            "notes" => "nullable|string",
            "program" => "array",
            "date_of_start" => "required|string|date_format:\"Y-m-d\"",
            "date_of_end" => "required|string|date_format:\"Y-m-d\"",
        ]);

		/** @var Book $book */
		$book = Book::query()->findOrFail($request->get("id"));

		$book->date_of_end = $request->get("date_of_end");
		$book->date_of_start = $request->get("date_of_start");
		$book->driver = $request->get("driver");
		$book->group_name = $request->get("group_name");
		$book->guide = $request->get("guide");
		$book->leader_name = $request->get("leader_name");
		$book->notes = $request->get("notes");
		$book->program = $request->get("program");
		$book->total_tourists = $request->get("total_tourists");
		$book->type_type = $request->get("type_type");
		$book->type_id = $request->get("type_id");
		$book->save();

        return new Response([], Response::HTTP_ACCEPTED);
    }
	/**
	 * @param Request $request
	 * @return Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function setColor(Request $request)
    {
        $this->validate( $request,  [
            "id" => "required|numeric|exists:" . Booking::ENTITY_TABLE . ",id",
            "color" => "required|string|max:7|min:7|regex:/^#/",
        ]);
        $this->dispatch(new UpdateBookingColor(
            $request->get("id"),
            $request->get("color")
        ));
        return new Response([], Response::HTTP_ACCEPTED);
    }

	/**
	 * @param Request $request
	 * @return Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function create(Request $request)
    {
		$this->validate( $request,  [
			"type_type" => "required|string",
			"type_id" => "required|integer",
			"group_name" => "required|string|max:191",
			"leader_name" => "required|string|max:191",
			"total_tourists" => "required|array",
			"driver" => "nullable|string|max:191",
			"guide" => "nullable|string|max:191",
			"notes" => "nullable|string",
			"program" => "array",
			"date_of_start" => "required|string|date_format:\"Y-m-d\"",
			"date_of_end" => "required|string|date_format:\"Y-m-d\"",
		]);

		/** @var Book $book */
		$book = new Book();

		$book->date_of_end = $request->get("date_of_end");
		$book->date_of_start = $request->get("date_of_start");
		$book->driver = $request->get("driver");
		$book->group_name = $request->get("group_name");
		$book->guide = $request->get("guide");
		$book->leader_name = $request->get("leader_name");
		$book->notes = $request->get("notes");
		$book->program = $request->get("program");
		$book->total_tourists = $request->get("total_tourists");
		$book->type_type = $request->get("type_type");
		$book->type_id = $request->get("type_id");
		$book->save();

		return Response::create("", Response::HTTP_CREATED);
    }

	/**
	 * @param Request $request
	 * @return Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function delete(Request $request)
    {
        $this->validate($request, [
            "id" => "required|exists:". Booking::ENTITY_TABLE . ",id"
        ]);
        $this->dispatch(new DeleteBooking($request->get("id")));
        return new Response([], Response::HTTP_ACCEPTED);
    }

	/**
	 * @param Request $request
	 * @return Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function generateTourTickets(Request $request)
	{
		$this->validate($request, [
			"bookingId" => "required|integer|exists:" . Booking::ENTITY_TABLE . ",id",
			"excludeIds" => "nullable|array",
			"excludeIds.*" => "integer"
		]);

		$document = $this->dispatch(new GenerateTourtickets(
			$request->get("bookingId"),
			$request->get("excludeIds", [])
		));
		return Response::create($document, "200", [
			"Content-Type" => "application/pdf",
			"Content-Disposition" =>  'attachment; filename=ticket.pdf'
		]);

	}

	/**
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function generateBorderDocuments(Request $request)
	{
		$this->validate($request, [
			"bookingId" => "required|integer|exists:" . Booking::ENTITY_TABLE . ",id",
		]);

		$document = $this->dispatch(new GenerateBorderDocuments(
			$request->get("bookingId")
		));
		return \response()->download($document, "Пограничный лист.xlsx")->deleteFileAfterSend();

	}

	public function fromFile(Request $request)
	{
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($request->file()["file"]->getFileInfo()->getRealPath());

		$data = $spreadsheet->getActiveSheet()->toArray();
		$tourists = collect([]);
		$arrivalDate = "";
		$departureDate = "";
		for ($i=2; $i<count($data); $i++) {
			try {
				$arrivalDate = Carbon::createFromFormat("d.m.Y", array_get($data, "{$i}.2"));
			} catch (\Exception $exception) {
			}
			try {
				$departureDate = Carbon::createFromFormat("d.m.Y", array_get($data, "{$i}.3"));
			} catch (\Exception $exception) {
			}
			$lainerName = array_get($data, "{$i}.4");

			$clientPassport = (string) array_get($data, "{$i}.9");
			if (!$clientPassport) {
				continue;
			}
			$client = Client::where("passport", "=", $clientPassport)->first();
			if (!$client) {
				$client = new Client();
				$client->passport = $clientPassport;
				try {
					$client->birthday = Carbon::createFromFormat("d.m.Y", array_get($data, "{$i}.7"));
				} catch (\Exception $exception) {
					$client->birthday = null;
				}
				$client->nationality = array_get($data, "{$i}.8");
				$client->name = array_get($data, "{$i}.5") . " " . array_get($data, "{$i}.6");
				$client->save();
			}
			$tourists->push($client);
		}

		$ship = Ship::where("name", "=", $lainerName)->first();
		$booking = new Booking();
		$booking->id = null;
		$booking->arrival_date = $arrivalDate->format("Y-m-d");
		$booking->departure_date = $departureDate->format("Y-m-d");
		$booking->ship_id = $ship ? $ship->id : null;
		$booking->ship = $ship ?? null;
		$booking->tourists = $tourists;
		return $booking;
	}

}