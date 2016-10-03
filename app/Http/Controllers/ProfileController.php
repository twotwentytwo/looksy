<?php

namespace Looksy\Http\Controllers;

use Auth;
use Looksy\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function getProfile($username)
    {
    	$user = User::where('username', $username)->first();

    	if(!$user) {
    		abort(404);
    	}

        $statuses = $user->statuses()->notReply()->get();

    	return view('profile.index')
            ->with('user', $user)
            ->with('statuses', $statuses)
            ->with('authUserIsFriend', Auth::user()->isFriendsWith($user));
    }

    public function getPostEdit() 
    {
    	return view('profile.edit');
    }

    public function postPostEdit(Request $request) 
    {

    	$this->validate($request, [
			'first_name' => 'alpha|max:50', 
			'last_name' => 'alpha|max:50', 
			'location' => 'max:20'
		]);

        Auth::user()->update([
            'first_name' => $request->input('first_name'), 
            'last_name' => $request->input('last_name'), 
            'location' => $request->input('location')
        ]);
       
        $file = $request->file('image');
        $filename = 'profile_' . strtolower($request->input('first_name')) . '.png';
        if($file) {
            Storage::disk('public')->put($filename, File::get($file));
        }

		return redirect()
			->route('profile.edit')
			->with('info', 'Your profile has been updated');
    }

    public function getUserImage($filename) 
    {
        $file = Storage::disk('public')->get($filename);
        return new Response($file, 200);
    }
}