@extends('templates.default')  

@section('body-class')
  authentication reset
@stop

@section('navigation')
@stop

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h1>PickList</h1>
			<p class="strapline">Good things happen when we share.</p>
		    <form class="form-vertical" role="form" method="post" action="{{ route('auth.reset') }}?email={{ $email }}&identifier={{ urlencode($identifier) }}" autocomplete="off">
		        <div class="form-group">
		            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
		            @if($errors->has('password'))
		            	<span class="help-block">{{ $errors->first('password') }}</span>
		            @endif
		        </div>
		         <div class="form-group">
		            <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Password">
		            @if($errors->has('confirm_password'))
		            	<span class="help-block">{{ $errors->first('confirm_password') }}</span>
		            @endif
		        </div>
		        <div class="form-group sign-in">
		            <button type="submit" class="btn btn-default">Reset password</button>
		        </div>
		        <input type="hidden" name="_token" value="{{ Session::token() }}">
		    </form>
		</div>
	</div>
@stop
 		