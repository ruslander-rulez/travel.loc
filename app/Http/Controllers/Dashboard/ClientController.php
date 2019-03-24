<?php

namespace App\Http\Controllers\Dashboard;


use App\Application\Client\CreateClient;
use App\Application\Client\DeleteClient;
use App\Application\Client\GetClientList;
use App\Application\Client\UpdateClient;
use App\Domain\Client\Client;
use App\Domain\Client\ClientFilter;
use App\Domain\Core\Sort;
use App\Domain\Core\Pagination;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    public function index()
    {
        return view("dashboard.client.index");
    }
    public function list(Request $request)
    {
        $this->validate($request, [
            "perPage" => "numeric|min:1",
            "page" => "numeric|min:1"
        ]);

        $filter = new ClientFilter();

        $sort = new Sort();
        $sort->setField("name");
        $sort->setDirection("ASC");

        $pagination = new Pagination($request->get("page"), $request->get("perPage"));
		$items = $this->dispatch(new GetClientList($filter, $pagination, $sort));

		return new Response($items["items"], Response::HTTP_OK, ["maxCountItems" => $items["total"]]);
    }

    public function search(Request $request)
    {
        $this->validate($request, [
            "search" => "required|string|min:1|max:100",
        ]);

        $filter = new ClientFilter();
		$filter->setSearch($request->get("search"));
        $pagination = new Pagination(1, 5);
		$items = $this->dispatch(new GetClientList($filter, $pagination, null));

		return new Response($items["items"], Response::HTTP_OK);
    }

	/**
	 * @param Request $request
	 * @return Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
    public function save(Request $request)
    {
        $this->validate( $request,  [
            "id" => "required|numeric|exists:" . Client::ENTITY_TABLE . ",id",
			"name" => "required|string|max:191",
			"email" => "nullable|string|email|max:191",
            "phone" => "nullable|string|max:191",
			"passport" => "required|string|max:191|unique:" . Client::ENTITY_TABLE . ",passport," . $request->get("id"),
            "nationality" => "required|string|max:191",
            "birthday" => "string|date_format:Y-m-d",
        ]);
        $this->dispatch(new UpdateClient(
            $request->get("id"),
            $request->get("name"),
            $request->get("email"),
            $request->get("phone"),
            $request->get("passport"),
            $request->get("nationality"),
            $request->get("birthday")
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
			"name" => "required|string|max:191",
			"email" => "nullable|string|email|max:191",
			"phone" => "nullable|string|max:191",
			"passport" => "required|string|max:191|unique:" . Client::ENTITY_TABLE . ",passport",
			"nationality" => "required|string|max:191",
			"birthday" => "string|date_format:Y-m-d",
		]);


         $client = $this->dispatch(new CreateClient(
			 $request->get("name"),
			 $request->get("email"),
			 $request->get("phone"),
			 $request->get("passport"),
			 $request->get("nationality"),
			 $request->get("birthday")
        ));
         return Response::create($client, Response::HTTP_CREATED);
    }

	/**
	 * @param Request $request
	 * @return Response
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function delete(Request $request)
    {
        $this->validate($request, [
            "id" => "required|exists:". Client::ENTITY_TABLE . ",id"
        ]);
        $this->dispatch(new DeleteClient($request->get("id")));
        return new Response([], Response::HTTP_ACCEPTED);
    }

}