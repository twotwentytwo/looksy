@extends('templates.default')  

@section('title')
  Search results
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
                <p>You searched for "{{ Request::input('query') }}"</p>
                @foreach ($users as $user)
    				@include('user/partials/userblock')
                    @if(Auth::user()->hasFriendRequestPending($user)) 
                        <p class="pending">Pending...</p>
                    @elseif(Auth::user()->hasFriendRequestReceived($user))
                        <a class="btn btn-primary accept" href="{{ route('friend.accept', ['username' => $user->username]) }}">Accept</a>
                    @elseif(Auth::user()->isFriendsWith($user))
                        <form action="{{ route('friend.remove', ['username' => $user->username]) }}" method="post" class="remove">
                            <input type="submit" value="Unfriend" class="unfriend btn btn-primary">
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                        </form>
                    @elseif(Auth::user()->id !== $user->id)
                        <a class="btn btn-primary accept" href="{{ route('friend.add', ['username' => $user->username]) }}">Add friend</a>
                    @endif
    			@endforeach
                @endif            
			</div>
		</div>
	@endif
@stop