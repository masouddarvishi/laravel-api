<?php


use Illuminate\Support\Facades\Route;

Route::prefix('api')->namespace('Hooraweb\Base\Http\Controllers')->group(function (){
    Route::get('base', 'TestController@test');
});