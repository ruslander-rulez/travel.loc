<?php
namespace App\Infrastructure\Eloquent;

use App\Domain\Place\Place;
use App\Domain\Place\PlaceFilter;
use App\Domain\Place\PlaceRepository;
use App\Domain\Core\Pagination;
use App\Domain\Core\Sort;

class PlaceRepositoryEloquent implements PlaceRepository
{
    use Helper;

    /**
     * @var Place
     */
    private $model;

    public function __construct(Place $model)
    {
        $this->model = $model;
    }

    /**
     * @param PlaceFilter $adviceFilter
     * @param Pagination|null $pagination
     * @param Sort|null $sort
     * @return Place[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all(PlaceFilter $adviceFilter, ?Pagination $pagination = null, ?Sort $sort = null)
    {
        $qb =  $this->model->newQuery();
		$qb->where(function ($query) use ($adviceFilter) {
            //filter
        });
		if ($sort) {
			$qb->orderBy($sort->field(), $sort->direction());
		}
          //  $qb->with("relationName");
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