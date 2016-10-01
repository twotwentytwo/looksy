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
	'as' => 'auth.signup', 
	'middleware' => ['guest']
]);

Route::post('/signup', [
	'uses' => '\Looksy\Http\Controllers\AuthController@postSignup', 
	'middleware' => ['guest']
]);

Route::get('/signin', [
	'uses' => '\Looksy\Http\Controllers\AuthController@getSignin', 
	'as' => 'auth.signin', 
	'middleware' => ['guest']
]);

Route::post('/signin', [
	'uses' => '\Looksy\Http\Controllers\AuthController@postSignin', 
	'middleware' => ['guest']
]);

Route::get('/signout', [
	'uses' => '\Looksy\Http\Controllers\AuthController@getSignout', 
	'as' => 'auth.signout'
]);

Route::get('/results', [
    'uses' => '\Looksy\Http\Controllers\SearchController@getResults',
    'as' => 'search.results'
]);


Route::get('/user/{username}', [
    'uses' => '\Looksy\Http\Controllers\ProfileController@getProfile',
    'as' => 'profile.index'
]);

Route::get('/profile/edit', [
    'uses' => '\Looksy\Http\Controllers\ProfileController@getPostEdit',
    'as' => 'profile.edit',
    'middleware' => ['auth']
]);

Route::post('/profile/edit', [
    'uses' => '\Looksy\Http\Controllers\ProfileController@postPostEdit',
    'as' => 'profile.edit', 
    'middleware' => ['auth']
]);

Route::get('/friends', [
    'uses' => '\Looksy\Http\Controllers\FriendController@getIndex',
    'as' => 'friend.index',
    'middleware' => ['auth']
]);

Route::get('/friends/add/{username}', [
    'uses' => '\Looksy\Http\Controllers\FriendController@getAdd',
    'as' => 'friend.add',
    'middleware' => ['auth']
]);

Route::get('/friends/accept/{username}', [
    'uses' => '\Looksy\Http\Controllers\FriendController@getAccept',
    'as' => 'friend.accept',
    'middleware' => ['auth']
]);

Route::post('/status', [
    'uses' => '\Looksy\Http\Controllers\StatusController@postStatus',
    'as' => 'status.post', 
    'middleware' => ['auth']
]);

Route::post('/status/{statusId}/reply', [
    'uses' => '\Looksy\Http\Controllers\StatusController@postReply',
    'as' => 'status.reply', 
    'middleware' => ['auth']
]);

Route::get('/add', [
    'uses' => '\Looksy\Http\Controllers\StatusController@getAdd',
    'as' => 'add.index'
]);

Route::get('/pick/{statusId}', [
    'uses' => '\Looksy\Http\Controllers\StatusController@showPick',
    'as' => 'pick.index', 
    'middleware' => ['auth']
]);

Route::get('/picks/{category}', [
    'uses' => '\Looksy\Http\Controllers\StatusController@getPicksByCategory',
    'as' => 'pick.category', 
    'middleware' => ['auth']
]);

Route::get('/pick/{statusId}/edit', [
    'uses' => '\Looksy\Http\Controllers\StatusController@getEditPick',
    'as' => 'pick.edit', 
    'middleware' => ['auth']
]);

Route::post('/pick/{statusId}/edit', [
    'uses' => '\Looksy\Http\Controllers\StatusController@postEditPick',
    'as' => 'pick.edit', 
    'middleware' => ['auth']
]);

Route::get('/pick/{statusId}/remove', [
    'uses' => '\Looksy\Http\Controllers\StatusController@postRemovePick',
    'as' => 'pick.remove', 
    'middleware' => ['auth']
]);

Route::get('/search', [
    'uses' => '\Looksy\Http\Controllers\StatusController@getSearch',
    'as' => 'search.index',
    'middleware' => ['auth']
]);

Route::post('/invite', [
    'uses' => '\Looksy\Http\Controllers\FriendController@postSendToFriend',
    'as' => 'emails.sendtofriend',
    'middleware' => ['auth']
]);

