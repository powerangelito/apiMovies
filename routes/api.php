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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    Route::get('movies', 'MovieController@getAll');
    Route::post('movies', 'MovieController@add');
    Route::get('movies/{id}', 'MovieController@get');
    Route::post('movies/{id}', 'MovieController@edit');
    Route::get('movies/delete/{id}', 'MovieController@delete');

    Route::get('innings', 'InningController@getAll');
    Route::post('innings', 'InningController@add');
    Route::get('innings/{id}', 'InningController@get');
    Route::post('innings/{id}', 'InningController@edit');
    Route::get('innings/delete/{id}', 'InningController@delete');

    Route::get('assigns', 'MovieInnginsController@getAll');
    Route::post('assigns/movie/{movie}/innign/{innign}', 'MovieInnginsController@assign');
});


