<?php

Route::group(['middleware' => 'not.auth.admin'], function () {
    Route::redirect('/root', '/root/login', 301);
    Route::get('root/login', ['as' => 'dashboard.login.show', 'uses' => 'Auth\AuthorizationController@loginPage']);
    Route::post('root/login', ['as' => 'dashboard.login', 'uses' => 'Auth\AuthorizationController@login']);
    /*
        Route::group(['prefix' => 'admin/password'], function () {
            Route::get('recover', [
                'as' => 'admin.password.recover.show', 'uses' => 'Auth\ForgotPasswordController@recoverPasswordPage'
            ]);
            Route::post('send/reset/link', [
                'as' => 'admin.password.recover.send', 'uses' => 'Auth\ForgotPasswordController@sendResetLink'
            ]);
            Route::get('set/new/{code}', [
                'as' => 'admin.password.set.new', 'uses' => 'Auth\ForgotPasswordController@newPasswordPage'
            ]);
            Route::put('update/to/new', [
                'as' => 'admin.password.update.to.new', 'uses' => 'Auth\ForgotPasswordController@setNewPassword'
            ]);
        });*/
});

Route::group(['middleware' => 'auth.as.admin', "prefix" => "/root", "as" => "root."], function () {

    Route::post("/logout", ["as" => "logout", "uses" => "Auth\AuthorizationController@logout"]);
    Route::get("/", ["uses" => "RootController@index", "as" => "index"]);

    Route::group(["prefix" => "/ship"], function () {
        Route::get("/", ["uses" => "ShipController@index", "as" => "ship.index"]);

        Route::get("/list", ["uses" => "ShipController@list", "as" => "ship.list"]);
        Route::put("/", ["uses" => "ShipController@save", "as" => "ship.save"]);
        Route::post("/", ["uses" => "ShipController@create", "as" => "ship.create"]);
        Route::delete("/", ["uses" => "ShipController@delete", "as" => "ship.delete"]);
    });
    Route::group(["prefix" => "/place"], function () {
        Route::get("/", ["uses" => "PlaceController@index", "as" => "place.index"]);

        Route::get("/list", ["uses" => "PlaceController@list", "as" => "place.list"]);
        Route::put("/", ["uses" => "PlaceController@save", "as" => "place.save"]);
        Route::post("/", ["uses" => "PlaceController@create", "as" => "place.create"]);
        Route::delete("/", ["uses" => "PlaceController@delete", "as" => "place.delete"]);
    });
    Route::group(["prefix" => "/hotel"], function () {
        Route::get("/", ["uses" => "HotelController@index", "as" => "hotel.index"]);

        Route::get("/list", ["uses" => "HotelController@list", "as" => "hotel.list"]);
        Route::put("/", ["uses" => "HotelController@save", "as" => "hotel.save"]);
        Route::post("/", ["uses" => "HotelController@create", "as" => "hotel.create"]);
        Route::delete("/", ["uses" => "HotelController@delete", "as" => "hotel.delete"]);
    });
    Route::group(["prefix" => "/restaurant"], function () {
        Route::get("/", ["uses" => "RestaurantController@index", "as" => "restaurant.index"]);

        Route::get("/list", ["uses" => "RestaurantController@list", "as" => "restaurant.list"]);
        Route::put("/", ["uses" => "RestaurantController@save", "as" => "restaurant.save"]);
        Route::post("/", ["uses" => "RestaurantController@create", "as" => "restaurant.create"]);
        Route::delete("/", ["uses" => "RestaurantController@delete", "as" => "restaurant.delete"]);
    });

    Route::group(["prefix" => "/client"], function () {
        Route::get("/", ["uses" => "ClientController@index", "as" => "client.index"]);

        Route::get("/list", ["uses" => "ClientController@list", "as" => "client.list"]);
        Route::get("/search", ["uses" => "ClientController@search", "as" => "client.search"]);
        Route::put("/", ["uses" => "ClientController@save", "as" => "client.save"]);
        Route::post("/", ["uses" => "ClientController@create", "as" => "client.create"]);
        Route::post("/from-file", ["uses" => "ClientController@fromFile", "as" => "client.from-file"]);
        Route::delete("/", ["uses" => "ClientController@delete", "as" => "client.delete"]);
    });

    Route::group(["prefix" => "/booking"], function () {
        Route::get("/", ["uses" => "BookingController@index", "as" => "booking.index"]);

        Route::get("/list", ["uses" => "BookingController@list", "as" => "booking.list"]);
        Route::get("/nearest-booking-list", ["uses" => "BookingController@nearestBookingList", "as" => "booking.nearestBookingList"]);
        Route::put("/", ["uses" => "BookingController@save", "as" => "booking.save"]);
        Route::put("/set-color", ["uses" => "BookingController@setColor", "as" => "booking.set-color"]);
        Route::post("/", ["uses" => "BookingController@create", "as" => "booking.create"]);
        Route::delete("/", ["uses" => "BookingController@delete", "as" => "booking.delete"]);

        Route::get("generate-tourtickets", ["uses" => "BookingController@GenerateTourtickets", "as" => "booking.generate-tourtickets"]);
        Route::get("generate-border-documents", ["uses" => "BookingController@generateBorderDocuments", "as" => "booking.generate-border-documents"]);

		Route::post("/from-file", ["uses" => "BookingController@fromFile", "as" => "booking.create"]);

		Route::get("/statistic", ["uses" => "BookingController@statistic", "as" => "booking.statistic"]);

	});

    Route::group(["prefix" => "/book"], function () {
        Route::get("/", ["uses" => "BookController@index", "as" => "book.index"]);

        Route::get("/list", ["uses" => "BookController@list", "as" => "book.list"]);
        Route::put("/", ["uses" => "BookController@save", "as" => "book.save"]);
		Route::post("/", ["uses" => "BookController@create", "as" => "book.create"]);
		Route::delete("/", ["uses" => "BookController@delete", "as" => "book.delete"]);
		Route::put("/change-program-color", ["uses" => "BookController@changeProgramColor", "as" => "book.change-program-color"]);

		Route::get('/generate-program', ["uses" => "BookController@generateProgram", "as" => "book.generate-program"]);
	});

    Route::group(["prefix" => "/attachment"], function () {
    	//Route::get("/", ["uses" => "AdviceController@index", "as" => "advice.index"]);

//        Route::get("/list", ["uses" => "AdviceController@list", "as" => "advice.list"]);
//        Route::put("/", ["uses" => "AdviceController@save", "as" => "advice.save"]);
        Route::post("/", ["uses" => "AttachmentController@create", "as" => "attachment.create"]);
//        Route::delete("/", ["uses" => "AdviceController@delete", "as" => "advice.delete"]);
    });

});