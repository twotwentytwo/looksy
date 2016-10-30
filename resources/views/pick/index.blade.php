@extends('templates.default')  

@section('title')
  PickList
@stop

@section('body-class')
  pick
@stop

@section('navigation')
    @include('templates.partials.navigation')
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @if($status->source == 'YouTube')
                <div class="videoWrapper">
                    <iframe src="https://www.youtube.com/embed/{{ $status->item_id }} " frameborder="0" allowfullscreen></iframe>
                </div>
            @else
                <div class="website-wrapper">
                    <div class="type {{ $status->type }}">
                        <a href="{{ route('pick.category', ['category' => $status->type]) }}">
                            <img src="/img/icons/categories/{{ $status->type }}.png" />
                        </a>
                    </div>
                    <div class="image">
                        <a href="{{ $status->url }}" target="_blank"><img src="{{ $status->image }}" /></a>
                    </div>
                    <div class="details">
                        <p class="title"><a target="_blank" href="{{ $status->url }}">{{ $status->title }}</a> @if(isset($status->source)) @ {{ $status->source }} @endif</p>
                    </div>        
                </div>
            @endif
                <div class="review">
                    <div class="comment">
                        <p class="text">{{ $status->review }} by <a href="{{ route('profile.index', ['username' => $status->user->username]) }}">{{ $status->user->getNameOrUsername() }}</a> {{ $status->created_at->diffForHumans() }}</p>
                        
                    </div>
                </div>
                @foreach($status->replies as $reply)
                    <div class="reply">
                        <div class="comment">
                            <p class="text">{{ $reply->body }} by <a href="{{ route('profile.index', ['username' => $status->user->username]) }}">{{ $reply->user->getNameOrUsername() }}</a></p>
                            <p class="timing">{{ $reply->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                @endforeach
                @if(Auth::user()->isFriendsWith($status->user) || Auth::user()->id == $user->id)
                    <form role="form" action="{{ route('status.reply', ['statusId' => $status->id]) }}" method="post" class="form-reply">
                        <div class="form-group{{ $errors->has("reply-{$status->id}") ? ' has-error': '' }}">
                            <textarea name="reply-{{ $status->id }}" class="form-control" rows="2" placeholder="Reply to this"></textarea>
                            @if($errors->has("reply-{$status->id}"))
                                <span class="help-block">{{ $errors->first("reply-{$status->id}") }}</span> 
                            @endif
                        </div>
                        <input type="submit" value="Reply" class="btn btn-default btn-sm">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                    </form>
                @endif
            </div>
        </div>
        <div class="back-link">
            <a href="{{ url()->previous() }}"><img src="{{asset('../img/icons/back.png')}}" /></a>
        </div>
    </div>
@stop