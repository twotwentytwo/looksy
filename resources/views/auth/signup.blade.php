@extends('templates.default')  

@section('title')
  PickList
@stop

@section('body-class')
  authentication sign-up
@stop

@section('navigation')
@stop

@section('content')
	<div class="row">
		<div class="col-lg-6">
			<p class="strapline">Good things happen when you share.</p>
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
		            <button type="submit" class="btn btn-default">Create account</button>
		        </div>
		        <input type="hidden" name="_token" value="{{ Session::token() }}">
		    </form>
		    <p>Signed up? Now try <a class="sign-up" href="{{ route('auth.signin') }}">signing in</a>.</p>
		</div>
	</div>
@stop
 		