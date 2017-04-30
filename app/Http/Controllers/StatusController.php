<?php

namespace Looksy\Http\Controllers;


use Auth;	
use DB;
use Looksy\Models\User;
use Looksy\Models\Status;
use Looksy\Models\Metadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Fusonic\OpenGraph\Consumer;

class StatusController extends Controller
{

    public function postStatus(Request $request)
    {
    	$this->validate($request, [
    		'status' => 'required|url', 
            'type' => 'required|max:500', 
            'review' => 'required|max:1000'
    	]);

        // WORK OUT IF ITS A YOUTUBE VIDEO 

        $url = $request->input('status');

        if (strpos($url, 'youtube') > 0) {
            $youtube_desktop = true;
            $youtube_mobile = false;
        } elseif(strpos($url, 'youtu.be') > 0) {
            $youtube_desktop = false;
            $youtube_mobile = true;
        } else {
            $youtube_desktop = false;
            $youtube_mobile = false;
        }

        // GET OG TAGS

        $url = $request->input('status');

        $consumer = new Consumer();
        $object = $consumer->loadUrl($url);

        $url = $object->url;
        $title = $object->title;
        $image = (isset($object->images) && !empty($object->images) ? $object->images[0]->url : "/img/template/placeholder_image.png");
        $source = $object->siteName;
        $segment = null;

        // GET YOUTUBE ID IF REQUIRED

        if($youtube_desktop) {
            $url = $request->input('status');
            parse_str(parse_url( $url, PHP_URL_QUERY ), $get_id_from_url );
            $segment = $get_id_from_url['v'];
        } elseif ($youtube_mobile) {
            $url = $request->input('status');
            preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $id);
            $segment = $id[1];
        }

        // CREATE ITEM 

        Auth::user()->statuses()->create([
    		'body' => $request->input('status'), 
            'item_id' => (isset($segment) ? $segment : null), 
            'type' => $request->input('type'),
            'review' => $request->input('review'), 
            'image' => $image, 
            'title' => (isset($title) ? $title : null), 
            'url' => (isset($url) ? $url : null),
            'source' => (isset($source) ? $source : null) 
    	]);

    	return redirect()->route('home');
    }

    public function getAdd()
    {
        $user = Auth::user();

        $statuses_collection = collect($user->statuses()->notReply()->get());
        $statuses = $statuses_collection->reverse();

        return view('add.index')
            ->with('statuses', $statuses)
            ->with('user', $user);
    }

    public function getPicksByCategory($category)
    {
        $statuses = DB::table('statuses')
            ->where('type', $category)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pick.category')
                ->with('statuses', $statuses)
                ->with('category', $category);    
    }

    public function getSearch()
    {
        $user = Auth::user();
        $statuses = DB::table('statuses')->get()->where('parent_id', null);
        return view('search.index')
            ->with('statuses', $statuses);
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

        $user = Auth::user();

        Mail::send('emails.comment', ['name'=> $status->user->username, 'friend' => Auth::user()->username, 'pick' => $status->title, 'id' => $status->id, 'comment' => $reply->body], function($message) use($user, $status)
        {
            $message
                ->to($status->user->email, $user->username)
                ->subject('You have a new comment from '. Auth::user()->username .' on "'. $status->title . '" on Pick List');
        });

    	return redirect()
            ->back();
    }

    public function showPick($statusId)
    {
        $user = Auth::user();
        $status = Status::find($statusId);

        return view('pick.index')
            ->with('status', $status)
            ->with('user', $user)
            ->with('authUserIsFriend', Auth::user()->isFriendsWith($user));
    }

    public function getEditPick($statusId)
    {
        $user = Auth::user();
        $status = Status::find($statusId);
        return view('pick.edit')
            ->with('user', $user)
            ->with('status', $status);
    }

    public function postEditPick(Request $request, $statusId)
    {
        $user = Auth::user();
        $status = Status::find($statusId);

        $title = $request->input('title');
        $type = $request->input('type');
        $review = $request->input('review');

        if(!empty($request->input('image'))) {
            $image = $request->input('image');
        } else {
            $image = $status->image;
        }

        Auth::user()->statuses()
            ->where('id', $statusId)
            ->update([
                'title' => $title, 
                'review' => $review, 
                'type' => $type, 
                'image' => $image
            ]);

        return view('pick.index')
            ->with('info', 'Your pick has been updated')
            ->with('user', $user)
            ->with('status', $status);
    }

    public function postRemovePick($statusId)
    {
        $user = Auth::user();

        $statuses_collection = collect($user->statuses()->notReply()->get());
        $statuses = $statuses_collection->reverse();

        DB::table('statuses')->where('id', $statusId)->delete();

        return view('profile.index')
            ->with('user', $user)
            ->with('statuses', $statuses);
    }
}