<!DOCTYPE html>
<html>
    <head>
        <title>Edit profile - PickList</title>
        <!-- Latest compiled and minified CSS -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Looksy css  -->

        <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('css/looksy.css')}}">
            
    </head>
    <body class="edit pick">
        
        <div class="container">
            <nav class="navbar navbar-default" role="navigation">
                <h1>Edit pick</h1>
                @include('templates.partials.navigation')
            </nav>
            @include('templates.partials.alerts')
            <div class="row">
                <div class="col-lg-6">
                    @if($status->source == 'YouTube')
                    <div class="videoWrapper">
                        <iframe src="https://www.youtube.com/embed/{{ $status->item_id }} " frameborder="0" allowfullscreen></iframe>

                    </div>
                    <div class="media">
                        <a class="pull-left" href="{{ route('profile.index', ['username' => $status->user->username]) }}">
                            <img class="media-object profile-image" alt="{{ $status->user->getNameOrUsername() }}" src="{{ $status->user->getAvatarUrl(40) }}">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="{{ route('profile.index', ['username' => $status->user->username]) }}">{{ $status->user->getNameOrUsername() }}</a></h4>
                            <p class="timing">{{ $status->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @else
                        <div class="website-wrapper">
                            <div class="image">
                                <a href="{{ $status->url }}"><img src="{{ $status->image }}" /></a>
                            </div>
                        </div>
                    @endif

                    <form class="form-vertical" role="form" method="post" action="">
                        <div class="form-group{{ $errors->has('title') ? ' has-error': '' }}">
                            <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ $status->title }}">
                        </div>
                        <div class="form-group{{ $errors->has('review') ? ' has-error': '' }}">
                            <input type="text" name="review" class="form-control" id="review" placeholder="Review" value="{{ $status->review }}">
                        </div>

                         <select name="type">
                            <option value="{{ $status->type }}">{{ $status->type }}</option>
                            <option value="film">Film</option>
                            <option value="tv">TV show</option>
                            <option value="video">Video clip</option>
                            <option value="music">Music</option>
                            <option value="podcast">Podcast</option>
                            <option value="web">Web</option>
                            <option value="news">News</option>
                            <option value="app">Mobile app</option>
                            <option value="food">Food &amp; drink</option>
                            <option value="art">Art</option>
                            <option value="book">Book / Writing</option>
                            <option value="shop">Shop</option>
                            <option value="location">Location</option>
                        </select>

                        <div class="form-group">
                            <button type="submit" class="btn btn-default">Update</button>
                        </div>
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                    </form>
                </div>
            </div>
            @if(Auth::user()->id == $user->id)
             <div class="delete-link">
                <a href="{{ route('pick.remove', ['statusId' => $status->id]) }}"><img src="../../img/icons/remove.png" /></a>
            </div>
            <div class="back-link">
                <a href="{{ route('profile.index', ['username' => Auth::user()->username]) }}"><img src="{{asset('img/icons/back.png')}}" /></a>
            </div>
            @endif
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