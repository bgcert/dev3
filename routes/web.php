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

Auth::login(\App\User::find(11));

Route::get('/home', function () {
    return 'hard to remove /home route';
});

// PUBLIC ROUTES
Route::view('/test', 'test');
Route::view('/design', 'design');
Route::get('/', 'PublicController@events');
Route::get('/', 'PublicController@events');

Route::get('/t', 'PublicController@themes');
Route::get('/e', 'PublicController@events');
Route::get('/v', 'PublicController@venues');
Route::get('/c/{slug}', 'PublicController@company');
Route::get('/user/{id}', 'PublicController@user');

Route::get('/theme/{id}', 'PublicController@showTheme');
Route::get('/event/{id}', 'PublicController@showEvent');
Route::get('/venue/{id}', 'PublicController@showVenue');

// Data routes
// load/../.. ?? 
Route::get('/data/eventlist', 'DataController@eventList');
Route::get('/data/venuelist', 'DataController@venueList');
Route::post('/data/relatedeventlist', 'DataController@relatedEventList');
Route::get('/data/getcompany/{id}', 'DataController@getCompany');
Route::get('/data/company/details/{slug}', 'DataController@getCompanyDetails');
Route::post('/data/theme/comments', 'DataController@themeComments');
Route::post('/data/venue/comments', 'DataController@venueComments');

// Load venue images
Route::get('/load/venue/images/{id}', 'DataController@venueImages');

// Verification routes
Route::get('email-verification/error', 'Auth\RegisterController@getVerificationError')->name('email-verification.error');
Route::get('email-verification/check/{token}', 'Auth\RegisterController@getVerification')->name('email-verification.check');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

// USER ROUTES
Route::group(['namespace' => 'Users', 'prefix' => 'users',  'middleware' => ['auth', 'isVerified']], function () {

	// Load data routes
	Route::get('/load/user/{id}', 'SettingsController@getUserData');

	// Settings routes
	Route::get('/settings', 'SettingsController@index');
	Route::post('/set/user/name', 'SettingsController@setName');
	Route::post('/set/publisher/data', 'SettingsController@setPublisher');
	Route::post('/change/password', 'SettingsController@changePassword');

	// Messanger routes
	Route::get('/messages', 'MessageController@index');
	Route::post('/threads', 'MessageController@allThreads');
	Route::post('/thread', 'MessageController@getThread');
	Route::post('/message', 'MessageController@store');	

	Route::get('/', 'UserController@index');
	Route::get('/order', 'UserController@order');

	Route::post('/follow', 'UserController@follow');

	Route::post('/like/theme', 'LikeController@toggleTheme');
	Route::post('/like/venue', 'LikeController@toggleVenue');

	// Comments
	Route::post('/comment/theme/add', 'CommentController@commentTheme');
	Route::post('/comment/venue/add', 'CommentController@commentVenue');
	Route::post('/comment/remove', 'CommentController@destroy');

});

Route::group(['namespace' => 'Publishers', 'prefix' => 'dashboard',  'middleware' => 'auth'], function () {

	Route::get('/', 'DashboardController@index');
	Route::resource('themes', 'ThemeController');
	Route::resource('events', 'EventController');
	//Route::resource('teachers', 'TeacherController');
	Route::resource('venues', 'VenueController');
	Route::resource('orders', 'OrderController');
	Route::resource('comments', 'CommentController');

	Route::get('/categories', 'DashboardController@categories');

});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin',  'middleware' => ['auth', 'admin']], function () {

	Route::get('/activity', 'AdminController@activity');

});