<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', [
	'uses' => '\Looksy\Http\Controllers\HomeController@index', 
	'as' => 'home'
]);

Route::get('/signup', [
	'uses' => '\Looksy\Http\Controllers\AuthController@getSignup', 
	'as' => 'auth.signup'
]);

Route::post('/signup', [
	'uses' => '\Looksy\Http\Controllers\AuthController@postSignup'
]);

Route::get('/signin', [
	'uses' => '\Looksy\Http\Controllers\AuthController@getSignin', 
	'as' => 'auth.signin'
]);

Route::post('/signin', [
	'uses' => '\Looksy\Http\Controllers\AuthController@postSignin'
]);
