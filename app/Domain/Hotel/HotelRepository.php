<?php
namespace App\Domain\Hotel;

use App\Domain\Core\Pagination;
use App\Domain\Core\RepositoryInterface;
use App\Domain\Core\Sort;
use Illuminate\Database\Eloquent\Model;

interface HotelRepository extends RepositoryInterface
{
    /**
     * @param HotelFilter $adviceFilter
     * @param Pagination|null $pagination
     * @param Sort|null $sort
     * @return Hotel[]
     */
    public function all(HotelFilter $adviceFilter, ?Pagination $pagination = null, ?Sort $sort = null);
}