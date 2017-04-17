@extends('templates.default')  

@section('body-class')
  authentication sign-in
@stop

@section('navigation')
@stop

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h1>PickList</h1>
			<p class="strapline">Great things happen when we share.</p>
		    <form class="form-vertical" role="form" method="post" action="{{ route('auth.signin') }}">
		    	@include('templates.partials.alerts')
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
		        	<p class="forgot_password"><a href="{{ route('auth.recover') }}">Forgot password?</a></p>
		        </div>
		        <div class="form-group sign-in">
		            <button type="submit" class="btn btn-default">Sign in</button>
		        </div>
		        <input type="hidden" name="_token" value="{{ Session::token() }}">
		    </form>
		    <p class="sign-up-cta">No account? It's free!<br><a class="sign-up" href="{{ route('auth.signup') }}">Sign Up</a></p>
		</div>
	</div>
@stop
 		