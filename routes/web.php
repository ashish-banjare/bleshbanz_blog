<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;

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

/*
|--------------------------------------------------------------------------
| Frontend
|--------------------------------------------------------------------------|
*/

// Route::group(['middleware' => 'verified'], function(){

	// Home
	Route::name('home')->get('/', 'Front\PostController@index');
	Route::get('/home', 'Front\PostController@index');

	Route::get('/send_mail', function(){
		Mail::to('aashish.van3591@gmail.com')->send(new OrderShipped());
	});
	// Contact
	Route::resource('contacts', 'Front\ContactController', ['only' => ['create', 'store']]);

	// Posts and comments
	Route::prefix('posts')->namespace('Front')->group(function () {
	    Route::name('posts.display')->get('{slug}', 'PostController@show');
	    Route::name('posts.tag')->get('tag/{tag}', 'PostController@tag');
	    Route::name('posts.search')->get('', 'PostController@search');
	    Route::name('posts.comments.store')->post('{post}/comments', 'CommentController@store');
	    Route::name('posts.comments.comments.store')->post('{post}/comments/{comment}/comments', 'CommentController@store');
	    Route::name('posts.comments')->get('{post}/comments/{page}', 'CommentController@comments');
	});

	Route::resource('comments', 'Front\CommentController', [
	    'only' => ['update', 'destroy'],
	    'names' => ['destroy' => 'front.comments.destroy']
	]);

	Route::name('category')->get('category/{category}', 'Front\PostController@category');

// });

Auth::routes();
Auth::routes(['verify' => true]);

/*
|------------------------------------------------------------------------
| Backend
|------------------------------------------------------------------------
*/

Route::prefix('admin')->namespace('Back')->group(function(){

	Route::middleware('redac')->group(function () {
		
		Route::name('admin')->get('/', 'AdminController@index');
		// category
		Route::resource('categories', 'CategoryController', ['except'=>'show']);
		// Posts
		Route::name('posts.seen')->put('posts/seen/{post}', 'PostController@updateSeen')->middleware('can:manage,post');
		Route::name('posts.active')->put('posts/active/{post}/{status?}', 'PostController@updateActive')->middleware('can:manage,post');
		Route::resource('posts', 'PostController');

		// Notifications
        Route::name('notifications.index')->get('notifications/{user}', 'NotificationController@index');
        Route::name('notifications.update')->put('notifications/{notification}', 'NotificationController@update');

	});

	Route::middleware('admin')->group(function () {

		// Users
		Route::name('users.seen')->put('users/seen/{user}', 'UserController@updateSeen');
		Route::name('users.valid')->put('users/valid/{user}', 'UserController@updateValid');
		Route::resource('users', 'UserController', ['only'=>['index', 'create', 'store', 'edit', 'update', 'destroy']]);

		// Settings
		Route::name('settings.edit')->get('settings', 'AdminController@settingsEdit');
		Route::name('settings.update')->put('settings', 'AdminController@settingsUpdate');

		// Contacts
        Route::name('contacts.seen')->put('contacts/seen/{contact}', 'ContactController@updateSeen');
        Route::resource('contacts', 'ContactController', ['only' => [
            'index', 'destroy'
        ]]);

        // Comments
        Route::name('comments.seen')->put('comments/seen/{comment}', 'CommentController@updateSeen');
        Route::resource('comments', 'CommentController', ['only' => [
            'index', 'destroy'
        ]]);

	});

});