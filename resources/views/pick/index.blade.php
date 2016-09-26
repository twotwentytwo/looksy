@extends('templates.default')

@section('content')
<div class="row">
    <div class="col-lg-5">
        @if($status->type == 'YouTube')
        <div class="videoWrapper">
            <iframe src="https://www.youtube.com/embed/{{ $status->item_id }} " frameborder="0" allowfullscreen></iframe>
        </div>
        @elseif($status->type == 'Spotify')
        <div class="videoWrapper">
            <iframe src="https://embed.spotify.com/?uri=spotify:album:{{ $status->item_id }}&theme=white&view=coverart" width="300" height="300" frameborder="0" allowtransparency="true"></iframe>
        </div>
        @elseif($status->type == 'Web')
            <div class="website-wrapper">
                <div class="image">
                    <a href="{{ $status->url }}"><img src="{{ $status->image }}" /></a>
                </div>
                <div class="details">
                    <p class="source"><a href="#">{{ $status->source }}</a></p>
                    <p class="title"><a href="{{ $status->url }}">{{ $status->title }}</a></p>
                    
                </div>
            </div>
        @endif
        <div class="media">
            <a class="pull-left" href="{{ route('profile.index', ['username' => $status->user->username]) }}">
                <img class="media-object profile-image" alt="{{ $status->user->getNameOrUsername() }}" src="{{ $status->user->getAvatarUrl() }}">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><a href="{{ route('profile.index', ['username' => $status->user->username]) }}">{{ $status->user->getNameOrUsername() }}</a></h4>
                
                <ul class="list-inline">
                    <li>{{ $status->created_at->diffForHumans() }}</li>
                    <!--<li><a href="#">Like</a></li>
                    <li>10 likes</li>-->
                </ul>

                @foreach($status->replies as $reply)
                    <div class="media">
                        <a class="pull-left" href="{{ route('profile.index', ['username' => $reply->user->username]) }}">
                            <img class="media-object  profile-image" alt="{{ $reply->user->getNameOrUsername() }}" src="{{ $reply->user->getAvatarUrl() }}">
                        </a>
                        <div class="media-body">
                            <h5 class="media-heading"><a href="{{ route('profile.index', ['username' => $reply->user->username]) }}">{{ $reply->user->getNameOrUsername() }}</a></h5>
                            <p>{{ $reply->body }}</p>
                            <ul class="list-inline">
                                <li>{{ $reply->created_at->diffForHumans() }}</li>
                                 <!--<li><a href="#">Like</a></li>
                    <li>10 likes</li>-->
                            </ul>
                        </div>
                    </div>
                @endforeach

                @if($authUserIsFriend|| Auth::user()->id === $status->user->id)
                    <form role="form" action="{{ route('status.reply', ['statusId' => $status->id]) }}" method="post">
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
          
    </div>
    
</div>
@stop