<?php

namespace Looksy\Http\Controllers;

use Auth;
use Looksy\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FriendController extends Controller
{
	public function getIndex() 
	{
		$friends = Auth::user()->friends();
		$requests = Auth::user()->friendRequests();

		return view('friends.index')
			->with('friends', $friends)
			->with('requests', $requests);
	}

	public function getAdd($username)
	{	

		

		$user = User::where('username', $username)->first();

		if(!$user) {
			return redirect()
				->route('home')
				->with('info', 'That user could not be found.');
		}

		if(Auth::user()->id == $user->id) {
			return redirect()
				->route('home');
		}

		if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())) {
			return redirect()
				->route('profile.index', ['username' => $user->username])
				->with('info', 'Friend request already pending.');
		}

		if(Auth::user()->isFriendsWith($user)) {
			return redirect()
				->route('profile.index', ['username' => $user->username])
				->with('info', 'You are already friends.');
		}

		Auth::user()->addFriend($user);

		Mail::send('emails.test', ['name'=> 'Tom'], function($message) 
    	{
        	$message->to('tmkersh@gmail.com', 'Some guy')->subject('Welcome!');
    	});

		return redirect()
			->route('profile.index', ['username' => $user->username])
			->with('info', 'Friend request sent');

		
	}

	public function getAccept($username) 
	{	
		$user = User::where('username', $username)->first();

		if(!$user) {
			return redirect()
				->route('home')
				->with('info', 'That user could not be found');
		}

		if(!Auth::user()->hasFriendRequestReceived($user)) {
			return redirect()->route('home');
		}

		Auth::user()->acceptFriendRequest($user);

		return redirect()
			->route('profile.index', ['username' => $username])
			->with('info', 'Friend request accepted');
	}


    
}