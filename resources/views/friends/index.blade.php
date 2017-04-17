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
        </div>
    </div>
@stop  