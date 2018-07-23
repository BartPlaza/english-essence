<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/words', 'WordsController@index');
Route::post('/words', 'WordsController@store');
Route::get('/import_csv', 'WordsController@import');
Route::post('/import_csv/validate', 'WordsController@validateFile');
Route::post('/import_csv/import', 'WordsController@importFile');
Auth::routes();