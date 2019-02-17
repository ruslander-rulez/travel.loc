<?php
namespace App\Application\Ship;

use App\Domain\Ship\ShipRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class GetAdviceBySlugHandler implements Handler
{
    /**
     * @var ShipRepository
     */
    private $adviceRepository;

    /**
     * GetAdviceBySlugHandler constructor.
     * @param ShipRepository $adviceRepository
     */
    public function __construct(ShipRepository $adviceRepository)
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