@extends('templates.default')

@section('body-class')
  home 
  @if($user_statuses_count == 0)
  	cold-start
  @endif
@stop

@section('navigation')
    @include('templates.partials.navigation')
@stop

@section('title')
    PickList
@stop

@section('content')
	
	<div class="row">
	    <div class="col-md-6 col-md-offset-3 row-inner">
	        @if($user_statuses_count == 0)
	        	<div class="cold-start">
	        		<div class="page-1">
	        			<div class="section-top">
	        				<h1><img src="/img/template/logo_white.png"></h1>
	        				<p>Whether you're raving about a film, a must-see exhibition or the best new pizza in town, great things happen when you share.</p>
						</div>
						<div class="section-bottom">
							<p>PickList – inspire friends and keep your finger on the pulse by sharing Picks with people you know.</p>
							<div class="align-button">
								<button type="submit" class="button"><a href="#" class="got-it">Got it!</a></button>
							</div>
						</div>
						
					</div>
					<div class="page-2">
						<div class="section-top">
							<h1><img src="/img/template/logo_white.png"></h1>
	        				<p>Only connecting with people you know means that your feed will only ever feature Picks from people whose opinions you trust.</p>
						</div>
						<div class="section-bottom">
							<p>We limit the number of Picks you can upload to five at a time. This helps to ensure a curated feed packed with quality Picks – it also keeps things nice and fresh.</p>
							<div class="align-button">
								<button type="submit" class="button"><a href="#" class="ok-great">OK great!</a></button>
							</div>
						</div>
					</div>
					<div class="page-3">
						<h1><img src="/img/template/logo_black.png"></h1>
						<p>Let’s get connected with some friends...</p>
			            <div class="friend-block">
			                <form role="search" action="{{ route('search.results') }}">
			                    <div class="form-group{{ $errors->has('query') ? ' has-error' : '' }}">
			                        <input type="text" name="query" class="form-control search-input" placeholder="Search friends">
			                        @if($errors->has('query'))
			                            <span class="help-block">{{ $errors->first('query') }}</span>
			                        @endif
			                    </div>
			                </form>
			            </div>
			            <div class="align-button">
							<button type="submit" class="button"><a href="/add" class="lets-begin">Let's begin!</a></button>
						</div>
			        </div>
	        	</div>
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