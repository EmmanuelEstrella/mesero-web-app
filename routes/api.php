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
Route::post('/orders', 'OrderController@store');
Route::get('/orders', 'OrderController@index');
Route::get('/orders/{order}/items', 'OrderController@items');
Route::get('/orders/{order}/received', 'OrderController@orderReceived');
Route::get('/orders/{order}/dismiss', 'OrderController@dismissRobot');
Route::get('/items', 'ItemController@index');
Route::post('/robot/update', 'OrderController@updateRobotStatus');

Route::middleware('auth:api')->group(function() {
    // Route::get('/orders', 'OrderController@index');
    // Route::get('/orders/{order}/items', 'ItemController@index');
});

