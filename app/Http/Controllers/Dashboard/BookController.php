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
			"is_canceled" => "bool",
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
		$book->is_canceled = $request->get("is_canceled");
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
			"is_canceled" => "bool",
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
		$book->is_canceled = $request->get("is_canceled");
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
            "id" => "required|exists:". Book::ENTITY_TABLE . ",id"
        ]);

        Book::query()->where("id", $request->get("id"))->delete();

        return new Response([], Response::HTTP_ACCEPTED);
    }

	public function changeProgramColor(Request $request)
	{
		/** @var Book $book */
		$book = Book::query()->findOrFail($request->get("bookId"));
		$program = $book->program;
		array_set($program, "{$request->programIndex}.color", $request->get("color"));
		$book->program = $program;
		$book->save();
	}
}