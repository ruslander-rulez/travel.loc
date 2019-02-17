<?php
namespace App\Domain\Ship;

use App\Domain\Core\Pagination;
use App\Domain\Core\RepositoryInterface;
use App\Domain\Core\Sort;
use Illuminate\Database\Eloquent\Model;

interface ShipRepository extends RepositoryInterface
{
    /**
     * @param ShipFilter $adviceFilter
     * @param Pagination|null $pagination
     * @param Sort|null $sort
     * @return Ship[]
     */
    public function all(ShipFilter $adviceFilter, ?Pagination $pagination = null, ?Sort $sort = null);
}