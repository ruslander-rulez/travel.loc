<?php

namespace App\Http\Controllers\Dashboard;


use App\Application\Booking\CreateBooking;
use App\Application\Booking\DeleteBooking;
use App\Application\Booking\GenerateBorderDocuments;
use App\Application\Booking\GenerateTourtickets;
use App\Application\Booking\GetBookingList;
use App\Application\Booking\UpdateBooking;
use App\Application\Booking\UpdateBookingColor;
use App\Domain\Client\Client;
use App\Domain\Core\Sort;
use App\Domain\Booking\Booking;
use App\Domain\Booking\BookingFilter;
use App\Domain\Core\Pagination;
use App\Domain\Ship\Ship;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        return view("dashboard.booking.index");
    }

	/**
	 * @param Request $request
	 * @return Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function list(Request $request)
    {
        $this->validate($request, [
            "perPage" => "numeric|min:1",
            "page" => "numeric|min:1",

			"dateFrom" => "string",
			"dateTo" => "string",

			"sortField" => "string",
			"sortDirection" => "string|in:ASC,DESC"
        ]);
        $filter = new BookingFilter();


		if ($request->get("dateFrom")) {
			$filter->setDepartureDateFrom(Carbon::parse($request->get("dateFrom")));
		}
		if ($request->get("dateTo")) {
			$filter->setDepartureDateTo(Carbon::parse($request->get("dateTo")));
		}


		$sort = new Sort();
        $sort->setField($request->get("sortField", "id"));
        $sort->setDirection($request->get("sortDirection", "DESC"));

        $pagination = new Pagination($request->get("page"), $request->get("perPage"));

        $items = $this->dispatch(new GetBookingList($filter, $pagination, $sort));

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
		$filter->setArrivalDateTo(Carbon::now()->addDays(4));

		$sort = new Sort();
        $sort->setField("arrival_date");
        $sort->setDirection($request->get("sortDirection", "DESC"));

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
            "ship_id" => "required|integer|exists:" . Ship::ENTITY_TABLE . ",id",
            "group_name" => "required|string|max:191",
            "tourticket_settings" => "nullable|array",
            "checklist" => "nullable|array",
            "additional_info" => "nullable|string|max:191",
            "arrival_date" => "required|string|date_format:\"Y-m-d\"",
            "departure_date" => "required|string|date_format:\"Y-m-d\"",
			"tourists" => "array",
			"tourists.*.id" => "required|exists:" . Client::ENTITY_TABLE . ",id",
			"leader_id" => "required|exists:" . Client::ENTITY_TABLE . ",id"
        ]);
        $this->dispatch(new UpdateBooking(
            $request->get("id"),
            $request->get("ship_id"),
            $request->get("group_name"),
            $request->get("additional_info"),
            $request->get("arrival_date"),
            $request->get("departure_date"),
			$request->get("tourists", []),
			$request->get("leader_id"),
			$request->get("tourticket_settings"),
			$request->get("checklist")
        ));
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
			"ship_id" => "required|integer|exists:" . Ship::ENTITY_TABLE . ",id",
			"group_name" => "required|string|max:191",
			"additional_info" => "nullable|string|max:191",
			"arrival_date" => "required|string|date_format:\"Y-m-d\"",
			"departure_date" => "required|string|date_format:\"Y-m-d\"",
			"tourticket_settings" => "nullable|array",
			"tourists" => "array",
			"tourists.*.id" => "required|exists:" . Client::ENTITY_TABLE . ",id",
			"leader_id" => "required|exists:" . Client::ENTITY_TABLE . ",id",
        ]);

         $this->dispatch(new CreateBooking(
			 $request->get("ship_id"),
			 $request->get("group_name"),
			 $request->get("additional_info"),
			 $request->get("arrival_date"),
			 $request->get("departure_date"),
			 $request->get("tourists", []),
			 $request->get("leader_id"),
			 $request->get("tourticket_settings")
        ));
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