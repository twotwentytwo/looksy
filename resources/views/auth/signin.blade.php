<!DOCTYPE html>
<html>
    <head>
        <title>Sign in - PickList</title>
        <!-- Latest compiled and minified CSS -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Disable tap highlight on IE -->
		<meta name="msapplication-tap-highlight" content="no">

		<!-- Web Application Manifest -->
		<link rel="manifest" href="manifest.json">

		<!-- Add to homescreen for Chrome on Android -->
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="application-name" content="Pick List">
		<link rel="icon" sizes="192x192" href="img/touch/chrome-touch-icon-192x192.png">

		<!-- Add to homescreen for Safari on iOS -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta name="apple-mobile-web-app-title" content="Web Starter Kit">
		<link rel="apple-touch-icon" href="img/touch/apple-touch-icon.png">

		<!-- Tile icon for Win8 (144x144 + tile color) -->
		<meta name="msapplication-TileImage" content="img/touch/ms-touch-icon-144x144-precomposed.png">
		<meta name="msapplication-TileColor" content="#ff8d6b">

		<!-- Color the status bar on mobile devices -->
		<meta name="theme-color" content="#ff8d6b">
        <!-- Looksy css  -->

        <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('css/looksy.css')}}">
			
    </head>
    <body class="authentication sign-in">
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
			        <form class="form-vertical" role="form" method="post" action="{{ route('auth.signin') }}">
			            <div class="form-group">
			                <input type="text" name="email" class="form-control" id="email" placeholder="Email address">
			            </div>
			            <div class="form-group">
			                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
			            </div>
			            <div class="checkbox">
			                <label><input type="checkbox" name="remember">Remember me</label>
			            </div>
			            <div class="form-group">
			                <button type="submit" class="btn btn-default">Sign in</button>
			            </div>
			            <input type="hidden" name="_token" value="{{ Session::token() }}">
			        </form>
			        <p>No account? <a class="sign-up" href="{{ route('auth.signup') }}">Sign up</a>, it's free!</p>
			    </div>
			</div>
 		</div>
    </body>
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	  <script src="{{asset('js/looksy.js')}}"></script>
	  <script src="{{asset('js/service-worker.js')}}"></script>

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-84723006-1', 'auto');
      ga('send', 'pageview');

    </script>
</html>