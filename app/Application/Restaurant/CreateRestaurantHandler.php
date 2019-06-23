<?php

namespace App\Application\Restaurant;

use App\Domain\Restaurant\Restaurant;
use App\Domain\Restaurant\RestaurantRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class CreateRestaurantHandler implements Handler
{
	/**
	 * @var RestaurantRepository
	 */
	private $RestaurantRepository;

	/**
	 * CreateRestaurantHandler constructor.
	 * @param RestaurantRepository $RestaurantRepository
	 */
	public function __construct(RestaurantRepository $RestaurantRepository)
    {
		$this->RestaurantRepository = $RestaurantRepository;
	}

    /**
     * Handle a Command object
     *
     * @param Command|CreateRestaurant $command
     * @return mixed
     */
    public function handle(Command $command)
    {
        $restaurant = new Restaurant();

        $restaurant->name = $command->name();

        $this->RestaurantRepository->store($restaurant);
        return $restaurant;
    }
}