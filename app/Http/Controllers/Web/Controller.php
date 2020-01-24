<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\AbstractController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\App;

class Controller extends AbstractController
{
	use ValidatesRequests;
	public function __construct(\ItDevgroup\CommandBus\CommandBus $dispatcher)
	{
 		parent::__construct($dispatcher);
 		App::setLocale("en");
	}
}