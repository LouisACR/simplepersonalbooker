<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/meeting/{uuid}', function ($uuid) {
    return view('global', ['uuid' => $uuid]);
});

Route::get('/', function () {
    return view('global', ['uuid' => '25E17BxBdpUxjxmPBXKe']);
});
