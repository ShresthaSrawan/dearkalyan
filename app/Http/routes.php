<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'index', 'uses' => 'FrontController@index']);

Route::auth();

Route::get('tag/{tag}', [ 'as' => 'tag.show', 'uses' => 'TagController@show']);

Route::group(['middleware' => 'auth'], function() {
	Route::get('home', 'AdminController@index');
	Route::get('post', ['as' => 'post.create', 'uses' => 'PostController@create']);
	Route::post('post', ['as' => 'post.store', 'uses' => 'PostController@store']);
	Route::get('post/{post}', ['as' => 'post.show', 'uses' => 'PostController@show']);
	
	Route::get('thumb/{thumbnail}', [ 'as' => 'image.thumbs', 'uses' => 'ImageController@thumbnail']);
});
