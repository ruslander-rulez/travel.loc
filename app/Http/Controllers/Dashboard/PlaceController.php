<?php

namespace App\Http\Controllers\Dashboard;


use App\Application\Place\CreatePlace;
use App\Application\Place\DeletePlace;
use App\Application\Place\GetPlaceList;
use App\Application\Place\UpdatePlace;
use App\Domain\Core\Sort;
use App\Domain\Place\Place;
use App\Domain\Place\PlaceFilter;
use App\Domain\Attachment\Attachment;
use App\Domain\Core\Pagination;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class PlaceController extends Controller
{
    public function index()
    {
        return view("dashboard.place.index");
    }
    public function list(Request $request)
    {
        $this->validate($request, [
            "perPage" => "numeric|min:1",
            "page" => "numeric|min:1"
        ]);

        $filter = new PlaceFilter();

        $sort = new Sort();
        $sort->setField("name");
        $sort->setDirection("ASC");
		$pagination = null;
		if ($request->get("perPage")) {
			$pagination = new Pagination($request->get("page"), $request->get("perPage"));
		}

        $items = $this->dispatch(new GetPlaceList($filter, $pagination, $sort));
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
            "id" => "required|numeric|exists:" . Place::ENTITY_TABLE . ",id",
            "name" => "required|string|max:191|unique:" . Place::ENTITY_TABLE . ",name,".$request->get("id"),
        ]);
        $this->dispatch(new UpdatePlace(
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
			"name" => "required|string|max:191|unique:" . Place::ENTITY_TABLE . ",name",
        ]);

         $this->dispatch(new CreatePlace(
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
            "id" => "required|exists:". Place::ENTITY_TABLE . ",id"
        ]);
        $this->dispatch(new DeletePlace($request->get("id")));
        return new Response([], Response::HTTP_ACCEPTED);
    }

}