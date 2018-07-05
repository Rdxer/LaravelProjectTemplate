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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

    $api->resource('user','App\Http\Controllers\API\v1\UserController');
    $api->resource('profile','App\Http\Controllers\API\v1\ProfileController');

});

//Route::resource('users', 'UserAPIController');

Route::resource('letters', 'LetterAPIController');