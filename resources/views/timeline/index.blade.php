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
	        	<div class="cold-start">
	        		<p>Start sharing your top picks and add some friends. You can have up to 5 picks to keep things fresh.</p>
	        		<p>Latest picks to inspire you.</p>
	        	</div>
	        	@foreach($picks as $pick)
	            	<div class="website-wrapper pick-{{ $pick->type }}">
	            		<div class="type label-{{ $pick->type }}">
	            			<a href="{{ route('pick.category', ['category' => $pick->type]) }}">{{ $pick->type }}</a>
	            		</div>
	            		<div class="image">
	            			<a href="{{ route('pick.index', ['statusId' => $pick->id]) }}"><img src="{{ $pick->image }}" /></a>
	            		</div>
	            		<div class="details">
	            			<p class="title"><a href="{{ route('pick.index', ['statusId' => $pick->id]) }}">{{ $pick->title }}</a></p>	
	            		</div>
	            	</div>
	        	@endforeach
	        @else
	        	@foreach($statuses as $status)
	            	<div class="website-wrapper pick-{{ $status->type }}">
	            		<div class="type label-{{ $status->type }}">
	            			<a href="{{ route('pick.category', ['category' => $status->type]) }}">
	            				<!--<img src="../img/icons/categories/{{ $status->type }}.png" />-->
	            				{{ $status->type }}
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
						<p class="review"><span>"{{ $status->review }}"</span></p>
						<p class="timing">{{ $status->created_at->diffForHumans() }}</p>
	            	</div>
	        	@endforeach
	        	{{ $statuses->render() }}
	        @endif
	    </div>
	</div>
@stop