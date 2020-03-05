<?php

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


Route::group(['prefix'=>'/','namespace'=>'Admin','as'=>'admin.'],function (){
    Route::group(['prefix'=>'/'],function (){
        Route::get('/','AuthController@index')->name('login');
        Route::post('/','AuthController@login')->name('login');
        Route::get('/logout','AuthController@logout')->name('logout');
    });

    Route::group(['middleware'=>['auth:web','auth_type:1']],function (){
        Route::get('/home','HomeController@index')->name('home');

        Route::get('/profile','ProfileController@index')->name('profile');
        Route::post('/profile','ProfileController@update')->name('profile.update');
        Route::resource('users','UserController');
        Route::get('users/{user}/destroy','UserController@destroy')->name('users.destroy');
        Route::get('users/all/types','UserController@allUsers')->name('allUsers.all');

    });
});


Route::get('/change-password/{token}','ChangePasswordController@changePassword')->name('change-password');
Route::post('/change-password/{token}','ChangePasswordController@updatePassword');
