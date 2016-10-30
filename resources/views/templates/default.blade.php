<!DOCTYPE html>
<html>
	<head>
		<title>PickList</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="{{asset('css/looksy.css')}}">

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
	</head>
	<body class="@yield('body-class')">
		<nav class="navbar navbar-default" role="navigation">
	        <h1>@yield('title')</h1>
	        @yield('navigation')
		</nav>
		<div class="container">
			@include('templates.partials.alerts')
			@yield('content')
		</div>
	</body>

	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="{{asset('js/looksy.js')}}"></script>
	<script src="{{asset('js/service-worker.js')}}"></script>

	<script>
		UPLOADCARE_LOCALE = 'en';
		UPLOADCARE_LIVE = false;
		UPLOADCARE_PUBLIC_KEY = "74a5ae6645e941547e29";
	</script>
	
	<script charset="utf-8" src="//ucarecdn.com/widget/2.10.0/uploadcare/uploadcare.full.min.js"></script>

	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-84723006-1', 'auto');
		ga('send', 'pageview');
	</script>
</html>