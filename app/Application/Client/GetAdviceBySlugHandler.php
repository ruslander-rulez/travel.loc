<?php
namespace App\Application\Client;

use App\Domain\Client\ClientRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class GetAdviceBySlugHandler implements Handler
{
    /**
     * @var ClientRepository
     */
    private $adviceRepository;

    /**
     * GetAdviceBySlugHandler constructor.
     * @param ClientRepository $adviceRepository
     */
    public function __construct(ClientRepository $adviceRepository)
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