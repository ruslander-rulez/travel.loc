<?php
namespace App\Domain\Menu;

use App\Domain\Core\Pagination;
use App\Domain\Core\RepositoryInterface;
use App\Domain\Core\Sort;
use Illuminate\Database\Eloquent\Model;

interface MenuRepository extends RepositoryInterface
{
    /**
     * @param MenuFilter $adviceFilter
     * @param Pagination|null $pagination
     * @param Sort|null $sort
     * @return Menu[]
     */
    public function all(MenuFilter $adviceFilter, ?Pagination $pagination = null, ?Sort $sort = null);
}