@extends('templates.default')  

@section('body-class')
  authentication sign-up
@stop

@section('navigation')
@stop

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<h1><img src="/img/template/logo_white.png"></h1>
			<p class="strapline">Great things happen when you share.</p>
		    <form class="form-vertical" role="form" method="post" action="{{ route('auth.signup') }}" autocomplete="off">

		    	<!--<div class="upload-image">
		    		<label>Add image</label>
		    		<input type="hidden" role="uploadcare-uploader" name="image" data-clearable="true">
		    	</div>-->
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

		        <div class="form-group{{ $errors->has('first_name') ? ' has-error': '' }}">
                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First name" value="{{ Request::old('first_name') ?: '' }}">
                    @if($errors->has('first_name'))
                        <span class="help-block">{{ $errors->first('first_name') }}</span> 
                    @endif
                </div>
                <div class="form-group{{ $errors->has('last_name') ? ' has-error': '' }}">
                    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last name" value="{{ Request::old('last_name') ?: '' }}">
                    @if($errors->has('last_name'))
                        <span class="help-block">{{ $errors->first('last_name') }}</span> 
                    @endif
                </div>
		        <div class="form-group{{ $errors->has('password') ? ' has-error' :''}}">
		            <input type="password" name="password" class="form-control" placeholder="Password" id="password">
		            @if($errors->has('password'))
		            	<span class="help-block">{{ $errors->first('password') }}</span>
		            @endif
		        </div>

		        
		    	

		        <div class="form-group sign-in">
		            <button type="submit" class="btn btn-default create">Create account</button>
		        </div>
		        <input type="hidden" name="_token" value="{{ Session::token() }}">
		    </form>
		    <p class="sign-in-cta"><a class="sign-up" href="{{ route('auth.signin') }}">Or Sign In</a></p>
		</div>
	</div>
@stop
 		