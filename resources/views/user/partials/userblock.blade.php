<div class="media">
	<a class="pull-left" href="{{ route('profile.index', ['username' =>  $user->username]) }}">
    	<img class="media-object profile-image" alt="{{ $user->getNameOrUsername() }}" src="{{ $user->getAvatarUrl('40') }}">
	</a>
    <div class="media-body">
        <h4 class="media-heading"><a href="{{ route('profile.index', ['username' =>  $user->username]) }}">{{ $user->getNameOrUsername() }}</a></h4>
    </div>
    @if ($user->location2)
    	<p>{{ $user->location2 }}</p>
    @endif
</div>