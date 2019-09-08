<?php

namespace App\Application\Place;

use App\Domain\Place\PlaceFilter;
use App\Domain\Core\Pagination;
use App\Domain\Core\Sort;
use ItDevgroup\CommandBus\Command;

class GetPlaceList implements Command
{
    /**
     * @var Pagination
     */
    private $pagination;
    /**
     * @var PlaceFilter
     */
    private $filter;
    /**
     * @var Sort
     */
    private $sort;

    /**
     * GetAdviceList constructor.
     * @param PlaceFilter $filter
     * @param Pagination $pagination
     * @param Sort $sort
     */
    public function __construct(PlaceFilter $filter, ?Pagination $pagination, ?Sort $sort)
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
     * @return PlaceFilter
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