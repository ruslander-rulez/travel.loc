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
			$request->get("checklist"),
			$request->get("color")
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

	public function statistic()
	{
		$statistic = [];
		Booking::query()
			->where("arrival_date", ">=", Carbon::now()->startOfYear())
			->where("arrival_date", "<=", Carbon::now()->endOfYear())
			->orderBy("arrival_date")
			->with("tourists")
			->chunk(30, function ($bookings) use (&$statistic) {
				$bookings->each(function ($booking) use (&$statistic) {
					$touristsTotal = $booking->tourists()->count();
					$tourticketSettings = $booking->tourticket_settings;
					if (!$tourticketSettings) {
						return;
					}
					foreach ($tourticketSettings as $key => $item) {
						$month = Carbon::createFromFormat("Y-m-d", $key)->format("m");
						array_set($statistic, $month, [
							"passenger_flow" => array_get(
								$statistic,
								"{$month}.passenger_flow", 0)
								+ ($touristsTotal) - count(
									array_intersect(
										array_get($item, "excludeIds", []), array_get($item, "excludeEveningIds", [])
									)
								),
							"passenger_turnover" => array_get(
								$statistic,
								"{$month}.passenger_turnover", 0) + $this->calculatePassengerTurnover($item, $touristsTotal)
						]);
					}
				});
			});
		array_set($statistic, "Всего.passenger_flow", array_sum(array_pluck($statistic, "passenger_flow")));
		array_set($statistic, "Всего.passenger_turnover", array_sum(array_pluck($statistic, "passenger_turnover")));
		return view("dashboard.booking.statistic", compact("statistic"));
	}

	private function calculatePassengerTurnover($tourticketSettings, $touristsTotal)
	{
		$result = 0;

		$result += (($touristsTotal - count(array_get($tourticketSettings, "excludeIds", []))) * 2);
		if (array_get($tourticketSettings, "eveningProgram")) {

			$result += (($touristsTotal - count(array_get($tourticketSettings, "excludeEveningIds", []))) * 2);
		}
		return $result;
	}
}