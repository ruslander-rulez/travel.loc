<?php


namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Base;

class Authenticate extends Base
{
	public function redirectTo($request)
	{
		return route("web.login");
	}
}