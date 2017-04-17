<!DOCTYPE html>
<html>
    <head>
        <title>PickList</title>
        <!-- Latest compiled and minified CSS -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Looksy css  -->

        <!-- Disable tap highlight on IE -->
        <meta name="msapplication-tap-highlight" content="no">

        <!-- Web Application Manifest -->
        <link rel="manifest" href="/manifest.json">

        <!-- Add to homescreen for Chrome on Android -->
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="application-name" content="PickList">
        <link rel="icon" sizes="192x192" href="/img/touch/chrome-touch-icon-192x192.png">

        <!-- Add to homescreen for Safari on iOS -->
        <!--<meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">-->
        <meta name="apple-mobile-web-app-title" content="PickList">
        <link rel="apple-touch-icon" href="/img/touch/apple-touch-icon.png">

        <!-- Tile icon for Win8 (144x144 + tile color) -->
        <meta name="msapplication-TileImage" content="/img/touch/ms-touch-icon-144x144-precomposed.png">
        <meta name="msapplication-TileColor" content="#ff8d6b">

        <!-- Color the status bar on mobile devices -->
        <meta name="theme-color" content="#ff8d6b">

        <link href="https://fonts.googleapis.com/css?family=Karla:400,400i,700,700i" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('css/looksy.css')}}">
            
    </head>
    @if(Auth::user()->id == $user->id)
        <body class="myprofile">
    @else
        <body class="profile">
    @endif
        <nav class="navbar navbar-default" role="navigation">
            @if(Auth::user()->id == $user->id)
                <h1>My Picks</h1>
            @else
                <h1>{{ $user->getNameOrUsername() }}</h1>
            @endif
            @include('templates.partials.navigation')
            @if(Auth::user()->id == $user->id)
                <div class="edit-link">
                    <a href="{{ route('profile.edit') }}"><img src="{{asset('../img/icons/edit.png')}}" /></a>
                </div>
            @endif
        </nav>
    
        <div class="container">        
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    @include('templates.partials.alerts')
                    @if(!$statuses->count())
                        @if(Auth::user()->id == $user->id)
                            <p class="no-picks-yet-title">You haven't posted and Picks yet.</p>
                            <p class="no-picks-yet-text">Start <a href="{{ route('add.index') }}">sharing your Picks</a> today to inspire your friends.</p>
                        @else
                            <p>{{ $user->getNameOrUsername() }} hasn't posted anything yet.</p>
                        @endif
                        
                    @else
                        @foreach($statuses as $status)
                            <div class="website-wrapper pick pick-{{ $status->type }}">
                                <div class="type label-{{ $status->type }}">
                                    <a href="{{ route('pick.category', ['category' => $status->type]) }}">
                                        {{ $status->type }}
                                    </a>
                                </div>
                                <div class="image">
                                    <a href="{{ route('pick.index', ['statusId' => $status->id]) }}"><img src="{{ $status->image }}" /></a>
                                </div>
                                <div class="details">
                                    <p class="title"><a href="{{ route('pick.index', ['statusId' => $status->id]) }}">{{ $status->title }}</a></p>
                                    @if(!(Auth::user()->id == $user->id))
                                        <p class="review"><span>"{{ $status->review }}"</span></p>
                                    @endif
                                </div>
                                @if(Auth::user()->id == $user->id)
                                    <div class="edit-pick">
                                        <a href="{{ route('pick.edit', ['statusId' => $status->id]) }}">Edit</a>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        @if(Auth::user()->id == $user->id)
                            @if($statuses->count() < 5)
                                <div class="missing">
                                    <p>{{(5-$statuses->count())}} empty {{ (5-$statuses->count()) == 1 ? 'slot' : 'slots' }} left.</p> 
                                    <p>Why not add a pick?</p>
                                </div>
                            @endif
                        @endif
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