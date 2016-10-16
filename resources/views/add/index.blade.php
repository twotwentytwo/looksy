<!DOCTYPE html>
<html>
    <head>
        <title>Add pick - PickList</title>
        <!-- Latest compiled and minified CSS -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Looksy css  -->

        <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('css/looksy.css')}}">
			
    </head>
    <body class="add-page">
 		<div class="container">
 			<nav class="navbar navbar-default" role="navigation">
          <h1>Add pick</h1>
          @include('templates.partials.navigation')
      </nav>
 			@include('templates.partials.alerts')
 			<div class="row">
			    <div class="col-lg-6">
            @if(Auth::user()->statuses()->notReply()->count() >= 10)
              <p>You already have your top 10 picks... To add another you must remove an existing pick on your <a href="{{ route('profile.index', ['username' => Auth::user()->username]) }}">profile</a> page.</p>
            @else
              <form role="form" action="{{ route('status.post') }}" method="post" class="add-form">
                <h3>Paste in a URL</h3>
                <p>Share something to inspire your friends.</p>
                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                  <input placeholder="URL goes here" name="status" class="form-control add">
                  @if($errors->has('status'))
                    <span class="help-block">{{ $errors->first('status') }}</span>
                  @endif
                </div>

              <div class="preview">
                <h3>Preview</h3>
                <img src="" class="image" />
                <p class="title"></p>
              </div>

              <h3>Add details</h3>
              <p>Add a category and a review for your friends.</p>

              <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                <select name="type">
                  <option value="">Choose category</option>
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
                @if($errors->has('category'))
                  <span class="help-block">{{ $errors->first('category') }}</span>
                @endif
              </div>
                <div class="form-group{{ $errors->has('review') ? ' has-error' : '' }}">
                  <textarea placeholder="Add a mini review" name="review" class="form-control add" rows="2"></textarea>
                  @if($errors->has('review'))
                    <span class="help-block">{{ $errors->first('review') }}</span>
                  @endif
                </div>
                <button type="submit" class="btn btn-default">Share</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
  			      </form>
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