<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PostController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


route::get("hotel","App\Http\Controllers\HotelController@index");

route::get("room_cats","App\Http\Controllers\RoomCategoryController@index");

route::post("book","App\Http\Controllers\ReservationController@store");

route::post("bo","App\Http\Controllers\ReservationController@price");

route::post("show","App\Http\Controllers\HotelController@show");

route::post("guest","App\Http\Controllers\GuestController@store");

route::post("login","App\Http\Controllers\Auth\AuthController@login");

route::get("admin-data","App\Http\Controllers\RoomController@index");

