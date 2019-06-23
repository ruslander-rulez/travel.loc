<?php

namespace App\Http\Controllers\Dashboard;


use App\Application\Hotel\CreateHotel;
use App\Application\Hotel\DeleteHotel;
use App\Application\Hotel\GetHotelList;
use App\Application\Hotel\UpdateHotel;
use App\Domain\Core\Sort;
use App\Domain\Hotel\Hotel;
use App\Domain\Hotel\HotelFilter;
use App\Domain\Core\Pagination;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HotelController extends Controller
{
    public function index()
    {
        return view("dashboard.hotel.index");
    }
    public function list(Request $request)
    {
        $this->validate($request, [
            "perPage" => "numeric|min:1",
            "page" => "numeric|min:1"
        ]);

        $filter = new HotelFilter();

        $sort = new Sort();
        $sort->setField("name");
        $sort->setDirection("ASC");
		$pagination = null;
		if ($request->get("perPage")) {
			$pagination = new Pagination($request->get("page"), $request->get("perPage"));
		}

        $items = $this->dispatch(new GetHotelList($filter, $pagination, $sort));
		$data = $request->get("perPage") ?
			new Response($items["items"], Response::HTTP_OK, ["maxCountItems" => $items["total"]]) :
        	new Response($items, Response::HTTP_OK);
		return $data;
    }

	/**
	 * @param Request $request
	 * @return Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function save(Request $request)
    {
        $this->validate( $request,  [
            "id" => "required|numeric|exists:" . Hotel::ENTITY_TABLE . ",id",
            "name" => "required|string|max:191|unique:" . Hotel::ENTITY_TABLE . ",name,".$request->get("id"),
        ]);
        $this->dispatch(new UpdateHotel(
            $request->get("id"),
            $request->get("name")
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
			"name" => "required|string|max:191|unique:" . Hotel::ENTITY_TABLE . ",name",
        ]);

         $this->dispatch(new CreateHotel(
            $request->get("name")
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
            "id" => "required|exists:". Hotel::ENTITY_TABLE . ",id"
        ]);
        $this->dispatch(new DeleteHotel($request->get("id")));
        return new Response([], Response::HTTP_ACCEPTED);
    }

}