<?php
namespace App\Application\Restaurant;

use App\Domain\Restaurant\RestaurantRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class DeleteRestaurantHandler implements Handler
{
    /**
     * @var RestaurantRepository
     */
    private $RestaurantRepository;

    /**
     * DeleteAdviceHandler constructor.
     * @param RestaurantRepository $RestaurantRepository
     */
    public function __construct(RestaurantRepository $RestaurantRepository)
    {
        $this->RestaurantRepository = $RestaurantRepository;
    }

    /**
     * Handle a Command object
     *
     * @param Command|DeleteRestaurant $command
     * @return mixed
     */
    public function handle(Command $command)
    {
        $advice = $this->RestaurantRepository->byId($command->id());
        $this->RestaurantRepository->delete($advice);
    }
}