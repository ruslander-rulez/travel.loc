<?php

namespace App\Http\Controllers\Dashboard;

use App\Domain\Profile\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
	public function index()
	{
		$profiles = Profile::query()->paginate(30);
		return view("dashboard.profile.index", compact("profiles"));
	}

	public function edit($profile)
	{
		$profile = Profile::query()->findOrFail($profile);
		return view("dashboard.profile.edit", compact("profile"));
	}

	public function new(Request $request)
	{
		return view("dashboard.profile.new");
	}

	public function create(Request $request)
	{
		$this->validate($request, [
			"name" => "required|string|max:150",
			"email" => "required|string|max:150|unique:" . Profile::ENTITY_TABLE . ",email",
			"password" => "required|confirmed|min:5"
		]);

		Profile::create([
			"name" => $request->get("name"),
			"email" => $request->get("email"),
			"password" => bcrypt($request->get("password"))
		]);

		return redirect(route("root.profile.index"))->with("success", "Профиль был создан");
	}

	public function update($id, Request $request)
	{
		$this->validate($request, [
			"name" => "required|string|max:150",
			"email" => "required|string|max:150|unique:" . Profile::ENTITY_TABLE . ",email,{$id}",
		]);

		Profile::query()->find($id)->update([
			"name" => $request->get("name"),
			"email" => $request->get("email"),
		]);

		return redirect(route("root.profile.index"))->with("success", "Профиль был обновлен");
	}

	public function updatePassword($id, Request $request)
	{
		$this->validate($request, [
			"password" => "required|confirmed|min:5"
		]);

		Profile::query()->find($id)->update([
			"password" => bcrypt($request->get("password")),
		]);

		return redirect()->back()->with("success", "Пароль был обновлен");
	}
}