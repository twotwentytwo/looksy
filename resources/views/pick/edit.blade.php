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
                    <option value="">Choose category</option>
                    <option value="see">See</option>
                    <option value="watch">Watch</option>
                    <option value="read">Read</option>
                    <option value="taste">Taste</option>
                    <option value="listen">Listen</option>
                    <option value="buy">Buy</option>
                    <option value="play">Play</option>
                    <option value="use">Use</option>
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