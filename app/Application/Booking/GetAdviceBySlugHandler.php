<?php
namespace App\Application\Booking;

use App\Domain\Booking\BookingRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class GetAdviceBySlugHandler implements Handler
{
    /**
     * @var BookingRepository
     */
    private $adviceRepository;

    /**
     * GetAdviceBySlugHandler constructor.
     * @param BookingRepository $adviceRepository
     */
    public function __construct(BookingRepository $adviceRepository)
    {
        $this->adviceRepository = $adviceRepository;
    }

    /**
     * Handle a Command object
     *
     * @param Command|GetAdviceBySlug $command
     * @return mixed
     */
    public function handle(Command $command)
    {
        return $this->adviceRepository->bySlug($command->slug());
    }
}