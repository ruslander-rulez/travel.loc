<?php

namespace App\Application\Hotel;

use App\Domain\Hotel\HotelFilter;
use App\Domain\Core\Pagination;
use App\Domain\Core\Sort;
use ItDevgroup\CommandBus\Command;

class GetHotelList implements Command
{
    /**
     * @var Pagination
     */
    private $pagination;
    /**
     * @var HotelFilter
     */
    private $filter;
    /**
     * @var Sort
     */
    private $sort;

    /**
     * GetAdviceList constructor.
     * @param HotelFilter $filter
     * @param Pagination $pagination
     * @param Sort $sort
     */
    public function __construct(HotelFilter $filter, ?Pagination $pagination, ?Sort $sort)
    {
        $this->pagination = $pagination;
        $this->filter = $filter;
        $this->sort = $sort;
    }

    /**
     * @return Pagination
     */
    public function pagination()
    {
        return $this->pagination;
    }

    /**
     * @return HotelFilter
     */
    public function filter()
    {
        return $this->filter;
    }

    /**
     * @return Sort
     */
    public function sort()
    {
        return $this->sort;
    }
}