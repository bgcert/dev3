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

Route::get('/query', function () {
    
	$items = Auth::user()->threads->where('id', 1)->first()->append('read');
    return view('query', compact('items'));
});

Route::get('/home', function () {
    return 'hard to remove /home route';
});

// PUBLIC ROUTES
Route::get('/', 'PublicController@home')->name('home');
Route::view('/terms', 'terms');

Route::get('/browse/{slug?}', 'PublicController@events');
Route::get('/t', 'PublicController@themes');
Route::get('/v', 'PublicController@venues');
Route::get('/c/{slug}', 'PublicController@company');
Route::get('/user/{id}', 'PublicController@user');

Route::get('/theme/{id}', 'PublicController@showTheme');
Route::get('/event/{id}', 'PublicController@showEvent');
Route::get('/venue/{id}', 'PublicController@showVenue');

// Load venue images
Route::get('/load/venue/images/{id}', 'DataController@venueImages');

// Verification route
// Route::get('/verify/{token}', 'Auth\RegisterController@verify')->name('verify');
Route::get('/verify/{token}', 'PublicController@verify')->name('verify');

Auth::routes();

Route::get('/not-verified', 'PublicController@notVerified');

//Route::get('/home', 'HomeController@index')->name('home');

// USER ROUTES
Route::group(['namespace' => 'Users', 'prefix' => 'users',  'middleware' => 'auth'], function () {

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
	Route::get('/notifications/check', 'UserController@notification_check');
	Route::get('/notifications/{id}', 'UserController@notification_read');

});


// Messanger new group
Route::group(['namespace' => 'Users', 'prefix' => 'msgr',  'middleware' => 'auth'], function () {
	Route::get('/threads', 'MessengerController@threads');
	Route::get('/thread/{id}', 'MessengerController@thread');
	Route::get('/thread/{id}/messages', 'MessengerController@messages');
	Route::post('/thread', 'MessengerController@newThread'); // For later
	Route::post('/thread/{id}/message/add', 'MessengerController@addMessage');
	Route::post('/thread/message/new', 'MessengerController@newMessage');
	Route::post('/thread/seen', 'MessengerController@seen');
	Route::post('/search', 'MessengerController@search');
});

// Messanger group
Route::group(['namespace' => 'Users', 'prefix' => 'messages',  'middleware' => 'auth'], function () {
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
	Route::post('/image/upload', 'DashboardController@upload');

	// Set order status
	Route::post('/orders/status', 'OrderController@setStatus');

});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin',  'middleware' => ['auth', 'admin']], function () {

	Route::get('/activity', 'AdminController@activity');

});