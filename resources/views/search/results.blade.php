@extends('templates.default')  

@section('title')
  {{ Request::input('query') }}
@stop

@section('body-class')
  search
@stop

@section('navigation')
    @include('templates.partials.navigation')
@stop

@section('content')
	
	@if(!$users->count() && !$statuses->count())
		<p>No results found, sorry.</p>
	@else
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
    			@if(!$users->count())
                    <p>Cannot find any friends called "{{ Request::input('query') }}".</p>
                    <p>Try <a href="{{ route('friend.index') }}">searching</a> again...</p>
                @else
                @foreach ($users as $user)
    				@include('user/partials/userblock')
                    @if(Auth::user()->hasFriendRequestPending($user)) 
                        <p>Waiting for {{ $user->getNameOrUsername() }} to accept your request.</p>
                    @elseif(Auth::user()->hasFriendRequestReceived($user))
                        <a class="btn btn-primary accept" href="{{ route('friend.accept', ['username' => $user->username]) }}">Accept</a>
                    @elseif(Auth::user()->isFriendsWith($user))
                        <p>You and {{ $user->getNameOrUsername() }} are friends.</p>
                    @elseif(Auth::user()->id !== $user->id)
                        <a class="btn btn-primary accept" href="{{ route('friend.add', ['username' => $user->username]) }}">Add</a>
                    @endif
    			@endforeach
                @endif            
			</div>
		</div>
	@endif
@stop