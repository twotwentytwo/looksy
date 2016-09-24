<!DOCTYPE html>
<html>
    <head>
        <title>Pick List</title>
			<!-- Latest compiled and minified CSS -->
			 <meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            
            <!-- Looksy css  -->
            
            <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="{{asset('css/looksy.css')}}">
			
    </head>
    <body>
    	@include('templates.partials.navigation')
 		<div class="container">
 			@include('templates.partials.alerts')
 			@yield('content')
 		</div>
    </body>
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="{{asset('js/looksy.js')}}"></script>
</html>