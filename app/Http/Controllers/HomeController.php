<?php

namespace Looksy\Http\Controllers;

use Auth;
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
			->paginate(5);

			//dd($statuses);

			return view('timeline.index')
				->with('statuses', $statuses);
		}

		return view('home');
	}
}