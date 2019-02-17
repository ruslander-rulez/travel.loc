<?php
namespace App\Application\Auth;

use App\Domain\BackendUser\BackendUserRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthManager;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class SignInAsBackendUserHandler implements Handler
{
    /**
     * @var PasswordHasher
     */
    private $passwordHasher;

    /**
     * @var AuthManager
     */
    private $authManager;

    /**
     * @var BackendUserRepository
     */
    private $backendUserRepository;

    /**
     * @param BackendUserRepository $backendUserRepository
     * @param PasswordHasher $passwordHasher
     * @param AuthManager $authManager
     */
    public function __construct(
        BackendUserRepository $backendUserRepository,
        PasswordHasher $passwordHasher,
        AuthManager $authManager
    ) {
        $this->passwordHasher = $passwordHasher;
        $this->authManager = $authManager;
        $this->backendUserRepository = $backendUserRepository;
    }

    /**
     * @param SignInAsBackendUser|Command $command
     *
     * @return void
     *
     * @throws AuthorizationException
     */
    public function handle(Command $command)
    {
            $backendUser = $this->backendUserRepository->byEmail($command->email());

            if (!$backendUser || !$this->passwordHasher->check($command->password(), $backendUser->password)) {
                throw new AuthorizationException;
            }
            $this->authManager->guard('dashboard')->login($backendUser);
    }
}
