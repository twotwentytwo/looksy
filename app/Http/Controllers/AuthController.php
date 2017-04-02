<?php

namespace Looksy\Http\Controllers;

use Illuminate\Http\Request;
use Looksy\Models\User;
use Illuminate\Support\Facades\Mail;
use Auth;
use Illuminate\Support\Facades\Hash;

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
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255', 
			'password' => 'required|min:6'
		]);

		$image_id = substr($request->input('image'), -37, 36);

		User::create([
			'email' => $request->input('email'), 
			'username' => $request->input('username'),
			'first_name' => $request->input('first_name'),
			'last_name' => $request->input('last_name'),
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

	public function getRecover()
	{
		return view('auth.recover');
	}

	public function postRecover(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email'
		]);

		$user = User::where('email', $request->email)->first();

		if(!$user) {
			return redirect()->route('auth.recover')->with('info', 'Could not find that user');
		} else {
			$identifier = str_random(128);
			$user->update([
				'recover_hash' => bcrypt($identifier), 
			]);
			Mail::send('emails.recover', ['user'=> $user, 'identifier'=> $identifier], function($message) use($user)
	        {
	            $message->to($user->email);
	            $message->subject('PickList recover your password');
	        });
			return redirect()->route('home')->with('info', 'An email has been sent with a reset link');
		}
	}

	public function getReset(Request $request)
	{
		$email = $request->email;
		$identifier = $request->identifier;
		$hashedIdentifier = bcrypt($request->identifier);
		$user = User::where('email', $request->email)->first();

		if(!$user) {
			return redirect()->route('home');
		} 
		if(!$user->recover_hash) {
			return redirect()->route('home');
		} 

		/* ERROR HERE, NEEDS REFACTOR */

		if(Hash::check($user->recover_hash, $hashedIdentifier)) {
			return redirect()->route('home');
		} 

		/* ERROR HERE, NEEDS REFACTOR */

		return view('auth.reset')
            ->with('email', $user->email)
            ->with('identifier', $identifier);
	}

	public function postReset(Request $request)
	{	
		$email = $request->email;
		$identifier = $request->identifier;

		$password = $request->password;
		$passwordConfirm = $request->confirm_password;

		$hashedIdentifier = bcrypt($request->identifier);

		$user = User::where('email', $request->email)->first();

		if(!$user) {
			return redirect()->route('home');
		} 
		if(!$user->recover_hash) {
			return redirect()->route('home');
		} 

		/* ERROR HERE, NEEDS REFACTOR */

		if(Hash::check($user->recover_hash, $hashedIdentifier)) {
			return redirect()->route('home');
		} 

		/* ERROR HERE, NEEDS REFACTOR */

		$this->validate($request, [
			'password' => 'required|min:6', 
			'confirm_password' => 'required|same:password'
		]);

		$user->update([
                'password' => bcrypt($password), 
                'recover_hash' =>  null
        ]);

        return redirect()->route('auth.signin')->with('info', 'Your password has been reset, you can now sign in with your new password.');
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