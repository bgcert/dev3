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
    return view('test');
});

Route::get('/e', 'PublicController@e');
Route::get('/v', 'PublicController@v');
Route::get('/c/{slug}', 'PublicController@c');

Route::get('/event/{id}', 'PublicController@showEvent');
Route::get('/venue/{id}', 'PublicController@showVenue');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
