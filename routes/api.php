<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('meeting/create', 'App\Http\Controllers\MeetingController@create');
Route::get('meeting/times', 'App\Http\Controllers\MeetingController@getTimes');

Route::get('booking/create', 'App\Http\Controllers\BookingController@create');
