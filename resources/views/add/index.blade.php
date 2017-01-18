@extends('templates.default')  

@section('title')
  Add Pick  
@stop

@section('navigation')
  @include('templates.partials.navigation')
@stop

@section('body-class')
  add-page
@stop

@section('content')
 			<div class="row">
			    <div class="col-md-6 col-md-offset-3">
            @if(Auth::user()->statuses()->notReply()->count() >= 5)
              <p class="limit">Whoops... you have reached your limit of 5 picks</p>
              <p>To add something new you have to <a href="{{ route('profile.index', ['username' => Auth::user()->username]) }}">edit &amp; remove</a> an old pick.</p>
            @else

              <p class="share-text">Why not share something to inspire your friends?</p>
              <form role="form" action="{{ route('status.post') }}" method="post" class="add-form">


                
                <div class="before-add">
                  <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    <input placeholder="Add URL for your pick" name="status" class="form-control add-input">
                    <!--<span class="help-block">Oooops... you need to enter a valid URL for your Pick.</span>-->
                    @if($errors->has('status'))
                      <span class="help-block">Oooops... you need to enter a valid URL for your Pick.</span>
                    @endif
                  </div>
                  <!-- 
                  
                  <p class="share-text">Good things happen when we share.</p>
                  -->
                </div>

              <div class="preview">
                
                <!--<img src="" class="image" />-->

                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }} categories-picker">
                  <select name="type" id="selectImage">
                    <option value="">Add category</option>
                    <option value="see">See</option>
                    <option value="watch">Watch</option>
                    <option value="read">Read</option>
                    <option value="taste">Taste</option>
                    <option value="listen">Listen</option>
                    <option value="buy">Buy</option>
                    <option value="play">Play</option>
                    <option value="use">Use</option>
                  </select>
                  @if($errors->has('category'))
                    <span class="help-block">{{ $errors->first('category') }}</span>
                  @endif
                </div>

                
                <!--
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                  <input placeholder="Title" name="title" class="form-control title">
                  @if($errors->has('title'))
                    <span class="help-block">{{ $errors->first('title') }}</span>
                  @endif
                </div>
                -->

                <div class="form-group{{ $errors->has('review') ? ' has-error' : '' }}">
                  <textarea placeholder="Add your review" name="review" class="form-control" rows="2"></textarea>
                  @if($errors->has('review'))
                    <span class="help-block">{{ $errors->first('review') }}</span>
                  @endif
                </div>
              </div>

              <div class="pick-btn">
                  <button type="submit" class="btn btn-default pick">Pick</button>
              </div>  
              <input type="hidden" name="_token" value="{{ Session::token() }}">
  			      </form>
            @endif
			    </div>
			</div>
@stop
 		
