<?php

namespace App\Application\Restaurant;

use App\Domain\Restaurant\RestaurantRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class GetRestaurantListHandler implements Handler
{
	/**
	 * @var RestaurantRepository
	 */
	private $RestaurantRepository;

	/**
	 * GetAdviceListHandler constructor.
	 * @param RestaurantRepository $RestaurantRepository
	 */
    public function __construct(RestaurantRepository $RestaurantRepository)
    {
		$this->RestaurantRepository = $RestaurantRepository;
	}

    /**
     * Handle a Command object
     *
     * @param Command|GetRestaurantList $command
     * @return mixed
     */
    public function handle(Command $command)
    {
        return $this->RestaurantRepository->all($command->filter(), $command->pagination(), $command->sort());
    }
}