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

Route::post('/auth/login', 'API\AuthController@login');
Route::middleware('jwt.auth')->post('/auth/logout', 'API\AuthController@logout');
Route::middleware('jwt.refresh')->get('auth/refresh', 'API\AuthController@refresh');
Route::middleware('jwt.auth')->post('/auth/user', 'API\AuthController@user');


