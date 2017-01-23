<?php

namespace Looksy\Http\Controllers;

use Auth;
use DB;
use Looksy\Models\Status;

class HomeController extends Controller
{
	public function index()
	{
		if(Auth::check()){
			$statuses = Status::notReply()->where(function($query) {
				return $query->where('user_id', Auth::user()->id)
					->orWhereIn('user_id', Auth::user()->friends()->pluck('id')
						);
			})
			->orderBy('created_at', 'desc')
			->paginate(10);

			/* Cold start */
			$picks = DB::table('statuses')
	    		->orderBy('created_at', 'desc')
	    		->take(3)
	    		->get();

			return view('timeline.index')
				->with('statuses', $statuses)
				->with('picks', $picks);
		}

		return view('auth.signin');
	}
}