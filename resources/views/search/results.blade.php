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
		

        <div class="friend-block invite-friends">
            <h3>We can't find anyone by that name</h3>
            <p class="no-friend-requests">Enter their email address and we’ll send them an invite.</p>
            <div class="friend-block">
                <form role="form" action="{{ route('emails.sendtofriend') }}" method="post">
                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        <input placeholder="Their email address" name="invite" class="form-control add">
                    </div>
                    <div class="invite button">
                        <input type="submit" value="Invite" class="invite btn btn-primary">
                    </div>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
                @include('templates.partials.alerts')
            </div>
        </div>
        <div class="back-link">
            <a onclick="window.history.back()"><img src="{{asset('img/icons/back.png')}}" /></a>
        </div>
	@else
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
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
                      
			</div>
		</div>
	@endif
@stop