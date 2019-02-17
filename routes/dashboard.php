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

    Route::group(["prefix" => "/client"], function () {
        Route::get("/", ["uses" => "ClientController@index", "as" => "client.index"]);

        Route::get("/list", ["uses" => "ClientController@list", "as" => "client.list"]);
        Route::get("/search", ["uses" => "ClientController@search", "as" => "client.search"]);
        Route::put("/", ["uses" => "ClientController@save", "as" => "client.save"]);
        Route::post("/", ["uses" => "ClientController@create", "as" => "client.create"]);
        Route::delete("/", ["uses" => "ClientController@delete", "as" => "client.delete"]);
    });

    Route::group(["prefix" => "/booking"], function () {
        Route::get("/", ["uses" => "BookingController@index", "as" => "booking.index"]);

        Route::get("/list", ["uses" => "BookingController@list", "as" => "booking.list"]);
        Route::put("/", ["uses" => "BookingController@save", "as" => "booking.save"]);
        Route::put("/set-color", ["uses" => "BookingController@setColor", "as" => "booking.set-color"]);
        Route::post("/", ["uses" => "BookingController@create", "as" => "booking.create"]);
        Route::delete("/", ["uses" => "BookingController@delete", "as" => "booking.delete"]);
    });

    Route::group(["prefix" => "/attachment"], function () {
    	//Route::get("/", ["uses" => "AdviceController@index", "as" => "advice.index"]);

//        Route::get("/list", ["uses" => "AdviceController@list", "as" => "advice.list"]);
//        Route::put("/", ["uses" => "AdviceController@save", "as" => "advice.save"]);
        Route::post("/", ["uses" => "AttachmentController@create", "as" => "attachment.create"]);
//        Route::delete("/", ["uses" => "AdviceController@delete", "as" => "advice.delete"]);
    });

});