<?php

namespace App\Http\Controllers\Web;

class HomeController extends Controller
{
	public function index()
	{
		return redirect(route("web.chat.index"));
	}
}