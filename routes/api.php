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

Route::post('login', 'AuthController@login');

Route::middleware(['auth:api'])->group(function () {
	Route::get('/v1/groups', 'UsersApiController@groups');
	Route::get('/v1/users', 'UsersApiController@users');
});


Route::get('/v1/users1', 'UsersApiController@users');
