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

        Route::get('/roles', 'RoleController@index')->name('roles.index');
        Route::get('/roles/{role}', 'RoleController@show')->name('roles.show');
        Route::post('/roles', 'RoleController@store')->name('roles.store');
        Route::put('/roles/{role}', 'RoleController@store')->name('roles.update');

        // Tag
        Route::get('/tags', 'TagController@index')->name('tags.index');
        Route::get('/tags/{tag}', 'TagController@show')->name('tags.show');
        Route::post('/tags', 'TagController@store')->name('tags.store');
        Route::put('/tags/{tag}', 'TagController@store')->name('tags.update');

        // Taxonomy
        Route::get('/taxonomies', 'TaxonomyController@index')->name('taxonomies.index');
        Route::get('/taxonomies/{taxonomy}', 'TaxonomyController@show')->name('taxonomies.show');
        Route::post('/taxonomies', 'TaxonomyController@store')->name('taxonomies.store');
        Route::put('/taxonomies/{taxonomy}', 'TaxonomyController@store')->name('taxonomies.update');


    });




});