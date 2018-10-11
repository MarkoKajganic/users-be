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


Route::post('/login', 'Auth\LoginController@authenticate');

Route::middleware('jwt')->get('/users', 'UserController@index');
Route::middleware('jwt')->get('/users/{id}', 'UserController@show');
Route::middleware('jwt')->post('/users', 'UserController@store');
Route::middleware('jwt')->put('/users/{id}', 'UserController@editAndUpdate');
Route::middleware('jwt')->delete('/users/{id}', 'UserController@destroy');
