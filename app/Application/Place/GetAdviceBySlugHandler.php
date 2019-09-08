<?php
namespace App\Application\Place;

use App\Domain\Place\PlaceRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class GetAdviceBySlugHandler implements Handler
{
    /**
     * @var PlaceRepository
     */
    private $adviceRepository;

    /**
     * GetAdviceBySlugHandler constructor.
     * @param PlaceRepository $adviceRepository
     */
    public function __construct(PlaceRepository $adviceRepository)
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