<?php
namespace App\Domain\Restaurant;

use App\Domain\Core\Pagination;
use App\Domain\Core\RepositoryInterface;
use App\Domain\Core\Sort;
use Illuminate\Database\Eloquent\Model;

interface RestaurantRepository extends RepositoryInterface
{
    /**
     * @param RestaurantFilter $adviceFilter
     * @param Pagination|null $pagination
     * @param Sort|null $sort
     * @return Restaurant[]
     */
    public function all(RestaurantFilter $adviceFilter, ?Pagination $pagination = null, ?Sort $sort = null);
}