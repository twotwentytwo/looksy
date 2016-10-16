<!DOCTYPE html>
<html>
    <head>
        <title>{{ $status->title }} - PickList</title>
        <!-- Latest compiled and minified CSS -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Looksy css  -->
        <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('css/looksy.css')}}">
    </head>
    <body class="pick">
        <div class="container">
            @include('templates.partials.alerts')
            <div class="row">
                <nav class="navbar navbar-default" role="navigation">
                    <h1>PickList</h1>
                    @include('templates.partials.navigation')
                </nav>
                <div class="col-lg-5">
                    @if($status->source == 'YouTube')
                        <div class="videoWrapper">
                            <iframe src="https://www.youtube.com/embed/{{ $status->item_id }} " frameborder="0" allowfullscreen></iframe>
                        </div>
                    @else
                        <div class="website-wrapper">
                            <div class="type {{ $status->type }}">
                                <a href="{{ route('pick.category', ['category' => $status->type]) }}">
                                    <img src="../img/icons/categories/{{ $status->type }}.png" />
                                </a>
                            </div>
                            <div class="image">
                                <a href="{{ $status->url }}" target="_blank"><img src="{{ $status->image }}" /></a>
                            </div>
                            <div class="details">
                                <p class="title"><a target="_blank" href="{{ $status->url }}">{{ $status->title }}</a> @if(isset($status->source)) @ {{ $status->source }} @endif</p>
                            </div>        
                        </div>
                    @endif
                        <div class="review">
                            <div class="media user">
                                <a class="pull-left" href="{{ route('profile.index', ['username' => $status->user->username]) }}">
                                    <img class="media-object profile-image" alt="{{ $status->user->getNameOrUsername() }}" src="{{ $status->user->getAvatarUrl('40') }}">
                                </a>
                            </div>
                            <div class="comment">
                                <p class="text">{{ $status->review }}</p>
                                <p class="timing">{{ $status->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        @foreach($status->replies as $reply)
                            <div class="media reply">
                                <a class="pull-left" href="{{ route('profile.index', ['username' => $reply->user->username]) }}">
                                    <img class="media-object  profile-image" alt="{{ $reply->user->getNameOrUsername() }}" src="{{ $reply->user->getAvatarUrl('40') }}">
                                </a>
                                <div class="media-body comment">
                                    <p class="text">{{ $reply->body }}</p>
                                    <p class="timing">{{ $reply->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                        @if(Auth::user()->isFriendsWith($status->user) || Auth::user()->id == $user->id)
                            <form role="form" action="{{ route('status.reply', ['statusId' => $status->id]) }}" method="post" class="form-reply">
                                <div class="form-group{{ $errors->has("reply-{$status->id}") ? ' has-error': '' }}">
                                    <textarea name="reply-{{ $status->id }}" class="form-control" rows="2" placeholder="Reply to this"></textarea>
                                    @if($errors->has("reply-{$status->id}"))
                                        <span class="help-block">{{ $errors->first("reply-{$status->id}") }}</span> 
                                    @endif
                                </div>
                                <input type="submit" value="Reply" class="btn btn-default btn-sm">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                            </form>
                        @endif
                    </div>
                </div>
                <div class="back-link">
                    <a href="{{ url()->previous() }}"><img src="{{asset('../img/icons/back.png')}}" /></a>
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