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

// Auth::login(\App\User::find(4));

// Route::get('/query', function () {
//     $id = \Auth::id();
//     	$items = \App\Order::with('event.theme.company')->withCount('participants')->whereHas('event.theme.company', function ($q) use ($id) {
// 			        	$q->where('user_id', $id);
// 			        })->orderBy('created_at')->get();

//     return view('query', compact('items'));
// });

Route::get('/home', function () {
    return 'hard to remove /home route';
});

// PUBLIC ROUTES
Route::get('/', 'PublicController@home');

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
// Categories
// Route::get('/data/categories', 'PublicController@categories');
// Route::get('/data/eventlist', 'DataController@eventList');
// Route::post('/data/event/search', 'DataController@eventSearch');
// Route::get('/data/venuelist', 'DataController@venueList');
// Route::post('/data/relatedeventlist', 'DataController@relatedEventList');
// Route::get('/data/getcompany/{id}', 'DataController@getCompany');
// Route::get('/data/company/details/{slug}', 'DataController@getCompanyDetails');
// Route::post('/data/theme/comments', 'DataController@themeComments');
// Route::post('/data/venue/comments', 'DataController@venueComments');

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
	Route::get('/load/user/', 'SettingsController@getUserData');

	// Settings routes
	Route::get('/settings', 'SettingsController@index');
	Route::post('/set/user/name', 'SettingsController@setName');
	Route::post('/set/publisher/data', 'SettingsController@setPublisher');
	Route::post('/change/password', 'SettingsController@changePassword');

	Route::get('/', 'UserController@index');
	Route::post('/order', 'UserController@order');

	// Follow
	Route::post('/follow', 'UserController@follow');

	// Like
	Route::post('/like/theme', 'LikeController@toggleTheme');
	Route::post('/like/venue', 'LikeController@toggleVenue');

	// Comments
	Route::post('/comment/theme/add', 'CommentController@commentTheme');
	Route::post('/comment/venue/add', 'CommentController@commentVenue');
	Route::post('/comment/remove', 'CommentController@destroy');

	// Notifications
	Route::get('/notifications', 'UserController@notifications');

});

// Messanger group
Route::group(['namespace' => 'Users', 'prefix' => 'messages',  'middleware' => ['auth', 'isVerified']], function () {
	Route::get('/', 'MessageController@index');
	Route::get('/threads', 'MessageController@getThreads');
	Route::get('/thread/{id}', 'MessageController@getThreadByUser');
	Route::post('/add', 'MessageController@addMessage');
	Route::post('/new', 'MessageController@newThread');
	Route::post('/seen', 'MessageController@seen');
	Route::post('/user/search', 'MessageController@search');
	Route::get('/contact/{id}', 'MessageController@getUserBy');
});

Route::group(['namespace' => 'Publishers', 'prefix' => 'dashboard',  'middleware' => 'auth'], function () {

	Route::get('/', 'DashboardController@index');
	Route::resource('themes', 'ThemeController');
	Route::resource('teachers', 'TeacherController');
	Route::resource('events', 'EventController');
	Route::resource('venues', 'VenueController');
	Route::resource('orders', 'OrderController');
	Route::resource('comments', 'CommentController');

	Route::get('/categories', 'ThemeController@categories');
	Route::get('/load/company', 'DashboardController@getCompany');
	Route::post('/save/company/data', 'DashboardController@saveCompany');

	// Theme cover change
	Route::post('/themes/set/cover', 'ThemeController@setCover');

	// Save image from upload component
	Route::post('/image/save', 'DashboardController@saveImage');

});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin',  'middleware' => ['auth', 'admin']], function () {

	Route::get('/activity', 'AdminController@activity');

});