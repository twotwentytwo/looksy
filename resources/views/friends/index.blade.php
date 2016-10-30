@extends('templates.default')  

@section('title')
  Friends
@stop

@section('body-class')
  friends
@stop

@section('navigation')
    @include('templates.partials.navigation')
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="friend-block">
                @if (!$friends->count())
                    <p>You don't have any friends yet.</p>
                @else
                    @foreach($friends as $user)
                        <div class="friend-of-mine">
                            @include('user/partials/userblock')
                            @if(Auth::user()->isFriendsWith($user))
                                <form action="{{ route('friend.remove', ['username' => $user->username]) }}" method="post">
                                    <input type="submit" value="Unfriend" class="unfriend btn btn-primary">
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                </form>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
            
            <div class="friend-block requests">
            <h3>Friend requests</h3>
                @if (!$requests->count())
                    <p>You have no friend requests.</p>
                @else
                    @foreach($requests as $user)
                        <div class="not-yet-friend-of-mine">
                            @include('user.partials.userblock')
                            @if(Auth::user()->hasFriendRequestReceived($user))
                                <a class="btn btn-primary accept" href="{{ route('friend.accept', ['username' => $user->username]) }}">Accept</a>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>

            <div class="friend-block">
                <h3>Search friends</h3>
                <form role="search" action="{{ route('search.results') }}">
                    <div class="form-group{{ $errors->has('query') ? ' has-error' : '' }}">
                        <input type="text" name="query" class="form-control" placeholder="Enter friends name">
                        @if($errors->has('query'))
                            <span class="help-block">{{ $errors->first('query') }}</span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                </form>
            </div>

            
            <div class="friend-block">
                <h3>Invite friends</h3>
                <form role="form" action="{{ route('emails.sendtofriend') }}" method="post">
                    <div class="form-group{{ $errors->has('invite') ? ' has-error' : '' }}">
                        <input placeholder="Type in friends email here" name="invite" class="form-control add">
                        @if($errors->has('invite'))
                            <span class="help-block">{{ $errors->first('invite') }}</span>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-default">Invite</button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
            </div>
        </div>
    </div>
@stop  