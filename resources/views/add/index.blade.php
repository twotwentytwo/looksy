@extends('templates.default')  

@section('title')
  Add Pick  
@stop

@section('navigation')
  @include('templates.partials.navigation')
@stop

@section('content')
 			<div class="row">
			    <div class="col-lg-6">
            @if(Auth::user()->statuses()->notReply()->count() >= 10)
              <p>You already have your top 10 picks... To add another you must remove an existing pick on your <a href="{{ route('profile.index', ['username' => Auth::user()->username]) }}">profile</a> page.</p>
            @else
              <form role="form" action="{{ route('status.post') }}" method="post" class="add-form">
                <h3>Paste in a URL</h3>
                <p>Share something to inspire your friends.</p>
                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                  <input placeholder="URL goes here" name="status" class="form-control add">
                  @if($errors->has('status'))
                    <span class="help-block">{{ $errors->first('status') }}</span>
                  @endif
                </div>

              <div class="preview">
                <h3>Preview</h3>
                <img src="" class="image" />
                <p class="title"></p>
              </div>

              <h3>Add details</h3>
              <p>Add a category and a review for your friends.</p>

              <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                <select name="type">
                  <option value="">Choose category</option>
                  <option value="film">Film</option>
                  <option value="tv">TV show</option>
                  <option value="video">Video clip</option>
                  <option value="music">Music</option>
                  <option value="podcast">Podcast</option>
                  <option value="web">Web</option>
                  <option value="news">News</option>
                  <option value="app">Mobile app</option>
                  <option value="food">Food &amp; drink</option>
                  <option value="art">Art</option>
                  <option value="book">Book / Writing</option>
                  <option value="shop">Shop</option>
                  <option value="location">Location</option>
                </select>
                @if($errors->has('category'))
                  <span class="help-block">{{ $errors->first('category') }}</span>
                @endif
              </div>
                <div class="form-group{{ $errors->has('review') ? ' has-error' : '' }}">
                  <textarea placeholder="Add a mini review" name="review" class="form-control add" rows="2"></textarea>
                  @if($errors->has('review'))
                    <span class="help-block">{{ $errors->first('review') }}</span>
                  @endif
                </div>
                <button type="submit" class="btn btn-default">Share</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
  			      </form>
            @endif
			    </div>
			</div>
@stop
 		
