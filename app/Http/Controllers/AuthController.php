<?php

namespace Looksy\Http\Controllers;

use Illuminate\Http\Request;
use Looksy\Models\User;
use Illuminate\Support\Facades\Mail;
use Auth;

class AuthController extends Controller
{
	public function getSignup()
	{
		return view('auth.signup');
	}

	public function postSignup(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|unique:users|email|max:255', 
			'username' => 'required|unique:users|alpha_dash|max:20', 
			'password' => 'required|min:6'
		]);

		$image_id = substr($request->input('image'), -37, 36);

		User::create([
			'email' => $request->input('email'), 
			'username' => $request->input('username'),
			'location' => $image_id,
			'password' => bcrypt($request->input('password'))
		]);

		Mail::send('emails.signup', ['name'=> $request->input('username')], function($message) use($request)
        {
            $message->to($request->input('email'), $request->input('username'))->subject('You have signed up to Pick List, welcome.');
        });

		return redirect()
			->route('home')
			->with('info', 'Your account has been created and you can now sign in'); 
	}

	public function getSignin()
	{
		return view('auth.signin');
	}

	public function postSignin(Request $request)
	{
		$this->validate($request, [
			'email' => 'required', 
			'password' => 'required'
		]);

		if(!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))) {
			return redirect()->back()->with('info', 'Could not sign you in with those details');
		}

		return redirect()->route('home')->with('info', 'You are now signed in');
	}

	public function getSignout()
	{
		Auth::logout();

		return redirect()->route('home')->with('info', 'You are now signed out');
	}
}