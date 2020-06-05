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
Route::get('polls', 'PollController@index');
Route::get('polls/{id}', 'PollController@show');
Route::post('polls', 'PollController@store');
Route::put('polls/{poll}', 'PollController@update');
Route::delete('polls/{poll}', 'PollController@delete');