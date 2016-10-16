<!DOCTYPE html>
<html>
    <head>
        <title>Home - PickList</title>
        <!-- Latest compiled and minified CSS -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Looksy css  -->

        <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('css/looksy.css')}}">
			
    </head>
    <body class="home">
    	<nav class="navbar navbar-default" role="navigation">
	        <h1>PickList</h1>
	        @include('templates.partials.navigation')
		</nav>
 		<div class="container">
 			@include('templates.partials.alerts')
 			<div class="row">
			    <div class="col-lg-5">
			        @if(!$statuses->count())
			        	<h3>Get started</h3>
			        	<ol>
			        		<li>First of all you want to add some <a href="{{ route('friend.index') }}">friends</a> - they may have already posted some picks you might like...</li>
			        		<li>You can start <a href="{{ route('add.index') }}">sharing your top picks</a> to inspire your friends right away.</li>
			        		<li>You can have up to 10 picks. If you already have 10, then you have to remove one to add more.</li>
			        	</ol>
			        @else
			        	@foreach($statuses as $status)
			            	<div class="website-wrapper {{ $status->type }}">
			            		<div class="type {{ $status->type }}">
			            			<a href="{{ route('pick.category', ['category' => $status->type]) }}">
			            				<img src="../img/icons/categories/{{ $status->type }}.png" />
			            			</a>
			            		</div>
			            		<div class="image">
			            			<a href="{{ route('pick.index', ['statusId' => $status->id]) }}"><img src="{{ $status->image }}" /></a>
			            		</div>
			            		<div class="details">
			            			<p class="title"><a href="{{ route('pick.index', ['statusId' => $status->id]) }}"><span>{{ $status->title }}</span></a>@if(isset($status->source)) @ {{ $status->source }}@endif</p>	
			            			<p class="review"><span>"{{ $status->review }}"</span></p>
			            		</div>
			            		@if($status->replies()->count())
				            		<div class="comments">
				            			<img src="{{asset('img/icons/comments.png')}}" />
				            			<p class="count">{{ $status->replies()->count() }}</p>
				            		</div>
			            		@endif
			            		<div class="media user">
                                    <a class="pull-left" href="{{ route('profile.index', ['username' => $status->user->username]) }}">
                                        <img class="media-object profile-image" alt="{{ $status->user->getNameOrUsername() }}" src="{{ $status->user->getAvatarUrl('40') }}">
                                    </a>
								    <div class="media-body">
								        <h4 class="media-heading username"><a href="{{ route('profile.index', ['username' => $status->user->username]) }}">{{ $status->user->getNameOrUsername() }}</a></h4>
								    </div>
								</div>
								<p class="timing">{{ $status->created_at->diffForHumans() }}</p>
			            	</div>
			        	@endforeach
			        	{{ $statuses->render() }}
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