<?php
namespace App\Infrastructure\Eloquent;

use App\Domain\Menu\Menu;
use App\Domain\Menu\MenuFilter;
use App\Domain\Menu\MenuRepository;
use App\Domain\Core\Pagination;
use App\Domain\Core\Sort;

class MenuRepositoryEloquent implements MenuRepository
{
    use Helper;

    /**
     * @var Menu
     */
    private $model;

    public function __construct(Menu $model)
    {
        $this->model = $model;
    }

    /**
     * @param MenuFilter $menuFilter
     * @param Pagination|null $pagination
     * @param Sort|null $sort
     * @return Menu[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all(MenuFilter $menuFilter, ?Pagination $pagination = null, ?Sort $sort = null)
    {
        $qb =  $this->model->newQuery();
		$qb->where(function ($query) use ($menuFilter) {
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