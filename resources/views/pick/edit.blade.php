@extends('templates.default')  

@section('title')
  Edit Pick
@stop

@section('body-class')
  edit pick
@stop

@section('navigation')
    @include('templates.partials.navigation')
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="website-wrapper">
                <div class="image">
                    <img src="{{ $status->image }}" />
                </div>
            </div>
            <form class="form-vertical" role="form" method="post" action="">
                <label>Image</label>

                <input type="hidden" role="uploadcare-uploader" name="image" data-clearable="true">

                <div class="form-group{{ $errors->has('title') ? ' has-error': '' }}">
                    <label>Title</label>

                    <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ $status->title }}">
                </div>

                <label>Category</label>

                <div class="categories-picker">

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

              </div>

                <div class="form-group{{ $errors->has('review') ? ' has-error': '' }}">
                    <label>Review</label>
                    
                    <input type="text" name="review" class="form-control" id="review" placeholder="Review" value="{{ $status->review }}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-default">Update</button>
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
    </div>
    @if(Auth::user()->id == $user->id)
        <div class="delete-link">
            <a href="{{ route('pick.remove', ['statusId' => $status->id]) }}"><img src="../../img/icons/remove.png" /></a>
        </div>
        <div class="back-link">
            <a href="{{ route('profile.index', ['username' => Auth::user()->username]) }}"><img src="{{asset('img/icons/back.png')}}" /></a>
        </div>
    @endif
@stop  