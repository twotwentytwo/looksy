<?php

namespace Looksy\Http\Controllers;


use Auth;	
use Looksy\Models\User;
use Looksy\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{

    public function postStatus(Request $request)
    {
    	$this->validate($request, [
    		'status' => 'required|max:1000'
    	]);

        // should refactor this and move into a model 

        $id = $request->input('status');
            parse_str(parse_url( $id, PHP_URL_QUERY ), $get_id_from_url );
            //dd($get_id_from_url['v']);

    	Auth::user()->statuses()->create([
    		'body' => $request->input('status'), 
            'item_id' => $get_id_from_url['v']
    	]);

    	return redirect()
    		->route('home')
    		->with('info', 'Status posted');
    }

    public function postReply(Request $request, $statusId)
    {
    	$this->validate($request, [
    		"reply-{$statusId}" => 'required|max:1000'
    	], 
    	[
    		'required' => 'The reply body is required'
    	]);

    	$status = Status::notReply()->find($statusId);

    	if(!$status) {
    		return redirect()->route('home');
    	}

    	if(!Auth::user()->isFriendsWith($status->user) && Auth::user()->id !== $status->user->id) {
    		return redirect()->route('home');
    	}

    	$reply = Status::create([
    		'body' => $request->input("reply-{$statusId}")
    	 ])->user()->associate(Auth::user());

    	$status->replies()->save($reply);

    	return redirect()->back();
    }

    
}