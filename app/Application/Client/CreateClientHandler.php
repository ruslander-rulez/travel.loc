<?php

namespace App\Application\Client;

use App\Domain\Client\Client;
use App\Domain\Client\ClientRepository;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class CreateClientHandler implements Handler
{
	/**
	 * @var ClientRepository
	 */
	private $clientRepository;

	/**
	 * CreateClientHandler constructor.
	 * @param ClientRepository $clientRepository
	 */
	public function __construct(ClientRepository $clientRepository)
    {
		$this->clientRepository = $clientRepository;
	}

    /**
     * Handle a Command object
     *
     * @param Command|CreateClient $command
     * @return mixed
     */
    public function handle(Command $command)
    {
        $client = new Client();

		$client->name = $command->name();
		$client->email = $command->email();
		$client->phone = $command->phone();
		$client->passport = $command->passport();
		$client->nationality = $command->nationality();
		$client->birthday = $command->birthday();

        $this->clientRepository->store($client);

        return $client;
    }
}