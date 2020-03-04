<?php

Route::group(['namespace' => 'Api'] ,function (){
    Route::group(['prefix' => 'auth'], function () {
        Route::post('register', 'AuthController@register')->name('api.register');
        Route::post('login', 'AuthController@login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('reset-password', 'AuthController@resetPassword');
    });
    Route::group(['middleware'=>['auth:api']],function (){
        Route::group(['prefix' => 'account'], function () {
            Route::get('/me','ProfileController@me');
            Route::post('/update','ProfileController@update')->name('api.account.update');
            Route::post('/update-password','ProfileController@updatePassword');
        });

        Route::apiResource('/hospitals','HospitalController');

    });
    Route::get('/countries','LocationController@index');
    Route::get('/countries/{country}','LocationController@singleCountry');
});
