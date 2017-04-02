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
                
                <form role="search" action="{{ route('search.results') }}">
                    <div class="form-group{{ $errors->has('query') ? ' has-error' : '' }}">
                        <input type="text" name="query" class="form-control search-input" placeholder="Search friends">
                        @if($errors->has('query'))
                            <span class="help-block">{{ $errors->first('query') }}</span>
                        @endif
                    </div>
                    <!--<button type="submit" class="btn btn-default">Search</button>-->
                </form>
            </div>

            <div class="friend-block">
                <!--<h3>Friends</h3>-->
                @if (!$friends->count())
                    <p class="no-friends">You don't have any friends yet. Search above to add.</p>
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

            <!--
            <div class="friend-block requests">
                <h3>People you may know</h3>
                @foreach($friendsOfFriends as $user)
                    <div class="not-yet-friend-of-mine">
                        <div class="media">
                            <a class="pull-left" href="{{ route('profile.index', ['username' =>  $user->username]) }}">
                                @if ($user->location)
                                    <img class="media-object profile-image" src="https://ucarecdn.com/{{ $user->location }}/-/scale_crop/40x40/center/-/quality/best/-/progressive/yes/">
                                @else
                                    <img class="media-object profile-image" src="https://www.gravatar.com/avatar/59b04b6cf46844615d8b2a465427e7f8?s=40&d=mm">
                                @endif
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <a href="{{ route('profile.index', ['username' =>  $user->username]) }}">{{ $user->first_name }} {{ $user->last_name }}</a>
                                </h4>
                            </div>
                            @if ($user->location2)
                                <p class="location">{{ $user->location2 }}</p>
                            @endif
                        </div>
                        <a class="btn btn-primary accept" href="{{ route('friend.add', ['username' => $user->username]) }}">Add</a>
                    </div>
                @endforeach
            </div>
            -->

        </div>
    </div>
@stop  