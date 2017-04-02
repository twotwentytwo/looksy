<?php

namespace Looksy\Http\Controllers;

use Auth;
use DB;
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
			['name'=> $user->username, 'friend' => Auth::user()->username], 
				function($message) use($user)
    				{
        				$message
        					->to($user->email, $user->username)
        					->subject('You have a new friend request from ' . Auth::user()->getNameOrUsername());
    	});

		return redirect()
			->route('friend.index', ['username' => $user->username])
			->with('info', 'Friend request sent');
	}

	public function postRemove($username)
	{	
		$user = User::where('username', $username)->first();

		if(!Auth::user()->isFriendsWith($user)) {
			return redirect()->back();
		}

		Auth::user()->removeFriend($user);

		return redirect()
			->route('friend.index', ['username' => $user->username])
			->with('info', 'Friend removed');
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

		Mail::send('emails.friendrequestaccepted', 
			['name'=> $user->username, 'friend' => Auth::user()->username], 
				function($message) use($user)
    				{
        				$message
        					->to($user->email, $user->username)
        					->subject('Friend request accepted on PickList');
    	});

		return redirect()
			->route('friend.index', ['username' => $username])
			->with('info', 'Friend request accepted');
	}

	public function postSendToFriend(Request $request)
	{

		$this->validate($request, [
    		'invite' => 'required|max:500'
    	]);

    	$name = Auth::user()->getNameOrUsername();

		$email = $request->input('invite');
		
		Mail::send('emails.sendtofriend', ['email' => $email, 'name'=> $name], function($message) use ($email, $name)
		{
        	$message->to($email)->subject('Check out PickList');
    	});

		return redirect()
			->route('friend.index')
			->with('info', 'Invite sent.');

	}    
}