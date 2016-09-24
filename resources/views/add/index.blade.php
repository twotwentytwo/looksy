@extends('templates.default')

@section('content')
	<div class="row">
	    <div class="col-lg-6">
	    	<h3>Share your latest pick with friends</h3>
	        <form role="form" action="{{ route('status.post') }}" method="post">
	            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
	                <textarea placeholder="Paste in a youtube video here {{ Auth::user()->getFirstNameOrUsername() }}" name="status" class="form-control" rows="2"></textarea>
	                @if($errors->has('status'))
	                	<span class="help-block">{{ $errors->first('status') }}</span>
	                @endif
	            </div>
	            <button type="submit" class="btn btn-default">Share</button>
	            <input type="hidden" name="_token" value="{{ Session::token() }}">
	        </form>
	        <hr>
	    </div>
	</div>
@stop