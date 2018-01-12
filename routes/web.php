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

Auth::routes();

Route::model('user', 'User');

Route::model('book', 'App\Book');

Route::model('order.sell', 'Model\Sell\Order');

Route::get('/', 'HomeController@index')->name('index');

Route::get('/contact', 'HomeController@contact')->name('contact');

Route::get('/FAQ', 'HomeController@FAQ')->name('faq');

Route::post('/contact', 'HomeController@submitContact')->name('submit.contact');

Route::get('/email/verify', 'EmailController@verifyEmail')->name('verify.email');

Route::post('/search/sell', 'BookController@searchForBookToSell')->name('search');

Route::post('/shippo/transaction/update', 'Sell\OrderController@update')->name('shippo.update.transaction');

Route::group(['middleware' => 'auth'], function() {

	Route::get('/home', 'UserController@accountPage')->name('account');

	Route::get('/verify', 'UserController@verifyEmailPage')->name('request.verify.email')
	->middleware('emailNotVerified');

	Route::post('/verify', 'EmailController@sendVerificationEmail')->name('request.verify.email')
	->middleware('emailNotVerified');

	Route::post('/account', 'UserController@updateAccountDetails')->name('account.update');

	Route::post('/pwd', 'UserController@updatePassword')->name('password.update');

	Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

	Route::group(['prefix' => '/book'], function() {

		Route::get('/sell/{book}', 'BookController@bookPage')->name('book.sell');

	});

	Route::group(['prefix' => '/order'], function() {

		Route::get('/sell/{book}', 'Sell\OrderController@store')->name('create.order.sell')
		->middleware('emailVerified');

	});

});

// ### ADMIN PANEL ### //
Route::group(['prefix' => '/admin', 'middleware' => 'isAdmin'], function() {

	Route::get('/', 'AdminController@index')->name('admin.index');

	Route::get('/users', 'AdminController@usersManager')->name('admin.users');

	Route::group(['prefix' => '/books'], function() {

		Route::get('/', 'AdminController@booksManager')->name('admin.books');

		Route::get('/add', 'AdminController@addDesiredBook')->name('admin.books.add.desired');

		Route::post('/add', 'AdminController@createDesiredBook')->name('admin.books.create.desired');

		Route::post('/update', 'AdminController@updateDesiredBook')->name('admin.books.update.desired');

		Route::delete('/{id?}', 'AdminController@deleteDesiredBook')->name('admin.books.delete.desired');

	});

	Route::group(['prefix' => '/orders'], function() {

		Route::get('/', 'AdminController@ordersManager')->name('admin.orders');

		Route::post('/update/received', 'AdminController@markOrderAsReceived')->name('admin.orders.update.received');

		Route::post('/update/paid', 'AdminController@markOrderAsPaid')->name('admin.orders.update.paid');

	});

});