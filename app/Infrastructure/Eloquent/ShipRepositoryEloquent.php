<?php
namespace App\Infrastructure\Eloquent;

use App\Domain\Ship\Ship;
use App\Domain\Ship\ShipFilter;
use App\Domain\Ship\ShipRepository;
use App\Domain\Core\Pagination;
use App\Domain\Core\Sort;
use Illuminate\Database\Query\Builder;

class ShipRepositoryEloquent implements ShipRepository
{
    use Helper;

    /**
     * @var Ship
     */
    private $model;

    public function __construct(Ship $model)
    {
        $this->model = $model;
    }

    /**
     * @param ShipFilter $adviceFilter
     * @param Pagination|null $pagination
     * @param Sort|null $sort
     * @return Ship[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all(ShipFilter $adviceFilter, ?Pagination $pagination = null, ?Sort $sort = null)
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