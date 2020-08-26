<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

 // public routes
 Route::get('login', 'Api\AuthController@login')->name('login');//Updated
 Route::post('/login', 'Api\AuthController@login')->name('login.api');
 Route::post('/register', 'Api\AuthController@register')->name('register.api');
 Route::post('/childReister','Api\AuthController@childRegister')->name('childRegister.api');

 // private routes
Route::middleware('auth:api')->group(function () {
    Route::get('/logout', 'Api\AuthController@logout')->name('logout');
    Route::resource('/restaurant','Api\RestaurantController');
    Route::resource('/schedule','Api\ScheduleController');
    Route::resource('/mesa','Api\MesaController');
    Route::resource('/category','Api\CategoryController');
    Route::resource('/dish','Api\DishController');
    Route::resource('/ingredient','Api\IngredientController');
    Route::resource('/unit','Api\UnitController');
});
