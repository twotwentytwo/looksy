<?php

namespace Looksy\Http\Controllers;


use Auth;	
use DB;
use Looksy\Models\User;
use Looksy\Models\OpenGraph;
use Looksy\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StatusController extends Controller
{

    public function postStatus(Request $request)
    {
    	$this->validate($request, [
    		'status' => 'required|max:500', 
            'type' => 'required|max:500', 
            'review' => 'required|max:1000'
    	]);

        // CALCULATE TYPE FROM URL

        $url = $request->input('status');

        if (strpos($url, 'youtube') > 0) {
            $type = 'YouTube';
        } elseif (strpos($url, 'spotify') > 0) {
            $type = 'Spotify';
        } else {
            $type = 'Web';
        }

        $url = $request->input('status');
        $site_html = file_get_contents($url);
        $matches = null;
        preg_match_all('~<\s*meta\s+property="(og:[^"]+)"\s+content="([^"]*)~i', $site_html,$matches);
        $ogtags = array();
        for($i = 0; $i<count($matches[1]); $i++)
        {
            $ogtags[$matches[1][$i]]=$matches[2][$i];
        }

        $url = (empty($ogtags['og:url'])) ? null : $ogtags['og:url'];
        $title = (empty($ogtags['og:title'])) ? null : $ogtags['og:title'];
        //$description = (empty($ogtags['og:description'])) ? null : $ogtags['og:description'];
        $image = (empty($ogtags['og:image'])) ? null : $ogtags['og:image'];
        $source = (empty($ogtags['og:site_name'])) ? 'Web' : $ogtags['og:site_name'];
        $segment = null;
        
        // PREPARE THE ID TO BE SAVED 

        if($type == 'YouTube') {

            $url = $request->input('status');
            parse_str(parse_url( $url, PHP_URL_QUERY ), $get_id_from_url );
            $segment = $get_id_from_url['v'];
            $source = 'YouTube';

        }

        Auth::user()->statuses()->create([
    		'body' => $request->input('status'), 
            'item_id' => $segment, 
            'type' => $request->input('type'),
            'review' => $request->input('review'), 
            'image' => $image, 
            'title' => $title, 
            'url' => $url,
            //'description' => $description, 
            'source' => $source, 
    	]);

    	return redirect()->route('home');
    }

    public function getAdd()
    {
        return view('add.index');
    }

    public function getPicksByCategory($category)
    {
        $statuses = DB::table('statuses')->get()
            ->where('type', $category);

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

        Mail::send('emails.comment', ['name'=> $status->user->username, 'friend' => Auth::user()->username, 'pick' => $status->title, 'id' => $status->id], function($message) use($user, $status)
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

        Auth::user()->statuses()
            ->where('id', $statusId)
            ->update([
                'title' => $title, 
                'review' => $review, 
                'type' => $type
            ]);

        return view('pick.index')
            ->with('info', 'Your pick has been updated')
            ->with('user', $user)
            ->with('status', $status);
    }

    public function postRemovePick($statusId)
    {
        $user = Auth::user();
        $statuses = $user->statuses()->notReply()->get();

        DB::table('statuses')->where('id', $statusId)->delete();

        return view('profile.index')
            ->with('info', 'Your pick has been removed')
            ->with('statuses', $statuses)
            ->with('user', $user);
    }

    
}