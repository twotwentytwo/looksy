@extends('templates.default')  

@section('body-class')
  authentication recover
@stop

@section('navigation')
@stop

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h1>PickList</h1>
			<p class="strapline">Great things happen when we share.</p>
		    <form class="form-vertical" role="form" method="post" action="{{ route('auth.recover') }}" autocomplete="off">
		        <div class="form-group{{ $errors->has('email') ? ' has-error' :''}}">
		            <input type="text" name="email" class="form-control" id="email" placeholder="Email address" value="{{ Request::old('email') ? : '' }}">
		            @if($errors->has('email'))
		            	<span class="help-block">{{ $errors->first('email') }}</span>
		            @endif
		        </div>
		        <div class="form-group sign-in">
		            <button type="submit" class="btn btn-default">Request reset</button>
		        </div>
		        <input type="hidden" name="_token" value="{{ Session::token() }}">
		    </form>
		</div>
	</div>
@stop
 		