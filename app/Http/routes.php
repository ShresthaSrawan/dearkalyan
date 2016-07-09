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

Route::get('thumb/{thumbnail}', [ 'as' => 'image.thumbs', 'uses' => 'ImageController@thumbnail']);

Route::group(['middleware' => 'auth'], function() {
	Route::get('home', 'AdminController@index');
	
	Route::get('post/{post}/publish', ['as' => 'post.publish', 'uses' => 'PostController@publish']);	
	Route::get('featured-image/{featured_image}/publish', ['as' => 'featured-image.publish', 'uses' => 'FeaturedImageController@publish']);	
	Route::get('slider-image/{slider_image}/publish', ['as' => 'slider-image.publish', 'uses' => 'SliderImageController@publish']);

	Route::resource('featured-image', 'FeaturedImageController', ['except' => ['index', 'show']]);
	Route::resource('slider-image', 'SliderImageController', ['except' => ['index', 'show']]);
	Route::resource('post', 'PostController', ['except' => ['index', 'show']]);
});

Route::get('post/{post}', ['as' => 'post.show', 'uses' => 'PostController@show']);
Route::get('featured-image/{featured_image}', ['as' => 'featured-image.show', 'uses' => 'FeaturedImageController@show']);