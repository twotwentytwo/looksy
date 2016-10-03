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

		Mail::send('emails.friendrequest', 
			['name'=> $user->username], 
				function($message) use($user)
    				{
        				$message
        					->to($user->email, $user->username)
        					->subject('You have a new friend request from on Pick List');
    	});

		return redirect()
			->route('profile.index', ['username' => $user->username])
			->with('info', 'Friend request sent');
	}

	public function getRemove($username)
	{	

		$user = User::where('username', $username)->first();
		Auth::user()->removeFriend($user);

		return redirect()
			->route('profile.index', ['username' => $user->username])
			->with('info', 'You are no longer friends');

		
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

	public function postSendToFriend(Request $request)
	{

		$this->validate($request, [
    		'invite' => 'required|max:500'
    	]);

		$email = $request->input('invite');
		
		Mail::send('emails.sendtofriend', ['email' => $email], function($message) use ($email)
		{
        	$message->to($email, 'Tom Kershaw')->subject('Someone wants you to check out Pick List on http://middletonprototype.com - a new mobile app for sharing cultural recommendations with your friends. Check it out today.');
    	});

		return redirect()
			->route('friend.index')
			->with('info', 'Invite to friend sent.');

	}    
}