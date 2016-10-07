<!DOCTYPE html>
<html>
    <head>
        <title>{{ $user->getNameOrUsername() }}'s picks - PickList</title>
        <!-- Latest compiled and minified CSS -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Looksy css  -->

        <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('css/looksy.css')}}">
            
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-default" role="navigation">
                <h1>{{ $user->getNameOrUsername() }}</h1>
                @include('templates.partials.navigation')
                
                @if(Auth::user()->id == $user->id)
                    <div class="edit-link">
                        <a href="{{ route('profile.edit') }}"><img src="{{asset('../img/icons/edit.png')}}" /></a>
                    </div>
               @endif
            </nav>
            <div class="row">
                <div class="col-lg-5">
                    @include('templates.partials.alerts')
                    @if(!$statuses->count())
                        <p>{{ $user->getNameOrUsername() }} hasn't posted anything yet</p>
                    @else
                        @foreach($statuses as $status)
                            <div class="website-wrapper">
                                <div class="type {{ $status->type }}">
                                    <a href="{{ route('pick.category', ['category' => $status->type]) }}">
                                        <img src="../img/icons/categories/{{ $status->type }}.png" />
                                    </a>
                                </div>
                                <div class="image">
                                    <a href="{{ route('pick.index', ['statusId' => $status->id]) }}"><img src="{{ $status->image }}" /></a>
                                </div>
                                <div class="details">
                                    <p class="title"><a href="{{ route('pick.index', ['statusId' => $status->id]) }}">{{ $status->title }}</a></p>
                                    <p class="review">"{{ $status->review }}"</p>
                                </div>
                                <p class="timing">{{ $status->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @endif
                </div>
                <hr>
                <div class="col-lg-4 col-lg-offset-3">
                    @if(Auth::user()->hasFriendRequestPending($user)) 
                        <p>Waiting for {{ $user->getNameOrUsername() }} to accept your request.</p>
                    @elseif(Auth::user()->hasFriendRequestReceived($user))
                        <a class="btn btn-primary" href="{{ route('friend.accept', ['username' => $user->username]) }}">Accept friend request</a>
                    @elseif(Auth::user()->isFriendsWith($user))
                        <p>You and {{ $user->getNameOrUsername() }} are friends.</p>

                        <form action="{{ route('friend.remove', ['username' => $user->username]) }}" method="post">
                            <input type="submit" value="Unfriend" class="unfriend">
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
                        </form>
                    @elseif(Auth::user()->id !== $user->id)
                        <a class="btn btn-primary" href="{{ route('friend.add', ['username' => $user->username]) }}">Add as friend</a>
                    @endif
                    <h3>Friends</h3>
                    @if (!$user->friends()->count())
                        <p>{{ $user->getFirstNameOrUsername() }} has no friends.</p>
                    @else
                        @foreach($user->friends() as $user)
                            @include('user/partials/userblock')
                        @endforeach
                    @endif
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