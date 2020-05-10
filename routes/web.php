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
})->name('index')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

/*
|------------------------------------------------------------------------
| Backend
|------------------------------------------------------------------------
*/

Route::prefix('admin')->namespace('Back')->group(function(){

	Route::middleware('redac')->group(function () {
		
		Route::name('admin')->get('/', 'AdminController@index');

	});

	Route::middleware('redac')->group(function () {

		// Users
		Route::resource('users', 'UserController', ['only'=>['index', 'create', 'store', 'edit', 'update', 'destroy']]);

	});

});