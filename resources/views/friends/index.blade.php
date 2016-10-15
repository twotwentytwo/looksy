<!DOCTYPE html>
<html>
    <head>
        <title>Friends - PickList</title>
        <!-- Latest compiled and minified CSS -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Looksy css  -->

        <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('css/looksy.css')}}">
            
    </head>
    <body class="friends">
        <div class="container">
            <nav class="navbar navbar-default" role="navigation">
                <h1>Friends</h1>
                @include('templates.partials.navigation')
            </nav>
            @include('templates.partials.alerts')
            <div class="row">
                <div class="col-lg-6">
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
                </div>
                <div class="col-lg-6">
                    <h3>Friend requests</h3>
                    <div class="friend-block requests">
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
                </div>
                <div class="col-lg-6">
                    <h3>Search friends</h3>
                    <form class="navbar-form navbar-left search-form" role="search" action="{{ route('search.results') }}">
                        <div class="form-group{{ $errors->has('query') ? ' has-error' : '' }}">
                            <input type="text" name="query" class="form-control" placeholder="Enter friends name">
                            @if($errors->has('query'))
                                <span class="help-block">{{ $errors->first('query') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-default">Search</button>
                    </form>
                </div>
                <div class="col-lg-6">
                    <h3>Invite friends</h3>
                    <div class="friend-block">
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
        </div>
    </body>
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <script src="{{asset('js/looksy.js')}}"></script>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-84723006-1', 'auto');
      ga('send', 'pageview');

    </script>
</html>