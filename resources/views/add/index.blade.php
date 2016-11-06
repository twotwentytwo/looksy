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
              <form role="form" action="{{ route('status.post') }}" method="post" class="add-form">
                
                <div class="before-add">
                  <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    <input placeholder="Paste a URL here" name="status" class="form-control add">
                    @if($errors->has('status'))
                      <span class="help-block">Oooops... you need to enter a valid URL.</span>
                    @endif
                  </div>
                  <!--<p class="share-text">Why not share something to inspire your friends?</p>
                  <p class="share-text">Good things happen when we share.</p>-->
                </div>

              <div class="preview">
                <img src="" class="image" />
                <p class="title"></p>
              </div>

              <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }} categories-picker">
                  <select name="type" id="selectImage">
                    <option value="">Choose pick category</option>
                    <option value="film" data-img-src="/img/icons/categories/film.png">Film</option>
                    <option value="tv" data-img-src="/img/icons/categories/tv.png">TV show</option>
                    <option value="video" data-img-src="/img/icons/categories/video.png">Video clip</option>
                    <option value="music" data-img-src="/img/icons/categories/music.png">Music</option>
                    <option value="podcast" data-img-src="/img/icons/categories/podcast.png">Podcast</option>
                    <option value="web" data-img-src="/img/icons/categories/web.png">Web</option>
                    <option value="news" data-img-src="/img/icons/categories/news.png">News</option>
                    <option value="app" data-img-src="/img/icons/categories/app.png">Mobile app</option>
                    <option value="food" data-img-src="/img/icons/categories/food.png">Food &amp; drink</option>
                    <option value="art" data-img-src="/img/icons/categories/art.png">Art</option>
                    <option value="book" data-img-src="/img/icons/categories/book.png">Book / Writing</option>
                    <option value="shop" data-img-src="/img/icons/categories/shop.png">Shop</option>
                  </select>
                  @if($errors->has('category'))
                    <span class="help-block">{{ $errors->first('category') }}</span>
                  @endif
                  </div>
                  <div class="form-group{{ $errors->has('review') ? ' has-error' : '' }}">
                    <textarea placeholder="Add your review" name="review" class="form-control add" rows="2"></textarea>
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
 		
