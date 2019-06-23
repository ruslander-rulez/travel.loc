<?php

namespace App\Http\Controllers\Dashboard;


use App\Application\Restaurant\CreateRestaurant;
use App\Application\Restaurant\DeleteRestaurant;
use App\Application\Restaurant\GetRestaurantList;
use App\Application\Restaurant\UpdateRestaurant;
use App\Domain\Core\Sort;
use App\Domain\Menu\Menu;
use App\Domain\Restaurant\Restaurant;
use App\Domain\Restaurant\RestaurantFilter;
use App\Domain\Core\Pagination;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RestaurantController extends Controller
{
    public function index()
    {
        return view("dashboard.restaurant.index");
    }
    public function list(Request $request)
    {
        $this->validate($request, [
            "perPage" => "numeric|min:1",
            "page" => "numeric|min:1"
        ]);

        $filter = new RestaurantFilter();

        $sort = new Sort();
        $sort->setField("name");
        $sort->setDirection("ASC");
		$pagination = null;
		if ($request->get("perPage")) {
			$pagination = new Pagination($request->get("page"), $request->get("perPage"));
		}

        $items = $this->dispatch(new GetRestaurantList($filter, $pagination, $sort));
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
            "id" => "required|numeric|exists:" . Restaurant::ENTITY_TABLE . ",id",
            "name" => "required|string|max:191|unique:" . Restaurant::ENTITY_TABLE . ",name,".$request->get("id"),
			"menus" => "nullable|array",
			"menus.*.name" => "required|string",
			"menus.*.id" => "nullable|numeric",
			"menus.*.dishes" => "array",
			"menus.*.dishes.*.name" => "string",
        ]);
        $restaurant = $this->dispatch(new UpdateRestaurant(
            $request->get("id"),
            $request->get("name")
        ));
		$this->syncMenu($restaurant, $request);
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
			"name" => "required|string|max:191|unique:" . Restaurant::ENTITY_TABLE . ",name",
			"menus" => "nullable|array",
			"menus.*.name" => "required|string",
			"menus.*.id" => "nullable|numeric",
			"menus.*.dishes" => "array",
			"menus.*.dishes.*.name" => "string",
        ]);

         $restaurant = $this->dispatch(new CreateRestaurant(
            $request->get("name")
        ));
         $this->syncMenu($restaurant, $request);
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
            "id" => "required|exists:". Restaurant::ENTITY_TABLE . ",id"
        ]);
        $this->dispatch(new DeleteRestaurant($request->get("id")));
        return new Response([], Response::HTTP_ACCEPTED);
    }

    private function syncMenu(Restaurant $restaurant, Request $request)
	{
		$menus = [];
		foreach ($request->get("menus", []) as $menu) {
			if (array_get($menu, "id")) {
				$menuObj = Menu::query()->find(array_get($menu, "id"));
			} else {
				$menuObj = new Menu();
			}
			$menuObj->name = array_get($menu, "name");
			$menuObj->dishes = array_get($menu, "dishes");
			$menuObj->restaurant_id = $restaurant->id;
			$menuObj->save();
			$menus[] = $menuObj->id;
		}
		$restaurant->menus()->whereNotIn("id", $menus)->delete();
	}

}