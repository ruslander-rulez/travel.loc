<?php
namespace App\Domain\Place;

use App\Domain\Core\Pagination;
use App\Domain\Core\RepositoryInterface;
use App\Domain\Core\Sort;
use Illuminate\Database\Eloquent\Model;

interface PlaceRepository extends RepositoryInterface
{
    /**
     * @param PlaceFilter $adviceFilter
     * @param Pagination|null $pagination
     * @param Sort|null $sort
     * @return Place[]
     */
    public function all(PlaceFilter $adviceFilter, ?Pagination $pagination = null, ?Sort $sort = null);
}