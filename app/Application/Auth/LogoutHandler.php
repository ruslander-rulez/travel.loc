<?php
namespace App\Application\Auth;

use Illuminate\Auth\AuthManager;
use ItDevgroup\CommandBus\Command;
use ItDevgroup\CommandBus\Handler;

class LogoutHandler implements Handler
{
    /**
     * @var AuthManager
     */
    private $authManager;

    /**
     * SignInHandler constructor.
     *
     * @param AuthManager $authManager
     * @internal param Guard $auth
     */
    public function __construct(AuthManager $authManager)
    {

        $this->authManager = $authManager;
    }

    /**
     * @param Logout|Command $command
     *
     * @return void
     */
    public function handle(Command $command)
    {
        $this->authManager->guard('dashboard')->logout();
    }
}
