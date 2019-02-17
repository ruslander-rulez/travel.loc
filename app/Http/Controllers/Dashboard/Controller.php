<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\AbstractController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\App;

class Controller extends AbstractController
{
    use AuthorizesRequests;
    public function __construct(\ItDevgroup\CommandBus\CommandBus $dispatcher)
    {
        parent::__construct($dispatcher);
        App::setLocale("ru");
    }
}
