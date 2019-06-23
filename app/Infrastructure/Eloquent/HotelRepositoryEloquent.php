<?php
namespace App\Infrastructure\Eloquent;

use App\Domain\Hotel\Hotel;
use App\Domain\Hotel\HotelFilter;
use App\Domain\Hotel\HotelRepository;
use App\Domain\Core\Pagination;
use App\Domain\Core\Sort;

class HotelRepositoryEloquent implements HotelRepository
{
    use Helper;

    /**
     * @var Hotel
     */
    private $model;

    public function __construct(Hotel $model)
    {
        $this->model = $model;
    }

    /**
     * @param HotelFilter $adviceFilter
     * @param Pagination|null $pagination
     * @param Sort|null $sort
     * @return Hotel[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all(HotelFilter $adviceFilter, ?Pagination $pagination = null, ?Sort $sort = null)
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