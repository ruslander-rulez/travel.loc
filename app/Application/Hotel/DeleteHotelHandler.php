<?php
namespace App\Application\Hotel;

use App\Domain\Hotel\HotelRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class DeleteHotelHandler implements Handler
{
    /**
     * @var HotelRepository
     */
    private $HotelRepository;

    /**
     * DeleteAdviceHandler constructor.
     * @param HotelRepository $HotelRepository
     */
    public function __construct(HotelRepository $HotelRepository)
    {
        $this->HotelRepository = $HotelRepository;
    }

    /**
     * Handle a Command object
     *
     * @param Command|DeleteHotel $command
     * @return mixed
     */
    public function handle(Command $command)
    {
        $advice = $this->HotelRepository->byId($command->id());
        $this->HotelRepository->delete($advice);
    }
}