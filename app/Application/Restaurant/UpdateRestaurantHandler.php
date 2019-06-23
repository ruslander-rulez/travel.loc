<?php

namespace App\Application\Restaurant;

use App\Domain\Restaurant\Restaurant;
use App\Domain\Restaurant\RestaurantRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class UpdateRestaurantHandler implements Handler
{

	/**
	 * @var RestaurantRepository
	 */
	private $restaurantRepository;

	/**
	 * UpdateAdviceHandler constructor.
	 * @param RestaurantRepository $restaurantRepository
	 */
    public function __construct(RestaurantRepository $restaurantRepository)
    {
		$this->restaurantRepository = $restaurantRepository;
	}

    /**
     * Handle a Command object
     *
     * @param Command|UpdateRestaurant $command
     */
    public function handle(Command $command)
    {
		/** @var Restaurant $restaurant */
		$restaurant = $this->restaurantRepository->byId($command->id());
        $restaurant->name = $command->name();
        $this->restaurantRepository->store($restaurant);
        return $restaurant;
    }
}