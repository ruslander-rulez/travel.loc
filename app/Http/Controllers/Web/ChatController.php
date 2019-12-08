<?php

namespace App\Http\Controllers\Web;

class ChatController extends Controller
{
	public function index()
	{
		return view("web.chat.index", compact("content"));
	}
}