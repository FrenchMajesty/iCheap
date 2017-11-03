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

Route::get('/', 'HomeController@index')->name('index');

// ### ADMIN PANEL ### //
Route::group(['prefix' => '/admin', 'middleware' => 'isAdmin'], function() {

	Route::get('/', 'AdminController@index')->name('admin.index');

	Route::get('/books', 'AdminController@booksManager')->name('admin.books');

	Route::get('/books/add', 'AdminController@addDesiredBook')->name('admin.books.add.desired');

	Route::post('/books/add', 'AdminController@createDesiredBook')->name('admin.books.create.desired');

});