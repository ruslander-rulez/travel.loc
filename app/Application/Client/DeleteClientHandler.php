<?php
namespace App\Application\Client;

use App\Domain\Client\ClientRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class DeleteClientHandler implements Handler
{
    /**
     * @var ClientRepository
     */
    private $ClientRepository;

    /**
     * DeleteAdviceHandler constructor.
     * @param ClientRepository $ClientRepository
     */
    public function __construct(ClientRepository $ClientRepository)
    {
        $this->ClientRepository = $ClientRepository;
    }

    /**
     * Handle a Command object
     *
     * @param Command|DeleteClient $command
     * @return mixed
     */
    public function handle(Command $command)
    {
        $advice = $this->ClientRepository->byId($command->id());
        $this->ClientRepository->delete($advice);
    }
}