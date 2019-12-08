<?php
Route::group(["as" => "web.", "namespace" => "Web"], function () {
	Auth::routes();

	Route::group(["middleware" => "auth:web"], function () {
		Route::get("/", "HomeController@index");

		Route::group(["prefix" => "chat"], function () {
			Route::get("/", "ChatController@index")->name("chat.index");
		});
	});
});
