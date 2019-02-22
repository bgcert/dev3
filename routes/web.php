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

// Auth::login(\App\User::find(9));

// Route::get('/query', function () {
    
// 	$items = Auth::user()->threads->where('id', 1)->first()->append('read');
//     return view('query', compact('items'));
// });

Route::get('/home', function () {
    return 'hard to remove /home route';
});

// PUBLIC ROUTES
Route::get('/', 'EventController@index')->name('home');

// Pages
Route::view('/page/help', 'pages/help');
Route::view('/page/contact', 'pages/contact');
Route::view('/page/publish', 'pages/publish');
Route::view('/page/confirm', 'pages/confirm');
Route::view('/page/live', 'pages/live');
// Route::view('/page/help', 'pages/terms');
Route::view('/terms', 'terms');

Route::view('/stream-test', 'stream-test');

Route::get('/browse/{slug?}', 'EventController@browse');
Route::get('/t', 'PublicController@themes');
Route::get('/v', 'PublicController@venues');
Route::get('/c/{slug}', 'PublicController@company');
Route::get('/user/{id}', 'PublicController@user');

Route::get('/theme/{slug}', 'PublicController@showThemeById');
// Route::get('/theme/{slug}', 'PublicController@showThemeBySlug');
Route::get('/event/{id}', 'EventController@show');
Route::get('/venue/{id}', 'PublicController@showVenue');
// Route::get('/video', 'PublicController@video');

// Load venue images
Route::get('/load/venue/images/{id}', 'DataController@venueImages');

// Verification route
Route::get('/verify/{token}', 'PublicController@verify')->name('verify');

Auth::routes();

Route::get('/not-verified', 'PublicController@notVerified');

//Route::get('/home', 'HomeController@index')->name('home');

// Order
Route::post('/order', 'PublicController@order');

// USER ROUTES
Route::group(['namespace' => 'Users', 'prefix' => 'users',  'middleware' => 'auth'], function () {

	// Load data routes
	Route::get('/load/user/', 'SettingsController@getUserData');

	// Settings routes
	Route::get('/settings', 'SettingsController@index');
	Route::post('/set/user/name', 'SettingsController@setName');
	Route::post('/set/publisher/data', 'SettingsController@setPublisher');
	Route::post('/change/password', 'SettingsController@changePassword');
	Route::post('/delete/account', 'SettingsController@deleteAccount');

	Route::get('/', 'UserController@index');

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
	Route::get('/notifications', 'UserController@getNotifications');
	Route::get('/notifications/check', 'UserController@checkNotifications');
	Route::get('/notifications/{id}', 'UserController@readNotification');

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

Route::group(['namespace' => 'Publishers', 'prefix' => 'dashboard',  'middleware' => 'auth'], function () {

	Route::get('/', 'DashboardController@index');
	Route::resource('themes', 'ThemeController');
	Route::resource('teachers', 'TeacherController');
	Route::resource('events', 'EventController');
	Route::resource('venues', 'VenueController');
	Route::resource('orders', 'OrderController');
	Route::resource('contacts', 'ContactController');
	Route::resource('comments', 'CommentController');

	Route::get('/get/items', 'DashboardController@getNewItemsCount');

	// Mark contact as unread
	Route::post('/contacts/unread', 'ContactController@unread');

	// Mark order as unread
	Route::post('/orders/unread', 'OrderController@unread');

	Route::get('/categories', 'ThemeController@categories');
	Route::get('/load/company', 'DashboardController@getCompany');
	Route::patch('/save/company/data', 'DashboardController@saveCompany');

	// Theme cover change
	Route::post('/themes/set/cover', 'ThemeController@setCover');

	// Save venue images from upload and multi upload components
	Route::post('/venue/cover/upload', 'VenueController@saveVenueCover');
	Route::post('/venue/image/upload', 'VenueController@saveVenueImage');

	// Save theme image route!!!
	Route::post('/image/upload', 'DashboardController@saveImage');

});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin',  'middleware' => ['auth', 'admin']], function () {

	Route::get('/', 'AdminController@index');

	Route::resource('users', 'AdminUserController');
	Route::resource('events', 'AdminEventController');
	Route::resource('orders', 'AdminOrderController');
	Route::resource('contacts', 'AdminContactController');
	Route::get('/activity', 'AdminController@activity');

	Route::get('/slug-builder', 'AdminController@slugBuilder');

});

// SEO Routes!
Route::get('/{slug}', 'PublicController@showThemeBySlug');
Route::get('/{slug}/{id}', 'PublicController@showThemeBySlug');
Route::get('/{slug}/{date}/{id}', 'EventController@showBySlug');