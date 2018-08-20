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

Route::get('/todos', 'TodosController@index');

Route::post('/todos', 'TodosController@store');

Route::get('/todos/{id}', 'TodosController@show');

Route::put('/todos/{id}', 'TodosController@update');

Route::delete('/todos/{id}', 'TodosController@destroy');

