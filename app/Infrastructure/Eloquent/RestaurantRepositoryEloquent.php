<?php
namespace App\Infrastructure\Eloquent;

use App\Domain\Restaurant\Restaurant;
use App\Domain\Restaurant\RestaurantFilter;
use App\Domain\Restaurant\RestaurantRepository;
use App\Domain\Core\Pagination;
use App\Domain\Core\Sort;

class RestaurantRepositoryEloquent implements RestaurantRepository
{
    use Helper;

    /**
     * @var Restaurant
     */
    private $model;

    public function __construct(Restaurant $model)
    {
        $this->model = $model;
    }

    /**
     * @param RestaurantFilter $adviceFilter
     * @param Pagination|null $pagination
     * @param Sort|null $sort
     * @return Restaurant[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all(RestaurantFilter $adviceFilter, ?Pagination $pagination = null, ?Sort $sort = null)
    {
        $qb =  $this->model->newQuery();
		$qb->where(function ($query) use ($adviceFilter) {
            //filter
        });
		if ($sort) {
			$qb->orderBy($sort->field(), $sort->direction());
		}
            $qb->with("menus");
        if ($pagination) {
            $maxItems =  $qb->count();
            $advices = $qb
                ->forPage($pagination->page(), $pagination->peerPage())
                ->get();

            return [
                "items" => $advices,
                "total" => $maxItems
            ];
        }
        $result = $qb->get();

        return $result;
    }
}