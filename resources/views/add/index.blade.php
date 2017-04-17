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
              <p class="limit">Whoops! please choose one of your picks to replace.</p>
              <p>We limit picks to five at a time to keep things curated and fresh.</p>

              @foreach($statuses as $status)
                  <div class="website-wrapper pick pick-{{ $status->type }}">
                      <div class="image">
                          <a href="{{ route('pick.index', ['statusId' => $status->id]) }}"><img src="{{ $status->image }}" /></a>
                      </div>
                      <div class="details">
                          <p class="title"><a href="{{ route('pick.index', ['statusId' => $status->id]) }}">{{ $status->title }}</a></p>
                      </div>
                      @if(Auth::user()->id == $user->id)
                          <div class="delete-pick">
                              <a href="{{ route('pick.remove', ['statusId' => $status->id]) }}">Delete</a>
                          </div>
                      @endif
                  </div>
              @endforeach
              
            @else

              <p class="share-text">Inspire your friends – share something now</p>
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
 		
