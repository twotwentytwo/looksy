@extends('templates.default')  

@section('title')
  PickList
@stop

@section('body-class')
  authentication sign-in
@stop

@section('navigation')
@stop

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<p class="strapline">Good things happen when you share.</p>
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
@stop
 		