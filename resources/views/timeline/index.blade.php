@extends('templates.default')

@section('content')

	<div class="row">
	    <div class="col-lg-5">
	        @if(!$statuses->count())
	        	<p>There's nothing in your timeline yet</p>
	        @else
	        	@foreach($statuses as $status)
	            	<div class="website-wrapper">
	            		<div class="image">
	            			<a href="{{ route('pick.index', ['statusId' => $status->id]) }}"><img src="{{ $status->image }}" /></a>
	            		</div>
	            		<div class="details">
	            			<p class="source"><a href="{{ route('pick.index', ['statusId' => $status->id]) }}">{{ $status->source }}</a></p>
	            			<p class="title"><a href="{{ route('pick.index', ['statusId' => $status->id]) }}">{{ $status->title }}</a></p>
	            			<p class="timing">{{ $status->created_at->diffForHumans() }}</p>
	            		</div>
	            	</div>
	        		<div class="media">
					    <a class="pull-left" href="{{ route('profile.index', ['username' => $status->user->username]) }}">
					        <img class="media-object profile-image" alt="{{ $status->user->getNameOrUsername() }}" src="{{ $status->user->getAvatarUrl() }}">
					    </a>
					    <div class="media-body">
					        <h4 class="media-heading"><a href="{{ route('profile.index', ['username' => $status->user->username]) }}">{{ $status->user->getNameOrUsername() }}</a></h4>
					    </div>
					</div>
	        	@endforeach

	        	{!! $statuses->render() !!}
	        @endif
	    </div>
	</div>
@stop