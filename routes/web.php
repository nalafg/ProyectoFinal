<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->group(function(){
	Route::get('/dashboard','DashboardController@index')->name('dashboard');

	Route::get('/users','UserController@index')->name('users');
	Route::get('/users/{id}','UserController@details');

	Route::get('/movies/{id}','MovieController@details');
	Route::get('/movies','MovieController@index')->name('movies');
	Route::post('/movies','MovieController@store');
	Route::put('/movies','MovieController@update');
	Route::delete('/movies','MovieController@destroy');

	Route::get('/loans','LoanController@index')->name('loans');
	Route::get('/loans/{id}','LoanController@details');
	Route::post('/loans','LoanController@store');
	Route::put('/loans','LoanController@update');
	Route::delete('/loans','LoanController@destroy');

	Route::get('/categories','CategoryController@index')->name('categories');
	Route::put('/categories','CategoryController@update');
	Route::post('/categories','CategoryController@store');
	Route::delete('/categories','CategoryController@destroy');

});
