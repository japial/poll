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

Route::group(['middleware' => 'auth:api'], function()
{
	Route::get('polls', 'PollsController@index');
	Route::get('polls/{id}', 'PollsController@show');
	Route::post('polls', 'PollsController@store');
	Route::put('polls/{poll}', 'PollsController@update');
	Route::delete('polls/{poll}', 'PollsController@delete');
	Route::apiResource('questions', 'QuestionsController');
	Route::get('polls/{poll}/questions', 'PollsController@questions');
	Route::get('files/get', 'FilesController@show');
	Route::post('files/upload', 'FilesController@upload');
	Route::post('logout', 'AuthController@logout');
	Route::any('errors', 'PollsController@errors');
	Route::get('user', function (Request $request) {
		return $request->user();
	});
});
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::get('unauthorized', 'AuthController@unauthorized');
