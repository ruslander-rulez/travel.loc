<?php

namespace App\Http\Controllers\Dashboard;


use App\Application\Booking\CreateBooking;
use App\Application\Booking\DeleteBooking;
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
            "page" => "numeric|min:1"
        ]);
        $filter = new BookingFilter();

        $sort = new Sort();
        $sort->setField("name");
        $sort->setDirection("ASC");

        $pagination = new Pagination($request->get("page"), $request->get("perPage"));

        $items = $this->dispatch(new GetBookingList($filter, $pagination, $sort));

        return new Response($items["items"], Response::HTTP_OK, ["maxCountItems" => $items["total"]]);
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
            "additional_info" => "nullable|string|max:191",
            "arrival_date" => "required|string|date_format:\"Y-m-d\"",
            "departure_date" => "required|string|date_format:\"Y-m-d\"",
            "evening_program" => "required|boolean",
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
            $request->get("evening_program"),
			$request->get("tourists", []),
			$request->get("leader_id")

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
			"evening_program" => "required|boolean",
			"tourists" => "array",
			"tourists.*.id" => "required|exists:" . Client::ENTITY_TABLE . ",id",
			"leader_id" => "required|exists:" . Client::ENTITY_TABLE . ",id"
        ]);

         $this->dispatch(new CreateBooking(
			 $request->get("ship_id"),
			 $request->get("group_name"),
			 $request->get("additional_info"),
			 $request->get("arrival_date"),
			 $request->get("departure_date"),
			 $request->get("evening_program"),
			 $request->get("tourists", []),
			 $request->get("leader_id")
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

}