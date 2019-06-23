<?php

namespace App\Application\Restaurant;

use App\Domain\Restaurant\RestaurantFilter;
use App\Domain\Core\Pagination;
use App\Domain\Core\Sort;
use ItDevgroup\CommandBus\Command;

class GetRestaurantList implements Command
{
    /**
     * @var Pagination
     */
    private $pagination;
    /**
     * @var RestaurantFilter
     */
    private $filter;
    /**
     * @var Sort
     */
    private $sort;

    /**
     * GetAdviceList constructor.
     * @param RestaurantFilter $filter
     * @param Pagination $pagination
     * @param Sort $sort
     */
    public function __construct(RestaurantFilter $filter, ?Pagination $pagination, ?Sort $sort)
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
     * @return RestaurantFilter
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