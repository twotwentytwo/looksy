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
        <div class="col-md-6 col-md-offset-3 row-inner">

            <div class="friend-block">
                <form role="search" action="{{ route('search.results') }}">
                    <div class="form-group{{ $errors->has('query') ? ' has-error' : '' }}">
                        <input type="text" name="query" class="form-control search-input" placeholder="Search friends">
                        @if($errors->has('query'))
                            <span class="help-block">{{ $errors->first('query') }}</span>
                        @endif
                    </div>
                </form>
            </div>

            <div class="friend-block">
                @if (!$friends->count())
                    <!-- <p class="no-friends">Connect with your friends.</p> -->
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
            
            @if ($requests->count() !== 0)
                <div class="friend-block requests">
                    <h3>Friend requests</h3>
                    @if (!$requests->count())
                        <p class="no-friend-requests">You have no friend requests.</p>
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
            @endif

        </div>
    </div>
@stop  