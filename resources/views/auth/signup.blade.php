<!DOCTYPE html>
<html>
    <head>
        <title>Sign up - PickList</title>
        <!-- Latest compiled and minified CSS -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Looksy css  -->

        <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('css/looksy.css')}}">
			
    </head>
    <body class="authentication">
 		<div class="container">
 			<div class="row">
 				<div class="col-lg-6">
 					<div class="header">
 						<h1>PickList</h1>
 						<p class="strapline">Good things happen when you share.</p>
 					</div>
 				</div>
			    <div class="col-lg-6">
			    	@include('templates.partials.alerts')
			        <form class="form-vertical" role="form" method="post" action="{{ route('auth.signup') }}">
			            <div class="form-group{{ $errors->has('email') ? ' has-error' :''}}">
			                <input type="text" name="email" class="form-control" id="email" placeholder="Email address" value="{{ Request::old('email') ? : '' }}">
			                @if($errors->has('email'))
			                	<span class="help-block">{{ $errors->first('email') }}</span>
			                @endif
			            </div>
			            <div class="form-group{{ $errors->has('username') ? ' has-error' :''}}">
			                <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="{{ Request::old('username') ? : '' }}">
			                @if($errors->has('username'))
			                	<span class="help-block">{{ $errors->first('username') }}</span>
			                @endif
			            </div>
			            <div class="form-group{{ $errors->has('password') ? ' has-error' :''}}">
			                <input type="password" name="password" class="form-control" placeholder="Password" id="password">
			                @if($errors->has('password'))
			                	<span class="help-block">{{ $errors->first('password') }}</span>
			                @endif
			            </div>
			            <div class="form-group">
			                <button type="submit" class="btn btn-default">Sign up</button>
			            </div>
			            <input type="hidden" name="_token" value="{{ Session::token() }}">
			        </form>
			        <p>Signed up? Now try <a class="sign-up" href="{{ route('auth.signup') }}">signing in</a>.</p>
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