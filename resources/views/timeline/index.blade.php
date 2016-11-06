@extends('templates.default')  

@section('title')
  PickList
@stop

@section('body-class')
  home
@stop

@section('navigation')
    @include('templates.partials.navigation')
@stop

@section('content')
	<div class="row">
	    <div class="col-md-6 col-md-offset-3">
	        @if(!$statuses->count())
	        	<h3>Get started</h3>
	        	<ol>
	        		<li>First of all you want to add some <a href="{{ route('friend.index') }}">friends</a> - they may have already posted some picks you might like... If they don't have a PickList account, invite them to join.</li>
	        		<li>You can start <a href="{{ route('add.index') }}">sharing your top picks</a> to inspire your friends right away.</li>
	        		<li>You can have up to 5 picks. If you already have 5, then you have to remove one to add more.</li>
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
	            			<p class="title"><a href="{{ route('pick.index', ['statusId' => $status->id]) }}">{{ $status->title }}</a></p>	
	            			<!--<p class="review"><span>"{{ $status->review }}"</span></p>-->
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
						<p class="review">"{{ $status->review }}"</p>
						<p class="timing">{{ $status->created_at->diffForHumans() }}</p>
	            	</div>
	        	@endforeach
	        	{{ $statuses->render() }}
	        @endif
	    </div>
	</div>
@stop