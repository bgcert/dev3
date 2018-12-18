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

Route::get('/categories', 'PublicController@categories');
Route::get('/eventlist/{slug?}', 'DataController@eventList');
Route::get('/cities', 'DataController@cities');
Route::post('/event/search', 'DataController@eventSearch');
Route::get('/venuelist', 'DataController@venueList');
Route::post('/relatedeventlist', 'DataController@relatedEventList');
Route::get('/getcompany/{id}', 'DataController@getCompany');
Route::get('/company/details/{slug}', 'DataController@getCompanyDetails');
Route::post('/theme/comments', 'DataController@themeComments');
Route::post('/venue/comments', 'DataController@venueComments');

Route::post('/order', 'PublicController@order');
Route::post('/contact/form', 'PublicController@saveContactForm');
Route::post('/admin/contact/form', 'PublicController@saveAdminContactForm');