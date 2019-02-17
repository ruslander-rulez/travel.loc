<?php

namespace App\Application\Client;

use App\Domain\Client\ClientRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class GetClientListHandler implements Handler
{
	/**
	 * @var ClientRepository
	 */
	private $ClientRepository;

	/**
	 * GetAdviceListHandler constructor.
	 * @param ClientRepository $clientRepository
	 */
    public function __construct(ClientRepository $clientRepository)
    {
		$this->ClientRepository = $clientRepository;
	}

    /**
     * Handle a Command object
     *
     * @param Command|GetClientList $command
     * @return mixed
     */
    public function handle(Command $command)
    {
        return $this->ClientRepository->all($command->filter(), $command->pagination(), $command->sort());
    }
}