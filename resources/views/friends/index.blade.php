@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-6">
         <form class="navbar-form navbar-left" role="search" action="{{ route('search.results') }}">
                <div class="form-group">
                    <input type="text" name="query" class="form-control" placeholder="Find friends">
                </div>
                <button type="submit" class="btn btn-default">Search</button>
            </form>
        </div>
        <div class="col-lg-6">
            <h3>Your friends</h3>

            @if (!$friends->count())
                <p>You have no friends.</p>
            @else
            @foreach($friends as $user)
                @include('user/partials/userblock')
            @endforeach

        @endif
        </div>
        <div class="col-lg-6">
            <h3>Your friend requests</h3>
            
            @if (!$requests->count())
                <p>You have no friend requests.</p>
            @else
                @foreach($requests as $user)
                    @include('user.partials.userblock')
                @endforeach
            @endif
        </div>
    </div>
@stop