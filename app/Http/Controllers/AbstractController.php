<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class AbstractController extends BaseController
{
    use ValidatesRequests;

    private $dispatcher;

    public function __construct(\ItDevgroup\CommandBus\CommandBus $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function dispatch(\ItDevgroup\CommandBus\Command $command)
    {
        return $this->dispatcher->execute($command);
    }
}