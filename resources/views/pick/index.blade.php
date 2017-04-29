@extends('templates.default')  

@section('title')
  {{ ucfirst($status->type) }}
@stop

@section('body-class')
  pick
  @if($status->source == 'YouTube')
    youtube
  @endif
@stop

@section('navigation')
    @include('templates.partials.navigation')
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3 row-inner">
            @if($status->source == 'YouTube')
                <div class="videoWrapper pick-{{ $status->type }}">
                    <iframe src="https://www.youtube.com/embed/{{ $status->item_id }} " frameborder="0" allowfullscreen></iframe>
                    <div class="details">
                        <p class="title"><a target="_blank" href="{{ $status->url }}">{{ $status->title }}</a></p>
                    </div> 
                </div>
            @else
                <div class="website-wrapper pick-{{ $status->type }}">
                    <div class="image">
                        <a href="{{ $status->url }}" target="_blank"><img src="{{ $status->image }}" /></a>
                        @if(Auth::user() == $status->user)
                            <div class="edit-pick">
                                <a href="{{ route('pick.edit', ['statusId' => $status->id]) }}">Edit</a>
                            </div>
                        @endif
                    </div>
                    <a href="{{ $status->url }}" target="_blank">
                        <div class="external-link"></div>
                    </a>
                    <div class="details">
                        <p class="title"><a target="_blank" href="{{ $status->url }}">{{ $status->title }}</a></p>
                    </div>        
                </div>
            @endif
                <div class="review">
                    <div class="comment">
                        <p class="text">{{ $status->review }} <a href="{{ route('profile.index', ['username' => $status->user->username]) }}">{{ $status->user->getNameOrUsername() }}</a></p>
                        <!--<p class="timing">{{ $status->created_at->diffForHumans() }}</p>-->
                    </div>
                </div>
                @foreach($status->replies as $reply)
                    <div class="reply">
                        <div class="comment">
                            <p class="text">{{ $reply->body }} <a href="{{ route('profile.index', ['username' => $reply->user->username]) }}">{{ $reply->user->getNameOrUsername() }}</a></p>
                        </div>
                    </div>
                @endforeach
                @if(Auth::user()->isFriendsWith($status->user) || Auth::user()->id == $user->id)
                    <form role="form" action="{{ route('status.reply', ['statusId' => $status->id]) }}" method="post" class="form-reply">
                        <div class="form-group{{ $errors->has("reply-{$status->id}") ? ' has-error': '' }}">
                            <textarea name="reply-{{ $status->id }}" class="form-control" rows="2" placeholder="Reply to this comment"></textarea>
                            @if($errors->has("reply-{$status->id}"))
                                <span class="help-block">{{ $errors->first("reply-{$status->id}") }}</span> 
                            @endif
                        </div>
                        <div class="reply-btn">
                            <input type="submit" value="Reply" class="btn btn-default btn-sm reply">
                        </div>
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