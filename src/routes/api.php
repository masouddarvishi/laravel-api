<?php


use Illuminate\Support\Facades\Route;

Route::prefix('api')->namespace('Hooraweb\LaravelApi\Http\Controllers')->group(function (){


    Route::name('auth.')->prefix('auth')->group(function () {
        Route::post('login', 'AuthController@login')->name('login');
        Route::post('register', 'AuthController@register')->name('register');
        Route::group(['middleware' => 'auth:api'], function () {
            Route::get('user', 'AuthController@authenticatedUser')->name('user');
            Route::get('logout', 'AuthController@logout')->name('logout');
        });
    });


    Route::group(['middleware' => 'auth:api'], function () {

        Route::get('/users', 'UserController@index')->name('users.index');
        Route::get('/users/{user}', 'UserController@show')->name('users.show');
        Route::post('/users', 'UserController@store')->name('users.store');
        Route::put('/users/{user}', 'UserController@store')->name('users.update');


    });




});